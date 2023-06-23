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
 * @package    Contact
 * @subpackage Contact/Service
 */
interface MailSenderInterface
{
    /**
     * Sends a e-mail to the provider
     * 
     * @param string $consignorCompany
     * @param string $consignorTitle
     * @param string $consignorForename
     * @param string $consignorSurname
     * @param string $consignorEmailAdress
     * @param string $consignorPhoneNumber
     * @param string $subject
     * @param string $message
     * @return boolean $result
     */
    public function send(
        $consignorCompany, $consignorTitle, $consignorForename,
        $consignorSurname, $consignorEmailAdress, $consignorPhoneNumber,
        $subject, $message); 
    
}