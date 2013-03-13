<?php

/**
 * This file is controller file for the Import CSV
 *
 * Long description for file (if any)...
 *
 */
class App_Import_Importcsv extends App_Import_Parsecsv {

  var $error = array();
  var $modelWiseData = array();
  var $modelName = null;
  var $saveRecord = array();

  public function import($file, $requiredFieldValue) {


    /*    Example : Table structure to see how your data will look like and how to fetch the data from excel file
      $this->conditions = 'Username != '' ';
      -
     * /*
     */
    $this->auto($file);
    /*

      echo '
      <table border='0' cellspacing='1' cellpadding="3">
      <tr>';
      echo '<td>Id</td>';
      foreach ($this->titles as $value):
      echo '<th>' . $value . '</th>';
      endforeach;
      echo '</tr>';
      foreach ($this->data as $key => $row):
      echo '<tr>';
      echo '<td>';
      echo $key;
      echo '</td>';
      foreach ($row as $fieldName => $value):
      echo '<td>';
      echo $value;
      echo '</td>';
      endforeach;
      echo '</tr>';
      endforeach;
      echo '</table>';
      //    exit; */

    /*
     * required,unique,exist,max_length,max,default,dataFormat,email
     * 
     */
    $fieldDetails =
            array(
                'Username' =>
                array('conditions' => array('required' => true, 'unique' => true),
                    'message' => array('required' => 'Please enter username', 'unique' => 'Username already exist'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'username')
                ),
                'Email' =>
                array('conditions' => array('required' => true, 'unique' => true, 'email' => true),
                    'message' => array('required' => 'Please enter email', 'unique' => 'Email already exist', 'email' => 'Enter valid email address'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'email')
                ),
                'Address1' =>
                array('conditions' => array('required' => true),
                    'message' => array('required' => 'Please enter Address'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'address1')
                ),
                'Address2' =>
                array('modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'address2')),
                'Suburb' =>
                array('conditions' => array('required' => true),
                    'message' => array('required' => 'Please enter suburb'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'suburb')
                ),
                'Coutry' =>
                array('conditions' => array('required' => true, 'exist' => array('model' => 'Country', 'field' => 'name')),
                    'message' => array('required' => 'Please enter country', 'exist' => 'Contry is not exist in our database'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'country_id')
                ),
                'State' =>
                array('conditions' => array('required' => true, 'exist' => array('model' => 'State', 'field' => 'name')),
                    'message' => array('required' => 'Please enter state', 'exist' => 'State is not exist in our database'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'state_id')
                ),
                'Post Code' =>
                array('conditions' => array('required' => true, 'max' => 9999),
                    'message' => array('required' => 'Please enter Post Code', 'max' => 'Postcode must not exceed 4 numbers.'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'postcode')
                ),
                'Phone' =>
                array('conditions' => array('required' => true, 'max_length' => 15),
                    'message' => array('required' => 'Please enter Phone', 'max_length' => 'Phone number must not exceed 15 characters.'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'phone')
                ),
                'Status' =>
                array('conditions' => array('required' => true, 'default' => array('Active', 'Inactive')),
                    'message' => array('required' => 'Please enter Status', 'default' => 'Status should be Active or Inactive'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'status')
                ),
                'Role' =>
                array('conditions' => array('required' => true, 'exist' => array('model' => 'ClientRole', 'field' => 'role', 'conditions' => array('type' => 2))),
                    'message' => array('required' => 'Please enter Role', 'exist' => 'Role is not exist in our database'),
                    'modelDetail' => array('Name' => 'ClientUser', 'FieldName' => 'role_id')
                ),
                'Proposed Start Date' =>
                array('conditions' => array('required' => true, 'dataFormat' => 'Y-m-d'),
                    'message' => array('required' => 'Please enter Proposed Start Date', 'dataFormat' => 'Proposed Start Date format is wrong. It should like Y-m-d'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'proposedstartdate')
                ),
                'Date Of Application' =>
                array('conditions' => array('required' => true, 'dataFormat' => 'Y-m-d'),
                    'message' => array('required' => 'Please enter Date Of Application', 'dataFormat' => 'Date Of Application format is wrong. It should like Y-m-d'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'dateofapplication')
                ),
                'Hear Aboutus' =>
                array('conditions' => array('required' => true, 'integer' => true),
                    'message' => array('required' => 'Please enter Date Of Application', 'integer' => 'Hear aboutus should be integer'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'hear_aboutus')),
                'Given Name' =>
                array('conditions' => array('required' => true),
                    'message' => array('required' => 'Please enter Given Name'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'given_name')
                ),
                'Family Name' =>
                array('conditions' => array('required' => true),
                    'message' => array('required' => 'Please enter Family Name'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'family_name')
                ),
                'Gender' =>
                array('conditions' => array('required' => true, 'default' => array('Male', 'Female')),
                    'message' => array('required' => 'Please enter Gender', 'default' => 'Please enter valid value for gender'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'gender')
                ),
                'Birth Date' =>
                array('conditions' => array('required' => true, 'dataFormat' => 'Y-m-d'),
                    'message' => array('required' => 'Please enter Birth date', 'dataFormat' => 'Birth Date format is wrong. It should like Y-m-d'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'birth_date')
                ),
                'Mobile' =>
                array('conditions' => array('required' => true, 'max_length' => 15),
                    'message' => array('required' => 'Please enter Mobile', 'max_length' => 'Mobile number must not exceed 15 characters.'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'mobile')
                ),
                'Workphone' =>
                array('conditions' => array('max_length' => 15),
                    'message' => array('max_length' => 'Mobile number must not exceed 15 characters.'),
                    'modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'workphone')
                ),
                'Primary Language' =>
                array('modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'primary_language')),
                'Culture' =>
                array('modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'culture')),
                'Region' =>
                array('modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'region')),
                'Birth Place' =>
                array('modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'birth_place')),
                'Age' =>
                array('modelDetail' => array('Name' => 'UserProfile', 'FieldName' => 'age')),
    );
    $user_id = 0;
    foreach ($this->data as $key => $row):
      foreach ($row as $fieldName => $value):
        if (isset($fieldDetails[$fieldName])) {
          $this->FieldValidations($fieldDetails[$fieldName], $value, $key, $fieldName);
        }
      endforeach;
      if (!isset($this->error[$key]) && !isset($this->error['system'])) {
        foreach ($this->modelWiseData as $mKey => $mValue) {
          $mKeyObj = 'Model_' . $mKey;
          $keyObject = new $mKeyObj(); // Model Object          
          try {
            foreach ($mValue as $fields => $fieldValue) {
              $keyObject->$fields = $fieldValue;
            }
          } catch (Exception $e) {
            echo 'Exception: <pre>';
            print_r($e->getMessage());
            exit;
          }
          if (isset($requiredFieldValue[$mKey]) && is_array($requiredFieldValue[$mKey])) {
            foreach ($requiredFieldValue[$mKey] as $rField => $rValue) {
              if ($rField == 'user_id') {
                $keyObject->$rField = $user_id;
                $user_id = 0;
              } else {
                $keyObject->$rField = $rValue;
              }
            }
          }
          try {

            $keyObject->save();
            if ($mKeyObj == 'Model_ClientUser') {
              $user_id = $keyObject->id;
            }

            $this->saveRecord[$key] = 1;
          } catch (Exception $e) {
            echo 'Exception: <pre>';
            print_r($e->getMessage());
            exit;
          }
        }
      }
    endforeach;
    if (isset($this->error)) {
      $status['error'] = $this->error;
      $status['inserted'] = $this->saveRecord;
      return $status;
    } else {
      $status['inserted'] = $this->saveRecord;
      return $status;
    }
  }

  public function FieldValidations($validationArray, $data, $rownumber, $excelfieldName) {
    if (isset($validationArray['conditions'])) {
      foreach ($validationArray['conditions'] as $key => $value) {
        $b_error = false;
        switch ($key) {
          case 'required':
            if ($value && ($data == NULL || $data == '')) {
              $b_error = true;
            }
            break;
          case 'unique':
            if ($value && $data) {
              $fieldname = $validationArray['modelDetail']['FieldName'];

              $user = Doctrine_Query::create()->select('m.id')->from('Model_' . $validationArray['modelDetail']['Name'] . ' m')->where('m.' . $fieldname . ' = ?', $data)->execute()->toArray();
              if (!empty($user)) {
                $b_error = true;
              }
            }
            break;
          case 'exist':
            if (is_array($value) && $data) {
              $user = Doctrine_Query::create()->select('m.id')->from('Model_' . $value['model'] . ' m')->where('m.' . $value['field'] . ' = ?', $data)->execute()->toArray();
              if (!empty($user)) {
                $data = isset($user[0]['id']) ? $user[0]['id'] : '';
              } else {
                $b_error = true;
              }
            } else {
              $this->error['system'][] = $key . ' keyword not define properly';
            }
            break;
          case 'max_length':
            if (($value && $value != 0 && $data)) {
              if (strlen($data) > $value) {
                $b_error = true;
              }
            }
            break;

          case 'max':
            if (($value && $value != 0 && $data)) {
              if ($data > $value) {
                $b_error = true;
              }
            }
            break;

          case 'default':

            if (is_array($value) && $data) {
              if (!in_array($data, $value)) {
                $b_error = true;
              }
            } else {
              $this->error['system'][] = $key . ' keyword value should be array';
            }
            break;

          case 'dataFormat':
            if ($value && $data) {              
              if ((string)(date($value, strtotime($data))) != (string)($data)) {
                $b_error = true;
              }
              $data = date($value, strtotime($data));
            }
            break;

          case 'integer':
            if ($value && $data) {
              if (!is_int(intval($data))) {
                $b_error = true;
              }
            }
            break;

          case 'email':
            if ($value && $data) {
              if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                $b_error = true;
              }
            }
            break;
        } // Switch case...        
        if ($b_error) {
          $this->error[$rownumber][] = isset($validationArray['message'][$key]) ? $validationArray['message'][$key] : '';
        }
      } // Foreach condition
    }   // if condition check  
    if (isset($validationArray['modelDetail'])) {
      foreach ($validationArray as $key => $modelDetails) {
        if ($key == 'modelDetail') {
          if (isset($modelDetails['FieldName']) && $modelDetails['Name']) {
            $this->modelWiseData[$modelDetails['Name']][$modelDetails['FieldName']] = $data;
          } elseif (isset($modelDetails['Name']) && $modelDetails['Name'] && !isset($modelDetails['FieldName'])) {
            $this->modelWiseData[$modelDetails['Name']][$excelfieldName] = $data;
          } elseif (!isset($modelDetails['Name']) && isset($modelDetails['FieldName']) && $modelDetails['FieldName']) {
            $this->modelWiseData[$this->modelName][$modelDetails['FieldName']] = $data;
          } else {
            $this->modelWiseData[$this->modelName][$excelfieldName] = $data;
          }
        }
      }
    } else {
      $this->modelWiseData[$this->modelName][$excelfieldName] = $data;
    }// For Model detail fillups
  }

}

?>
