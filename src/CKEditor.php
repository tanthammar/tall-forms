<?php

namespace Tanthammar\TallForms;

use Mertasan\FormBuilder\Exceptions\InvalidArrayFieldType;
use Mertasan\FormBuilder\Exceptions\InvalidCKEditorType;
use Tanthammar\TallForms\Traits\IsCKEditorField;

class CKEditor extends BaseField {

    public $type = 'ckeditor';
    public $align_label_top = true;
    public $textarea_rows = 5;
    public bool $includeScript = false;
    protected string $editorVersion = "24.0.0";
    public array $editorConfig = [];
    public string $editorTypeKey = "classic";
    public string $editorType = "ClassicEditor";
    public string $editorScript;
    private array $editorTypes = [
        "classic" => "ClassicEditor",
        "inline" => "InlineEditor",
        "balloon" => "BalloonEditor",
        "balloon-block" => "BalloonEditor",
    ];
    public $required = false;

    /**
     * Push external (cdn-links) for required scripts and styles to the layout
     * Else, you must import them yourself
     * Only pushed once
     */
    public function includeExternalScripts (): self
    {
        $this->includeScript = true;
        return $this;
    }

    public function rows(int $rows = 5): Textarea
    {
        $this->textarea_rows = $rows;
        return $this;
    }

    public function editorConfig ($config = []): self
    {
        $this->editorConfig = $config;
        return $this;
    }

    public function editorType (string $type, $scriptUrl = NULL): self
    {
        $this->setEditorType($type);
        if($scriptUrl) $this->editorScript($scriptUrl);
        return $this;
    }

    public function editorScript(string $url){
        $this->editorScript = $url;
        return $this;
    }

    public function required(): self
    {
        $this->required = true;
        return $this;
    }

    public function getEditorConfig(){
        return json_encode(filled($this->editorConfig));
    }

    protected function setEditorType ($type): void
    {
        throw_if(!isset($this->editorTypes[$type]),
            new InvalidCKEditorType($this->editorTypes, $this->name, $this->type)
        );
        $this->editorTypeKey = $type;
        $this->editorType = $this->editorTypes[$type];
        $this->setCDN();
    }

    protected function setCDN(): void {
        $this->editorScript = '//cdn.ckeditor.com/ckeditor5/'.$this->editorVersion.'/'.$this->editorTypeKey.'/ckeditor.js';
    }
}
