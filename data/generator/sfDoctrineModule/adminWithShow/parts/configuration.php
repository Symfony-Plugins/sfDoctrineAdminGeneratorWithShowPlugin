[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorConfiguration extends sfModelGeneratorConfiguration
{
<?php include dirname(__FILE__).'/actionsConfiguration.php' ?>

<?php include dirname(__FILE__).'/fieldsConfiguration.php' ?>

  public function getForm($object = null)
  {
    $class = $this->getFormClass();

    return new $class($object, $this->getFormOptions());
  }

  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return '<?php echo isset($this->config['form']['class']) ? $this->config['form']['class'] : $this->getModelClass().'Form' ?>';
<?php unset($this->config['form']['class']) ?>
  }

  public function getFormOptions()
  {
    return array();
  }

  public function hasFilterForm()
  {
    return <?php echo !isset($this->config['filter']['class']) || false !== $this->config['filter']['class'] ? 'true' : 'false' ?>;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return '<?php echo isset($this->config['filter']['class']) && !in_array($this->config['filter']['class'], array(null, true, false), true) ? $this->config['filter']['class'] : $this->getModelClass().'FormFilter' ?>';
<?php unset($this->config['filter']['class']) ?>
  }
<?php if(isset($this->params['with_show']) && $this->params['with_show'] == true): ?>
<?php include dirname(__FILE__).'/showConfiguration.php' ?>
<?php endif; ?>

<?php if(isset($this->params['with_csv']) && $this->params['with_csv'] == true): ?>
<?php include dirname(__FILE__).'/csvConfiguration.php' ?>
<?php endif; ?>

<?php if(isset($this->params['with_excel']) && $this->params['with_excel'] == true): ?>
<?php include dirname(__FILE__).'/excelConfiguration.php' ?>
<?php endif; ?>

<?php if(isset($this->params['with_pdf']) && $this->params['with_pdf'] == true): ?>
<?php include dirname(__FILE__).'/pdfConfiguration.php' ?>
<?php endif; ?>

<?php if(isset($this->params['with_xml']) && $this->params['with_xml'] == true): ?>
<?php include dirname(__FILE__).'/xmlConfiguration.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/filtersConfiguration.php' ?>

<?php include dirname(__FILE__).'/paginationConfiguration.php' ?>

<?php include dirname(__FILE__).'/sortingConfiguration.php' ?>

  public function getTableMethod()
  {
    return '<?php echo isset($this->config['list']['table_method']) ? $this->config['list']['table_method'] : null ?>';
<?php unset($this->config['list']['table_method']) ?>
  }

  public function getTableCountMethod()
  {
    return '<?php echo isset($this->config['list']['table_count_method']) ? $this->config['list']['table_count_method'] : null ?>';
<?php unset($this->config['list']['table_count_method']) ?>
  }

  public function getConnection()
  {
    return null;
  }
}
