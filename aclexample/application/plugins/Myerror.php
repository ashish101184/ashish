<?php

class Application_Plugin_Myerror extends Zend_Controller_Plugin_Abstract
{

    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
        $frontController = Zend_Controller_Front::getInstance();        
        $error = $frontController->getPlugin('Zend_Controller_Plugin_ErrorHandler');          
        $error->setErrorHandlerModule($request->getModuleName())
        ->setErrorHandlerController('error')
        ->setErrorHandlerAction('error');
        return true;     
    }
    
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
    	$front = Zend_Controller_Front::getInstance();

    	$front->registerPlugin(new Application_Plugin_Myerror(array(
    			'controller'=>'Error',
    			'action'=>'error'
    	)));
    }
}