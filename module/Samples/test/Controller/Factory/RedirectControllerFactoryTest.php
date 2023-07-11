<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    SamplesTest\Controller\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace SamplesTest\Controller\Factory;

use PHPUnit\Framework\TestCase;
use Samples\Controller\Factory\RedirectControllerFactory;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Mvc\Application;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Samples\Controller\RedirectController;

/**
 * RedirectControllerFactoryTest class
 *
 * @package SamplesTest\Controller\Factory
 */
class RedirectControllerFactoryTest extends TestCase
{
    /**
     * @var RedirectControllerFactory
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
        $this->factory = new RedirectControllerFactory();
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
     * Test is the redirect controller factory a instance of 
     * 
     * @return void
     */
    public function testRedirectControllerFactoryInstanceOf() : void
    {
        $this->assertInstanceOf(FactoryInterface::class, $this->factory);
    }
    
    /**
     * Test is the flash controller factory returns a instance of redirect controller 
     * 
     * @return void
     */
    public function testInvokeReturnsInstanceOf() : void
    {
        $factory = $this->factory;
        // Factory invoke returns this result
        $result = $factory($this->container, null);
        $this->assertInstanceOf(RedirectController::class, $result);
    }
}
