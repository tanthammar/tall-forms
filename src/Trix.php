<?php


namespace Tanthammar\TallForms;


class Trix extends BaseField
{
    public $type = 'trix';
    public $align_label_top = true;
    public bool $includeScript = false;
    public bool $allowAttachments = false;
    public string $attachmentKey;
    public int $maxKB = 1024;
    public string $sizeLimitAlert = 'The file is larger then allowed max bytes limit.';

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

    /**
     * The component property used for livewire file uploads triggerd by the Trix attachment button
     * @param string $componentPropertyName
     * @return $this
     */
    public function allowAttachments(string $componentPropertyName): self
    {
        $this->allowAttachments = true;
        $this->attachmentKey = $componentPropertyName;
        return $this;
    }

    /**
     * You still have to validate in backend, this is just a simple frontend validation
     * @param int $kiloBytes
     * @return $this
     */
    public function maxKB(int $kiloBytes): self
    {
        $this->maxKB = $kiloBytes;
        return $this;
    }

    public function sizeLimitAlert(string $message): self
    {
        $this->sizeLimitAlert = $message;
        return $this;
    }
}
