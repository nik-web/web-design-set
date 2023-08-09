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
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\InArray;

/**
 * UserEditForm
 * 
 * This form is used to update users.
 * 
 * @package User\Form
 */
class UserEditForm extends Form
{
    /**
     * Constructor.
     *     
     */
    public function __construct()
    {        
        // Define form name
        parent::__construct('edit-form');
        // POST method is default by laminas
        $this->setAttributes([
            'id'             => 'edit-form',
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
        // Add the form element select for user status
        $this->add([
            'name'    => 'status',
            'type'    => Select::class,
            'attributes' => [
                'id'        => 'status',
                'class'     => 'form-control',                
            ],
            'options' => [
                'label'            => 'Nutzer-Status',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
                'value_options'    => [
                    1 => 'Aktiv',
                    0 => 'Gesperrt',
                ],
            ],
        ]);
        // Add the csrf form element
        $this->add([
            'name'    => 'csrf',
            'type'    => Csrf::class,
            'options' => [
                'csrf_options' => [
                'timeout' => 600
                ]
            ],
        ]);
        // Add the form element submit
        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [                
                'value' => 'Speichern',
                'class' => 'submit-success',
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
        // Add input for "status" field
        $inputFilter->add([
            'name'     => 'status',
            'required' => false,
            'filters'  => [                    
            ],                
            'validators' => [
                [
                    'name'    => InArray::class,
                    'options' => [
                        'haystack' => [1, 0],
                        'messages' => [
                            InArray::NOT_IN_ARRAY => 'Diese Statuseingabe ist nicht möglich!',
                        ],
                    ]
                ],
            ],
        ]);
    }
}