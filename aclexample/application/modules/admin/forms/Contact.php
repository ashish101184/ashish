<?php
class Admin_Form_Contact extends App_Form_tcForm
{
 public function configure()
 {
    $this->setWidgets(array(
              'first_name' => new sfWidgetFormInput(array('label' => 'Your fname:')),
              'last_name' => new sfWidgetFormTextarea(array('label' => 'Please lname:')),
              'phone' => new sfWidgetFormTextarea(array('label' => 'Please phone:')),
              'email' => new sfWidgetFormTextarea(array('label' => 'Please email:')),
              'address' => new sfWidgetFormTextarea(array('label' => 'Please address:'))
    ));
   
    $this->setValidators(array(
              'first_name' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
              'last_name' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
              'phone' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
              'email' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
              'address' => new sfValidatorString(array('max_length' => 255, 'required' => true))
    ));    
    $this->widgetSchema->setNameFormat('Contact[%s]');
 }
 
}

