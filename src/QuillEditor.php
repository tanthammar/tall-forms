<?php

namespace Tanthammar\TallForms;

class QuillEditor extends BaseField
{
    public $type = 'quill-editor';
    public $theme = 'snow';
    public $allowMedia = false;
    public $quillAdvanced = false;
    public $allowFullScreen = false;

    /* theme
     * set quill theme, default = 'snow'
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function theme($prop = 'snow'): self
    {
        $this->theme = $prop;

        return $this;
    }

    /* quillAdvanced
     * set if quillAdvanced true/false - default: false
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function quillAdvanced(): self
    {
        $this->quillAdvanced = true;

        return $this;
    }

    /* allowMedia
     * allow media in quill editor. default = false
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function allowMedia() : self
    {
        $this->allowMedia = true;

        return $this;
    }

    /* allowFullScreen
     * allow media in quill editor. default = false
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function allowFullScreen() : self
    {
        $this->allowFullScreen = true;

        return $this;
    }
}
