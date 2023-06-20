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
 * ProviderName class
 * 
 * View helper for setting and retrieving the provider name of this application.
 *
 * @package    Application\View\Helper
 * @author     Niklaus Höpfner <editor@nik-web.net>
 */
class ProviderName extends AbstractHelper
{
    /**
     * Render provider name and business
     * 
     * @param boolean $withBusinessType
     * @return string $result provider name
     */
    public function render($withBusinessType = true) : string
    {
        $bussiness = '';
        
        if ($withBusinessType) {
            $bussiness = '<br>' . Provider::BUSINESS_TYPE . ' (' . Provider::COMPANY_FORM . ')';
        }
        
        $title = "";
        if(!empty(Provider::TITLE)) {
            $title = Provider::TITLE . ' ';
        }
        
        $result = $title . Provider::FIRST_NAME . ' ' . Provider::LAST_NAME . $bussiness;
        
        return $result;
    }
}
