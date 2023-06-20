<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Application\View\Helper
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Application\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use Application\ValueObject\Provider;

/**
 * ProviderAddress class
 * 
 * View helper for setting and retrieving the provider address of this application.
 *
 * @package Application\View\Helper
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class ProviderAddress extends AbstractHelper
{
    /**
     * Render provider address
     * 
     * @return string $result provider address
     */
    public function render() : string
    {
        $result = Provider::STREET . ' ' . Provider::HOUSE_NUMBER
            . '<br>' . Provider::POSTCODE . ' ' . Provider::CITY . '<br>'
            . Provider::COUNTRY;
        
        return $result;
    }
}
