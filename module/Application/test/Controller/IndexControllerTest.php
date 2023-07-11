<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    ApplicationTest\Controller
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace ApplicationTest\Controller;

use Application\Controller\IndexController;
use Application\ValueObject\Provider;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * IndexControllerTest class
 * 
 * @package ApplicationTest\Controller
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
{    
    /**
     * {@inheritDoc}
     * 
     * @return void
     */
    public function setUp() : void
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
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
        $this->dispatch('/', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');
    }
    
    /**
     * Test whether in the application/index/index Template, the layout is rendered 
     * with the specified CSS selectors.
     * 
     * @return void
     */
    public function testIndexActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/', 'GET');
        $this->assertQuery('h1');
        $this->assertQuery('p');
        $this->assertQuery('#main-header');
        // partial/nav-bar/brand-base
        $this->assertQuery('#main-nav-bar');
    }
    
    /**
     * Test whether you can access the PrivacyPolicyAction
     * 
     * @return void
     */
    public function testPrivacyPolicyActionCanBeAccessed() : void
    {
        $this->dispatch('/datenschutz', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('privacy-policy');
    }
    
    /**
     * Test whether in the application/index/privacy-policy Template, the layout 
     * is rendered with the specified CSS selectors.
     * 
     * @return void
     */
    public function testPrivacyPolicyActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/privacy-policy', 'GET');
        $this->assertQuery('h1');
        $this->assertQuery('#main-header');
    }
    
    /**
     * Test whether you can access the ImprintAction
     * 
     * @return void
     */
     public function testImprintActionCanBeAccessed() : void
    {
        $this->dispatch('/impressum', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('imprint');
        $mailer = new \ReflectionClass(Provider::class);
        $this->assertArrayHasKey('TAX_ID_NUMBER', $mailer->getConstants());
    }

    /**
     * Test whether in the application/index/imprint Template, the layout 
     * is rendered with the specified CSS selectors.
     * 
     * @return void
     */
    public function testImprintActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/imprint', 'GET');
        $this->assertQuery('h1');
        $this->assertQuery('#main-header');
    }
    
    /**
     * Test invalid route does not cause a crash
     * 
     * @return void
     */
    public function testInvalidRouteDoesNotCrash() : void
    {
        $this->dispatch('/invalid/route', 'GET');
        $this->assertResponseStatusCode(404);
    }
}
