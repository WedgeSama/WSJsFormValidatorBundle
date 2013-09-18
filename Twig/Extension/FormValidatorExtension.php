<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle\Twig\Extension;

use Symfony\Bridge\Twig\Form\TwigRendererInterface;
use Symfony\Component\Form\FormView;

class FormValidatorExtension extends \Twig_Extension {

    /**
     * This property is public so that it can be accessed directly from compiled
     * templates without having to call a getter, which slightly decreases performance.
     *
     * @var \Symfony\Component\Form\FormRendererInterface
     */
    public $renderer;

    /**
     *
     * @var boolean
     */
    private $enabled;

    public function __construct(TwigRendererInterface $renderer, $enabled) {
        $this->renderer = $renderer;
        $this->enabled = $enabled;
    }

    public function getFunctions() {
        return array(
            'form_validation' => new \Twig_Function_Method($this, 
                'renderValidation', 
                array(
                    'is_safe' => array(
                        'html'
                    )
                )),
            'constraint_name' => new \Twig_Function_Method($this, 
                'getConstraintName', 
                array(
                    'is_safe' => array(
                        'html'
                    )
                ))
        );
    }

    /**
     * Render Function Form validation
     *
     * @param FormView $view            
     * @param bool $prototype            
     *
     * @return string
     */
    public function renderValidation(FormView $view, $prototype = false) {
        if ($this->enabled) {
            $block = $prototype ? 'validation_prototype' : 'validation';
            return $this->renderer->searchAndRenderBlock($view, $block);
        }
        return "";
    }

    public function getConstraintName(FormView $view, $msg) {
        if ($this->enabled) {
            foreach ($view->vars['attr'] as $attr => $value) {
                if ($value == $msg)
                    return preg_replace("#^data-(.*)-msg$#", "$1", $attr);
            }
        }
        return "";
    }

    public function getName() {
        return 'ws.twig.extension.form_validator';
    }
}