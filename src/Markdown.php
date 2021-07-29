<?php


namespace Tanthammar\TallForms;


class Markdown extends BaseField
{
    public array $options = [];
    public string $syncOn = 'change';
    public null|string $placeholder = null;
    public bool $includeScript = false;

    public function overrides(): self
    {
        $this->type = 'markdown';
        $this->align_label_top = true;
        $this->deferEntangle();
        return $this;
    }

    /**
     * [EasyMDE config](https://github.com/Ionaru/easy-markdown-editor#configuration)
     */
    public function options(array $config): self
    {
        $this->options = $config;
        return $this;
    }

    /**
     * [any CodeMirror event](https://codemirror.net/doc/manual.html#events)
     */
    public function syncOn(string $event = 'blur'): self
    {
        $this->syncOn = $event;
        return $this;
    }

    public function syncOnChange(): self
    {
        $this->syncOn = 'change';
        return $this;
    }

    public function syncOnBlur(): self
    {
        $this->syncOn = 'blur';
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     * Push external (cdn-links) for required scripts and styles to the layout
     * Else, you must import them yourself
     * Only pushed once
     */
    public function includeExternalScripts(): self
    {
        $this->includeScript = true;
        return $this;
    }
}
