<?php

namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;

class TagsSearch extends Tags
{

    public function render(): View
    {
        return view('tall-forms::components.tags-search');
    }
}
