<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Listener  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Rbac\Listener;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\EventInterface;
use Laminas\Mvc\MvcEvent;
use Rbac\Service\RbacManagerInterface;
use Laminas\Authentication\AuthenticationServiceInterface;

/**
 * Rbac listener
 * 
 * @package Rbac\Listener
 */
class RbacListener extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = -1)
    {        
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, 
            [$this, 'setupAccess'],
            $priority
        );                  
    }
    
    /**
     * Setup access
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function setupAccess(EventInterface $e)
    { 
        $serviceManager = $e->getApplication()->getServiceManager();
        $identity = $serviceManager->get(AuthenticationServiceInterface::class)
            ->getIdentity();  
        $permission = $e->getRouteMatch()->getMatchedRouteName();
        $rbacManager = $serviceManager->get(RbacManagerInterface::class);        
        if (! $rbacManager->isGranted($identity, $permission)) {
            $controller = $e->getTarget();
            // Redirect the user to the not authorized page.
            return $controller->redirect()->toRoute('not-authorized', []);
        }
    }
}
