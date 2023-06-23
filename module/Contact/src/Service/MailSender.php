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

declare(strict_types=1);

namespace Contact\Service;

use Laminas\Mail\Message;
use Laminas\Mail\Transport\Sendmail;
use Application\ValueObject\Provider;

/**
 * MailSender
 *
 * @package    Contact
 * @subpackage Contact\Service
 */
class MailSender implements MailSenderInterface
{
    /**
     *
     * @var Message
     */
    private $message;
    
    /**
     *
     * @var Sendmail
     */
    private $transport;
    
    /**
     * Construct the mail sender
     * 
     * @param Message $message
     * @param  Sendmail $transport
     */
    public function __construct(Message $message, Sendmail $transport)
    {
        $this->message = $message;
        $this->transport = $transport;
    }

    /**
     * {@inheritDoc}
     */
    public function send(
        $consignorCompany, $consignorTitle, $consignorForename,
        $consignorSurname, $consignorEmailAdress, $consignorPhoneNumber,
        $subject, $message 
    ) {
        if (!empty($consignorCompany)) {
            $company = $consignorCompany;
        } else {
            $company = 'keine Angabe';
        }
        
        if (!empty($consignorTitle)) {
            $title = $consignorTitle . ' ';
        } else {
            $title = '';
        }
        
        $isValidConsignorEmailAdress = filter_var($consignorEmailAdress, FILTER_VALIDATE_EMAIL);
        
        if (empty($consignorForename) || empty($consignorSurname)
            || empty($isValidConsignorEmailAdress) || empty($subject)
            || empty($message)
        ) {
            return false;
        }
        
        if (!empty($consignorPhoneNumber)) {
            $phoneNumber = $consignorPhoneNumber;
        } else {
            $phoneNumber = 'keine Angabe';
        }
        
        $body = $message
                . "\n\n"
                . 'von: ' . $title . $consignorForename . ' '
                . $consignorSurname
                .  "\n"
                . 'E-Mail Adresse: ' . $consignorEmailAdress
                . "\n"
                . 'Telefonnummer: ' . $phoneNumber
                . "\n"
                . 'Firma: ' . $company;
        
        $from = 'Kontaktformular '  . Provider::HOSTNAME;
        
        $this->message
            ->addFrom($consignorEmailAdress, $from)
            ->setSubject($subject)->setBody($body);
        
        try {
            $this->transport->send($this->message);
            return true;
        } catch(\Exception $e) {
            //echo'Exception abgefangen: ',  $e->getMessage(), "\n";
            return false;
        }
    }
}