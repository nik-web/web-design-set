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

/**
 * Describes the interface of the auth manager service.
 * 
 * @package User\Service
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
interface AuthManagerInterface {
    
    /**
     * Executes a user login
     * 
     * @param string $log E-mail address ou alias of the user
     * @param string $password Password of the user
     * @param integer $rememberMe
     * @return array $data
     */
    public function login($log, $password, $rememberMe);
    
    /**
     * Performs a user logout
     */
    public function logout();
}
