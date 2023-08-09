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

use Laminas\Form\Form;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\InputFilter\InputFilter;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\StripNewlines;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\InArray;

/**
 * LoginForm
 *
 * @package User\Form
 */
class LoginForm extends Form
{
    /**
     * Constructor
     *     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('login-form');
        // POST method is default by laminas
        $this->setAttributes([
            'id'             => 'login-form',
            'class'          => 'stands-alone-form',
            'accept-charset' => 'utf-8',
        ]);
        // This method adds form elements to this form
        $this->addElements();
        // This method add the filtering/validation rules
        $this->addInputFilter();          
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() 
    {
        // Add a text element for the log
        $this->add([
            'name'       => 'log',
            'type'       => Text::class,
            'attributes' => [
                'id'        => 'log',
                'autofocus' => true,
            ],
            'options'    => [
                'label'            => 'Nutzername / E-Mail Adresse',
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
            ],
            'options' => [
                'label'            => 'Passwort',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);        
        // Add a checkbox element for the remember me
        $this->add([            
            'name'    => 'remember_me',
            'type'    => Checkbox::class,
            'options' => [
                'label'              => 'Angemeldet bleiben',
                'use_hidden_element' => false,
                'label_attributes'   => [
                    'id'    => 'remember_me_label',
                    'class' => 'input-checkbox-label',
                ],
            ],
        ]);
        // Add a csrf element
        $this->add([
            'name'    => 'csrf',
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
                'id'    => 'submit',
                'class' => 'submit-success',                
                'value' => 'Einloggen',
            ],
        ]);
    }
    
    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() 
    {
        // Create main input filter
        $inputFilter = new InputFilter();
        // Set input filter to this form      
        $this->setInputFilter($inputFilter);     
        // Add input for the log
        $inputFilter->add([
            'name'     => 'log',
            'required' => true,
            'filters'  => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class],
                ['name' => StripNewlines::class],                    
            ],                
            'validators' => [
                [
                    'name'    => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Eine Eingabe ist erforderlich!',
                        ],
                    ],
                ],
            ],
        ]);     
        // Add input for the password
        $inputFilter->add([
            'name'     => 'password',
            'required' => true,
            'filters'  => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class],
                ['name' => StripNewlines::class],                 
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
            ],
        ]);
        // Add input for remember me
        $inputFilter->add([
            'name'       => 'remember_me',
            'required'   => false,
            'filters'    => [],                
            'validators' => [
                [
                    'name'    => InArray::class,
                    'options' => [
                        'haystack' => [0, 1],
                    ]
                ],
            ],
        ]);
    }   
}
