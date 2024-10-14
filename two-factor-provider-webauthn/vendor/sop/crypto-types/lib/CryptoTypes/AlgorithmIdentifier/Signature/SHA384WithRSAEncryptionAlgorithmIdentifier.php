<?php

declare(strict_types = 1);

namespace WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Sop\CryptoTypes\AlgorithmIdentifier\Signature;

/**
 * RSA with SHA-384 signature algorithm identifier.
 *
 * @see https://tools.ietf.org/html/rfc4055#section-5
 */
class SHA384WithRSAEncryptionAlgorithmIdentifier extends RFC4055RSASignatureAlgorithmIdentifier
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->_oid = self::OID_SHA384_WITH_RSA_ENCRYPTION;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'sha384WithRSAEncryption';
    }
}
