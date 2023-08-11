<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Service  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Rbac\Service;

use User\Repository\UserInterface;
use Rbac\Repository\RoleInterface;
use Laminas\Permissions\Rbac\Rbac;
use Rbac\Entity\Role;
//use Laminas\Permissions\Rbac\Role;
use User\Entity\User;

/**
 * RbacManager class
 *
 * @package Rbac
 * @subpackage Rbac\Service
 */
class RbacManager implements RbacManagerInterface {
    
    /**
     * @var Rbac
     */
    private $rbac;
    
    /**
     * @var UserInterface 
     */
    private $userRepository;
    
    /**
     * @var RoleInterface
     */
    private $roleRepository;
    
    /**
     * Construct
     * 
     * @param Rbac $rbac
     * @param UserInterface $userRepository
     * @param RoleInterface $roleRepository
     */
    public function __construct(
        Rbac $rbac,
        UserInterface $userRepository,
        RoleInterface $roleRepository
    ) {
        $this->rbac = $rbac;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function init()
    {
        // Construct role hierarchy without database
        // Create some roles
        $guest= new Role('guest');
        $guest->addPermission('home');
        $guest->addPermission('privacy-policy');
        $guest->addPermission('imprint');
        $guest->addPermission('contact');
        $guest->addPermission('sample-flash');
        $guest->addPermission('sample-flash-show');
        $guest->addPermission('sample-redirect');
        $guest->addPermission('user-login');
        $guest->addPermission('not-authorized');
        
        $user = new Role('user');
        $user->addChild($guest);
        $user->addPermission('user-logout');
        
        $admin = new Role('admin');
        $admin->addChild($user);
        $admin->addPermission('all-users');        
        $admin->addPermission('all-users-paginated');
        $admin->addPermission('user-detail');
        $admin->addPermission('add-user');
        $admin->addPermission('edit-user');
        $admin->addPermission('delete-user');
        
        // add Roles
        $this->rbac->addRole($guest);
        $this->rbac->addRole($user);
        $this->rbac->addRole($admin);
    }
    
    /**
     * {@inheritDoc}
     */
    public function isGranted($identity, $permission)
    {
        if (null === $identity) {
            $roleNames = ['guest',];
        } else {
            $user = $this->userRepository->findUserById($identity);
            if (! $user instanceof User) {
                $roleNames = ['guest',];
            } else {
                $roleNames = $this->roleRepository->findAllRoleNamesByUserId($user->getId());    
                if (empty($roleNames)) {
                    $roleNames = ['user',];
                }
            }
        }
        $this->init();
        
        foreach ($roleNames as $roleName) {
            if ($this->rbac->isGranted($roleName, $permission)) {

                return true;
            }
        }
        
        return false;
    }
}
