
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
    foreach($this-><?php echo $this->getPluralName() ?>  as $object)
    {
      $col = 1;
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
    $tmp_file = sfConfig::get('sf_upload_dir').'/'.uniqid();
    $objWriter->save('php://output');
    $this->content = file_get_contents($tmp_file);
   
    $this->setLayout(false);
    $this->setTemplate('export');
    
    $this->getResponse()->clearHttpHeaders();
    $this->setLayout(false);

    $this->getResponse()->setContentType('application/octet-stream');
    $this->getResponse()->addHttpMeta('content-disposition: ', 'attachment; filename="' . $this->configuration->getExcelFilename() . '.xls', true);
  }
  
  function int2Char($integer)
  {
    $chrs = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S' ,'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    return $chrs[$integer];
  }