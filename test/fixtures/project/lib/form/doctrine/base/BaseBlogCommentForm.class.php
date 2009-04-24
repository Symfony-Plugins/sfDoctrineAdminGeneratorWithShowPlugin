<?php

/**
 * BlogComment form base class.
 *
 * @package    form
 * @subpackage blog_comment
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBlogCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'post_id'    => new sfWidgetFormDoctrineSelect(array('model' => 'BlogPost', 'add_empty' => true)),
      'author'     => new sfWidgetFormInput(),
      'email'      => new sfWidgetFormInput(),
      'site'       => new sfWidgetFormInput(),
      'content'    => new sfWidgetFormTextarea(),
      'ipv4'       => new sfWidgetFormInput(),
      'ipv6'       => new sfWidgetFormInput(),
      'spam'       => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'BlogComment', 'column' => 'id', 'required' => false)),
      'post_id'    => new sfValidatorDoctrineChoice(array('model' => 'BlogPost', 'required' => false)),
      'author'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'site'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'content'    => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'ipv4'       => new sfValidatorString(array('max_length' => 16, 'required' => false)),
      'ipv6'       => new sfValidatorString(array('max_length' => 64, 'required' => false)),
      'spam'       => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogComment';
  }

}