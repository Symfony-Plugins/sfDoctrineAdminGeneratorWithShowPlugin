<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * BlogTag filter form base class.
 *
 * @package    filters
 * @subpackage BlogTag *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseBlogTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'slug'           => new sfWidgetFormFilterInput(),
      'blog_post_list' => new sfWidgetFormDoctrineSelectMany(array('model' => 'BlogPost')),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'slug'           => new sfValidatorPass(array('required' => false)),
      'blog_post_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'BlogPost', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addBlogPostListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.BlogPostTag BlogPostTag')
          ->andWhereIn('BlogPostTag.blog_post_id', $values);
  }

  public function getModelName()
  {
    return 'BlogTag';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'slug'           => 'Text',
      'blog_post_list' => 'ManyKey',
    );
  }
}