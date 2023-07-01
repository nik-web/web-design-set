<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * Contact module with Laninas MVC framework
 *
 * @package    Contact\Form 
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Contact\Form;

use Laminas\Form\Form;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Captcha;
use Laminas\Captcha\Figlet;
use Laminas\Form\Element\Csrf;
use Laminas\Form\Element\Submit;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\StringLength;
use Laminas\Validator\Hostname;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\InArray;

/**
 * This contact form class is used to send user feedback data such as user email, 
 * message, subject and text.
 * 
 * @package Contact
 * @subpackage Contact\Form
 */
class ContactForm extends Form
{
    
   /**
    * Constructor of this form
    * 
    * Define form name: "contact_form"
    * POST method is default for this form
    * Add form elements to this form
    * Add input filter to the form elements of this form
    */
    public function __construct()
    {
        parent::__construct('contact_form');
        
        $this->setAttributes([
            'id'             => 'contact-form',
            'class'          => 'stands-alone-form',
            'accept-charset' => 'utf-8',
        ]);
        // This method adds form elements to this form
        $this->addElements();
        // This method add the filtering/validation rules
        $this->addInputFilter();
    }
    
    /**
     * This method adds form elements to this form.
     * 
     * Add form element text for the company name of the sender with name: "company"
     * Add form element text for the title of the sender with name: "title"
     * Add form element text for the fist name of the sender with name: "forename"
     * Add form element text for the last name of the sender with name: "surname"
     * Add form element email for the e-mail address of the sender with name: "email"
     * Add form element phone for the phonenumber of the sender with name: "phone"
     * Add form element text for the e-mail subject with name: "subject"
     * Add form element textarea for e-mail text with name: "body"
     * Add form element checkbox for accept privacy policy
     * Add form element checkbox for data processed accepted
     * Add form element csrf with name: "contact_csrf"
     * Add form element submit for the submit button with name: "contact_submit"
     */
  
