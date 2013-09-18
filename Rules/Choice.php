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

class Choice extends RulesModel {

    public function parseAttributes(Constraint $cst) {
        $min = $cst->min;
        $max = $cst->max;
        $multiple = $cst->multiple;
        
        $this->attibutes['data-choice'] = "true";
        
        if ($multiple) {
            if ($min != null) {
                $this->attibutes['data-choice-min'] = $min;
                $this->attibutes['data-choice-min-msg'] = $this->pluralize(
                    $this->trans->trans($cst->minMessage, 
                        array(
                            "{{ limit }}" => $min
                        ), "validators"), $min);
            }
            
            if ($max != null) {
                $this->attibutes['data-choice-max'] = $max;
                $this->attibutes['data-choice-max-msg'] = $this->pluralize(
                    $this->trans->trans($cst->maxMessage, 
                        array(
                            "{{ limit }}" => $max
                        ), "validators"), $max);
            }
        }
        
        return $this->attibutes;
    }
}