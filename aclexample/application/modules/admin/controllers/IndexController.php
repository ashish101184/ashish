<?php

class Admin_IndexController extends App_Controller_tcAction
{


    
    public function init()
    {
        /* Initialize action controller here */
      parent::init();
    }
    
    public function indexAction()
    {
        // action body
      $this->view->current_date_and_time = date('M d, Y - H:i:s');
      
         
      //$user->username = 'new_user_2@test.local';
      //$user->password = 'test';
      //$user->save();
      /*      
      $users = Model_UserTable::getInstance()->findById("1");
      foreach($users as $user){
        $contact = $user->Contact;
      }
      $cusers = $contact->User;
      print_r($contact);exit;
      
      
      $form = new ZFDoctrine_Form_Model(array(
          'model' => 'Model_User',
          'action' => '',
          'method' => 'post'
      ));
      $this->view->form = $form;
      
      
      if($this->getRequest()->isPost() && $form->isValid($_POST)) {
        // This saves the form's data to the DB.
        // $record will be the new model instance created when saving.
        $record = $form->save();
      
        //redirect elsewhere after completion
        $this->_redirect('/admin');
      }
      exit;
      /*
      // action body
      //$user = new Model_User();
      $users = Model_UserTable::getInstance()->findById("1");
      foreach($users as $user){
        $userdata = $user;
      }      
      if($userdata){
        $form = new Admin_Form_User($userdata->toArray());
        $form->setObject($user);
      } 
      if($this->getRequest()->isPost()){
          $this->processForm($form, '/admin');        
      }
       
      $this->view->form = $form;
      */
      ///$doc = new Doctrine_Form('User');
      //$user->logOut();exit;
      
      $this->generateResourcesAction();
      
      $form = new Admin_Form_UserContact();
      if($this->getRequest()->isPost()){
        $this->processForm($form, '/admin');
      }
      $this->view->form = $form;
    }
    
    public function pageAction(){      
      $this->view->pagerLayout = $this->paginate();
      $pager = $this->view->pagerLayout->getPager();      
      // Fetching users
      $this->view->items = $pager->execute();          
    }
    
    public function getQuery(){
      return Doctrine_Query::create()->from( 'Model_User u' )->orderby( 'u.username ASC' );
    }
    
    public function uploadAction(){
      $form = new Admin_Form_UserContact();
      //$form->setObject(new Model_User());
      if($this->getRequest()->isPost()){
          
        $fileclass = new stdClass();
        // we stripped out the image thumbnail for our purpose, primarily for security reasons
        // you could add it back in here.
        $this->processForm($form, '/admin/index/upload',$fileclass);
      }
      $this->view->form = $form;         
    }
    public function generateResourcesAction() {
        $objResources = new My_ACL_Resources();
        $objResources->buildAllArrays();
        $objResources->writeToDB();
    }
     public function logoutuserAction() {
         $user = new Model_User();   
        $user->logOut();
    }

}

