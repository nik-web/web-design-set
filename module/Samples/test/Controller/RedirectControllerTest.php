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

use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Laminas\Stdlib\ArrayUtils;
use Samples\Controller\RedirectController;
use Samples\Form\TestForm;
use Laminas\ServiceManager\ServiceManager;

/**
 * RedirectControllerTest class
 *
 * @package SamplesTest\Controller
 */
class RedirectControllerTest extends AbstractHttpControllerTestCase
{ 
    /**
     * @var Mock object from TestForm
     */
    protected $form;

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
        $this->form = $this->createMock(TestForm::class);
    }
    
    /**
     * Overwrite the service TestForm mit his Mock object
     * 
     * @param ServiceManager $services
     */
    protected function configureServiceManager(ServiceManager $services)
    {
        $services->setAllowOverride(true);
        $services->setService(TestForm::class, $this->form);
        $services->setAllowOverride(false);
    }
    
    /**
     * Test whether you can access the IndexAction
     * 
     * @return void
     */
    public function testIndexActionCanBeAccessed() : void
    {
        $this->dispatch('/umleiten-test', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('samples');
        $this->assertControllerName(RedirectController::class); // as specified in router's controller name alias
        $this->assertControllerClass('RedirectController');
        $this->assertMatchedRouteName('sample-redirect');
    }
    
    /**
     * Test whether in the IndexActionViewModelTemplate, the layout is rendered 
     * with the specified CSS selectors.
     * 
     * @return void
     */
    public function testIndexActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/umleiten-test', 'GET');
        $this->assertQuery('h1');
    }
    
    /**
     * Test IndexAction redirects after post a valid form
     * 
     * @return void
     */
    public function testIndexActionPostValidForm() : void
    {                  
        
        $this->form->method('isValid')->willReturn(true);
        $this->configureServiceManager($this->getApplicationServiceLocator()); // use only for post with redirect
        $this->dispatch('/umleiten-test', 'POST');
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/');
    }
}
