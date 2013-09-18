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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class WSJsFormValidatorExtension extends Extension {

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        foreach ($config as $key => $value)
            $container->setParameter('ws_js_form_validator.' . $key, $value);
        
        $loader = new Loader\YamlFileLoader($container, 
            new FileLocator(__DIR__ . '/../Resources/config'));
        
        if ($container->getParameter('ws_js_form_validator.enabled')) {
            $loader->load('services.yml');
            $loader->load('match_list.yml');
        }
        
        $loader->load('twig.yml');
    }
}
