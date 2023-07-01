<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Global Configuration Override
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 * Copy this file without the .dist extension at the end and populate values as needed.
 * NOTE: In practice, this file will typically be INCLUDED in your source control, 
 * so do not include passwords or other sensitive information in this file.
 * 
 * @see        https://docs.laminas.dev/laminas-mvc/services/#default-configuration-options
 * @see        https://docs.laminas.dev/laminas-mvc-plugin-flashmessenger/cookbook/application-wide-layout/#set-formats-individually-for-namespaces
 * @package    web-design-set
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @link       https://github.com/nik-web/web-design-set
 * @version    1.0.0
 * @since      1.0.0
 */

return [
    'view_manager' => [
    ],
    'view_helper_config' => [
        'flashmessenger' => [
            'message_open_format'      => '<aside %s><button type="button" class="site-messages-close">&otimes;</button><ul class="site-messages-list"><li>',
            'message_separator_string' => '</li><li>',
            'message_close_string'     => '</li></ul></aside>',
        ],
    ],
];