    private function addElements() 
    {
        $this->add([
            'name'       => 'organization',
            'type'       => Text::class,
            'attributes' => [
                'id'           => 'organization',
                'autofocus'    => true,
                'autocomplete' => 'organization',
            ],
            'options'    => [
                'label'            => 'Unternehmen / Institution',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'title',
            'type'       => Text::class,
            'attributes' => [
                'id'           => 'title',
                'autocomplete' => 'off',
            ],
            'options'    => [
                'label'            => 'Titel',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'forename',
            'type'       => Text::class,
            'attributes' => [
                'id'           => 'forename',
                'autocomplete' => 'given-name',
            ],
            'options'    => [
                'label'            => 'Vorname',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([
            'name'       => 'surname',
            'type'       => Text::class,
            'attributes' => [
                'type'         => 'text',
                'id'           => 'surname',
                'autocomplete' => 'family-name',
            ],
            'options'    => [
                'label'            => 'Nachname',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([
            'name'    => 'email',
            'type'    => Text::class,
            'attributes' => [
                'id'           => 'email',
                'autocomplete' => 'email',
            ],
            'options' => [
                'label'            => 'E-Mail Adresse',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([
            'name'    => 'phone',
            'type'    => Text::class,
            'attributes' => [
                'id'           => 'phone',
                'autocomplete' => 'off',
            ],
            'options' => [
                'label'            => 'Telefonnummer',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([
            'name' => 'subject',
            'type'  => Text::class,
            'attributes' => [
                'type'  => 'text',
                'id'    => 'subject',
                'autocomplete' => 'off',
            ],
            'options' => [
                'label'            => 'Betreff',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([
            'name'  => 'message',
            'type'  => Textarea::class,
            'attributes' => [
                'id'    => 'message',
                'rows'  => '4',
                'autocomplete' => 'off',
            ],
            'options' => [
                'label'            => 'Nachricht',
                'label_attributes' => [
                    'class' => 'form-control-label',
                ],
            ],
        ]);
        $this->add([            
            'name'    => 'accept-privacy-policy',
            'type'    => Checkbox::class,
            'attributes' => [
                'id' => 'accept-privacy-policy',
            ],
            'options' => [
                'label'              => 'Bitte akzeptieren Sie unsere Datenschuzbestimmungen!',
                'use_hidden_element' => false,
                'label_attributes'   => [
                    'id'    => 'privacy-policy-label',
                    'class' => 'input-checkbox-label',
                ],
            ],
        ]);
        $this->add([            
            'name'    => 'data-processed-accepted',
            'type'    => Checkbox::class,
            'attributes' => [
                'id' => 'data-processed-accepted',
            ],
            'options' => [
                'label'              => 'Ich stimme zu, dass meine Angaben und Daten zur Beantwortung meiner Anfrage elektronisch erhoben und gespeichert werden.',
                'use_hidden_element' => false,
                'label_attributes'   => [
                    'id'    => 'data-processed-accepted-label',
                    'class' => 'input-checkbox-label',
                ],
            ],
        ]);
        $this->add([
            'name'    => 'captcha',
            'type'    => Captcha::class,
            'attributes' => [
                'type'         => 'text',
                'id'           => 'captcha',
                'class'        => 'captcha-input',
                'autocomplete' => 'off',
            ],
            'options' => [
                'label' => 'Sicherheitsabfrage',
                'label_attributes' => [
                    'id'    => 'form-label-captcha',
                    'class' => 'form-control-label',
                ],
                'captcha'   => [
                    'class' => Figlet::class,
                    'wordLen' => 4,
                    'timeout' => 300,
                    'messages' => [
                        Figlet::MISSING_VALUE => 'Dieses Feld ist ein Pflichtfeld!',
                        Figlet::MISSING_ID    => 'Captcha ID-Feld fehlt!',
                        Figlet::BAD_CAPTCHA   => 'Die Sicherheitsabfrage ist fehlgeschlagen, wiederholen Sie bitte die Eingabe!',
                    ],
                ],                
            ],            
        ]);
        $this->add([
            'name'    => 'csrf',
            'type'    => Csrf::class,
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type'  => Submit::class,
            'attributes' => [
                'id'    => 'submit',
                'class' => 'submit-success',
                'value' => 'Senden',
            ],
        ]);
    }
    
    /**
     * This method add input filter for the form elements of this form.
     * 
     */
    private function addInputFilter() 
    {
        // Get the default input filter attached to form model.
        $inputFilter = $this->getInputFilter();
        
        $inputFilter->add([
            'name'     => 'organization',
            'required' => false,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
        ]);
        $inputFilter->add([
            'name'     => 'title',
            'required' => false,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
        ]);
        $inputFilter->add([
            'name'     => 'forename',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],                
            'validators' => [
                [
                    'name'    => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Dieses Feld ist ein Pflichtfeld!',
                        ],
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min'      => 2,
                        'max'      => 128,
                        'messages' => [
                            StringLength::TOO_SHORT => "Die Eingabe muss mindextens %min% Zeichen lang sein.",
                            StringLength::TOO_LONG  => "Die Eingabe darf maximal %max% Zeichen lang sein.",
                        ],
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name'     => 'surname',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],                
            'validators' => [
                [
                    'name'    => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Dieses Feld ist ein Pflichtfeld!',
                        ],
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min'      => 2,
                        'max'      => 128,
                        'messages' => [
                            StringLength::TOO_SHORT => "Die Eingabe muss mindextens %min% Zeichen lang sein.",
                            StringLength::TOO_LONG  => "Die Eingabe darf maximal %max% Zeichen lang sein.",
                        ],
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name'     => 'email',
            'required' => true,
            'filters'  => [
               ['name' => 'StringTrim'],                    
            ],                
            'validators' => [
                [
                    'name'    => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Dieses Feld ist ein Pflichtfeld!',
                        ],
                    ],
                ],
               [
                'name' => 'EmailAddress',
                'options' => [
                    'allow'      => Hostname::ALLOW_DNS,
                    'useMxCheck' => false,
                    'messages'   => [
                        EmailAddress::INVALID_FORMAT      => "Die Eingabe ist keine gültige E-Mail Adresse. Verwenden Sie das Basisformat local-part@hostname.",
                        EmailAddress::INVALID_HOSTNAME    => "'%hostname%' ist kein gültiger Hostname für die E-Mail-Adresse",
                        Hostname::UNKNOWN_TLD             => "Die Eingabe scheint ein DNS-Hostname zu sein, kann die TLD jedoch nicht mit der bekannten Liste abgleichen.",
                        Hostname::LOCAL_NAME_NOT_ALLOWED  => "Die Eingabe scheint ein lokaler Netzwerkname zu sein, lokale Netzwerknamen sind jedoch nicht zulässig",
                    ],                          
                ],
              ],
            ],
        ]);
        $inputFilter->add([
            'name'     => 'phone',
            'required' => false,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
        ]);
        $inputFilter->add([
            'name'     => 'subject',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],                
            'validators' => [
                [
                    'name'    => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Dieses Feld ist ein Pflichtfeld!',
                        ],
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min'      => 2,
                        'max'      => 128,
                        'messages' => [
                            StringLength::TOO_SHORT => "Die Eingabe muss mindextens %min% Zeichen lang sein.",
                            StringLength::TOO_LONG  => "Die Eingabe darf maximal %max% Zeichen lang sein.",
                        ],
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name'     => 'message',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],                    
                ['name' => 'StripTags'],
            ],                
            'validators' => [
                [
                    'name'    => 'NotEmpty',
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Dieses Feld ist ein Pflichtfeld!',
                        ],
                    ],
                ],
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min'      => 3,
                        'max'      => 4096,
                        'messages' => [
                            StringLength::TOO_SHORT => "Die Eingabe muss mindextens %min% Zeichen lang sein.",
                            StringLength::TOO_LONG  => "Die Eingabe darf maximal %max% Zeichen lang sein.",
                        ],
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name'       => 'accept-privacy-policy',
            'required'   => true,
            'filters'    => [],                
            'validators' => [
                [
                    'name'    => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Sie müssen unsere Datenschutzbestimmungen akzeptieren!',
                        ],
                    ],
                ],
                [
                    'name'    => InArray::class,
                    'options' => [
                        'haystack' => [0, 1],
                    ]
                ],
            ],
        ]);
        $inputFilter->add([
            'name'       => 'data-processed-accepted',
            'required'   => true,
            'filters'    => [],                
            'validators' => [
                [
                    'name'    => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'Sie müssen dem Speichern und dem Verarbeiten der elektronisch erhobenen Angaben und Daten zustimmen!',
                        ],
                    ],
                ],
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
