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

/**
 * RbacManagerInterface
 *
 * @package Rbac\Service
 */
interface RbacManagerInterface {
    
    /**
     * Initializes the RBAC container.
     */
    public function init();
    
    /**
     * Checks whether the given roles has permission.
     * 
     * @param string|null $identity User auth instance
     * @param string $permission
     * 
     * @return bolean
     */
    public function isGranted($identity, $permission);
}
