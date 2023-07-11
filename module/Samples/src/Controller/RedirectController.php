<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
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
use Samples\Form\TestForm;

/**
 * RedirectController class
 *
 * @package Samples\Controller
 */
class RedirectController extends AbstractActionController
{
    
    /**
     * @var TestForm
     */
    protected $form;
    
    /**
     * Constract the controller
     * 
     * @param TestForm $form
     */    
    public function __construct(TestForm $form)
    {
        $this->form = $form;
    }
    
    /**
     * This action will display the redirect form.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {        
        $form = $this->form;
        if ($this->getRequest()->isPost()) {
            // Use Params Plugin
            $postData = $this->params()->fromPost();
            $form->setData($postData);            
            if($form->isValid()) {

                return $this->redirect()->toRoute('home');
            }
        }
        
        return new ViewModel(['form' => $form,]);                       
    }
}
