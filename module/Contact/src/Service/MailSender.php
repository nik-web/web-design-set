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
     * @var Sendmail
     */
    private $transport;
    
    /**
     * @var string The organization of the sender or an empty string
     */
    protected $consignorOrganization;
    
    /**
     * @var string The title of the sender or an empty string
     */
    protected $consignorTitle;
    
    /**
     * @var string The forename of the sender
     */
    protected $consignorForename;
    
    /**
     * @var string The surname of the sender
     */
    protected $consignorSurname;
    
    /**
     * @var string The email address of the sender
     */
    protected  $consignorEmailAddress;
    
    /**
     * @var string The phone number of the sender or an empty string
     */
    protected $consignorPhoneNumber;
    
    /**
     * @var string The email message of the sender
     */
    protected $consignorEmailMessage;
    
    /**
     * @var string The email subject of the sender
     */
    protected $consignorEmailSubject;

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
    public function setConsignorOrganization(string $consignorOrganization) {
        $this->consignorOrganization = $consignorOrganization;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setConsignorTitle(string $consignorTitle) {        
        $this->consignorTitle = $consignorTitle;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setConsignorForename(string $consignorForename) {
        $this->consignorForename = $consignorForename;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setConsignorSurname(string $consignorSurname) {
        $this->consignorSurname = $consignorSurname;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setConsignorEmailAddress(string $consignorEmailAddress) {
        $this->consignorEmailAddress = $consignorEmailAddress;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setConsignorPhoneNumber(string $consignorPhoneNumber) {
        $this->consignorPhoneNumber = $consignorPhoneNumber;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setConsignorEmailMessage(string $consignorEmailMessage) {
        $this->consignorEmailMessage = $consignorEmailMessage;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setConsignorEmailSubject(string $consignorEmailSubject) {
        $this->consignorEmailSubject = $consignorEmailSubject;
    }
    
    /**
     * Create email body of the sender
     * 
     * @return string email body
     */
    protected function createEmailBody() {
        if (!empty($this->consignorOrganization)) {
            $organization = $this->consignorOrganization;
        } else {
            $organization = 'keine Angabe';
        }
        if (!empty($this->consignorTitle)) {
            $title = $this->consignorTitle . ' ';
        } else {
            $title = '';
        }
        if (!empty($this->consignorPhoneNumber)) {
            $phoneNumber = $this->consignorPhoneNumber;
        } else {
            $phoneNumber = 'keine Angabe';
        }
        $body = $this->consignorEmailMessage
                . "\n\n"
                . 'von: ' . $title . $this->consignorForename . ' '
                . $this->consignorSurname
                .  "\n"
                . 'E-Mail Adresse: ' . $this->consignorEmailAddress
                . "\n"
                . 'Telefonnummer: ' . $phoneNumber
                . "\n"
                . 'Unternehmen / Institution: ' . $organization;
        
        return $body;
    }
    
    /**
     * Create from name
     * 
     * @return string 
     */
    protected function createFromName() {
        return 'vom web-design-set Kontaktformular';
    }

    /**
     * {@inheritDoc}
     */
    public function send() {        
        $body = $this->createEmailBody();        
        $fromName = $this->createFromName();        
        $this->message
            ->addFrom(Provider::CONTACT_EMAIL, $fromName)
            ->setSubject($this->consignorEmailSubject)->setBody($body);
        $this->transport->send($this->message);
    }
}
