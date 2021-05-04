<?php

namespace Tanthammar\TallForms;

class QuillEditor extends BaseField
{
    public $type = 'quill-editor';
    public $theme = 'snow';
    public $allowMedia = false;
    public $quillAdvanced = false;

    /* theme
     * set quill theme, default = 'snow'
     * @author Arif Pavel
     * @since 03 May 21
     * @version v8.0.0
     * @param mixed
     * @return null
    */
    public function theme($prop): self
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
    public function quillAdvanced($prop): self
    {
        $this->quillAdvanced = $prop;

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
    public function allowMedia($prop) : self
    {
        $this->allowMedia = $prop;

        return $this;
    }
}
