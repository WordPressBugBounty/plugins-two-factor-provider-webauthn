<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\Cache\Messenger;

use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Symfony\Component\Cache\CacheItem;

/**
 * @internal
 */
final class EarlyExpirationResult
{
    public function __construct(public readonly CacheItem $item)
    {
    }
}
