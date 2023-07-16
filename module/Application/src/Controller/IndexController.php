<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 *
 * @package    Application\Controller  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\ValueObject\Provider;

/**
 * IndexController class
 *
 * @package Application\Controller
 * @author  Niklaus Höpfner <editor@nik-web.net>
 */
class IndexController extends AbstractActionController
{
    /**
     * This action is for the imprint of the website.
     * 
     * @return ViewModel
     */
    public function imprintAction()
    {
        return new ViewModel([
            'taxIdNumber' => Provider::TAX_ID_NUMBER,
        ]);
    }
    
    /**
     * This action is for the privacy policy of the website.
     * 
     * @return ViewModel
     */
    public function privacyPolicyAction()
    {
        return new ViewModel([
            'lastUpdate' => Provider::PRIVACY_POLICY_LAST_UPDATE,
        ]);
    }
}
