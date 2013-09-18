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

class Length extends RulesModel {

    public function parseAttributes(Constraint $cst) {
        $min = $cst->min;
        $max = $cst->max;
        
        $this->attibutes['data-length'] = "true";
        
        if ($min != null && $min == $max) {
            $this->attibutes['data-length-exact'] = $min;
            $this->attibutes['data-length-msg'] = $this->pluralize(
                $this->trans->trans($cst->exactMessage, 
                    array(
                        "{{ limit }}" => $min
                    ), "validators"), $min);
            
            return $this->attibutes;
        }
        
        if ($min != null) {
            $this->attibutes['data-length-min'] = $min;
            $this->attibutes['data-length-min-msg'] = $this->pluralize(
                $this->trans->trans($cst->minMessage, 
                    array(
                        "{{ limit }}" => $min
                    ), "validators"), $min);
        }
        
        if ($max != null) {
            $this->attibutes['data-length-max'] = $max;
            $this->attibutes['data-length-max-msg'] = $this->pluralize(
                $this->trans->trans($cst->maxMessage, 
                    array(
                        "{{ limit }}" => $max
                    ), "validators"), $max);
        }
        
        return $this->attibutes;
    }
}