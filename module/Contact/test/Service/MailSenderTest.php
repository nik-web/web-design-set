<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package     ContactTest\Service
 * @author      Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version     1.0.0
 * @since       1.0.0
 */

declare(strict_types=1);

namespace ContactTest\Service;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Laminas\Mvc\Application;
use Laminas\Stdlib\ArrayUtils;
use Contact\Service\Factory\MailSenderFactory;

/**
 * MailSenderTest class
 *
 * @author nik
 */
class MailSenderTest extends TestCase {
    /**
     * @var MailSender
     */
    public $mailSender;
    
    /**
     * @var ReflectionClass
     */
    public $reflectionClass;

    /**
     * Sets up the fixture.
     * 
     * This method is called before a test is executed.
     * 
     * @return void
     */
    protected function setUp() : void
    {
        $configOverrides = [];
        // Retrieve configuration
        $appConfig = require __DIR__ . '/../../../../config/application.config.php';
        if (file_exists(__DIR__ . '/../../../../config/development.config.php')) {
            $appConfig = ArrayUtils::merge($appConfig, require __DIR__ . '/../../../../config/development.config.php');
        }
        $config = ArrayUtils::merge($appConfig, $configOverrides);
        $container = Application::init($config)->getServiceManager();
        $factory = new MailSenderFactory();
        $this->mailSender = $factory($container, null);
        $this->reflectionClass = new ReflectionClass($this->mailSender);
    }
    
    /**
     * Test the consignor organisation setter
     * 
     * @return void
     */
    public function testSetConsignorOrganization() : void
    {   
        $this->mailSender->setConsignorOrganization('organization');
        $property = $this->reflectionClass->getProperty('consignorOrganization');
        $property->setAccessible(true);
        $this->assertEquals('organization', $property->getValue($this->mailSender));
    }
    
    /**
     * Test the consignor title setter
     * 
     * @return void
     */
    public function testSetConsignorTitle() : void
    {   
        $this->mailSender->setConsignorTitle('title');
        $property = $this->reflectionClass->getProperty('consignorTitle');
        $property->setAccessible(true);
        $this->assertEquals('title', $property->getValue($this->mailSender));
    }
    
    /**
     * Test the consignor forename setter
     * 
     * @return void
     */
    public function testSetConsignorForename() : void
    {   
        $this->mailSender->setConsignorForename('forename');
        $property = $this->reflectionClass->getProperty('consignorForename');
        $property->setAccessible(true);
        $this->assertEquals('forename', $property->getValue($this->mailSender));
    }
    
    /**
     * Test the consignor surname setter
     * 
     * @return void
     */
    public function testSetConsignorSurname() : void
    {   
        $this->mailSender->setConsignorSurname('surname');
        $property = $this->reflectionClass->getProperty('consignorSurname');
        $property->setAccessible(true);
        $this->assertEquals('surname', $property->getValue($this->mailSender));
    }
    
    /**
     * Test the consignor email address setter
     * 
     * @return void
     */
    public function testSetConsignorEmailAddress() : void
    {   
        $this->mailSender->setConsignorEmailAddress('email');
        $property = $this->reflectionClass->getProperty('consignorEmailAddress');
        $property->setAccessible(true);
        $this->assertEquals('email', $property->getValue($this->mailSender));
    }
    
    /**
     * Test the consignor phone number setter
     * 
     * @return void
     */
    public function testSetConsignorPhoneNumber() : void
    {   
        $this->mailSender->setConsignorPhoneNumber('phone');
        $property = $this->reflectionClass->getProperty('consignorPhoneNumber');
        $property->setAccessible(true);
        $this->assertEquals('phone', $property->getValue($this->mailSender));
    }
    
    /**
     * Test the consignor email message setter
     * 
     * @return void
     */
    public function testSetConsignorEmailMessage() : void
    {   
        $this->mailSender->setConsignorEmailMessage('message');
        $property = $this->reflectionClass->getProperty('consignorEmailMessage');
        $property->setAccessible(true);
        $this->assertEquals('message', $property->getValue($this->mailSender));
    }
    
    /**
     * Test the consignor email subject setter
     * 
     * @return void
     */
    public function testSetConsignorEmailSubject() : void
    {   
        $this->mailSender->setConsignorEmailSubject('subject');
        $property = $this->reflectionClass->getProperty('consignorEmailSubject');
        $property->setAccessible(true);
        $this->assertEquals('subject', $property->getValue($this->mailSender));
    }
}
