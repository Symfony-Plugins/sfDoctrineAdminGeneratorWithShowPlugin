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
      return <?php echo $this->asPhp(isset($this->config['form']['actions']) ? $this->config['form']['actions'] : array('_delete' => null, '_list' => null, '_save' => null, '_save_and_add' => null) ) ?>;
<?php unset($this->config['form']['actions']) ?>
  }
  
  public function getNewActions()
  {
    return <?php echo $this->asPhp(isset($this->config['new']['actions']) ? $this->config['new']['actions'] : array()) ?>;
<?php unset($this->config['new']['actions']) ?>
  }

  public function getEditActions()
  {
<?php if(isset($this->params) && $this->params['with_show'] == true): ?>
    return <?php echo $this->asPhp(isset($this->config['edit']['actions']) ? $this->config['edit']['actions'] : array('_delete' => null, '_list' => null, '_show' => null, '_save' => null, '_save_and_add' => null)) ?>;
<?php else: ?>
    return <?php echo $this->asPhp(isset($this->config['edit']['actions']) ? $this->config['edit']['actions'] : array()) ?>;
<?php endif; ?>
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
<?php $actions = array('_new' => null); ?>
<?php if(isset($this->params)): ?>
  <?php if(isset($this->params['with_csv'])   && $this->params['with_csv']   == true) $actions= array_merge($actions, array('_csv'    => array('action' => 'csv'))); ?>
  <?php if(isset($this->params['with_excel']) && $this->params['with_excel'] == true) $actions= array_merge($actions, array('_excel'  => array('action' => 'excel'))); ?>
  <?php if(isset($this->params['with_pdf'])   && $this->params['with_pdf']   == true) $actions= array_merge($actions, array('_pdf'    => array('action' => 'pdf'))); ?>
  <?php if(isset($this->params['with_xml'])   && $this->params['with_xml']   == true) $actions= array_merge($actions, array('_xml'    => array('action' => 'xml'))); ?>
<?php endif; ?>
    return <?php echo $this->asPhp(isset($this->config['list']['actions']) ? $this->config['list']['actions'] :$actions ) ?>;
<?php unset($this->config['list']['actions']) ?>
  }

  public function getListBatchActions()
  {
<?php $batchActions = array('_delete' => null); ?>
<?php if(isset($this->params)): ?>
  <?php if(isset($this->params['with_csv'])   && $this->params['with_csv']   == true) $batchActions= array_merge($batchActions, array('_csv'    => array('action' => 'csv'))); ?>
  <?php if(isset($this->params['with_excel']) && $this->params['with_excel'] == true) $batchActions= array_merge($batchActions, array('_excel'  => array('action' => 'excel'))); ?>
  <?php if(isset($this->params['with_pdf'])   && $this->params['with_pdf']   == true) $batchActions= array_merge($batchActions, array('_pdf'    => array('action' => 'pdf'))); ?>
  <?php if(isset($this->params['with_xml'])   && $this->params['with_xml']   == true) $batchActions= array_merge($batchActions, array('_xml'    => array('action' => 'xml'))); ?>
<?php endif; ?>
    return <?php echo $this->asPhp(isset($this->config['list']['batch_actions']) ? $this->config['list']['batch_actions'] : $batchActions) ?>;
<?php unset($this->config['list']['batch_actions']) ?>
  }
