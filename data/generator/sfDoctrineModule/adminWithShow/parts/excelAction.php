
  public function executeExcel(sfWebRequest $request)
  {
    $this-><?php echo $this->getPluralName() ?> = Doctrine::getTable('<?php echo $this->getModelClass() ?>')->findAll();
    $this->exportToExcel();
  }
  
  
  public function executeBatchExcel(sfWebRequest $request)
  {
  
    $ids = $request->getParameter('ids');

    $this-><?php echo $this->getPluralName() ?> = Doctrine_Query::create()
      ->from('<?php echo $this->getModelClass() ?>')
      ->whereIn('id', $ids)
      ->execute();

    if ( ! $this-><?php echo $this->getPluralName() ?> )
    {
      $this->getUser()->setFlash('error', 'A problem occurs when exporting the selected items.');
    }else
    {
      $this->exportToExcel();
    }
  }
  
  public function exportToExcel()
  {
    error_reporting(8);
    $objPHPExcel = new sfPhpExcel();
    $objPHPExcel->getProperties()->setCreator("author");
    $objPHPExcel->getProperties()->setTitle($this->configuration->getExcelTitle());
    $objPHPExcel->getProperties()->setSubject("Report");
    $objPHPExcel->getProperties()->setDescription("Report");

    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle('Reports');

    $activeSheet = 0;
    $line         = 1;$tab = array();

    $col = 0;
    foreach($this->configuration->getExcelDisplay() as $display)
    {
      $method = 'get'.ucfirst($display);
      $objPHPExcel->getActiveSheet()->SetCellValue($this->int2Char($col).$line, ucfirst($display));
      //$tab[$this->int2Char($col).$line] =  $object->{ 'get'.ucfirst($display)}(); 
      $col ++;
    }
    $line ++;

    foreach($this-><?php echo $this->getPluralName() ?>  as $object)
    {
      $col = 0;
      foreach($this->configuration->getExcelDisplay() as $display)
      {
        $method = 'get'.ucfirst($display);
        $objPHPExcel->getActiveSheet()->SetCellValue($this->int2Char($col).$line, $object->{ 'get'.ucfirst($display)}() );
        $tab[$this->int2Char($col).$line] =  $object->{ 'get'.ucfirst($display)}(); 
        $col ++;
      }
      $line ++;
    }
    
    $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
    
    $objWriter->setTempDir(sfConfig::get('app_sf_doctrine_admin_generator_with_show_plugin_tmp_dir', sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'tmp' ));
   
    $this->setLayout(false);
    $this->setTemplate(false);
    
    $this->getResponse()->clearHttpHeaders();
    $this->getResponse()->setContentType('application/octet-stream');
    $this->getResponse()->addHttpMeta('content-disposition', 'attachment; filename="' . $this->configuration->getExcelFilename() . '.xls', true);
    $this->getResponse()->sendHttpHeaders();

    $objWriter->save();
    die;
    return sfView::NONE;
  }
  
  function int2Char($integer)
  {
    $chrs = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S' ,'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    return $chrs[$integer];
  }