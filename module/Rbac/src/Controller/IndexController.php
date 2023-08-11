<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Controller  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Rbac\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

/**
 * IndexController
 *
 * @package Rbac\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * This action will display the not authorized web page.
     * 
     * @return ViewModel
     */
    public function indexAction()
    {
        
        return new ViewModel();
    }
}
