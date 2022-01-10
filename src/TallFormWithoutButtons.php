<?php

namespace Tanthammar\TallForms;

abstract class TallFormWithoutButtons extends TallFormComponent
{
    protected string $view = '';

    protected function getForm(): object
    {
        if (!is_object($this->memoizedForm)) {
            $defaults = [
                'showSave' => false,
                'showDelete' => false,
                'showReset' => false,
                'showGoBack' => false,
                'wrapWithView' => false,
            ];

            $defaults = array_merge(config('tall-forms.form'), $defaults);

            $this->memoizedForm = method_exists($this, 'formAttr')
                ? (object)array_merge($defaults, $this->formAttr())
                : (object)$defaults;
        }
        return $this->memoizedForm;
    }

    public function render()
    {
        $form = $this->getForm();
        $view = view($this->view, [
            'form' => $form,
            'fields' => $this->getFieldsNested(),
        ]);
        if (filled($form->layout)) $view->layout($form->layout);
        if (filled($form->slot)) $view->slot($form->slot);
        return $view;
    }
}
