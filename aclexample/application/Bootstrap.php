<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    public function _initDoctrine() {
        //require the Doctrine.php file
        require_once 'Doctrine.php';
        //Get a Zend Autoloader instance
        $loader = Zend_Loader_Autoloader::getInstance();
        //Autoload all the Doctrine files
        $loader->pushAutoloader(array('Doctrine', 'autoload'));
        //Get the Doctrine settings from application.ini
        $doctrineConfig = $this->getOptions('doctrine');
        //Get a Doctrine Manager instance so we can set some settings
        $manager = Doctrine_Manager::getInstance();
        //set models to be autoloaded and not included (Doctrine_Core::MODEL_LOADING_AGGRESSIVE)
        $manager->setAttribute(
                Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);
        //enable ModelTable classes to be loaded automatically
        $manager->setAttribute(
                Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true
        );
        //enable validation on save()
        $manager->setAttribute(
                Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL
        );
        //enable sql callbacks to make SoftDelete and other behaviours work transparently
        $manager->setAttribute(
                Doctrine_Core::ATTR_USE_DQL_CALLBACKS, true
        );
        //not entirely sure what this does :)
        $manager->setAttribute(
                Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true
        );
        //enable automatic queries resource freeing
        $manager->setAttribute(
                Doctrine_Core::ATTR_AUTO_FREE_QUERY_OBJECTS, true
        );
        //connect to database
        $manager->openConnection($doctrineConfig['resources']['doctrine']['connection_string']);
        //set to utf8
        $manager->connection()->setCharset('utf8');
        return $manager;
    }

    // dont change this funciton
    public function _initCoreSession() {
        $this->bootstrap('db');
        /*
          $config = array (
          'name' => 'session',
          'primary' => 'id',
          'modifiedColumn' => 'modified',
          'dataColumn' => 'data',
          'lifetimeColumn' => 'lifetime'
          ); */
        $sessionConfig = $this->getOptions('session');
        //print_r($sessionConfig['resources']['session']['saveHandler']['options']);exit;
        Zend_Session::setSaveHandler(new Zend_Session_SaveHandler_DbTable($sessionConfig['resources']['session']['saveHandler']['options']));
        Zend_Session::start();
    }

    protected function _initAutoload() {
        // Add autoloader empty namespace
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
                    'basePath' => APPLICATION_PATH,
                    'namespace' => '',
                    'resourceTypes' => array(
                        'model' => array(
                            'path' => 'models/',
                            'namespace' => 'Model_'
                        )
                    ),
                ));
        Zend_Controller_Action_HelperBroker::addPath('ZFDoctrine/Controller/Helper', 'ZFDoctrine_Controller_Helper');
        // Return it so that it can be stored by the bootstrap
        return $autoLoader;
    }

    protected function _initLayoutHelper() {
        $this->bootstrap('frontController');
        $layout = Zend_Controller_Action_HelperBroker::addHelper(
                        new Plugins_SelectLayout());
    }

    protected function _initSymfonyAutoload() {
        require_once 'symfony/lib/autoload/sfCoreAutoload.class.php';
        sfCoreAutoload::register();
    }

    protected function _initLoadAclIni() {
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/acl.ini');
        Zend_Registry::set('acl', $config);
    }

    protected function _initAclControllerPlugin() {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            
        } else {
            $user = new Model_User();
            $user->authenticate(array('username' => 'super', 'password' => 'abc'));
        }
        $objFront = Zend_Controller_Front::getInstance();
        $objFront->registerPlugin(new My_Controller_Plugin_ACL(), 1);
    }

    protected function _initPlugins() {
        $this->bootstrap('frontController');
        $front = $this->getResource('frontController');
        $front->registerPlugin(new Application_Plugin_Myerror(array(
                    'controller' => 'Error',
                    'action' => 'error'
                )));
    }

    protected function _initConfig() {
        define('PUBLIC_PATH', APPLICATION_PATH . '/../public/');
    }

}

