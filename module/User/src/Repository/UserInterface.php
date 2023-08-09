<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Repository
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace User\Repository;

use User\Entity\User;

/**
 * Describes the interface of the user repository
 * 
 * @package User\Repository
 */
interface UserInterface
{
    /**
     * Return a set of all user users that we can iterate over.
     *
     * Each entry should be a user instance.
     *
     * @return \Laminas\Db\ResultSet\HydratingResultSet | array
     */
    public function findAllUsers();
    
    /**
     * Return a paginator instance
     *
     * Each entry should be a user instance.
     *
     * @return \Laminas\Paginator\Paginator
     */
    public function findAllUsersPaginated();
    
    /**
     * Return a single user or void.
     *
     * @param  int $id Identifier of the user to return.
     * @return User | void
     */
    public function findUserById($id): ?User;
    
    /**
     * Return a single user or void.
     *
     * @param  sring $email email address of the user to return.
     * @return User | void
     */
    public function findByEmail($email): ?User;
    
    /**
     * Return a single user or void.
     *
     * @param  sring $alias alias of the user to return.
     * @return User | void
     */
    public function findByAlias($alias): ?User;
    
}