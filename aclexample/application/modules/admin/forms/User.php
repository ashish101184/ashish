<?php
class Admin_Form_User extends App_Form_tcForm
{
  protected static $showFields = array(
      'username',
      'password',
  );
    public $resourceConfig = array(
            'fields'=>array('User_picture_'),
            'field_name'=>array('User_picture_'=>'picture'),
            'destinations'=>array('User_picture_'=>'upload/user')
    );
  
  
 public function configure()
 {
    $this->setWidgets(array(
              'username' => new sfWidgetFormInput(array('label' => 'Your username:')),
              'password' => new sfWidgetFormTextarea(array('label' => 'Please pass:')),
              'picture' => new sfWidgetFormInputFile(array('label' => 'Upload file:'))
    ));   
    
   
    $this->setValidators(array(
              'username' => new sfValidatorString(array('max_length' => 255, 'required' => true)),
              'password' => new sfValidatorString(array('max_length' => 255, 'required' => true))
    ));
    $this->validatorSchema->setOption('allow_extra_fields', true);
    $this->widgetSchema->setNameFormat('User[%s]');    
 }
}