<?php

/**
 * Model_Base_Contact
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property Doctrine_Collection $User
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Model_Base_Contact extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('contact');
        $this->hasColumn('first_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('last_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('phone', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('address', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Model_User as User', array(
             'local' => 'id',
             'foreign' => 'contact_id'));
    }
}