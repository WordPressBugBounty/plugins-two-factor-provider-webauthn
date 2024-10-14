<?php

declare(strict_types = 1);

namespace WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Sop\X501\ASN1\AttributeValue;

use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Sop\X501\ASN1\AttributeType;
use WildWolf\WordPress\TwoFactorWebAuthn\Vendor\Sop\X501\ASN1\AttributeValue\Feature\DirectoryString;

/**
 * 'organizationalUnitName' attribute value.
 *
 * @see https://www.itu.int/ITU-T/formal-language/itu-t/x/x520/2012/SelectedAttributeTypes.html#SelectedAttributeTypes.organizationalUnitName
 */
class OrganizationalUnitNameValue extends DirectoryString
{
    /**
     * Constructor.
     *
     * @param string $value      String value
     * @param int    $string_tag Syntax choice
     */
    public function __construct(string $value,
        int $string_tag = DirectoryString::UTF8)
    {
        $this->_oid = AttributeType::OID_ORGANIZATIONAL_UNIT_NAME;
        parent::__construct($value, $string_tag);
    }
}
