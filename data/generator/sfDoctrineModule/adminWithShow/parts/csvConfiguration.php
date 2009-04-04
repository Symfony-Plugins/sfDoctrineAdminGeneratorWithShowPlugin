  public function getCsvTitle()
  {
    return '<?php echo isset($this->config['csv']['title']) ? $this->config['csv']['title'] : 'Csv '.sfInflector::humanize($this->getModuleName()) ?>';
<?php unset($this->config['csv']['title']) ?>
  }

  public function getCsvDisplay()
  {
<?php if (isset($this->config['csv']['display'])): ?>
    return <?php echo $this->asPhp($this->config['csv']['display']) ?>;
<?php elseif (isset($this->config['csv']['hide'])): ?>
    return <?php echo $this->asPhp(array_diff($this->getAllFieldNames(false), $this->config['csv']['hide'])) ?>;
<?php else: ?>
    return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['csv']['display'], $this->config['csv']['hide']) ?>
  }

  public function getCsvFilename()
  {
<?php if (isset($this->config['csv']['filename'])): ?>
    return '<?php echo $this->config['csv']['filename']; ?>';
<?php else: ?>
    return '<?php echo $this->getPluralName() ?>';
<?php endif; ?>
<?php unset($this->config['csv']['filename']) ?>
  }
  
  public function getCsvFieldSeparator()
  {
<?php if (isset($this->config['csv']['separator'])): ?>
  <?php if($this->config['csv']['separator'] == "'" ): ?>
  return '<?php echo addslashes($this->config['csv']['separator']); ?>';
  <?php else: ?>
  return '<?php echo $this->config['csv']['separator']; ?>';
  <?php endif; ?>
    
<?php else: ?>
    return ',';
<?php endif; ?>
<?php unset($this->config['csv']['separator']) ?>
  }

  public function getCsvDelimiter()
  {
<?php if (isset($this->config['csv']['delimeter'])): ?>
  <?php if($this->config['csv']['delimeter'] == "'" ): ?>
  return '<?php echo addslashes($this->config['csv']['delimeter']); ?>';
  <?php else: ?>
  return '<?php echo $this->config['csv']['delimeter']; ?>';
  <?php endif; ?>
<?php else: ?>
    return '"';
<?php endif; ?>
<?php unset($this->config['csv']['delimeter']) ?>
  }
  
  public function getCsvImportFields()
  {
<?php if (isset($this->config['csv_import']['display'])): ?>
    return <?php echo $this->asPhp($this->config['csv_import']['display']) ?>;
<?php elseif (isset($this->config['csv_import']['hide'])): ?>
    return <?php echo $this->asPhp(array_diff($this->getAllFieldNames(false), $this->config['csv_import']['hide'])) ?>;
<?php else: ?>
    return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['csv_import']['display'], $this->config['csv_import']['hide']) ?>
  }

  public function getImportFormClass()
  {
   return 'adminGenImportFileForm';
  }  