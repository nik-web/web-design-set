<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    UserTest\Entity      
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace UserTest\Entity;

use PHPUnit\Framework\TestCase;
use User\Entity\User;

/**
 * UserTest class
 *
 * @package UserTest\Entity
 */
class UserTest extends TestCase
{
    /**
     * Are all of the Album's properties initially set to NULL
     * 
     * @return void
     */
    /*
    public function testInitialUserValuesAreNull() : void
    {
        $user = new User();
        
        $this->assertNull($user->getId(), '"id" should be null by default');
        $this->assertNull($user->getEmail(), '"email" should be null by default');
        $this->assertNull($user->getAlias(), '"alias" should be null by default');
        $this->assertNull($user->getPassword(), '"password" should be null by default');
        $this->assertNull($user->getStatus(), '"status" should be null by default');
        $this->assertNull($user->getCreatedOn(), '"created on" should be null by default');
        $this->assertNull($user->getUpdatedOn(), '"updated on" should be null by default');
        $this->assertNull($user->getPwdResetToken(), '"pws reset token" should be null by default');
        $this->assertNull($user->getPwdResetTokenCreatedOn(), '"pwd reset token created on" should be null by default');
    }
     * 
     */
    
    
    public function testGetters()
    {
        $id = 1;
        $alias = 'john_doe';
        $email = 'john@example.com';
        $password = 'hashed_password';
        $status = 1;
        $createdOn = '2023-07-22 10:00:00';
        $updatedOn = '2023-07-22 10:30:00';
        $pwdResetToken = 'reset_token';
        $pwdResetTokenCreatedOn = '2023-07-22 11:00:00';

        $user = new User($alias, $email, $password, $status, $createdOn, $updatedOn, $pwdResetToken, $pwdResetTokenCreatedOn, $id);

        // Test getters
        $this->assertSame($id, $user->getId());
        $this->assertSame($alias, $user->getAlias());
        $this->assertSame($email, $user->getEmail());
        $this->assertSame($password, $user->getPassword());
        $this->assertSame($status, $user->getStatus());
        $this->assertSame($createdOn, $user->getCreatedOn());
        $this->assertSame($updatedOn, $user->getUpdatedOn());
        $this->assertSame($pwdResetToken, $user->getPwdResetToken());
        $this->assertSame($pwdResetTokenCreatedOn, $user->getPwdResetTokenCreatedOn());
    }

}
