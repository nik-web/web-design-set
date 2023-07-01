<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package     Contact\Service
 * @author      Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version     1.0.0
 * @since       1.0.0
 */

namespace Contact\Service;

/**
 * Mail Sender Interface
 *
 * @package    Contact/Service
 */
interface MailSenderInterface
{
    /**
     * Setter for the organization of the sender
     * 
     * @param string The organization of the sender or an empty string
     */
    public function setConsignorOrganization(string $consignorOrganization);

    /**
     * Setter for the title of the sender
     * 
     * @param string The title of the sender or an empty string
     */
    public function setConsignorTitle(string $consignorTitle);
    
    /**
     * Setter for the forename of the sender
     * 
     * @param string The forename of the sender
     */
    public function setConsignorForename(string $consignorForename);
    
    /**
     * Setter for the surname of the sender
     * 
     * @param string The surname of the sender
     */
    public function setConsignorSurname(string $consignorSurname);
    
    /**
     * Setter for the email address of the sender
     * 
     * @param string The email address of the sender
     */
    public function setConsignorEmailAddress(string $consignorEmailAddress);
    
    /**
     * Setter for the phone number of the sender
     * 
     * @param string The phone number of the sender or an empty string
     */
    public function setConsignorPhoneNumber(string $consignorPhoneNumber);
    
    /**
     * Setter for the email message of the sender
     * 
     * @param string The email message of the sender
     */
    public function setConsignorEmailMessage(string $consignorEmailMessage);
    
    /**
     * Setter for the email subject of the sender
     * 
     * @param string The email message of the sender
     */
    public function setConsignorEmailSubject(string $consignorEmailSubject);

    /**
     * Sends a e-mail to the provider
     *
     * @return void
     */
    public function send(); 
    
}
