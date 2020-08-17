<?php

namespace Tanthammar\TallForms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Tags\Tag;

class TagsField extends Component
{

    public $model;
    public $type;
    public $tags;
    public $search = "";
    public $options = [];
    public $field;
    public $help;
    public $errorMsg;

    public function mount(string $field, string $tagType = null, Model $model = null, string $tags = null, string $help = null, string $errorMsg = null)
    {
        $this->model = $model;
        $this->type = $tagType;
        $this->tags = filled($this->model)
            ? $this->getExisting()
            : (filled($tags)
                ? explode(",", $tags)
                : []
            );
        $this->field = $field;
        $this->help = $help;
        $this->errorMsg = $errorMsg;
    }

    public function getExisting()
    {
        $query = filled($this->type) ? $this->model->tagsWithType($this->type) : $this->model->tags;
        clock($this->type);
        return array_filter(
            $query->pluck('name')->unique()->toArray()
        );
    }

    public function getRules()
    {
        return ['search' => 'nullable|string|between:3,40'];
    }

    public function updatedSearch()
    {
        $slug = Str::slug($this->search, '-');
        if (filled($slug)) {
            $this->options = array_filter(
                Tag::where("slug", 'like', '%' . $slug . '%')
                    ->where('type', $this->type)
                    ->orderBy("name", 'asc')
                    ->take(10)
                    ->pluck('name')
                    ->unique()
                    ->toArray()
            );
        }
    }

    public function syncTags()
    {
        $cleaned = collect(array_sort($this->tags))->unique()->toArray();
        filled($this->model)
            ? (filled($this->type) ? $this->model->syncTagsWithType($cleaned, $this->type) : $this->model->syncTags($cleaned))
            : $this->emitUp('fillField', [
            'field' => $this->field,
            'value' => implode(",", $cleaned)
        ]);
        $this->tags = $cleaned;
        $this->search = "";

        //$this->notify();
    }

    public function addTag($tag)
    {
        $tag = Str::of($tag)->trim()->trim(",")->title()->__toString();
        if (!in_array($tag, $this->tags)) {
            array_push($this->tags, $tag);
        }
        $this->syncTags();
    }

    public function removeTag(int $i): void
    {
        unset($this->tags[$i]);
        $this->search = "";
        //$this->tags = array_values($this->tags);
        $this->syncTags();
    }

    public function addFromSearch()
    {
        $this->validate($this->getRules());
        $this->addTag($this->search);
        $this->search = "";
    }

    public function addFromOptions($option)
    {
        //validate that the option has not been modified in frontend
        if (in_array($option, $this->options)) {
            $this->addTag($option);
        }
        $this->search = "";
    }

    public function render()
    {
        return view('tall-forms::livewire.tags');
    }
}
