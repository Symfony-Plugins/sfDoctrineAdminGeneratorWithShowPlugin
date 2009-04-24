<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * BlogPost filter form base class.
 *
 * @package    filters
 * @subpackage BlogPost *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseBlogPostFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'author_id'      => new sfWidgetFormFilterInput(),
      'category_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'BlogCategory', 'add_empty' => true)),
      'title'          => new sfWidgetFormFilterInput(),
      'extract'        => new sfWidgetFormFilterInput(),
      'content'        => new sfWidgetFormFilterInput(),
      'is_published'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'allow_comments' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'version'        => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'slug'           => new sfWidgetFormFilterInput(),
      'tags_list'      => new sfWidgetFormDoctrineSelectMany(array('model' => 'BlogTag')),
    ));

    $this->setValidators(array(
      'author_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'category_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'BlogCategory', 'column' => 'id')),
      'title'          => new sfValidatorPass(array('required' => false)),
      'extract'        => new sfValidatorPass(array('required' => false)),
      'content'        => new sfValidatorPass(array('required' => false)),
      'is_published'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'allow_comments' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'version'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'slug'           => new sfValidatorPass(array('required' => false)),
      'tags_list'      => new sfValidatorDoctrineChoiceMany(array('model' => 'BlogTag', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addTagsListColumnQuery(Doctrine_Query $query, $field, $values)
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
          ->andWhereIn('BlogPostTag.blog_tag_id', $values);
  }

  public function getModelName()
  {
    return 'BlogPost';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'author_id'      => 'Number',
      'category_id'    => 'ForeignKey',
      'title'          => 'Text',
      'extract'        => 'Text',
      'content'        => 'Text',
      'is_published'   => 'Boolean',
      'allow_comments' => 'Boolean',
      'version'        => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'slug'           => 'Text',
      'tags_list'      => 'ManyKey',
    );
  }
}