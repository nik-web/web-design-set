<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Entity
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Entity;

/**
 * User class
 * 
 * This class represents a registered user.
 *
 * @package User\Entity
 */
class User
{
    /**
     * User status active constants .
     */
    const STATUS_ACTIVE = 1;
    
    /**
     * User status blocked constants .
     */
    const STATUS_BLOCKED = 0;
    
    /**
     * @var integer|null Should contain a identifier
     */
    private $id = null;
    
    /**
     * @var string|null Should contain a alias
     */
    private $alias = null;
    
    /**
     * @var string|null Should contain a e-mail address
     */
    private $email = null;
    
    /**
     * @var string|null Shoud contain a passwordhash
     */
    private $password = null;
    
    /**
     * @var integer|null Should contain a status
     */
    private $status = null;

    /**
     * @var string|null Shound contain a create date-time
     */
    private $createdOn = null;
    
    /**
     * @var string|null Shound contain a update date-time
     */
    private $updatedOn = null;
    
    /**
     * @var string|null Shound contain a password reset token
     */
    private $pwdResetToken = null;
    
    /**
     * @var string|null Shound contain a password reset token create date-time
     */
    private $pwdResetTokenCreatedOn = null;
    
    /**
     * Constructor
     * 
     * @param string $alias
     * @param string $email
     * @param string $password
     * @param integer $status
     * @param string $createdOn
     * @param string $updatedOn
     * @param string $pwdResetToken
     * @param string $pwdResetTokenCreatedOn
     * @param integer $id
     */
    public function __construct(
        $alias, $email, $password, $status, $createdOn, $updatedOn,
        $pwdResetToken, $pwdResetTokenCreatedOn, $id = null
    ){
        $this->alias = $alias;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->createdOn = $createdOn;
        $this->updatedOn = $updatedOn;
        $this->pwdResetToken = $pwdResetToken;
        $this->pwdResetTokenCreatedOn = $pwdResetTokenCreatedOn;
        $this->id = $id;
    }
    
    /**
     * Get identifier
     * 
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * Get e-mail address
     * 
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    /**
     * Get alias
     * 
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }
    
    /**
     * Get passwordhash
     * 
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }
    
    /**
     * Get status
     * 
     * @return integer|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * Returns the date of user creation.
     * 
     * @return string|null    
     */
    public function getCreatedOn(): ?string
    {
        return $this->createdOn;
    }
    
    /**
     * Returns the date when user was updated.
     * 
     * @return string|null    
     */
    public function getUpdatedOn(): ?string 
    {
        return $this->updatedOn;
    }
    
    /**
     * Returns password reset token.
     * 
     * @return string|null
     */
    public function getPwdResetToken(): ?string
    {
        return $this->pwdResetToken;
    }
        
    /**
     * Returns password reset token's creation date.
     * 
     * @return string|null
     */
    public function getPwdResetTokenCreatedOn(): ?string
    {
        return $this->pwdResetTokenCreatedOn;
    }
   
    /**
     * Exchange array
     * 
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        
        if (1 === intval($data['status']) | 0 === intval($data['status'])) {
            $status = intval ($data['status']);
        } else {
            $status = null;
        }
        
        $this->id = !empty($data['id']) ? intval($data['id']) : null;
        $this->alias = !empty($data['alias']) ? $data['alias'] : null;
        $this->email  = !empty($data['email']) ? $data['email'] : null;
        $this->password = !empty($data['password']) ? $data['password'] : null;
        $this->status = $status;
        $this->createdOn = !empty($data['created_on']) ? $data['created_on'] : null;
        $this->updatedOn = !empty($data['updated_on']) ? $data['updated_on'] : null;
        $this->pwdResetToken = !empty($data['pwd_reset_token']) ? $data['pwd_reset_token'] : null;
        $this->pwdResetTokenCreatedOn = !empty($data['pwd_reset_token_created_on']) ? $data['pwd_reset_token_created_on'] : null;
    }
    
    /**
     * Get array copy
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'                         => $this->id,
            'alias'                      => $this->alias,
            'email'                      => $this->email,
            'password'                   => $this->password,
            'status'                     => $this->status,
            'created_on'                 => $this->createdOn,
            'updated_on'                 => $this->updatedOn,
            'pwd_reset_token'            => $this->pwdResetToken,
            'pwd_reset_token_created_on' => $this->pwdResetTokenCreatedOn,
        ];
    }
}
