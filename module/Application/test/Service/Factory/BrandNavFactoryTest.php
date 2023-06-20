<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    ApplicationTest\Service\Factory
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace ApplicationTest\Service\Factory;

use PHPUnit\Framework\TestCase;
use Application\Service\Factory\BrandNavFactory;
use Laminas\Navigation\Service\AbstractNavigationFactory;

/**
 * BrandNavFactoryTest class
 *
 * @package ApplicationTest\Service\Factory
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class BrandNavFactoryTest extends TestCase
{
    /**
     * @var BrandNavFactory
     */
    public $factory;
    
    /**
     * Sets up the fixture.
     * 
     * This method is called before a test is executed.
     * 
     * @return void
     */
    protected function setUp() : void
    {
        $this->factory = new BrandNavFactory();
        
    }
    
    /**
     * Test is the navigation factory a instance of AbstractNavigationFactory
     * 
     * @return void
     */
    public function testBrandNavFactoryReturnsObjectInstance() : void
    {
        $factory = $this->factory;
        //$this->assertInstanceOf(BrandNavFactory::class, $factory);
        $this->assertInstanceOf(AbstractNavigationFactory::class, $factory);
    }
    
    /**
     * Test the get name method
     * 
     * @return void
     */
    public function testGetName() : void
    {
        $name = $this->factory->getName();
        $this->assertEquals('brand_nav', $name);
    }
     
}
