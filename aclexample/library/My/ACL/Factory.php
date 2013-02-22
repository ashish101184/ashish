<?php

class My_ACL_Factory {

    private static $_sessionNameSpace = 'My_Control_Panel';
    private static $_objAuth;
    private static $_objAclSession;
    private static $_objAcl;

    public static function get(Zend_Auth $objAuth, $bolClearACL = false) {

        self::$_objAuth = $objAuth;
        self::$_objAclSession = new Zend_Session_Namespace(self::$_sessionNameSpace);

        if ($bolClearACL) {
            self::_clear();
        }

        return (isset(self::$_objAclSession->acl)) ? self::$_objAclSession->acl : self::_loadAclFromDB();
    }

    private static function _clear() {
        unset(self::$_objAclSession->acl);
    }

    private static function _saveAclToSession() {
        self::$_objAclSession->acl = self::$_objAcl;
    }

    private static function _loadAclFromDB() { 
        //Zend_Auth::getInstance()->clearIdentity();exit;
        $arrRolesInstance = Model_RoleTable::getInstance()->findAll();
        $arrResources = Model_AclTable::getInstance()->findAll()->toArray();
        $arrRoleResources = Model_AclRoleTable::getInstance()->findAll();

        self::$_objAcl = new Zend_ACL();
        $i=0;
        foreach ($arrRolesInstance as $role) {
            $arrRoles_inh=array();
            $rolearray=$role->toArray();
            $arrCoreRoles[] = $rolearray['role'];
            $parent_id=$role->RolesInheritances->parent_role_id;
            if($parent_id){
                $arrRoles_inh = Model_RolesInheritancesTable::getInstance()->findByRoleId($rolearray['id'])->toArray();
            }
            $arrRoles[$i]['role']=$rolearray['role'];
            if(!empty($arrRoles_inh)){
                foreach($arrRoles_inh as $key=>$value){
                    $getRolename= Model_RoleTable::getInstance()->findById($value['parent_role_id'])->toArray();
                    $getparentroleName = $getRolename[0]['role'];   
                    $arrRoles[$i]['inherits'][]=$getparentroleName;
                }
            }else{
                $arrRoles[$i]['inherits']="";
            }
            $i++;
        }
            
        while (count($arrRoles) > 0) {
            $role = array_shift($arrRoles);
            if (isset($role['inherits']) && !empty($role['inherits'])) {
                $exists = true;
                $isCore = false;
                if(is_array($role['inherits'])){
                    foreach ($role['inherits'] as $index => $inherited) {
                        if (in_array($inherited, $arrCoreRoles)) {
                            $isCore = true;
                        } else {
                            unset($role['inherits'][$index]);
                        }
                        if (!self::$_objAcl->hasRole($inherited)) {
                            $exists = false;
                        }
                    }
                }

                if ($exists && $isCore) {
                    self::$_objAcl->addRole(new Zend_Acl_Role($role['role']), $role['inherits']);
                } else {
                    $arrRoles[] = $role;
                    
                }
            } else {
                self::$_objAcl->addRole(new Zend_Acl_Role($role['role']));
            }
        }

        foreach ($arrResources as $resource) {
            if($resource['module']=="all" && $resource['controller']=="all" && $resource['action']=="all"){
                $allowreo_value=null . '::' . null . '::' . null;
            }else{
                $allowreo_value=$resource['module'] . '::' . $resource['controller'] . '::' . $resource['action'];
            }
            self::$_objAcl->add(new Zend_Acl_Resource($allowreo_value));
            
        }
        foreach ($arrRoleResources as $roleResource) {
            $rolData = $roleResource->Role->toArray();
            $aclData = $roleResource->Acl->toArray();
            if($aclData['module']=="all" && $aclData['controller']=="all" && $aclData['action']=="all"){
                $allowreo_value_role=null . '::' . null . '::' . null;
            }else{
                $allowreo_value_role=$aclData['module'] . '::' . $aclData['controller'] . '::' . $aclData['action'];
            }
            
            self::$_objAcl->allow($rolData['role'], $allowreo_value_role);
        }
        
        if (self::$_objAuth->hasIdentity()) {
            $arrRole = self::$_objAuth->getIdentity();
            //$roleName = $arrRole->role_id;exit;
            $arrRoles = Model_RoleTable::getInstance()->findById($arrRole->role_id)->toArray();
            $roleName = $arrRoles[0]['role'];
            $userId = $arrRole->id;
            $arrAllow = Model_AllowAclTable::getInstance()->findByUserId($userId)->toArray();
            $arrDeny = Model_DenyAclTable::getInstance()->findByUserId($userId)->toArray();

            if (count($arrAllow) > 0) {
                foreach ($arrAllow as $resource) {
                    $resources_array = Model_AclTable::getInstance()->findById($resource['acl_id'])->toArray();
                    if($resources_array[0]['module']=="all" && $resources_array[0]['controller']=="all" && $resources_array[0]['action']=="all"){
                        $allowreo= null . '::' . null . '::' . null;
                    
                    }else{
                        $allowreo=$resources_array[0]['module'] . '::' . $resources_array[0]['controller'] . '::' . $resources_array[0]['action'];
                    }
                    self::$_objAcl->allow($roleName, $allowreo);
                }
            }

            if (count($arrDeny) > 0) {
                foreach ($arrDeny as $resource) {
                    $resources_array = Model_AclTable::getInstance()->findById($resource['acl_id'])->toArray();
                    if($resources_array[0]['module']=="all" && $resources_array[0]['controller']=="all" && $resources_array[0]['action']=="all"){
                        $allowreo= null . '::' . null . '::' . null;
                    
                    }else{
                        $allowreo=$resources_array[0]['module'] . '::' . $resources_array[0]['controller'] . '::' . $resources_array[0]['action'];    
                    }
                    self::$_objAcl->deny($roleName, $allowreo);
                }
            }
        }

        self::_saveAclToSession();
        return self::$_objAcl;
    }

}