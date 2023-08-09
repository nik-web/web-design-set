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
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;

/**
 * UserDeleteForm
 * 
 * This form is used to delete users.
 * 
 * @package User\Form
 */
class UserDeleteForm extends Form
{
    /**
     * Constructor.
     *     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('delete-form');
        // POST method is default by laminas
        $this->setAttributes([
            'id'    => 'delete-form',
            'class' => 'stands-not-alone-form',
        ]);
        $this->addElements();          
    }
    
    /**
     * This method adds elements to form.
     */
    protected function addElements()
    {
        // Add the form element csrf
        $this->add([
            'name'    => 'csrf',
            'type'    => Csrf::class,
            'options' => [
                'csrf_options' => [
                    'timeout' => 600,
                ]
            ],
        ]);
        // Add the form element submit for confirm
        $this->add([
            'name'       => 'confirm',
            'type'       => Submit::class,
            'attributes' => [                
                'value' => 'Bestätigen',
                'class' => 'submit-danger',
            ],
        ]);
        // Add the form element submit for cancel
        $this->add([
            'name'       => 'cancel',
            'type'       => Submit::class,
            'attributes' => [                
                'value' => 'Abbrechen',
                'class' => 'submit-primary',
            ],
        ]);
    }
}
