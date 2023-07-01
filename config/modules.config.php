<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 * 
 * If the "laminas/laminas-component-installer" is used by installation of 
 * Laminas components, this file will be added automatically.
 * 
 * @package    web-design-set
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

return [
    'Laminas\Mvc\Plugin\FlashMessenger',
    'Laminas\Mvc\I18n',
    'Laminas\I18n',
    'Laminas\Mail',
    'Laminas\Session',
    'Laminas\Form',
    'Laminas\Hydrator',
    'Laminas\InputFilter',
    'Laminas\Filter',
    'Laminas\Navigation',
    'Laminas\Router',
    'Laminas\Validator',
    'Application',
    'Contact',
    'Samples',
];