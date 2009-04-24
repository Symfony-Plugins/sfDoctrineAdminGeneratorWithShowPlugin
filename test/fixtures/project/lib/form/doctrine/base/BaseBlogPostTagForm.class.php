<?php

/**
 * BlogPostTag form base class.
 *
 * @package    form
 * @subpackage blog_post_tag
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBlogPostTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'blog_post_id' => new sfWidgetFormInputHidden(),
      'blog_tag_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'blog_post_id' => new sfValidatorDoctrineChoice(array('model' => 'BlogPostTag', 'column' => 'blog_post_id', 'required' => false)),
      'blog_tag_id'  => new sfValidatorDoctrineChoice(array('model' => 'BlogPostTag', 'column' => 'blog_tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_post_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogPostTag';
  }

}