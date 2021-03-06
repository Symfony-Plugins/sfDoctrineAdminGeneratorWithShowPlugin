<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseBlogPost extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('blog_post');
    $this->hasColumn('author_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('category_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('title', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('extract', 'string', 6000, array('type' => 'string', 'length' => '6000'));
    $this->hasColumn('content', 'string', 6000, array('type' => 'string', 'length' => '6000'));
    $this->hasColumn('is_published', 'boolean', 1, array('type' => 'boolean', 'default' => false, 'length' => '1'));
    $this->hasColumn('allow_comments', 'boolean', 1, array('type' => 'boolean', 'default' => true, 'length' => '1'));
  }

  public function setUp()
  {
    $this->hasOne('BlogCategory as Category', array('local' => 'category_id',
                                                    'foreign' => 'id',
                                                    'onDelete' => 'CASCADE'));

    $this->hasMany('BlogTag as Tags', array('refClass' => 'BlogPostTag',
                                            'local' => 'blog_post_id',
                                            'foreign' => 'blog_tag_id'));

    $this->hasMany('BlogComment', array('local' => 'id',
                                        'foreign' => 'post_id'));

    $versionable0 = new Doctrine_Template_Versionable();
    $timestampable0 = new Doctrine_Template_Timestampable();
    $sluggable0 = new Doctrine_Template_Sluggable(array('fields' => array(0 => 'title'), 'name' => 'slug', 'type' => 'string', 'length' => '255'));
    $this->actAs($versionable0);
    $this->actAs($timestampable0);
    $this->actAs($sluggable0);
  }
}