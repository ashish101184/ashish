<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap
{ 
  
  protected function _initAutoload()
  { 
    $autoloader = new Zend_Application_Module_Autoloader(array(
        'namespace' => 'Admin_',
        'basePath'  => dirname(__FILE__),
    ));
    
    return $autoloader;
  }
  
  protected function _initPlugins() {
    $front = Zend_Controller_Front::getInstance();
    $front->registerPlugin(new Admin_Plugin_Error());
  }
  
}