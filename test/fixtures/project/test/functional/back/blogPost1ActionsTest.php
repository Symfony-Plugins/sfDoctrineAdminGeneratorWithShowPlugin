<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

# purge all post!
Doctrine::getTable('BlogPost')->findAll()->delete();

$browser = new sfTestFunctional(new sfBrowser());


#
#  test if the the theme don't have broken the admin gen
#
#
$browser->
  get('/blogPost1/index')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()->
  
  with('request')->begin()->
    isParameter('module', 'blogPost1')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    checkElement('h1', 'BlogPost1 List')->
  end()->

  with('response')->begin()->
    checkElement('div.sf_admin_list p', 'No result')->
  end()->

  click('New')->
  
  with('response')->begin()->
    isStatusCode(200)->
    setField('blog_post[title]'      , 'my first post')->
    setField('blog_post[extract]'    , 'a short text about my post')->
    setField('blog_post[content]'    , 'my content of my post..')->
    click('Save')->
    followRedirect()->
    click('Cancel')->
    end()->
  
  with('response')->begin()->
    click('New')->
  end()->
//  
  with('response')->begin()->
    isStatusCode(200)->
    setField('blog_post[title]'      , 'my second post')->
    setField('blog_post[extract]'    , 'another short text about my post')->
    setField('blog_post[content]'    , 'a long text for my second post.')->
    click('Save')->
  end()->

  
# test if show is enabled
  get('/blogPost1/1')->
    isStatusCode(404)->
    
# test if export actions is disabled    
  get('blogPost/csv/action')->
    isStatusCode(404)->
  get('blogPost/excel/action')->
    isStatusCode(404)->
  get('blogPost/csv/pdf/action')->
    isStatusCode(404)->
  get('blogPost/csv/xml/action')->
    isStatusCode(404)->
    
  get('/blogPost1/index')->

  with('response')->begin()->
    checkElement('body'       ,'!/Csv/')->
    checkElement('body'       ,'!/Excel/')->
    checkElement('body'       ,'!/Pdf/')->
    checkElement('body'       ,'!/Xml/')->
  end()
  ;

  
/*  with('response')->begin()
    ->checkElement('h1',"BlogPost1 List")
    ->checkElement('table tbody tr.sf_admin_row td.sf_admin_list_td_author_id', "my first post")
  ->end()*/ 
  