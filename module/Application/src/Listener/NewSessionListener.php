<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 *
 * @package    Application\Listener  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Application\Listener;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\EventInterface;
use Laminas\Mvc\MvcEvent;

/**
 * New session listener
 * 
 * @package    Application\Listener
 */
class NewSessionListener extends AbstractListenerAggregate
{
    
    //protected $listeners = [];
    
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, [$this, 'afterResetSession'], $priority);                  
    }
    
    /**
     * After reset session redirect
     *
     * @param  EventInterface $e
     * @return void
     */
    public function afterResetSession(EventInterface $e)
    {
        $controller = $e->getTarget();
        $message = 'Es ist ein Sicherheitsproblem aufgetreten, gegebenenfalls'
                . ' müssen Sie sich neu anmelden!';
        $controller->flashMessenger()->addErrorMessage($message);
        $routeName = 'home';
                     
        return $controller->redirect()->toRoute($routeName, []);      
    }
}
