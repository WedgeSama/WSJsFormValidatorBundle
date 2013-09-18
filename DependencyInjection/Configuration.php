<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration implements ConfigurationInterface {

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ws_js_form_validator');
        
        $this->addEnabled($rootNode);
        $this->addConfig($rootNode);
        
        return $treeBuilder;
    }
    
    private function addEnabled(ArrayNodeDefinition $rootNode) {
        $rootNode
            ->children()
                ->booleanNode('enabled')
                    ->defaultTrue()
                ->end()
            ->end();
    }
    
    private function addConfig(ArrayNodeDefinition $rootNode) {
        $rootNode
            ->children()
                ->arrayNode('config')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('containerSuffix')
                            ->defaultValue("_errors")
                        ->end()
                        ->booleanNode('onChange')
                            ->defaultTrue()
                        ->end()
                        ->booleanNode('onLive')
                            ->defaultTrue()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
