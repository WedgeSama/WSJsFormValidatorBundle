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
use Symfony\Component\Translation\TranslatorInterface;

abstract class RulesModel implements RulesInterface {

    /**
     *
     * @var Constraint
     */
    protected $constraint;

    /**
     * Set public to be more faster.
     *
     * @var array
     */
    protected $attibutes;

    /**
     *
     * @var TranslatorInterface
     */
    protected $trans;

    protected $class;

    public function __construct(TranslatorInterface $trans, $class) {
        $this->attibutes = array();
        $this->constraint = null;
        $this->trans = $trans;
        $this->class = $class;
        $this->parsleyName = "";
    }

    public function getConstraintClass() {
        return $this->class;
    }

    protected function pluralize($msg, $value) {
        $plurial = explode('|', $msg);
        
        if ($value > 1)
            return $plurial[1];
        return $plurial[0];
    }
}