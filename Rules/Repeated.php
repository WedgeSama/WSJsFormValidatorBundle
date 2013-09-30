<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle\Rules;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use WS\JsFormValidatorBundle\Getters\Linker;

class Repeated extends RulesModel {

    /**
     *
     * @var Linker
     */
    protected $linker;

    public function initValidator(Linker $linker) {
        $this->linker = $linker;
    }

    public function parseAttributes(Constraint $cst) {
        return array();
    }

    /**
     * Specifique method to handle the repeated type "constraint"
     *
     * @param FormView $view
     * @param FormInterface $form
     * @return multitype:
     */
    public function getRepeatedAttributes(FormView $view, FormInterface $form) {
        $parent = $form->getParent();
        $config = $parent->getConfig();
        
        $msg = $config->getOption('invalid_message', "");
        $second_name = $config->getOption('second_name', "");
        $group_id = $view->parent->vars['id'];
        
        $this->attibutes['data-repeated'] = "true";
        $this->attibutes['data-repeated-id'] = $group_id . "_" . $second_name;
        $this->attibutes['data-repeated-msg'] = $this->trans->trans($msg, 
            array(), "validators");
        
        // get constraints from parent
        if ($parent->getParent())
            $entityCst = $parent->getParent()
                ->getConfig()
                ->getAttribute('constraints');
        
        $options = $config->getOptions();
        
        $csts = is_array($options['constraints']) ? $options['constraints'] : array();
        
        if (isset($entityCst) &&
             in_array($parent->getName(), array_keys($entityCst)))
            $csts = array_merge($csts, $entityCst[$parent->getName()]);
        
        foreach ($csts as $cst)
            $this->attibutes = array_merge($this->attibutes, 
                $this->linker->getRuleObject($cst)
                    ->parseAttributes($cst));
        
        return $this->attibutes;
    }
}