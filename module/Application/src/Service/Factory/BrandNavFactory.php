<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Application\Service\Factory
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Application\Service\Factory;

use Laminas\Navigation\Service\AbstractNavigationFactory;

/**
 * BrandNavFactory class
 *
 * @package Application\Service\Factory
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class BrandNavFactory extends AbstractNavigationFactory
{
    /**
     * Returns config name of the brand navigation
     * 
     * @return string
     */
    public function getName() : string
    {
        return 'brand_nav';
    }
}
