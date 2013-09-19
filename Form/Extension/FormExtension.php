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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\Form\FormBuilderInterface;
use WS\JsFormValidatorBundle\Getters\Constraints;
use WS\JsFormValidatorBundle\Getters\Linker;

class FormExtension extends AbstractTypeExtension {

    /**
     *
     * @var Constraints
     */
    protected $getter;

    /**
     *
     * @var Linker
     */
    protected $linker;

    /**
     *
     * @var boolean
     */
    protected $config;

    public function initValidator(Constraints $getter, Linker $linker, 
        array $config) {
        $this->getter = $getter;
        $this->linker = $linker;
        $this->config = $config;
    }

    public function getExtendedType() {
        return 'form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $defaults = $this->config;
        $resolver->setDefaults(
            array(
                'validator_config' => $defaults
            ))
            ->setNormalizers(
            array(
                'validator_config' => function (Options $options, $configs) use(
                $defaults) {
                    return array_merge($defaults, $configs);
                }
            ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $groups = is_array($options['validation_groups']) ? $options['validation_groups'] : array(
            "Default"
        );
        
        if (isset($options['data_class']) && $options['data_class'] != "") {
            $entityCst = $this->getter->getEntityConstraints(
                $options['data_class'], $groups);
            
            $builder->setAttribute('constraints', $entityCst);
        }
    }

    public function buildView(FormView $view, FormInterface $form, 
        array $options) {
        if ($form->getParent())
            $entityCst = $form->getParent()
                ->getConfig()
                ->getAttribute('constraints');
        
        $csts = is_array($options['constraints']) ? $options['constraints'] : array();
        
        if (isset($entityCst) &&
             in_array($form->getName(), array_keys($entityCst)))
            $csts = array_merge($csts, $entityCst[$form->getName()]);
        
        foreach ($csts as $cst)
            $view->vars['attr'] = array_merge($view->vars['attr'], 
                $this->linker->getRuleObject($cst)
                    ->parseAttributes($cst));
        
        if ($form->isRoot()) {
            $view->vars['attr']['name'] = $form->getName();
            $view->vars['validator_config'] = $options['validator_config'];
        }
    }
}