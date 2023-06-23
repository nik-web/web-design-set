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
 * IndexController
 *
 * @package Contact
 * @subpackage Contact\Controller
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
     * Create and send flash message after sending email
     * 
     * @param boolean $result
     * @return void
     */
    private function sendFlashMessage($result)
    {
    // Laminas\Mvc\Plugin\FlashMessenger\FlashMessenger
            $flash = $this->flashMessenger();

            if ($result) {
                $message = 'Ihre E-Mail wurde gesendet!';
                $flash->addSuccessMessage($message);
                
                return $this->redirect()->toRoute('home');
            } else {
                $message = 'Ihre E-Mail konnte nicht gesendet werden, versuchen Sie es bitte noch einmal!';
                $flash->addErrorMessage($message);
                
                return $this->redirect()->toRoute('contact');
            }
    }


    /**
     * This action will display the contact web page.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        
        $form = $this->contactForm;
        
        if ($this->getRequest()->isPost()) {
            
            $form->setData($this->params()->fromPost());
            
            if($form->isValid()) {
                $cleanData = $form->getData();
                $result = $this->mailSender->send(
                    $cleanData['company'], $cleanData['title'],
                    $cleanData['forename'], $cleanData['surname'],
                    $cleanData['email'], $cleanData['phone'],
                    $cleanData['subject'], $cleanData['message']);
                
                $this->sendFlashMessage($result);
            }           
        } 
        
        return new ViewModel([
            'form' => $form,
        ]);
    }
}
