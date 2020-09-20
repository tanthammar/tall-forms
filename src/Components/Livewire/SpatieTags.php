<?php

namespace Tanthammar\TallForms\Components\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Tags\Tag;

class SpatieTags extends Component
{
    public $model;
    public $field;
    public $type;
    public $tags;
    public $search = "";
    public $options = [];
    public $help;
    public $errorMsg;
    public $tagLocale;
    public $errorClass;
    public $helpClass;
    public $color;


    public function mount(string $field,
                          ?string $tagType,
                          ?string $tags,
                          ?string $help,
                          ?string $errorMsg,
                          ?string $tagLocale,
                          string $errorClass,
                          string $helpClass,
                          string $color,
                          $model = null)
    {
        $this->model = isset($model) && $model->exists ? $model : null;
        $this->field = $field;
        $this->type = $tagType;
        $this->tags = filled($this->model) && $model->exists
            ? $this->getExisting()
            : (filled($tags)
                ? explode(",", $tags)
                : []
            );
        $this->help = $help;
        $this->errorMsg = $errorMsg;
        $this->tagLocale = $tagLocale;
        $this->errorClass = $errorClass;
        $this->helpClass = $helpClass;
        $this->color = $color;
    }

    public function getExisting()
    {
        $query = filled($this->type) ? $this->model->tagsWithType($this->type) : $this->model->tags;
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

    // OBSERVE: there is a syncTags() method in Tanthammar\TallForms\TallForm,
    // It's used for action="create" forms, create() method, to sync tags after the model is created
    // this method is triggered via wire:click.prevent="addFromOptions('{{$option}}')" in tags.blade
    public function syncTags()
    {
        $cleaned = collect(\Arr::sort($this->tags))->unique()->toArray();
        filled($this->model)
            ? $this->syncModelWithLocale($cleaned)
            : $this->emitUp('tallFillField', [
            'field' => $this->field,
            'value' => implode(",", $cleaned)
        ]);
        $this->tags = $cleaned;
        $this->search = "";

        //$this->notify();
    }

    public function syncModelWithLocale($cleaned)
    {
        if (filled($this->tagLocale)) {
            $currentLocale = app()->getLocale();
            app()->setLocale($this->tagLocale);
            $this->syncModel($cleaned);
            app()->setLocale($currentLocale);
        } else {
            $this->syncModel($cleaned);
        }
    }

    public function syncModel($cleaned)
    {
        filled($this->type) ? $this->model->syncTagsWithType($cleaned, $this->type) : $this->model->syncTags($cleaned);
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
        //$this->search = ""; not needed called in syncTags() later
        //$this->tags = array_values($this->tags);
        $this->syncTags();
    }

    public function addFromSearch()
    {
        $this->validate($this->getRules());
        $this->addTag($this->search);
        //$this->search = ""; not needed called in syncTags() later
    }

    public function addFromOptions($option)
    {
        //validate that the option has not been modified in frontend
        if (in_array($option, $this->options)) {
            $this->addTag($option);
        }
        //$this->search = ""; //keep the search value to avoid rerendering of the component and to let the user continue typing from the value they had
    }

    public function render()
    {
        return view('tall-forms::livewire.spatie-tags');
    }
}
