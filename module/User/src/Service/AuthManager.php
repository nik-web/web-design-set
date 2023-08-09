<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Service  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Service;

use User\Service\AuthManagerInterface;
use Laminas\Authentication\AuthenticationServiceInterface;
use User\Repository\SecuritytokenInterface as Repository;
use User\Command\SecuritytokenInterface as Command;
use User\Entity\Securitytoken;
use Laminas\Http\Header\SetCookie;

/**
 * AuthManager class
 * 
 * The main business logic behind authentication is implemented in this service.
 *
 * @package User\Service
 */
class AuthManager implements AuthManagerInterface
{
    /**
    * @var AuthenticationServiceInterface
    */
    protected $authService;
    
    /**
     * @var Repository
     */
    protected $repository;
    
    /**     
     * @var Command
     */
    protected $command;


    /**
     * Constructs the service.
     * 
     * @param AuthenticationServiceInterface $authService
     * @param Repository $repository
     * @param Command $command
     */
    public function __construct(
        AuthenticationServiceInterface $authService,
        Repository $repository,
        Command $command
    ) {
        $this->authService = $authService;
        $this->repository = $repository;
        $this->command = $command;
    }
    
    /**
     * {@inheritDoc}
     */
    public function login($log, $password, $rememberMe): array
    {
        $data = [];
        // Allow login only if the user is not logged in.
        if ($this->authService->getIdentity() == null) {
            // Authenticate with email/password.
            $authAdapter = $this->authService->getAdapter();
            $authAdapter->setLog($log);
            $authAdapter->setPassword($password);
            // \Laminas\Authentication\Result
            $result = $this->authService->authenticate();
            $resultCode = $result->getCode();
            $data['code'] = $resultCode;
            if (1 === $resultCode) {
                $identity = $this->authService->getIdentity();
                // Delete old token from db
                $securitytoken = $this->repository->findByIdentity($identity);
                if ($securitytoken instanceof Securitytoken) {
                    $this->command->delete($securitytoken); 
                }
            }
            if ($rememberMe && 1 === $resultCode) {
                // Insert securitytoken to db
                $securitytoken = new Securitytoken(
                    $identity, null, null, date('Y-m-d H:i:s')
                );
                $securitytoken->setIdentifier();
                $randomString = Securitytoken::getRandomString();
                $securitytoken->setToken($randomString);
                $this->command->insert($securitytoken);
                $cookieIdentifier = new SetCookie(
                    'identifier', $securitytoken->getIdentifier(),
                    time()+(3600*24*365), '/'
                );
                $data['identifier'] = $cookieIdentifier;
                $cookieToken = new SetCookie(
                    'securitytoken', $randomString, time()+(3600*24*365), '/'
                );
                $data['securitytoken'] = $cookieToken;
            }
        }
        
        return $data;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function logout()  
    {
        $identity = $this->authService->getIdentity();
        // Allow to log out only when user is logged in.
        if ($identity != null) {
            $securitytoken = $this->repository->findByIdentity($identity);
            if ($securitytoken instanceof Securitytoken) {
                $this->command->delete($securitytoken); 
            }
            
            $this->authService->clearIdentity();
        }
    }
}
