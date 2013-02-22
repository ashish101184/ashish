<?php

/**
 * Model_Base_DenyAcl
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $acl_id
 * @property Model_User $User
 * @property Model_Acl $Acl
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Model_Base_DenyAcl extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('deny_acl');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('acl_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Model_User as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $this->hasOne('Model_Acl as Acl', array(
             'local' => 'acl_id',
             'foreign' => 'id'));
    }
}