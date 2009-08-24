  protected function getConfig()
  {
    $configuration = parent::getConfig();
    $configuration['show'] = $this->getFieldsShow();
    return $configuration;
  }

  protected function compile()
  {
    parent::compile();
    
    $config = $this->getConfig();
    
    // add configuration for the show view 
    $this->configuration['show'] = array( 'fields'         => array(),
                                          'title'          => $this->getShowTitle(),
                                          'actions'        => $this->getShowActions(),
                                          'display'        => $this->getShowDisplay(),
                                        ) ;

    foreach (array('show') as $context)
    {
      foreach ($this->configuration[$context]['actions'] as $action => $parameters)
      {
        $this->configuration[$context]['actions'][$action] = $this->fixActionParameters($action, $parameters);
      }
    }
<?php if(isset($this->params['with_csv']) && $this->params['with_csv'] == true): ?>
    $this->compileCsv();
<?php endif; ?>
<?php if(isset($this->params['with_excel']) && $this->params['with_excel'] == true): ?>
    $this->compileExcel();
<?php endif; ?>
<?php if(isset($this->params['with_pdf']) && $this->params['with_pdf'] == true): ?>
    $this->compilePdf();
<?php endif; ?>
<?php if(isset($this->params['with_xml']) && $this->params['with_xml'] == true): ?>
    $this->compileXml();
<?php endif; ?>

<?php if(isset($this->params['with_csv_import']) && $this->params['with_csv_import'] == true): ?>
    $this->compileCsvImport();
<?php endif; ?>



  }

  public function getShowActions()
  {
    return array(  '_list' => NULL,  '_edit' => NULL);
  }

  protected function compileCsv()
  {
    $this->configuration['csv'] = array( 'fields'           => array(),
                                          'title'           => $this->getCsvTitle(),
                                          'display'         => $this->getCsvDisplay(),
                                          'filename'        => $this->getCsvFilename()
                                        ) ;
  }
  
  protected function compileExcel()
  {
    $this->configuration['excel'] = array( 'fields'         => array(),
                                          'title'           => $this->getExcelTitle(),
                                          'display'         => $this->getExcelDisplay(),
                                          'filename'        => $this->getExcelFilename()
                                        ) ;
  }
  
  protected function compilePdf()
  {
    $this->configuration['pdf'] = array( 'fields'           => array(),
                                          'title'           => $this->getPdfTitle(),
                                          'display'         => $this->getPdfDisplay(),
                                          'filename'        => $this->getPdfFilename()
                                        ) ;
  }
  
  protected function compileXml()
  {
    $this->configuration['xml'] = array( 'fields'           => array(),
                                          'title'           => $this->getXmlTitle(),
                                          'display'         => $this->getXmlDisplay(),
                                          'filename'        => $this->getXmlFilename()
                                        ) ;
  }

  protected function compileCsvImport()
  {
    $this->configuration['csv_import'] = array( 'fields'    => array(),
                                          'display'         => $this->getCsvImportFields(),
                                        ) ;
  }
  
  public function getShowTitle()
  {
    return '<?php echo $this->escapeString(isset($this->config['show']['title']) ? $this->config['show']['title'] : 'Show '.sfInflector::humanize($this->getModuleName())) ?>';
 <?php unset($this->config['show']['title']) ?>
  }

  public function getShowDisplay()
  {
  <?php if (isset($this->config['show']['display'])): ?>
    return <?php echo $this->asPhp($this->config['show']['display']) ?>;
<?php elseif (isset($this->config['show']['hide'])): ?>
    return <?php echo $this->asPhp(array_diff($this->getAllFieldNames(false), $this->config['show']['hide'])) ?>;
<?php else: ?>
    return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['show']['display'], $this->config['show']['hide']) ?>
  }
