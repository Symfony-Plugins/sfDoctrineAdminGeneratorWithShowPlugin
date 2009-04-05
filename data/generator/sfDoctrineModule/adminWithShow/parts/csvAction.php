
  /**
   * return all data in a csv file
   *
   */
  public function executeCsv(sfWebRequest $request)
  {
    $this-><?php echo $this->getPluralName() ?> = Doctrine::getTable('<?php echo $this->getModelClass() ?>')->findAll();
    $this->exportToCsv();
  }

  public function executeBatchCsv(sfWebRequest $request)
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
      $this->exportToCsv();
    }
  }
  
  public function exportToCsv()
  {
    $csv = '';
    $fp = fopen('php://temp/', 'r+');
    
    $first = true;


    $line = array();
    foreach($this->configuration->getCsvDisplay() as $display)
    {
      $line[] = $display;
    }
    fputcsv($fp, $line, $this->configuration->getCsvFieldSeparator(), $this->configuration->getCsvDelimiter());
    
    foreach($this-><?php echo $this->getPluralName() ?> as $<?php echo $this->getSingularName() ?>)
    {
      $line = array();
      foreach($this->configuration->getCsvDisplay() as $display)
      {
        $line[] = $<?php echo $this->getSingularName() ?>->get($display);
      }
      fputcsv($fp, $line, $this->configuration->getCsvFieldSeparator(), $this->configuration->getCsvDelimiter());
    }
    rewind($fp);
    $this->content = stream_get_contents($fp);

    $this->setLayout(false);
    $this->setTemplate('export');

    $this->getResponse()->clearHttpHeaders();
    $this->getResponse()->setContentType('application/octet-stream');
    $this->getResponse()->addHttpMeta('content-disposition', 'attachment; filename="' . $this->configuration->getCsvFilename() . '.csv', true);
    
    if($this->getRequest()->getMethod() == sfWebRequest::POST)
    {
      $this->getResponse()->setContent($this->content);
      $this->getResponse()->send();
      $this->setTemplate(false);
      return sfView::NONE;
    }    

  }
  
  public function getImport()
  {
   $class = $this->configuration->getImportFormClass();
   return new $class(); 
  }
  
  public function executeImport(sfWebRequest $request)
  {
    $this->import = $this->getImport();
    
    $this->import->bind($request->getParameter($this->import->getName()), $request->getFiles($this->import->getName()));
    if ($this->import->isValid())
    {
      $this->importFile($this->import->getValue('file'));
      
    }
    $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
  }
  
  public function importFile($file)
  {
    //$content = file_get_contents($file->getTempName());
    $this->ImportCsv($file->getTempName());
  }
  
  public function ImportCsv($file)
  {
    $fields = array();
    $first = true;
    $errors  = 0;
    $success = 0;
    
    $authorized_fields = $this->configuration->getCsvDisplay();
    $import_fields = array();
    
    $fp = fopen($file, 'r');
    $fields = fgetcsv($fp);
    
    foreach($fields as $field)
    {
      if(in_array($field, $authorized_fields))
      {
        $import_fields[] = $field;
      }else
      {
        return $this->getUser()->setFlash('error', "Import failed with field '$field'.");
      }  
    }
    
    $import_fields_count = count($import_fields);
    
    while(false !== ($line = fgetcsv($fp)));
    {
      $<?php echo $this->getSingularName() ?> = new <?php echo $this->getModelClass() ?>();
      for($i=0; $i < $import_fields_count; $i++)
      {
          $setter = 'set'.ucfirst($import_fields[$i]);
          $<?php echo $this->getSingularName() ?>->$setter($line[$i]);
      }

      try
      {
        $<?php echo $this->getSingularName() ?>->save();
      }catch(sfEception $e)
      {
        $errors ++;
      }

      
    }
    
    $this->getUser()->setFlash('notice', 'Your data have been imported, ( success : '. $success.' , errors : '.$errors.' )');
    
  }