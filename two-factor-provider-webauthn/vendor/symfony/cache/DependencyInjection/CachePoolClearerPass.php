<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\Cache\DependencyInjection;

use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\Reference;

/**
 * @author Nicolas Grekas <p@tchwork.com>
 */
class CachePoolClearerPass implements CompilerPassInterface
{
    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $container->getParameterBag()->remove('cache.prefix.seed');

        foreach ($container->findTaggedServiceIds('cache.pool.clearer') as $id => $attr) {
            $clearer = $container->getDefinition($id);
            $pools = [];
            foreach ($clearer->getArgument(0) as $name => $ref) {
                if ($container->hasDefinition($ref)) {
                    $pools[$name] = new Reference($ref);
                }
            }
            $clearer->replaceArgument(0, $pools);
        }
    }
}
