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
use Application\View\Helper\CopyrightNotice;
use Application\ValueObject\Provider;

/**
 * CopyrightNoticeTest class
 *
 * @package ApplicationTest\View\Helper
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class CopyrightNoticeTest extends TestCase
{
    /**
     * @var CopyrightNotice
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
        $this->helper = new CopyrightNotice();
    }
    
    /**
     * Test is the helper a instance of Application\View\Helper\ProviderName
     * 
     * @return void
     */
    public function testCopyrightNoticeReturnsObjectInstance() : void
    {
        $helper = $this->helper;
        $this->assertInstanceOf(CopyrightNotice::class, $helper);
    }
    
    /**
     * Tests, the required constants are available
     * 
     * @return void
     */
    public function testProviderConstantsExist() : void
    {
        $mailer = new \ReflectionClass(Provider::class);
        $this->assertArrayHasKey('YEAR_OF_PUBLICATION', $mailer->getConstants());
        $this->assertArrayHasKey('FIRST_NAME', $mailer->getConstants());
        $this->assertArrayHasKey('LAST_NAME', $mailer->getConstants());
    }
    
    /**
     * Test the render method
     * 
     * @return void
     */
    public function testRender() : void
    {
        if (date('Y') === Provider::YEAR_OF_PUBLICATION) {
            $testNotice =  '&copy; ' . date('Y') . ' '
                . Provider::FIRST_NAME . ' ' . Provider::LAST_NAME;
        } else {
            $testNotice = '&copy; ' . Provider::YEAR_OF_PUBLICATION . ' - '
                . date('Y'). ' ' . Provider::FIRST_NAME . ' ' . Provider::LAST_NAME;
        }
        $testNotice = '<small id="copyright-notice">' . $testNotice . '</small>';
        $copyrightNotice = $this->helper->render();
        $this->assertEquals($testNotice, $copyrightNotice);
    }
}
