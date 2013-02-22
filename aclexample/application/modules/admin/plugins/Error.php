<?php 
class Admin_Plugin_Error extends Zend_Controller_Plugin_Abstract
{

    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
    	
    	if($request->getModuleName() != 'admin') {
    		return;
    	}
    	
    	$front = Zend_Controller_Front::getInstance();
    	$front->registerPlugin(new Admin_Plugin_Error(array(
    			'module'=>'admin',
    			'controller'=>'Error',
    			'action'=>'error'
    	)));
    }
}
?>
