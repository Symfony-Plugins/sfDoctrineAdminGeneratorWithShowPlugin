<?php

/**
 * BlogPostVersion form base class.
 *
 * @package    form
 * @subpackage blog_post_version
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBlogPostVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'author_id'      => new sfWidgetFormInput(),
      'category_id'    => new sfWidgetFormInput(),
      'title'          => new sfWidgetFormInput(),
      'extract'        => new sfWidgetFormTextarea(),
      'content'        => new sfWidgetFormTextarea(),
      'is_published'   => new sfWidgetFormInputCheckbox(),
      'allow_comments' => new sfWidgetFormInputCheckbox(),
      'version'        => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'BlogPostVersion', 'column' => 'id', 'required' => false)),
      'author_id'      => new sfValidatorInteger(array('required' => false)),
      'category_id'    => new sfValidatorInteger(array('required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'extract'        => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'content'        => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'is_published'   => new sfValidatorBoolean(array('required' => false)),
      'allow_comments' => new sfValidatorBoolean(array('required' => false)),
      'version'        => new sfValidatorDoctrineChoice(array('model' => 'BlogPostVersion', 'column' => 'version', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_post_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogPostVersion';
  }

}