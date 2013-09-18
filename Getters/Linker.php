<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle\Getters;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\DependencyInjection\ContainerInterface;
use WS\JsFormValidatorBundle\Rules\RulesInterface;

class Linker {

    /**
     * Association twig block's name => php class
     *
     * @var array
     */
    private $rules;

    public function __construct() {
        $this->rules = array();
    }

    public function addRule(RulesInterface $rule) {
        $this->rules = array_merge($this->rules, 
            array(
                $rule->getConstraintClass() => $rule
            ));
    }

    /**
     * Get the rule for the given constraint.
     *
     * @param Constraint $cst            
     * @throws \Exception
     * @return WS\JsFormValidatorBundle\Rules\RulesInterface
     */
    public function getRuleObject(Constraint $cst) {
        $class_name = get_class($cst);
        
        if (! array_key_exists($class_name, $this->rules))
            throw new \Exception(
                sprintf(
                    'The class "%s" does not have any match. Did you forgot to register the service rule?', 
                    $class_name));
        
        return $this->rules[$class_name];
    }
}