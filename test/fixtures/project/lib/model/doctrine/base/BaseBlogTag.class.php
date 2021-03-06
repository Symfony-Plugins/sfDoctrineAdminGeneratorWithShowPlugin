<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseBlogTag extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('blog_tag');
    $this->hasColumn('name', 'string', 255, array('type' => 'string', 'length' => '255'));
  }

  public function setUp()
  {
    $this->hasMany('BlogPost', array('refClass' => 'BlogPostTag',
                                     'local' => 'blog_tag_id',
                                     'foreign' => 'blog_post_id'));

    $timestampable0 = new Doctrine_Template_Timestampable();
    $sluggable0 = new Doctrine_Template_Sluggable(array('fields' => array(0 => 'name'), 'name' => 'slug', 'type' => 'string', 'length' => '255'));
    $this->actAs($timestampable0);
    $this->actAs($sluggable0);
  }
}