<?php

namespace Tanthammar\TallForms\LivewireComponents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Livewire\Component;
use Spatie\Tags\Tag;

class SpatieTags extends Component
{
    public $model;
    public $field;
    public $tags;
    public $search = "";
    public $options = [];
    public $errorClass;
    public $helpClass;
    public $color;
    public $rules = ['search' => 'string|between:3,50']; //overriden in addFromSearch(), prevents Livewire from squeaking
    /**
     * @param array $field
     * @param null|string $tags
     * @param null|Model $model
     */
    public function mount(array $field, $tags = '', $model = null)
    {
        $this->model = isset($model) && $model->exists ? $model : null;
        $this->field = $field; //observe that the field is an array here, not the class
        $this->tags = filled($this->model) && $model->exists
            ? $this->getExisting()
            : (filled($tags)
                ? explode(",", $tags)
                : []
            );
        $this->errorClass = config('tall-forms.component-attributes.error');
        $this->helpClass = config('tall-forms.component-attributes.help');
        $this->color = config('tall-forms.component-attributes.tags-color');
    }

    public function getExisting()
    {
        //using tags()->where('type') because bug: https://github.com/spatie/laravel-tags/issues/279#
        $query = filled(data_get($this->field, 'tagType'))
            ? $this->model->tags()->where('type', $this->field['tagType']) : $this->model->tags();
        return $query->pluck('name')->unique()->toArray();

    }

    public function updatedSearch()
    {
        $slug = Str::slug($this->search, '-');
        if (filled($slug)) {
            $this->options = array_filter(
                Tag::where("slug", 'like', '%' . $slug . '%')
                    ->where('type', data_get($this->field, 'tagType'))
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
        filled($this->model) && $this->model->exists
            ? $this->syncModelWithLocale($cleaned)
            : $this->emitUp('tallFillField', [
            'field' => $this->field['name'],
            'value' => implode(",", $cleaned)
        ]);
        $this->tags = $cleaned;
        $this->search = "";
        $this->dispatchBrowserEvent("tags-search-input-{$this->field['name']}-focus");

        //$this->notify();
    }

    public function syncModelWithLocale($cleaned)
    {
        if (filled(data_get($this->field, 'tagLocale'))) {
            $currentLocale = app()->getLocale();
            app()->setLocale($this->field['tagLocale']);
            $this->syncModel($cleaned);
            app()->setLocale($currentLocale);
        } else {
            $this->syncModel($cleaned);
        }
    }

    public function syncModel($cleaned)
    {
        filled(data_get($this->field, 'tagType'))
            ? $this->model->syncTagsWithType($cleaned, $this->field['tagType'])
            : $this->model->syncTags($cleaned);
    }

    public function addTag($tag)
    {
        $tag = Str::of($tag)->trim()->trim(",")->title();
        $tags = $tag->contains(',') ? explode(",", $tag) : null;
        if (is_array($tags)) {
            $this->tags = array_unique(array_merge($this->tags, $tags));
        } else {
            if (!in_array($tag, $this->tags)) array_push($this->tags, $tag->__toString());
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
        $this->validateOnly(
            'search',
            ['search' => data_get($this->field, 'tagsRules', 'string|between:3,50')],
            null,
            ['search' => 'tag'],
        );
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
