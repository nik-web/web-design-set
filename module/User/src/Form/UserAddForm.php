<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Form  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Form;

use Laminas\Db\Adapter\AdapterInterface; // Configuring the default adapter
use Laminas\Form\Form;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\InputFilter\InputFilter;
use Laminas\Filter\StringTrim;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\StringLength;
use Laminas\Validator\Db\NoRecordExists;
use Laminas\Validator\Db\AbstractDb;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\Hostname;
use Laminas\Validator\Identical;
use User\ValueObject\Data;

/**
 * Add Form
 * 
 * This form is used to create users.
 * 
 * @package User
 * @subpackage User\Form
 */
class UserAddForm extends Form
{
    /**
     * @var AdapterInterface 
     */
    private $dbAdapter;
    
    /**
     * Constructor.
     * 
     * @param AdapterInterface $dbAdapter    
     */
    public function __construct(AdapterInterface $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        
        // Define form name
        parent::__construct('add-form');
        // POST method is default by laminas
        $this->setAttributes([
            'id'             => 'add-form',
            'class'          => 'stands-alone-form',
            'accept-charset' => 'utf-8',
        ]);
        $this->addElements();
        $this->addInputFilter();          
    }
    
    /**
     * This method adds elements to form.
     */
    protected function addElements()
    {
        // Add a text element for the alias
        $this->add([
            'name'       => 'alias',            
            'type'       => Text::class,
            'attributes' => [
                'id'        => 'alias',
                'class'     => 'form-control',
                'autofocus' => true,
            ],
            'options'    => [
                'label'            => 'Nutzername',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        // Add a text element fot the email
        $this->add([                        
            'name'       => 'email',
            'type'       => Text::class,
            'attributes' => [
                'id'        => 'email',
                'class'     => 'form-control',
            ],
            'options'    => [
                'label'            => 'E-Mail Adresse',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        // Add a password element for the password
        $this->add([
            'name'       => 'password',
            'type'       => Password::class,
            'attributes' => [
                'id'        => 'password',
                'class'     => 'form-control',
            ],
            'options'    => [
                'label'            => 'Passwort',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        // Add a passwort element for the confirm password
        $this->add([
            'name'       => 'confirm_password',
            'type'       => Password::class,
            'attributes' => [
                'id'        => 'confirm-password',
                'class'     => 'form-control',
            ],
            'options'    => [
                'label'            => 'Passwort bestätigen',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);        
        // Add a csrf element
        $this->add([
            'name'    => 'login_csrf',
            'type'    => Csrf::class,
            'options' => [
                'csrf_options' => [
                     'timeout' => 600,
                ],
            ]
        ]);
        // Add a submit element
        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [                
                'value' => 'Anlegen',
                'class' => 'submit-success',
            ],
        ]);  
    }
    
    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() 
    {   
        $aliasMinLength = Data::ALIAS_MIN_LENGTH;
        $aliasMinMessage = sprintf('Der Nutzername muss mindextens %d Zeichen lang sein!', $aliasMinLength);
        $aliasMaxLenght = Data::ALIAS_MAX_LENGTH;
        $aliasMaxMessage = sprintf('Der Nutzername darf maximal %d Zeichen lang sein!', $aliasMaxLenght);
        $passwordMinLength = Data::PASSWORD_MIN_LENGTH;
        $passwordMinMessage = sprintf('Das Passwort muss mindextens %d Zeichen lang sein!', $passwordMinLength);
        $passwordMaxLenght = Data::PASSWORD_MAX_LENGTH;
        $passwordMaxMessage = sprintf('Das Passwort darf maximal %d Zeichen lang sein!', $passwordMaxLenght);
        // Create main input filter
        $inputFilter = new InputFilter();
        // Set input filter to this form       
        $this->setInputFilter($inputFilter);
        // Add input filter for alias
        $inputFilter->add(
            [
                'name'       => 'alias',
                'required'   => true,
                'filters'    => [                    
                    ['name' => StringTrim::class],
                ],                
                'validators' => [
                    [
                        'name'    => NotEmpty::class,
                        'options' => [
                            'messages' => [
                                NotEmpty::IS_EMPTY => 'Ein Nutzername ist erforderlich, dieser darf nicht leer sein!',
                            ],
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => $aliasMinLength,
                            'max'      => $aliasMaxLenght,
                            'messages' => [
                                StringLength::TOO_SHORT => $aliasMinMessage,
                                StringLength::TOO_LONG  => $aliasMaxMessage,
                            ],
                        ],
                    ],
                    /*
                    [
                        'name'    => NoRecordExists::class,
                        'options' => [
                            'table'    => 'registration_registrations',
                            'field'    => 'alias',
                            'adapter'  => $this->dbAdapter,
                            'messages' => [
                                AbstractDb::ERROR_RECORD_FOUND => 'Eine Anmeldung mit diesem Nutzernamen ist bereits vornaden!',
                            ],
                        ],
                    ],
                     * 
                     */
                    [
                        'name'    => NoRecordExists::class,
                        'options' => [
                            'table'   => 'user_users',
                            'field'   => 'alias',
                            'adapter' => $this->dbAdapter,
                            'messages' => [
                                AbstractDb::ERROR_RECORD_FOUND => 'Eine Anmeldung mit diesem Nutzernamen ist bereits vornaden!',
                            ],
                        ],
                    ],
                ],
                
            ]
        );
        // Add input filer for email
        $inputFilter->add([
            'name'       => 'email',
            'required'   => true,
            'filters'    => [
                ['name' => StringTrim::class],                    
            ],                
            'validators' => [
                [
                    'name'    => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Eine E-Mail Adresse ist erforderlich!',
                        ],
                    ],
                ],
                [
                    'name'    => EmailAddress::class,
                    'options' => [
                        'allow'      => Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                        'messages'   => [
                            EmailAddress::INVALID_FORMAT => 'Die Eingabe ist keine gültige E-Mail Adresse! Verwenden Sie das Basisformat local-part@hostname.',
                        ],
                    ],
                ],
                /*
                [
                    'name'    => NoRecordExists::class,
                    'options' => [
                        'table'    => 'registration_registrations',
                        'field'    => 'email',
                        'adapter'  => $this->dbAdapter,
                        'messages' => [
                            AbstractDb::ERROR_RECORD_FOUND => 'Eine Anmeldung mit dieser E-Mail Adresse ist bereits vornaden!',
                        ],
                    ],
                ],
                 * 
                 */
                [
                    'name'    => NoRecordExists::class,
                    'options' => [
                        'table'    => 'user_users',
                        'field'    => 'email',
                        'adapter'  => $this->dbAdapter,
                        'messages' => [
                            AbstractDb::ERROR_RECORD_FOUND => 'Eine Anmeldung mit dieser E-Mail Adresse ist bereits vornaden!',
                        ],
                    ],
                ],                  
            ],
        ]);
        // Add input filter for password
        $inputFilter->add([
                'name'       => 'password',
                'required'   => true,
                'filters'    => [
                    ['name' => StringTrim::class],                    
                ],                
                'validators' => [
                    [
                        'name'    => NotEmpty::class,
                        'options' => [
                            'messages' => [
                                NotEmpty::IS_EMPTY => 'Eine Eingabe des Passworts ist erforderlich!',
                            ],
                        ],
                    ],
                    [
                        'name'    => StringLength::class,
                        'options' => [
                            'min'      => $passwordMinLength,
                            'max'      => $passwordMaxLenght,
                            'messages' => [
                                StringLength::TOO_SHORT => $passwordMinMessage,
                                StringLength::TOO_LONG  => $passwordMaxMessage,
                            ],
                        ],
                    ],
                ],
            ]);
        // Add input filter for confirm password
        $inputFilter->add([
            'name'       => 'confirm_password',
            'required'   => true,
            'filters'    => [                        
            ],                
            'validators' => [
                [
                    'name'    => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Eine Bestätigung des Passworts ist erforderlich!',
                        ],
                    ],
                ],
                [
                    'name'    => Identical::class,
                    'options' => [
                        'token'    => 'password',
                        'messages' => [
                            Identical::NOT_SAME => 'Die Bestätigung des Passworts ist nicht korrekt!',
                        ],                            
                    ],
                ],
            ],
        ]);
    }
}