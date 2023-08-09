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

use User\Entity\Securitytoken;

/**
 * Describes the interface of the securitytoken repository
 * 
 * @package User
 * @subpackage User\Repository
 */
interface SecuritytokenInterface
{    
    /**
     * Persist a new securitytoken in the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to insert; may or may not have an identifier.
     * @return null|int $id
     */
    public function insert(Securitytoken $securitytoken): ?int;
    
    /**
     * Update an existing securitytoken in the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to update; must have an identifier.
     * @return null|Securitytoken
     */
    public function update(Securitytoken $securitytoken): ?Securitytoken;
    
    /**
     * Delete a securitytoken from the system.
     *
     * @param Securitytoken $securitytoken The securitytoken to delete.
     * @return boolean
     */
    public function delete(Securitytoken $securitytoken): bool;
    
}