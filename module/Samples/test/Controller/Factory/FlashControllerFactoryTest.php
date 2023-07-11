<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Samples module with Laninas MVC framework
 *
 * @package     SamplesTest\Controller\Factory
 * @author      Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version     1.0.0
 * @since       1.0.0
 */
declare(strict_types=1);

namespace SamplesTest\Controller\Factory;

use PHPUnit\Framework\TestCase;
use Samples\Controller\Factory\FlashControllerFactory;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Mvc\Application;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Samples\Controller\FlashController;

/**
 * FlashControllerFactoryTest class
 *
 * @package ContactTest\Controller\Factory
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class FlashControllerFactoryTest extends TestCase
{
    /**
     * @var FlashControllerFactory
     */
    public $factory;
    
    /**
     * @var \Laminas\ServiceManager\ServiceManager
     */
    public $container;
    
    
    /**
     * {@inheritDoc}
     *  
     * @return void
     */
    protected function setUp() : void
    {
        $this->factory = new FlashControllerFactory();
        $configOverrides = [];
        // Retrieve configuration
        $appConfig = require __DIR__ . '/../../../../../config/application.config.php';
        if (file_exists(__DIR__ . '/../../../../../config/development.config.php')) {
            $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../../../../../config/development.config.php');
        }
        $config = ArrayUtils::merge($appConfig, $configOverrides);
        $this->container = Application::init($config)->getServiceManager();
    }
    
    /**
     * Test is the flash controller factory a instance of 
     * 
     * @return void
     */
    public function testFlashControllerFactoryInstanceOf() : void
    {
        $this->assertInstanceOf(FactoryInterface::class, $this->factory);
    }
    
    /**
     * Test is the flash controller factory returns a instance of flash controller 
     * 
     * @return void
     */
    public function testInvokeReturnsInstanceOf() {
        $factory = $this->factory;
        // Factory invoke returns this result
        $result = $factory($this->container, null);
        $this->assertInstanceOf(FlashController::class, $result);
    }
}
