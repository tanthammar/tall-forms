<?php


namespace Tanthammar\TallForms;


class Trix extends BaseField
{
    public $type = 'trix';
    public $align_label_top = true;
    public bool $includeScript = false;
    public bool $allowAttachments = false;
    public string $attachmentKey;
    public array $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/tiff', 'image/tif', 'image/gif'];
    public int $maxAttachments = 1;
    public int $maxKB = 1024;

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
     * <br>Default = 1024
     * @param int $kiloBytes
     * @return $this
     */
    public function maxKB(int $kiloBytes): self
    {
        $this->maxKB = $kiloBytes;
        return $this;
    }

    /**
     * Default = 1 attachment allowed
     * @param int $integer
     * @return $this
     */
    public function maxAttachments(int $count): self
    {
        $this->maxAttachments = $count;
        return $this;
    }


    /**
     * You still have to validate in backend, this is just a simple frontend validation
     * <br>Default = ['image/jpeg', 'image/jpg', 'image/png', 'image/tiff', 'image/tif', 'image/gif']
     *
     * @param array $array
     * @return $this
     */
    public function allowedMimeTypes(array $array): self
    {
        $this->allowedMimeTypes = $array;
        return $this;
    }
}
