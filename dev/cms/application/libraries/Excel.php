<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }

    public function parseFile($filePath){
      //Create excel reader after determining the file type
      $inputFileName = $filePath;
      /**  Identify the type of $inputFileName  * */
      $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
      /**  Create a new Reader of the type that has been identified  * */
      $objReader = PHPExcel_IOFactory::createReader($inputFileType);
      /** Set read type to read cell data onl * */
      $objReader->setReadDataOnly(true);
      /**  Load $inputFileName to a PHPExcel Object  * */
      $objPHPExcel = $objReader->load($inputFileName);
          //Get worksheet and built array with first row as header
      $objWorksheet = $objPHPExcel->getAllSheets();
          //excel with first row header, use header as key
      $worksheet = array();
      foreach ($objWorksheet as $key => $PHPExcel_Worksheet){
              //excel sheet with no header
          $worksheet[$key] = $PHPExcel_Worksheet->toArray(null, true, true, false);

      }
      return $worksheet;
    }
}
