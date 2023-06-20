<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Global Configuration Override for DEVELOPMENT MODE.
 * This configuration override file is for providing configuration to use while
 * in development mode.
 * 
 * These will only be considered when development mode is enabled!
 * 
 * @see        https://docs.laminas.dev/tutorials/advanced-config/#environment-specific-application-configuration
 * @package    web-design-set
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @link       https://github.com/nik-web/web-design-set
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

return [
    'view_manager' => [
        'display_exceptions'       => true, // by default NULL
        'display_not_found_reason' => true, // by default false
    ],
];
