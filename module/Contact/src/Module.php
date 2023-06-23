<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laminas MVC framework
 * 
 * @package    Contact
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/base-application
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Contact;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Contact module class
 * 
 * @package Contact
 */

class Module implements ConfigProviderInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
