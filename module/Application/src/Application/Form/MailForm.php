<?php
/**
 * Created by PhpStorm.
 * User: yukhimenko
 * Date: 29.08.14
 * Time: 17:37
 */

namespace Application\Form;

use Zend\Form\Form;

class MailForm extends Form {


    function __construct($name = null)
    {
        parent::__construct('Mail');

        $this->setAttribute('role', 'form');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'name' => 'from',
            'type' => 'Email',
            'options' => array(
                'label' => 'From:',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Enter sender email',
            ),
        ));

        $this->add(array(
            'name' => 'to',
            'type' => 'Email',
            'options' => array(
                'label' => 'To:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Enter recipient email',
            ),
        ));

        $this->add(array(
            'name' => 'subject',
            'type' => 'Text',
            'options' => array(
                'label' => 'Subject:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Enter email subject',
            ),
        ));

        $this->add(array(
            'name' => 'message',
            'type' => 'TextArea',
            'options' => array(
                'label' => 'Message:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Enter email message',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Send',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            )
        ));

        //$this->setDefaults(array('from' => 'smtp@smtp.cera-gmc.org'));
    }
}