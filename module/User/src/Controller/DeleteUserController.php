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
use User\Form\UserDeleteForm;
use User\Command\UserInterface as Command;
use User\Entity\User;

/**
 * DeleteUserController
 *
 * @package User\Controller
 */
class DeleteUserController extends AbstractActionController
{
    /**
     * @var Repository
     */
    private $repository;
    
    /**    
     * @var UserDeleteForm
     */
    private $form;
    
    /**
     * @var Command
     */
    private $command;


    /**
     * Constructs this controller.
     * 
     * @param Repository $repository
     * @param UserDeleteForm $form
     * @param Commamd $command
     */
    public function __construct(Repository $repository, UserDeleteForm $form, Command $command)
    {
        $this->repository = $repository;
        $this->form = $form;
        $this->command = $command;
    }
    
    /**
     * This action will display the user delete form.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        $id = $this->params()->fromRoute('id');
        $user = $this->repository->findUserById($id);
        if (!$user instanceof User ) {
            $message = sprintf(
                'Nutzer mit der ID „%s“ nicht gefunden.',
                $id);
            $this->flashMessenger()->addErrorMessage($message);
            
            return $this->redirect()->toRoute('all-users', []);
        }
        // Retrieve the current request.
        $request = $this->getRequest();        
        if ($request->isPost()) {
            // Laminas\Stdlib\Parameters
            $data = $request->getPost();
            if (array_key_exists('cancel', $data->toArray())) {
                $message = 'Der Löschvorgang wurde abgebrochen!';
                $this->flashmessenger()->addSuccessMessage($message);
                
                return $this->redirect()->toRoute('user-detail', ['id' => $id,]);
            }
            $this->form->setData($data);
            if($this->form->isValid()) {
                $this->command->delete($user);
                $message = 'Das Nutzerkonto wurde gelöscht!';
                $this->flashmessenger()->addSuccessMessage($message);
                    
                return $this->redirect()->toRoute('all-users', []);
            }
        }
        
        return new ViewModel(['user' => $user, 'form' => $this->form,]);
    }
}
