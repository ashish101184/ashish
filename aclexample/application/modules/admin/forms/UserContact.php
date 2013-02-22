<?php
class Admin_Form_UserContact extends App_Form_tcForm
{
  protected static $showFields = array(
      'User',
      'Contact',
  );
  
 public function configure()
 {
    //$this->widgetSchema->setNameFormat('UserContact[%s]');
    $this->embedUserContact();
    $this->validatorSchema->setOption('allow_extra_fields', true);
 }
 
 private function embedUserContact(){
   $userForm = new Admin_Form_User();
   $userForm->objectModel = new Model_User();
   
   $contactForm = new Admin_Form_Contact();
   $contactForm->objectModel = new Model_Contact();
   
   $this->embedForm('User', $userForm);   
   $this->embedForm('Contact', $contactForm);
   
 }
}

