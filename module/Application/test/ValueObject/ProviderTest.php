<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    ApplicationTest\ValueObject
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace ApplicationTest\ValueObject;

use PHPUnit\Framework\TestCase;
use Application\ValueObject\Provider;

/**
 * ProviderTest class
 *
 * @package ApplicationTest\ValueObject
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class ProviderTest extends TestCase
{
    /**
     * Test provider constants exist
     * 
     * @return void
     */
    public function testProviderConstantsExist() : void
    {
        $mailer = new \ReflectionClass(Provider::class);
        $this->assertArrayHasKey('TITLE', $mailer->getConstants());
        $this->assertArrayHasKey('LAST_NAME', $mailer->getConstants());
        $this->assertArrayHasKey('FIRST_NAME', $mailer->getConstants());
        $this->assertArrayHasKey('COMPANY_FORM', $mailer->getConstants());
        $this->assertArrayHasKey('BUSINESS_TYPE', $mailer->getConstants());
        $this->assertArrayHasKey('STREET', $mailer->getConstants());
        $this->assertArrayHasKey('HOUSE_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('POSTCODE', $mailer->getConstants());
        $this->assertArrayHasKey('CITY', $mailer->getConstants());
        $this->assertArrayHasKey('COUNTRY', $mailer->getConstants());
        $this->assertArrayHasKey('STATE', $mailer->getConstants());
        $this->assertArrayHasKey('PHONE_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('FAX_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('MOBILE_PHONE_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('CONTACT_EMAIL', $mailer->getConstants());
        $this->assertArrayHasKey('TAX_ID_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('HOSTNAME', $mailer->getConstants());
        $this->assertArrayHasKey('YEAR_OF_PUBLICATION', $mailer->getConstants());
    }
    
    /**
     * Test provier constants required
     * 
     * An address without a street is possible
     * 
     * @return void
     */
    public function testProviderConstantsRequired() : void
    {
        $this->assertNotEmpty(Provider::LAST_NAME, 'Provider last name cannot be empty');
        $this->assertNotEmpty(Provider::FIRST_NAME, 'Provider first name cannot be empty');
        $this->assertNotEmpty(Provider::COMPANY_FORM, 'Provider company form cannot be empty');
        $this->assertNotEmpty(Provider::CITY, 'Provider city cannot be empty');
        $this->assertNotEmpty(Provider::COUNTRY, 'Provider country cannot be empty');
        $this->assertNotEmpty(Provider::CONTACT_EMAIL, 'Provider contact email address cannot be empty');
        $this->assertNotEmpty(Provider::HOSTNAME, 'Provider hostname cannot be empty');
        $this->assertNotEmpty(Provider::YEAR_OF_PUBLICATION, 'Provider year of publication cannot be empty');
    }
}
