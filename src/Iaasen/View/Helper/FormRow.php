<?php
/**
 * User: ingvar.aasen
 * Date: 2026-06-09
 */

namespace Iaasen\View\Helper;

class FormRow extends \Laminas\Form\View\Helper\FormRow
{
    public function __construct()
    {
        $this->setLabelAttributes(['class' => 'form-label']);
    }

    public function render(\Laminas\Form\ElementInterface $element, ?string $labelPosition = null): string
    {
        $view = $this->getView();
        return sprintf(
            '<div class="form-group">%s%s%s</div>',
            $view->formLabel($element),
            $view->formElement($element),
            $view->formElementErrors($element)
        );
    }

}
