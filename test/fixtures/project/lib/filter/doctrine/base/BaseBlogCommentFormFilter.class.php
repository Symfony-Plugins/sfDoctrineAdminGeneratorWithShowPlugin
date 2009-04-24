<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * BlogComment filter form base class.
 *
 * @package    filters
 * @subpackage BlogComment *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseBlogCommentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'post_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'BlogPost', 'add_empty' => true)),
      'author'     => new sfWidgetFormFilterInput(),
      'email'      => new sfWidgetFormFilterInput(),
      'site'       => new sfWidgetFormFilterInput(),
      'content'    => new sfWidgetFormFilterInput(),
      'ipv4'       => new sfWidgetFormFilterInput(),
      'ipv6'       => new sfWidgetFormFilterInput(),
      'spam'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'post_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'BlogPost', 'column' => 'id')),
      'author'     => new sfValidatorPass(array('required' => false)),
      'email'      => new sfValidatorPass(array('required' => false)),
      'site'       => new sfValidatorPass(array('required' => false)),
      'content'    => new sfValidatorPass(array('required' => false)),
      'ipv4'       => new sfValidatorPass(array('required' => false)),
      'ipv6'       => new sfValidatorPass(array('required' => false)),
      'spam'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('blog_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogComment';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'post_id'    => 'ForeignKey',
      'author'     => 'Text',
      'email'      => 'Text',
      'site'       => 'Text',
      'content'    => 'Text',
      'ipv4'       => 'Text',
      'ipv6'       => 'Text',
      'spam'       => 'Boolean',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}