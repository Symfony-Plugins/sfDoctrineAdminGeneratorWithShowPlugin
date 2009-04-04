  public function getExcelTitle()
  {
    return '<?php echo isset($this->config['excel']['title']) ? $this->config['excel']['title'] : 'Excel '.sfInflector::humanize($this->getModuleName()) ?>';
<?php unset($this->config['excel']['title']) ?>
  }

  public function getExcelDisplay()
  {
  <?php if (isset($this->config['excel']['display'])): ?>
    return <?php echo $this->asPhp($this->config['excel']['display']) ?>;
<?php elseif (isset($this->config['excel']['hide'])): ?>
    return <?php echo $this->asPhp(array_diff($this->getAllFieldNames(false), $this->config['excel']['hide'])) ?>;
<?php else: ?>
    return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['excel']['display'], $this->config['excel']['hide']) ?>
  }

  public function getExcelFilename()
  {
<?php if (isset($this->config['excel']['filename'])): ?>
    return '<?php echo $this->config['excel']['filename']; ?>';
<?php else: ?>
    return '<?php echo $this->getPluralName() ?>';
<?php endif; ?>
<?php unset($this->config['excel']['filename']) ?>
  }
