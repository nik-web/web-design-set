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
use User\Entity\User;
use User\Repository\UserInterface;
use User\ValueObject\Data;

/**
 * ListAllUsersController class
 *
 * @package User\Controller
 */
class DisplayUsersController extends AbstractActionController
{
    /**
     * @var UserInterface
     */
    private $userRepository;
    
    /**
     * Construct the list all users controller
     * 
     * @param UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }    
    
    /**
     * This action will display all users.
     * 
     * @return ViewModel
     */
    public function indexAction(): ViewModel
    {
        $users = $this->userRepository->findAllUsers();
        
        return new ViewModel([
            'users' => $users,
        ]);
    }
    
    /**
     * This action will display all users paginated.
     * 
     * @return ViewModel
     */
    public function paginatedAction()
    {
        $page = (int) $this->params()->fromRoute('page');
        $paginator = $this->userRepository->findAllUsersPaginated();
        //$paginator->setDefaultItemCountPerPage(Data::PAGINATOR_CONT_PER_PAGE);
        $paginator->setDefaultItemCountPerPage('1');// test the paging
        $paginator->setPageRange(Data::PAGINATOR_PAGE_RANGE);
        $paginator->setCurrentPageNumber($page);
        
        return new ViewModel([
            'paginator' => $paginator,
        ]);
    }
    
    /**
     * This action will display the details of the user.
     * 
     * @return ViewModel
     */
    public function detailAction()
    {
        $id = (int) $this->params()->fromRoute('id');        
        $user = $this->userRepository->findUserById($id);
        
        if (! $user instanceof User) {
            $message = sprintf(
                'Nutzer mit der ID „%s“ nicht gefunden.',
                $id);
            $this->flashMessenger()->addErrorMessage($message);
            
            return $this->redirect()->toRoute('all-users', []);
        }
        
        return new ViewModel([
            'user' => $user,
        ]);
    }
}
