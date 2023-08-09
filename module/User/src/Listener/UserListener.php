<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Listener  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Listener;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\EventManager\EventInterface;
use Laminas\Mvc\MvcEvent;
use User\Entity\Securitytoken;
use User\Entity\User;
use Laminas\Authentication\AuthenticationServiceInterface;
use User\Service\AuthAdapterInterface;
use User\Repository\SecuritytokenInterface as SecuritytokenRepository;
use User\Command\SecuritytokenInterface as SecuritytokenCommand;
use User\Repository\UserInterface;
use Laminas\Http\Header\Cookie;
use Laminas\Http\Header\SetCookie;

/**
 * User listener
 * 
 * @package User\Listener
 */
class UserListener extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, 
            [$this, 'setupRememberMe'],
            $priority
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH, 
            [$this, 'storeLastURL'],
            $priority
        );
    }
    
    
    /**
     * Store the current url in the session conainer
     * 
     * @param MvcEvent $e
     * @return void
     */
    public function storeLastURL(MvcEvent $e): void
    {
        $controller = $e->getTarget();                
        if ($controller::class === 'User\Controller\AuthController') {
            // Not set in this controller
            return;
        }
        $url = $controller->getRequest()->getUriString();
        // Set url to last url session container
        $e->getApplication()->getServiceManager()
            ->get('lastURLSessionContainer')->myVar = $url;
    }

    /**
     * Setup remember me
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function setupRememberMe(EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $authService = $serviceManager->get(AuthenticationServiceInterface::class);
        if ($authService->hasIdentity()) {
            
            return;
        }
        $controller = $e->getTarget();
        // Laminas\Http\Header\Cookie
        $cookie = $controller->getRequest()->getCookie();
        if (! $cookie instanceof Cookie) {
            
            return;
        }
        if (! $this->cookiesExists($cookie)) {
            
            return;
        }
        // Get Securitytoken from db
        $securitytoken = $serviceManager->get(SecuritytokenRepository::class)
            ->findByIdentifier($cookie->identifier);           
        if (! $securitytoken instanceof Securitytoken) {
            // Securitytoken not found remove cookies
            $this->removeCookies($controller);

            return;                
        }
        if (sha1($cookie->securitytoken) != $securitytoken->getToken()) {
            // Securitytokens not equal remove cookies and remove securitytocken
            $this->removeCookies($controller);             
            $serviceManager->get(SecuritytokenCommand::class)
                    ->delete($securitytoken);

            return;                
        }
        $authAdapter = $serviceManager->get(AuthAdapterInterface::class);
        // Get user id
        $userId = $securitytoken->getIdentity();
        // Get user from db
        $user = $serviceManager->get(UserInterface::class)->findUserById($userId);
        if (! $user instanceof User) {
            // No user to this securitytoken found, remove this securitytocken
            $this->removeCookies($controller);             
            $serviceManager->get(SecuritytokenCommand::class)
                    ->delete($securitytoken);

            return;
        }
        // Prepare auth adapter
        $authAdapter->setLog($user->getAlias());
        $authAdapter->setToken($securitytoken->getToken());
        // Get 
        $result = $authService->authenticate();
        if (1 === $result->getCode()) {
            // update securitytoken in db and set new cookies
            $randomString = Securitytoken::getRandomString();                
            $securitytoken->setToken($randomString);
            $newSecuritytoken = $serviceManager
                ->get(SecuritytokenCommand::class)->update($securitytoken);
            if ($newSecuritytoken instanceof Securitytoken) {
                $this->setCookies($controller, $randomString, $newSecuritytoken);
            }
        } else {
            // delete securitytoken and remove cookies
            $serviceManager->get(SecuritytokenCommand::class)
                ->delete($securitytoken);                
            $this->removeCookies($controller);
        }
        // Redirect the same page and use identity.
        $routeName = $e->getRouteMatch()->getMatchedRouteName();

        return $controller->redirect()->toRoute($routeName, []);
    }
    
    /**
     * Check if securitytoken cookie and indentifier cookie exists
     * 
     * @param Cookie $cookie
     * @return bool
     */
    protected function cookiesExists(Cookie $cookie): bool
    {      
        $cookies = $cookie->getArrayCopy();        
        if (! array_key_exists('identifier', $cookies)) {
            
            return false;
        }
        if (! array_key_exists('securitytoken', $cookies)) {
            
            return false;
        }
        
        return true;
    }


    /**
     * Remove securitytoken cookie and indentifier cookie
     * 
     * @param object $controller
     */
    protected function removeCookies($controller)
    {
        $expires = time()-(3600*24*365);
        $cookieToken = new SetCookie('securitytoken', '', $expires, '/');
        $controller->getResponse()->getHeaders()->addHeader($cookieToken);
        $cookieIdentifier = new SetCookie('identifier', '', $expires, '/');
        $controller->getResponse()->getHeaders()->addHeader($cookieIdentifier);
    }
    
    /**
     * Set securitytoken cookie and indentifier cookie
     * 
     * @param object $controller
     * @param string $randomString
     * @param Securitytokene $securitytoken
     */
    protected function setCookies($controller, $randomString, $securitytoken)
    {          
        $expires = time()+(3600*24*365);
        $cookieToken = new SetCookie('securitytoken', $randomString, $expires, '/');
        $controller->getResponse()->getHeaders()->addHeader($cookieToken);
        $cookieIdentifier = new SetCookie(
            'identifier', $securitytoken->getIdentifier(), $expires, '/'
        );
        $controller->getResponse()->getHeaders()->addHeader($cookieIdentifier);
    }
}
