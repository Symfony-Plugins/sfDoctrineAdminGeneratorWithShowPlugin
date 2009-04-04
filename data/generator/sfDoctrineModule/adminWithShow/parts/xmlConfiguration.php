  public function getXmlTitle()
  {
    return '<?php echo isset($this->config['xml']['title']) ? $this->config['xml']['title'] : 'Xml '.sfInflector::humanize($this->getModuleName()) ?>';
<?php unset($this->config['xml']['title']) ?>
  }

  public function getXmlDisplay()
  {
  <?php if (isset($this->config['xml']['display'])): ?>
    return <?php echo $this->asPhp($this->config['xml']['display']) ?>;
<?php elseif (isset($this->config['xml']['hide'])): ?>
    return <?php echo $this->asPhp(array_diff($this->getAllFieldNames(false), $this->config['xml']['hide'])) ?>;
<?php else: ?>
    return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['xml']['display'], $this->config['xml']['hide']) ?>
  }
  
  public function getXmlFilename()
  {
<?php if (isset($this->config['xml']['filename'])): ?>
    return '<?php echo $this->config['xml']['filename']; ?>';
<?php else: ?>
    return '<?php echo $this->getPluralName() ?>';
<?php endif; ?>
<?php unset($this->config['xml']['filename']) ?>
  }
