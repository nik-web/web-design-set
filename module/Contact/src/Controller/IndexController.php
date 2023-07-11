<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package    Contact\Controller  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Contact\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Contact\Form\ContactForm;
use Contact\Service\MailSenderInterface;

/**
 * IndexController class
 *
 * @package Contact\Controller
 */
class IndexController extends AbstractActionController {
    
    /**
     * @var ContactForm
     */
    protected $contactForm;
    
    /**
     * @var MailSenderInterface
     */
    protected $mailSender;


    /**
     * Constructor
     * 
     * @param ContactForm
     */
    public function __construct(
        ContactForm $contactForm, MailSenderInterface $mailSender
    ) {
        $this->contactForm = $contactForm;
        $this->mailSender = $mailSender;
    }

    /**
     * This action will display the contact web page.
     * 
     * @return ViewModel | \Laminas\Http\PhpEnvironment\Response
     */
    public function indexAction()
    {        
        $form = $this->contactForm;
        if ($this->getRequest()->isPost()) {
            $form->setData($this->params()->fromPost());            
            if($form->isValid()) {
                $cleanData = $form->getData();
                $this->mailSender->setConsignorOrganization($cleanData['organization']);
                $this->mailSender->setConsignorTitle($cleanData['title']);
                $this->mailSender->setConsignorForename($cleanData['forename']);
                $this->mailSender->setConsignorSurname($cleanData['surname']);
                $this->mailSender->setConsignorEmailAddress($cleanData['email']);
                $this->mailSender->setConsignorPhoneNumber($cleanData['phone']);
                $this->mailSender->setConsignorEmailSubject($cleanData['subject']);
                $this->mailSender->setConsignorEmailMessage($cleanData['message']);
                $this->mailSender->send();                
                $message = 'Ihre E-Mail wurde gesendet!';
                $this->flashMessenger()->addSuccessMessage($message);
                
                return $this->redirect()->toRoute('contact');
            }           
        }
        
        return new ViewModel([
            'form' => $form,
        ]);
    }
}
