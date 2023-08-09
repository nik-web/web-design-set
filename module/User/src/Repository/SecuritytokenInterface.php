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

use User\Entity\Securitytoken;

/**
 * Describes the interface of the securitytoken repository
 * 
 * @package User\Repository
 */
interface SecuritytokenInterface
{
    /**
     * Return a single securitytoken.
     * 
     * @param string $identity user auth identity
     * @return Securitytoken|null
     */
    public function findByIdentity($identity): ?Securitytoken;
    
    /**
     * Return a single securitytoken.
     * 
     * @param string $identifier
     * @return Securitytoken|null
     */
    public function findByIdentifier($identifier): ?Securitytoken;
    
}