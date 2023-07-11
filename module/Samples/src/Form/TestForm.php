<?php

/**
 * Samples module with Laninas MVC framework
 *
 * @package    Samples\Form
 * @author     Niklaus Höpfner <author@nik-web.net>
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Samples\Form;

use Laminas\Form\Form;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;

/**
 * TestForm
 * 
 * This form is used to redirect
 * 
 * @package Samples\Form
 */
class TestForm extends Form
{
    /**
     * Constructor.
     *     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('test-form');
        // POST method is default by laminas
        $this->setAttributes([
            'id'    => 'test-form',
            'class' => 'stands-alone-form',
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
        // Add the form element submit
        $this->add([
            'name'       => 'submit',
            'type'       => Submit::class,
            'attributes' => [                
                'value' => 'Start',
                'class' => 'submit-success',
            ],
        ]);
    }
}
