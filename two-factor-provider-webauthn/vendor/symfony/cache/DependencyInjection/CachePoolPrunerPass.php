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

use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\Cache\PruneableInterface;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\ContainerBuilder;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\DependencyInjection\Reference;

/**
 * @author Rob Frawley 2nd <rmf@src.run>
 */
class CachePoolPrunerPass implements CompilerPassInterface
{
    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('console.command.cache_pool_prune')) {
            return;
        }

        $services = [];

        foreach ($container->findTaggedServiceIds('cache.pool') as $id => $tags) {
            $class = $container->getParameterBag()->resolveValue($container->getDefinition($id)->getClass());

            if (!$reflection = $container->getReflectionClass($class)) {
                throw new InvalidArgumentException(sprintf('Class "%s" used for service "%s" cannot be found.', $class, $id));
            }

            if ($reflection->implementsInterface(PruneableInterface::class)) {
                $services[$id] = new Reference($id);
            }
        }

        $container->getDefinition('console.command.cache_pool_prune')->replaceArgument(0, new IteratorArgument($services));
    }
}
