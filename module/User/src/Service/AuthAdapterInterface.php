<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Service
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace User\Service;

use Laminas\Authentication\Adapter\AdapterInterface;

/**
 * Describes the interface of the user auth apapter
 * 
 * AdapterInterface used for authenticating user.
 * 
 * @package User\Service
 * @author Niklaus Höpfner <editor@nik-web.net>
 */
interface AuthAdapterInterface extends AdapterInterface
{
    /**
     * Sets user email address or alias.
     * 
     * @param string $log
     */
    public function setLog($log);
    
    /**
     * Sets user password.
     * 
     * @param string $password
     */
    public function setPassword($password);
    
    /**
     * Set user token
     * 
     * @param sring $token
     */
    public function setToken($token);
}
