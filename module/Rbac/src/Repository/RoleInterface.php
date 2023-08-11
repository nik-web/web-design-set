<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Repository
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Rbac\Repository;

/**
 * Describes the interface of the role repository
 * 
 * @package Rbac\Repository
 */
interface RoleInterface
{
    /**
     * Find all role names by user id
     * 
     * @param  int $userId Identifier of the user
     * @return array $roleNames
     */
    public function findAllRoleNamesByUserId($userId);
}
