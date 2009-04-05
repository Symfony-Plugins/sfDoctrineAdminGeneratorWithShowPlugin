<?php

/**
 * sfDoctrineAdminGeneratorWithShowPlugin configuration.
 * 
 * @package     sfDoctrineAdminGeneratorWithShowPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id: PluginConfiguration.class.php 12675 2008-11-06 08:07:42Z Kris.Wallsmith $
 */
class sfDoctrineAdminGeneratorWithShowPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    if(sfConfig::get('sf_environment') != 'test')
    {
      if(!in_array('sfDoctrinePlugin',$this->configuration->getPlugins()))
      {
        //throw new sfException('sfDoctrineAdminGeneratorWithShowPlugin require sfDoctrinePlugin.');
      }
    }
  }
}
