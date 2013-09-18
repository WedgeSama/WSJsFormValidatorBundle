<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class CheckboxExtension extends AbstractTypeExtension {

    public function getExtendedType() {
        return 'checkbox';
    }

    public function buildView(FormView $view, FormInterface $form, 
        array $options) {
        if ($form->getConfig()
            ->getAttribute('expanded', false))
            $view->vars['attr']['data-expanded'] = $view->parent->vars['id'];
    }
}