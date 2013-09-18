<?php
/*
 * This file is part of the WSJsFormValidatorBundle package.
 *
 * (c) Benjamin Georgeault <https://github.com/WedgeSama/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WS\JsFormValidatorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use WS\JsFormValidatorBundle\DependencyInjection\Compiler\FormPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use WS\JsFormValidatorBundle\DependencyInjection\Compiler\LinkerPass;

class WSJsFormValidatorBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        parent::build($container);
        
        $container->addCompilerPass(new FormPass());
        $container->addCompilerPass(new LinkerPass());
    }
}
