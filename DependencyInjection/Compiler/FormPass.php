<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FormPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        if ($container->getParameter('ws_js_form_validator.enabled')) {
            $resources = $container->getParameter('twig.form.resources');
            
            $resources[] = 'WSJsFormValidatorBundle:Form:form_layout.html.twig';
            $resources[] = 'WSJsFormValidatorBundle:Form:js_layout.html.twig';
            
            $container->setParameter('twig.form.resources', $resources);
        }
    }
}