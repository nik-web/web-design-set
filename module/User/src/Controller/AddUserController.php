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
use Laminas\View\Model\ViewModel;
use Laminas\Crypt\Password\Bcrypt;
use User\Command\UserInterface;
use User\Form\UserAddForm;
use User\Entity\User;

/**
 * AddUserController
 *
 * @package User\Controller
 */
class AddUserController extends AbstractActionController
{    
    /**
     * @var UserAddForm
     */
    private  $form;
    
    /**
     * @var UserInterface
     */
    private $command;
    
    /**
     * Constructs this controller.
     * 
     * @param UserAddForm $form
     * @param UserInterface $command
     */
    public function __construct(UserAddForm $form, UserInterface $command)
    {
        $this->form = $form;
        $this->command = $command;
    }
    
    /**
     * This action will display the add user form.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
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
        // Get only filtered and validated data
        $data = $form->getData();
        $alias = $data['alias'];
        $email = $data['email'];
        $bcrypt = new Bcrypt();
        $password = $bcrypt->create($data['password']);
        $user = new User($alias, $email, $password, 1, date('Y-m-d H:i:s'), null, null, null);        
        if ($this->command->insert($user)) {
            $message = 'Sie haben ein neues Benutzerkonto angelegt.';
            $this->flashmessenger()->addSuccessMessage($message);
        } else {
            $message = 'Es ist ein Fehler beim anlegen des Benutzerkontos aufgetreten!';
            $this->flashmessenger()->addWarningMessage($message);
        }
        
        return $this->redirect()->toRoute('all-users', []);
    }
}
