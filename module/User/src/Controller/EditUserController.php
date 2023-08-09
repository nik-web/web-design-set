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
use User\Repository\UserInterface as Repository;
use User\Form\UserEditForm;
use User\Command\UserInterface as Command;
use User\Entity\User;

/**
 * EditUserController
 *
 * @package User\Controller
 */
class EditUserController extends AbstractActionController
{
    /**
     * @var Repository
     */
    private $repository;
    
    /**
     * @var UserEditForm
     */
    private  $form;
    
    /**
     * @var Command
     */
    private $command;


    /**
     * Constructs this controller.
     * 
     * @param Repository $repository
     * @param UserEditForm $form
     * @param Command $command
     */
    public function __construct(Repository $repository, UserEditForm $form, Command $command)
    {
        $this->repository = $repository;
        $this->form = $form;
        $this->command = $command;
    }
    
    /**
     * This action will display the edit user form.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        // Retrieve the current request.
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id');
        $user = $this->repository->findUserById($id);
        if (!$user | !$user instanceof User ) {
            
            return $this->redirect()->toRoute('all-users', []);
        }
        $form = $this->form;
        // Fill in the form with user data
        $data = $user->getArrayCopy();
        $form->setData($data);
        if ($request->isPost()) {            
            // Populate the form with data from the request.
            $form->setData($request->getPost());
            // Validate form
            if($form->isValid()) {                
                $cleanData = $form->getData();                
                $userData = $user->getArrayCopy();                
                // Overwrite with current data
                $userData['status'] = $cleanData['status'];
                $userData['updated_on'] = date('Y-m-d H:i:s');
                // Set current data to the user
                $user->exchangeArray($userData);
                // Updated user
                $user = $this->command->update($user);                
                if ( $user instanceof User) {
                    $message = 'Die Kontodaten wurden geändert.';
                    $this->flashmessenger()->addSuccessMessage($message);
                } else {
                    $message = 'Die Kontodaten wurden nicht geändert.';
                    $this->flashmessenger()->addWarningMessage($message);
                }
                
                return $this->redirect()
                    ->toRoute('user-detail', ['id' => $user->getId(),]);
            }
        
        }
        
        return new ViewModel([
            'user' => $user,
            'form' => $form,
        ]);
    }
}