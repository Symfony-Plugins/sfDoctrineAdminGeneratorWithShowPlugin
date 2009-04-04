<?php
class adminGenImportFileForm extends sfForm
{
  public function setup()
  {
    parent::setup();
    $this->widgetSchema['file'] = new sfWidgetFormInputFile();
    
    $this->setValidators(
    array('file' => new sfValidatorFile())
    );

    $this->widgetSchema->setNameFormat('import[%s]');
  }
  
  public function configure()
  {
    parent::configure();
  }
  
}
