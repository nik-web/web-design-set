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

    public function testIndexActionCanBeAccessed() : void
    {
        $this->dispatch('/', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');
    }

    public function testIndexActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/', 'GET');
        $this->assertQuery('h1, p, #main-header');
    }

    public function testPrivacyPolicyActionCanBeAccessed() : void
    {
        $this->dispatch('/datenschutz', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('application');
        $this->assertControllerName(IndexController::class); // as specified in router's controller name alias
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('privacy-policy');
    }

    public function testPrivacyPolicyActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/privacy-policy', 'GET');
        $this->assertQuery('h1, #main-header');
    }
    
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

    public function testImprintActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/imprint', 'GET');
        $this->assertQuery('h1, #main-header');
    }

    public function testInvalidRouteDoesNotCrash() : void
    {
        $this->dispatch('/invalid/route', 'GET');
        $this->assertResponseStatusCode(404);
    }
}
