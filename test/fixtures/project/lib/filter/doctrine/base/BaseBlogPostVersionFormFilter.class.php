<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * BlogPostVersion filter form base class.
 *
 * @package    filters
 * @subpackage BlogPostVersion *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseBlogPostVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'author_id'      => new sfWidgetFormFilterInput(),
      'category_id'    => new sfWidgetFormFilterInput(),
      'title'          => new sfWidgetFormFilterInput(),
      'extract'        => new sfWidgetFormFilterInput(),
      'content'        => new sfWidgetFormFilterInput(),
      'is_published'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'allow_comments' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'author_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'category_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'          => new sfValidatorPass(array('required' => false)),
      'extract'        => new sfValidatorPass(array('required' => false)),
      'content'        => new sfValidatorPass(array('required' => false)),
      'is_published'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'allow_comments' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('blog_post_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogPostVersion';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'author_id'      => 'Number',
      'category_id'    => 'Number',
      'title'          => 'Text',
      'extract'        => 'Text',
      'content'        => 'Text',
      'is_published'   => 'Boolean',
      'allow_comments' => 'Boolean',
      'version'        => 'Number',
    );
  }
}