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
use Application\View\Helper\ProviderName;
use Application\ValueObject\Provider;

/**
 * ProviderNameTest class
 *
 * @package ApplicationTest\View\Helper
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class ProviderNameTest extends TestCase
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
        $this->helper = new ProviderName();
    }
    
    /**
     * Test is the helper a instance of Application\View\Helper\ProviderName
     * 
     * @return void
     */
    public function testProviderNameReturnsObjectInstance() : void
    {
        $helper = $this->helper;
        $this->assertInstanceOf(ProviderName::class, $helper);
    }
    
    /**
     * Tests, the required constants are available
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
    }
    
    /**
     * Test the render method
     * 
     * @return void
     */
    public function testRender() : void
    {
        $title = "";
        if (!empty(Provider::TITLE)) {
            $title = Provider::TITLE . ' ';
        }
        $testString = $title . Provider::FIRST_NAME . ' ' . Provider::LAST_NAME
            . '<br>' . Provider::BUSINESS_TYPE . ' (' . Provider::COMPANY_FORM . ')';
        $nameBusinessString = $this->helper->render();
        $this->assertEquals($testString, $nameBusinessString);
        $testString = $title . Provider::FIRST_NAME . ' ' . Provider::LAST_NAME;
        $nameString = $this->helper->render(false);
        $this->assertEquals($testString, $nameString);
    }
}
