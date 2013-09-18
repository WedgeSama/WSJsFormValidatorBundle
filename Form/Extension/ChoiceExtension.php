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
use Symfony\Component\Form\FormBuilderInterface;

class ChoiceExtension extends AbstractTypeExtension {

    public function getExtendedType() {
        return 'choice';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        if ($options['expanded']) {
            foreach ($builder->all() as $child) {
                $child->setAttribute('expanded', true);
            }
        }
    }
}