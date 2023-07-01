<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package     ContactTest\Service\Factory
 * @author      Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version     1.0.0
 * @since       1.0.0
 */

declare(strict_types=1);

namespace ContactTest\Service\Factory;

use PHPUnit\Framework\TestCase;
use Laminas\Mvc\Application;
use Laminas\Stdlib\ArrayUtils;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Contact\Service\Factory\MailSenderFactory;
use Contact\Service\MailSenderInterface;

/**
 * MailSenderFactoryTest class
 *
 * @package ContactTest\Service\Factory
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class MailSenderFactoryTest extends TestCase {
    /**
     * @var MailSenderFactory
     */
    public $factory;
    
    /**
     * 
     * @var \Laminas\ServiceManager\ServiceManager
     */
    public $container;

    /**
     * Sets up the fixture.
     * 
     * This method is called before a test is executed.
     * 
     * @return void
     */
    protected function setUp() : void
    {
        
        $this->factory = new MailSenderFactory();
        
        $configOverrides = [];
        
        // Retrieve configuration
        $appConfig = require __DIR__ . '/../../../../../config/application.config.php';
        
        if (file_exists(__DIR__ . '/../../../../../config/development.config.php')) {
            $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../../../../../config/development.config.php');
        }
        
        $config = ArrayUtils::merge($appConfig, $configOverrides);
        
        $this->container = Application::init($config)->getServiceManager();
        parent::setUp();
    }
    
    /**
     * Test is the mail sender factory a instance of 
     * 
     * @return void
     */
    public function testMailSenderFactoryInstanceOf() : void
    {
        $factory = $this->factory;
        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }
    
    /**
     * Test is the mail sender factory returns a instance of mail sender interface 
     * 
     * @return void
     */
    public function testInvokeReturnsInstanceOf() {
        $factory = $this->factory;
        // Factory invoke returns this result
        $result = $factory($this->container, null);
        $this->assertInstanceOf(MailSenderInterface::class, $result);
    }
}
