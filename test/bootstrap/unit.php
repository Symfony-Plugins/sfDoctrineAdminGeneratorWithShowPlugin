<?php

if (!isset($_SERVER['SYMFONY']))
{
  throw new RuntimeException('Could not find symfony core libraries.');
}

require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();
sfConfig::set('sf_environment', 'test');

$configuration = new sfProjectConfiguration(getcwd());
require_once $configuration->getSymfonyLibDir().'/vendor/lime/lime.php';


require_once dirname(__FILE__).'/../../config/sfDoctrineAdminGeneratorWithShowPluginConfiguration.class.php';
$plugin_configuration = new sfDoctrineAdminGeneratorWithShowPluginConfiguration($configuration, dirname(__FILE__).'/../..');
