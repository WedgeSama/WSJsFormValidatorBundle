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

class Type extends RulesModel {

    public function parseAttributes(Constraint $cst) {
        $type = $cst->type;
        $allowed = array(
                'float', 
                'int', 
                'double', 
                'numeric', 
                'long', 
                'null', 
                'string', 
                'bool' 
        );
        
        if (in_array($type, $allowed)) {
            $type = preg_replace('#^bool$#', 'boolean', $type);
            
            $this->attibutes['data-type'] = "true";
            $this->attibutes['data-type-info'] = $type;
            $this->attibutes['data-type-msg'] = $this->trans->trans(
                    $cst->message, 
                    array(
                            '{{ type }}' => $type 
                    ), "validators");
        }
        
        return $this->attibutes;
    }

}