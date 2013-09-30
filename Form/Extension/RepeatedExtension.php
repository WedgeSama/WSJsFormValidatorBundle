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
use Symfony\Component\Form\FormBuilderInterface;

class RepeatedExtension extends AbstractTypeExtension {

    public function getExtendedType() {
        return 'repeated';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $childs = $builder->all();
        
        $first_name = $options['first_name'];
        $first = $childs[$first_name];
        
        $first->setAttribute('repeated', true);
    }
}