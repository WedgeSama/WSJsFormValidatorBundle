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

class False extends RulesModel {

    public function parseAttributes(Constraint $cst) {
        $this->attibutes['data-false'] = "true";
        $this->attibutes['data-false-msg'] = $this->trans->trans($cst->message, 
            array(), "validators");
        
        return $this->attibutes;
    }
}