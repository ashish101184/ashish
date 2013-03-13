<?php
/**
 * This file is controller file for the Export CSV
 *
 * Long description for file (if any)...
 *
 * LICENSE: Some license information
 *
 * @category   Zend
 * @package    Zend_Novo
 * @subpackage Admin
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license   BSD License
 * @version    $Id:$
 * @link       http://framework.zend.com/package/PackageName
 * @since      File available since Release 1.0.0
 */
class App_Export_Exportcsv
{
  
    /**
     * Perform helper when called from an action controller
     *
     * @param  array $aryData
     * @param  string $strName
     * @param  bool $bolCols; default true; 
     * @return void
     */
    public function direct($aryData = array(), $strName = "csv", $bolCols = true)
    {
        $this->printExcel($aryData, $strName, $bolCols);
    }

    /**
     * Printcsv file
     *
     * @param  array $aryData
     * @param  string $strName
     * @param  bool $bolCols
     * @return void
     */
    public function printExcel($aryData = array(), $strName = "csv", $bolCols = true)
    {
      

        if (!is_array($aryData) || empty($aryData))
        {
            exit(1);
        }
        $tm = time();
        if(!$strName){
          $strName = $strName . "_".$tm;
        }
        // header
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=" .$strName.".csv");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-control: private, must-revalidate');
        header("Pragma: public");

       
        if ($bolCols)
        {
            $aryCols = array_keys($aryData[0]);           
            array_unshift($aryData, $aryCols);
        }

        // buffer for fputcsv
        ob_start();

        // output Stream for fputcsv
        $fp = fopen("php://output", "w");
        if (is_resource($fp))
        {
            foreach ($aryData as $aryLine)
            {
              
                fputcsv($fp, $aryLine, ',', '"');
            }
            $strContent = ob_get_clean();            
            $strContent = preg_replace('/^ID/', 'id', $strContent);
            $strContent = utf8_decode($strContent);
            $intLength = mb_strlen($strContent, 'utf-8');

            // length
            header('Content-Length: ' . $intLength);

            //close open file

            echo $strContent;
            exit(0);
        }
        ob_end_clean();
        exit(1);
    }
} 
?>