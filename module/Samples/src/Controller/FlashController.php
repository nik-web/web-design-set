<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Samples module with Laninas MVC framework
 *
 * @package    Samples\Controller  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Samples\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Samples\Form\FlashTestForm;

class FlashController extends AbstractActionController
{
    /**
     * @var FlashTestForm
     */
    protected $form;

    /**
     * Constract the controller
     * 
     * @param FlashTestForm $form
     */
    public function __construct(FlashTestForm $form)
    {
        $this->form = $form;
    }
    
    /**
     * Set default messages to the flash messenger
     */
    private function setDefaultMessanges() {
        $firstDefaultMessage = 'Das ist die erste Standardmelung (default).'
            . '<br>Hier soll der <strong>String</strong> umbrechen und '
            . 'strong soll angezeigt werden!';
        $this->flashMessenger()->addMessage($firstDefaultMessage);
        $secondDefaultMessage = 'Das $autoEscape wurde auf false gesetzt und'
            . ' somit sind HTML-Tags erlaubt, das war die zweite Standardmeldung.';
        $this->flashMessenger()->addMessage($secondDefaultMessage);
    }
    
    /**
     * Set success messages to the flash messanger
     */
    private function setSuccessMessages() {
        $firstSuccessMessage = 'Das ist die 1. Erfolgsmeldung (success).';
        $this->flashMessenger()->addSuccessMessage($firstSuccessMessage);
        $secondSuccessMessage = 'Das ist die 2. Erfolgsmeldung (success).';
        $this->flashMessenger()->addSuccessMessage($secondSuccessMessage);        
    }
    
    /**
     * Set info messages to the flash messanger
     */
    private function setInfoMessanges() {
        $firstInfoMessage = 'Das ist eine Information (info).';
        $this->flashMessenger()->addInfoMessage($firstInfoMessage);
        $seconInfoMessage = 'Das ist eine 2. info Meldung (info).';
        $this->flashMessenger()->addInfoMessage($seconInfoMessage);        
    }
    
    /**
     * Set warning messages to the flash messanger
     */
    private function setWarningMessanges() {
        $firstWarningMessage = 'Das ist eine Warnmeldung (warning)';   
        $this->flashMessenger()->addWarningMessage($firstWarningMessage);           
        $secondWarningMessage = 'Das $autoEscape wurde auf false gesetzt.';
        $this->flashMessenger()->addWarningMessage($secondWarningMessage);        
    }
    
    /**
     * Set error messages to the flash messanger
     */
    private function setErrorMessanges() {
        $errorMessage = 'Das ist eine Fehlermeldung (error), sie steht ganz allein!';
        $this->flashMessenger()->addErrorMessage($errorMessage);
    }
    
    /**
     * This action will display the test flashmessenger web page.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = $this->form;
        if ($this->getRequest()->isPost()) {
            $this->setDefaultMessanges();
            $this->setSuccessMessages();
            $this->setInfoMessanges();
            $this->setWarningMessanges();
            $this->setErrorMessanges();

            return $this->redirect()->toRoute('sample-flash-show', []); 
        }
        
        return new ViewModel(['form' => $form,]);                        
    }
}
