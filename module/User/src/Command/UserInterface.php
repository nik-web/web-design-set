<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Command
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace User\Command;

use User\Entity\User;

/**
 * Describes the interface of the user command
 * 
 * @package User\Command
 */
interface UserInterface
{
    /**
     * Persist a new user in the system.
     *
     * @param User $user The user to insert; may or may not have an identifier.
     * @return int $id new user identifier
     */
    public function insert(User $user): ?int;

    /**
     * Update an existing user in the system.
     *
     * @param User $user The user to update; must have an identifier.
     * @return null|User
     */
    public function update(User $user): ?User;
    
    /**
     * Delete a user from the system.
     *
     * @param User $user The user to delete.
     * @return bool
     */
    public function delete(User $user): bool;
    
}