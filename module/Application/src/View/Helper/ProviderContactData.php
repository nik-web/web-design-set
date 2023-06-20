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
 * ProviderContactData class
 * 
 * View helper for setting and retrieving the provider contact data of this application.
 *
 * @package Application\View\Helper
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class ProviderContactData extends AbstractHelper
{
    /**
     * Render provider contact data
     * 
     * @param boolean $withStrong with HTML tag <strong>
     * @return string $result provider contact data
     */
    public function render($withStrong = true) : string
    {
        $phoneNumber = '';
        if (Provider::PHONE_NUMBER) {
            if ($withStrong) {
                $phoneNumber = '<strong>Telefon: </strong>'
                    . Provider::PHONE_NUMBER;
            } else {
                $phoneNumber = 'Telefon: '. Provider::PHONE_NUMBER;
            }
            $phoneNumber = $phoneNumber . '<br>';
        }
        
        $faxNumber = '';
        if (Provider::FAX_NUMBER) {
            if ($withStrong) {
                $faxNumber = '<strong>Fax: </strong>' . Provider::FAX_NUMBER;
            } else {
                $faxNumber = 'Fax: ' . Provider::FAX_NUMBER;
            }
            $faxNumber = $faxNumber . '<br>';
        }
        
        $mobilePhoneNumber = '';
        if (Provider::MOBILE_PHONE_NUMBER) {
            if ($withStrong) {
                $mobilePhoneNumber = '<strong>Mobil-Telefon: </strong>'
                    . Provider::MOBILE_PHONE_NUMBER;
            } else {
                $mobilePhoneNumber = 'Mobil-Telefon: '
                    . Provider::MOBILE_PHONE_NUMBER;
            }
            $mobilePhoneNumber = $mobilePhoneNumber . '<br>';
        }
        
        if ($withStrong) {
            $contactEmail = '<strong>E-Mail: </strong>' . Provider::CONTACT_EMAIL;
        } else {
            $contactEmail = 'E-Mail: ' . Provider::CONTACT_EMAIL;
        }
        
        $result = $phoneNumber . $faxNumber . $mobilePhoneNumber . $contactEmail;

        return $result;
    }
}
