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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class LinkerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        if (! $container->hasDefinition('ws.validator_linker'))
            return;
        
        $definition = $container->getDefinition('ws.validator_linker');
        $taggedServices = $container->findTaggedServiceIds(
            'ws.validator.linker');
        
        foreach ($taggedServices as $id => $attributes)
            $definition->addMethodCall('addRule', 
                array(
                    new Reference($id)
                ));
    }
}