<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    SamplesTest\Controller
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace SamplesTest\Controller;

use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Samples\Controller\FlashShowController;

/**
 * FlashShowControllerTest class
 *
 * @package SamplesTest\Controller
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class FlashShowControllerTest extends AbstractHttpControllerTestCase
{
        
    /**
     * {@inheritDoc}
     * 
     * @return void
     */
    public function setUp() : void
    {        
        $configOverrides = [];
        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));        
        parent::setUp();
    }
    
    /**
     * Test whether you can access the IndexAction
     * 
     * @return void
     */
    public function testIndexActionCanBeAccessed() : void
    {
        $this->dispatch('/flash-nachrichten/anzeigen', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('samples');
        $this->assertControllerName(FlashShowController::class); // as specified in router's controller name alias
        $this->assertControllerClass('FlashShowController');
        $this->assertMatchedRouteName('sample-flash-show');
    }
    
    /**
     * Test whether in the IndexActionViewModelTemplate, the layout is rendered 
     * with the specified CSS selectors.
     * 
     * @return void
     */
    public function testIndexActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/flash-nachrichten/anzeigen', 'GET');
        $this->assertQuery('h1');
    }
}
