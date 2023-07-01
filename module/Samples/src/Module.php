<?php

/**
 * Application module with Laminas MVC framework
 * 
 * @package    Samples
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/advanced-application
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Samples;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Samples module class
 * 
 * @package Samples
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