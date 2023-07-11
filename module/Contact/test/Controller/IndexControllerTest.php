<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    ContactTest\Controller
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace ContactTest\Controller;

use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Laminas\Stdlib\ArrayUtils;
use Contact\Controller\IndexController;
use Contact\Form\ContactForm;
use Laminas\ServiceManager\ServiceManager;

/**
 * IndexControllerTest class
 *
 * @package ContactTest\Controller
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
{   
    /**
     * Test post data
     * 
     * @var array 
     */
    static protected $postData = [
            'organization'            => 'Test Organization',
            'title'                   => 'Test Title',
            'forename'                => 'John',
            'surname'                 => 'Doe',
            'email'                   => 'john.doe@example.com',
            'phone'                   => '123456789',
            'subject'                 => 'Test Subject',
            'message'                 => 'Test Message',
            'accept-privacy-policy'   => '1',
            'data-processed-accepted' => '1',            
            'captcha'                 => [
                'id'    => 'a09f0801f7489b5e1714609ad62f1140',
                'input' => 'JYGI',
            ],
            'submit'                  => 'Senden',
            'csrf'                    => '21eadab7fc2db6c19a7e257cc5c1e9e8-4aa48c65e28f74c1fd2c6835bcb68811',                         
        ];
    
    /**
     * Mock from ContactForm
     * 
     * @var MockObject
     */
    protected $contactForm;

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
        
        $contactFormMethods = ['setData', 'isValid', 'getData'];        
        $this->contactForm = $this
            ->createPartialMock(ContactForm::class, $contactFormMethods);
    }
    
    /**
     * Overwrite the service manager
     * 
     * @param ServiceManager $services
     */   
    protected function configureServiceManager(ServiceManager $services)
    {
        $services->setAllowOverride(true);
        $services->setService(ContactForm::class, $this->contactForm);
        $services->setAllowOverride(false);
    }
    
    /**
     * Test whether you can access the IndexAction
     * 
     * @return void
     */
    public function testIndexActionCanBeAccessed() : void
    {
        $this->dispatch('/kontakt', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('contact');
        $this->assertControllerName(IndexController::class);
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('contact');
    }
    
    /**
     * Test whether in the IndexActionViewModelTemplate, the layout is rendered 
     * with the specified CSS selectors.
     * 
     * @return void
     */
    public function testIndexActionViewModelTemplateRenderedWithinLayout() : void
    {
        $this->dispatch('/kontakt', 'GET');
        $this->assertQuery('h1');
        $this->assertQuery('.stands-alone-form');
    }
    
    /**
     * Test IndexAction redirects after post a valid form
     * 
     * @return void
     */
    public function testIndexActionRedirectsAfterValidPost() : void
    {
        $this->contactForm->expects($this->once())->method('setData')->with(self::$postData);                                          
        $this->contactForm->expects($this->once())->method('isValid')->willReturn(true);                
        $this->contactForm->expects($this->once())->method('getData')->willReturn(self::$postData);
        
        $this->configureServiceManager($this->getApplicationServiceLocator()); // use only for post with redirect
        
        $this->dispatch('/kontakt', 'POST', self::$postData);
        $this->assertResponseStatusCode(302);
        $this->assertRedirectTo('/kontakt');
    }
}
