  public function getCredentials($action)
  {
    if (0 === strpos($action, '_'))
    {
      $action = substr($action, 1);
    }

    return isset($this->configuration['credentials'][$action]) ? $this->configuration['credentials'][$action] : array();
  }

  public function getActionsDefault()
  {
    return <?php echo $this->asPhp(isset($this->config['actions']) ? $this->config['actions'] : array()) ?>;
<?php unset($this->config['actions']) ?>
  }

  public function getFormActions()
  {
    <?php if(isset($this->params) && $this->params['with_show'] == true): ?>
      return <?php echo $this->asPhp(isset($this->config['form']['actions']) ? $this->config['form']['actions'] : array('_delete' => null, '_list' => null, '_show' => null, '_save' => null, '_save_and_add' => null) ) ?>;
    <?php else: ?>
      return <?php echo $this->asPhp(isset($this->config['form']['actions']) ? $this->config['form']['actions'] : array('_delete' => null, '_list' => null, '_save' => null, '_save_and_add' => null) ) ?>;
    <?php endif; ?>
    
<?php unset($this->config['form']['actions']) ?>
  }
  
  public function getNewActions()
  {
    return <?php echo $this->asPhp(isset($this->config['new']['actions']) ? $this->config['new']['actions'] : array()) ?>;
<?php unset($this->config['new']['actions']) ?>
  }

  public function getEditActions()
  {
    return <?php echo $this->asPhp(isset($this->config['edit']['actions']) ? $this->config['edit']['actions'] : array()) ?>;
<?php unset($this->config['edit']['actions']) ?>
  }

  public function getListObjectActions()
  {
    <?php if(isset($this->params) && $this->params['with_show'] == true): ?>
      return <?php echo $this->asPhp(isset($this->config['list']['object_actions']) ? $this->config['list']['object_actions'] : array( '_show' => null, '_edit' => null, '_delete' => null)) ?>;
    <?php else: ?>
      return <?php echo $this->asPhp(isset($this->config['list']['object_actions']) ? $this->config['list']['object_actions'] : array('_edit' => null, '_delete' => null)) ?>;
    <?php endif; ?>
<?php unset($this->config['list']['object_actions']) ?>
  }
  
  public function getListActions()
  {
    return <?php echo $this->asPhp(isset($this->config['list']['actions']) ? $this->config['list']['actions'] : array('_new' => null)) ?>;
<?php unset($this->config['list']['actions']) ?>
  }

  public function getListBatchActions()
  {
    return <?php echo $this->asPhp(isset($this->config['list']['batch_actions']) ? $this->config['list']['batch_actions'] : array('_delete' => null)) ?>;
<?php unset($this->config['list']['batch_actions']) ?>
  }
