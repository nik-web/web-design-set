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

use User\Entity\User;
use User\Repository\UserInterface;
use Laminas\Authentication\Result;
use Laminas\Crypt\Password\Bcrypt;

/**
 * AuthAdapter class
 * 
 * Adapter used for authenticating user. It takes login (email or alias) and 
 * password on input and checks the database if there is a user with such login
 * and password exists.
 * If such user exists, the service returns his identity.
 * The identity is saved to session and can be retrieved later with Identity
 * view helper provided by Laminas
 *
 * @package User\Service
 */
class AuthAdapter implements AuthAdapterInterface
{
    /**
     * User email address or user alias
     *
     * @var string
     */
    private $log = null;

    /**
     * User password
     * 
     * @var string 
     */
    private $password = null;
    
    /**
     * Securitytoken
     * 
     * @var string
     */
    private $token = null;

    /**
     * Repository
     * 
     * @var UserInterface
     */
    private $repository;
    
    /**
     * Constructor.
     */
    public function __construct(UserInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setLog($log) 
    {
        $this->log = $log;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function setPassword($password) 
    {
        $this->password = (string)$password;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate()
    {
        // Check the in the database if there is a user with such email or alias.
        if (filter_var($this->log, FILTER_VALIDATE_EMAIL)) {
            // Log is a email address
            // Find user with such email address.
            $user = $this->repository->findByEmail($this->log);
        } else {
            // Log is a alias
            // Find user with such alias.
            $user = $this->repository->findByAlias($this->log);
        }
        // If there is no such user, return 'Identity Not Found' status.
        if (! $user instanceof User) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND, 
                null, 
                ['Invalid user not found.']);        
        } else {
            $userId = $user->getId();
        }  
        // If the user with such email or alias exists, we need to check if it is active or blocked.
        // Do not allow blocked users to log in.
        if ($user->getStatus() === User::STATUS_BLOCKED) {
            return new Result(
                Result::FAILURE, 
                null, 
                ['User is blocked.']);        
        }
        if (null != $this->password) {
            // Now we need to calculate hash based on user-entered password and compare
            // it with the password hash stored in database.
            $bcrypt = new Bcrypt();
            $passwordHash = $user->getPassword();
            if ($bcrypt->verify($this->password, $passwordHash)) {
                // The password hash matches. 
                // Return user identity (email) to be saved in session for later use.
                return new Result(
                    Result::SUCCESS,
                    $userId,
                    ['Authenticated successfully.']);        
            }             
            // If password check didn't pass return 'Invalid Credential' failure status.
            return new Result(
                Result::FAILURE_CREDENTIAL_INVALID, 
                null, 
                ['Invalid credentials.']);
        } elseif (null != $this->token) {
            return new Result(
                Result::SUCCESS,
                $userId,
                ['Authenticated successfully.']);
        }
    }
}
