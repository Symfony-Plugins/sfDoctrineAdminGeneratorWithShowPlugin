  public function getPdfTitle()
  {
    return '<?php echo isset($this->config['pdf']['title']) ? $this->config['pdf']['title'] : 'Pdf '.sfInflector::humanize($this->getModuleName()) ?>';
<?php unset($this->config['pdf']['title']) ?>
  }

  public function getPdfDisplay()
  {
  <?php if (isset($this->config['pdf']['display'])): ?>
    return <?php echo $this->asPhp($this->config['pdf']['display']) ?>;
<?php elseif (isset($this->config['pdf']['hide'])): ?>
    return <?php echo $this->asPhp(array_diff($this->getAllFieldNames(false), $this->config['pdf']['hide'])) ?>;
<?php else: ?>
    return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['pdf']['display'], $this->config['pdf']['hide']) ?>
  }

  public function getPdfFilename()
  {
<?php if (isset($this->config['pdf']['filename'])): ?>
    return '<?php echo $this->config['pdf']['filename']; ?>';
<?php else: ?>
    return '<?php echo $this->getPluralName() ?>';
<?php endif; ?>
<?php unset($this->config['pdf']['filename']) ?>
  }
  
  public function pdfConfigurationf()
  {
    if (! sfConfig::get ( 'sf_tcpdf_dir' ))
    {
      sfConfig::set ( 'sf_tcpdf_dir', sfConfig::get ( 'sf_root_dir' ) . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'sfTCPDFPlugin' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'tcpdf' . DIRECTORY_SEPARATOR );
    }


    if(! sfConfig::get('sf_tcpdf_font_dir'))
    {
      sfConfig::set ( 'sf_tcpdf_font_dir', sfConfig::get ( 'sf_tcpdf_dir' ) . 'fonts' . DIRECTORY_SEPARATOR );
    }
  
  }
