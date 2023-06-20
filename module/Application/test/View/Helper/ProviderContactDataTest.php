<?php

/**
 * This file is part of base application with Laminas MVC framework
 *
 * @package    ApplicationTest\View\Helper
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/base-application
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace ApplicationTest\View\Helper;

use PHPUnit\Framework\TestCase;
use Application\View\Helper\ProviderContactData;
use Application\ValueObject\Provider;

/**
 * ProviderContactDataTest class
 *
 * @package ApplicationTest\View\Helper
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class ProviderContactDataTest extends TestCase
{
    /**
     * @var ProviderName
     */
    public $helper;
    
    /**
     * Sets up the fixture.
     * 
     * This method is called before a test is executed.
     * 
     * @return void
     */
    protected function setUp() : void
    {
        $this->helper = new ProviderContactData;
    }
    
    /**
     * Test is the helper a instance of Application\View\Helper\ProviderContactData
     * 
     * @return void
     */
    public function testProviderContactDataReturnsObjectInstance() : void
    {
        $helper = $this->helper;
        $this->assertInstanceOf(ProviderContactData::class, $helper);
    }
    
    /**
     * Tests, the required constants are available
     * 
     * @return void
     */
    public function testProviderConstantsExist() : void
    {
        $mailer = new \ReflectionClass(Provider::class);
        $this->assertArrayHasKey('PHONE_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('FAX_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('MOBILE_PHONE_NUMBER', $mailer->getConstants());
    }
    
    /**
     * Test the render method
     * 
     * @return void
     */
    public function testRender() : void
    {
        $phoneNumberStrong = '';
        $phoneNumber = '';
        if (!empty(Provider::PHONE_NUMBER)) {
            $phoneNumberStrong = '<strong>Telefon: </strong>' . Provider::PHONE_NUMBER . '<br>';
            $phoneNumber = 'Telefon: ' . Provider::PHONE_NUMBER . '<br>';
        }
        $faxNumberStrong = '';
        $faxNumber = '';
        if (!empty(Provider::FAX_NUMBER)) {
            $faxNumberStrong = '<strong>Fax: </strong>' . Provider::FAX_NUMBER . '<br>';
            $faxNumber = 'Fax: ' . Provider::FAX_NUMBER;
        }
        $mobilePhoneNumberStrong = '';
        $mobilePhoneNumber = '';
        if (!empty(Provider::MOBILE_PHONE_NUMBER)) {
            $mobilePhoneNumberStrong = '<strong>Mobil-Telefon: </strong>'
                    . Provider::MOBILE_PHONE_NUMBER . '<br>';
            $mobilePhoneNumber = 'Mobil-Telefon: '
                    . Provider::MOBILE_PHONE_NUMBER . '<br>';
        }
        
        $contactEmailStrong = '<strong>E-Mail: </strong>' . Provider::CONTACT_EMAIL;
        $contactEmail = 'E-Mail: ' . Provider::CONTACT_EMAIL;
        
        $testStrongString = $phoneNumberStrong . $faxNumberStrong
            . $mobilePhoneNumberStrong . $contactEmailStrong;
        $testString = $phoneNumber . $faxNumber . $mobilePhoneNumber
            . $contactEmail;
        
        $contactDataStrongString = $this->helper->render();
        $this->assertEquals($testStrongString, $contactDataStrongString);
        $contactDataString = $this->helper->render(false);
        $this->assertEquals($testString, $contactDataString);
    }
}
