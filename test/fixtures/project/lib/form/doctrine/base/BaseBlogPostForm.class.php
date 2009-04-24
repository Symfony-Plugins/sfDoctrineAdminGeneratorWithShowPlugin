<?php

/**
 * BlogPost form base class.
 *
 * @package    form
 * @subpackage blog_post
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseBlogPostForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'author_id'      => new sfWidgetFormInput(),
      'category_id'    => new sfWidgetFormDoctrineSelect(array('model' => 'BlogCategory', 'add_empty' => true)),
      'title'          => new sfWidgetFormInput(),
      'extract'        => new sfWidgetFormTextarea(),
      'content'        => new sfWidgetFormTextarea(),
      'is_published'   => new sfWidgetFormInputCheckbox(),
      'allow_comments' => new sfWidgetFormInputCheckbox(),
      'version'        => new sfWidgetFormInput(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'slug'           => new sfWidgetFormInput(),
      'tags_list'      => new sfWidgetFormDoctrineChoiceMany(array('model' => 'BlogTag')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorDoctrineChoice(array('model' => 'BlogPost', 'column' => 'id', 'required' => false)),
      'author_id'      => new sfValidatorInteger(array('required' => false)),
      'category_id'    => new sfValidatorDoctrineChoice(array('model' => 'BlogCategory', 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'extract'        => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'content'        => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'is_published'   => new sfValidatorBoolean(array('required' => false)),
      'allow_comments' => new sfValidatorBoolean(array('required' => false)),
      'version'        => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tags_list'      => new sfValidatorDoctrineChoiceMany(array('model' => 'BlogTag', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'BlogPost', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('blog_post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogPost';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tags_list']))
    {
      $this->setDefault('tags_list', $this->object->Tags->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveTagsList($con);
  }

  public function saveTagsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tags_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $this->object->unlink('Tags', array());

    $values = $this->getValue('tags_list');
    if (is_array($values))
    {
      $this->object->link('Tags', $values);
    }
  }

}