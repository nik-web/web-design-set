<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    ApplicationTest\View\Helper
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace ApplicationTest\View\Helper;

use PHPUnit\Framework\TestCase;
use Application\View\Helper\ProviderAddress;
use Application\ValueObject\Provider;

/**
 * ProviderAddressTest class
 *
 * @package ApplicationTest\View\Helper
 * @author  Niklaus Höpfner <editor@nik-web.net>
 *
 */
class ProviderAddressTest extends TestCase
{
    /**
     * @var ProviderAddress
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
        $this->helper = new ProviderAddress();
    }
    
    /**
     * Test is the helper a instance of Application\View\Helper\ProviderAddress
     * 
     * @return void
     */
    public function testProviderNameReturnsObjectInstance() : void
    {
        $helper = $this->helper;
        $this->assertInstanceOf(ProviderAddress::class, $helper);
    }
    
    /**
     * Tests, the required constants are available
     * 
     * @return void
     */
    public function testProviderConstantsExist() : void
    {
        $mailer = new \ReflectionClass(Provider::class);
        $this->assertArrayHasKey('STREET', $mailer->getConstants());
        $this->assertArrayHasKey('HOUSE_NUMBER', $mailer->getConstants());
        $this->assertArrayHasKey('POSTCODE', $mailer->getConstants());
        $this->assertArrayHasKey('CITY', $mailer->getConstants());
        $this->assertArrayHasKey('COUNTRY', $mailer->getConstants());
    }
    
    /**
     * Test the render method
     * 
     * @return void
     */
    public function testRender() : void
    {
        $testString = Provider::STREET . ' ' . Provider::HOUSE_NUMBER
            . '<br>' . Provider::POSTCODE . ' ' . Provider::CITY . '<br>'
            . Provider::COUNTRY;
        $addressString = $this->helper->render();
        $this->assertEquals($testString, $addressString);
    }
}
