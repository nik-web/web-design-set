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
 * Securitytoken for remember me
 * 
 * @package User\Entity
 */
class Securitytoken
{    
    /**
     * @var integer|null Should contain a identifier
     */
    private $id = null;
    
    /**
     * @var integer|null user identifier
     */
    private $identity = null;
    
    /**
     * @var string|null value for cookie indifier
     */
    private $identifier = null;
    
    /**
     * @var string|null value for cookie securitytoken
     */
    private $token = null;

    /**
     * @var string|null Shound contain a create date-time
     */
    private $createdOn;
    
    /**
     * Generating a random string of 32 hexadecimal characters (equivalent to 16 bytes).
     * 
     * @return string
     */
    static function getRandomString(): string
    {
        if(function_exists('random_bytes')) {
            $bytes = random_bytes(16);
            $string = bin2hex($bytes); 
        } elseif(function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes(16);
            $string = bin2hex($bytes); 
        } elseif(function_exists('mcrypt_create_iv')) {
            $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
            $string = bin2hex($bytes); 
        } else {
            // any string with > 12 characters
            $string = md5(uniqid('A2_$100-qGccX?', true));
        }
        
        return $string;
    }

    /**
     * Constructor.
     * 
     * @param integer $identity
     * @param string $identifier
     * @param string $token
     * @param string $createdOn
     * @param integer $id
     */
    public function __construct($identity, $identifier, $token, $createdOn, $id = null) 
    {
        $this->identity = $identity;
        $this->identifier = $identifier;
        $this->token = $token;
        $this->createdOn = $createdOn;
        $this->id = $id;
    }
    
    /**
     * Set identifier
     * 
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Get identifier
     * 
     * @return integer|null
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set user auth identity
     * 
     * @param integer $identity user auth identity
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }
    
    /**
     * Get user auth identity
     * 
     * @return integer $identity user auth idetity
     */
    public function getIdentity()
    {
        return $this->identity;
    }
    
    /**
     * Set value for cookie indifier
     */
    public function setIdentifier()
    {
        $this->identifier = self::getRandomString();
    }
    
    /**
     * Get value for cookie indifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
    
    /**
     * Set value for cookie securitytoken
     * 
     * @param string $randomString 
     */
    public function setToken($randomString)
    {
        $this->token = sha1($randomString);
    }
    
    /**
     * Set value for cookie securitytoken
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set date created on
     * 
     * @param string $date
     */
    public function setCreatedOn($date)
    {
        $this->createdOn = $date;
    }
    
    /**
     * Get date created on
     * 
     * @return string|null
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
    
    /**
     * Exchange array
     * 
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? intval($data['id']) : null;
        $this->identity = !empty($data['identity']) ? intval($data['identity']) : null;
        $this->identifier = !empty($data['identifier']) ? $data['identifier'] : null;
        $this->token = !empty($data['token']) ? $data['token'] : null;
        $this->createdOn = !empty($data['created_on']) ? $data['created_on'] : null;
    }
    
    /**
     * Get array copy
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'id'         => $this->id,
            'identity'   => $this->identity,
            'identifier' => $this->identifier,
            'token'      => $this->token,
            'created_on' => $this->createdOn,
        ];
    }
}
