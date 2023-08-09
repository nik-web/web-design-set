<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Controller  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use User\Form\LoginForm;
use User\Service\AuthManagerInterface;
use Laminas\Session\Container;
use Laminas\View\Model\ViewModel;

/**
 * AuthController class
 *
 * @package User\Controller
 */
class AuthController extends AbstractActionController
{
    /**
     * @var LoginForm
     */
    protected $form;
    
    /**
     * @var AuthManagerInterface
     */
    protected $service;
    
    /**
     * @var Container
     */
    protected $sessionContainer;

    /**
     * Construct the auth controller
     * 
     * @param LoginForm
     */
    public function __construct(
        LoginForm $form,
        AuthManagerInterface $service,
        Container $sessionContainer
    ) {
        $this->form = $form;
        $this->service = $service;
        $this->sessionContainer = $sessionContainer;
    }
    
    /**
     * This action will display the login form.
     * 
     * @return ViewModel
     */
    public function loginAction()
    {
        if ($this->identity()) {
            // Redirect if a user is logged in.
            return $this->redirect()->toRoute('home', []);
        }
        // Retrieve the current request.
        $request = $this->getRequest();
        $form = $this->form;
        // Create a default view model containing the form.
        $viewModel = new ViewModel(['form' => $form]);
        // If we do not have a POST request, we return the default view model.
        if (! $request->isPost()) {
            return $viewModel;
        }
        // Populate the form with data from the request.
        $form->setData($request->getPost());
        // If the form is not valid, we return the default view model; at this point,
        // the form will also contain error messages.
        if (! $form->isValid()) {
            return $viewModel;
        }
        // Get filtered and validated data
        $cleanData = $form->getData();
        
        $log = $cleanData['log'];
        $password = $cleanData['password'];
        $rememberMe = intval($cleanData['remember_me']);
        $loginData = $this->service->login($log, $password, $rememberMe);        
        $flash = $this->flashmessenger();
        if (isset($loginData['code']) && 0 <= $loginData['code']) {
            if (0 === $loginData['code']) {
                // 'User is blocked.'
                $message = 'Dieses Nutzerkonto wurde von uns gesperrt!';
                $flash->addErrorMessage($message);
                
                return $this->redirect()->toRoute('home', []);
            }
            if (1 === $loginData['code']) {
                if ($rememberMe) {                                 
                    $this->getResponse()->getHeaders()
                        ->addHeader($loginData['identifier']);                                                        
                    $this->getResponse()->getHeaders()
                        ->addHeader($loginData['securitytoken']);                  
                }
                $message = 'Sie haben sich erfolgreich angemeldet!';
                $flash->addSuccessMessage($message);
                
                if (isset($this->sessionContainer->myVar)) {
                    $url = $this->sessionContainer->myVar;
                    
                    return $this->redirect()->toUrl($url);
                }
                
                return $this->redirect()->toRoute('home', []);
            }
        } else {
            $message = 'Überprüfen Sie bitte Ihre Anmeldedaten!';            
            $flash->addErrorMessage($message);
            
            return $this->redirect()->toRoute('user-login', []);            
        }
    }
    
    /**
     * The "logout" action performs logout operation.
     * 
     * @return type
     */
    public function logoutAction()
    {
        $this->service->logout();
        return $this->redirect()->toRoute('user-login', []);
    }
}
