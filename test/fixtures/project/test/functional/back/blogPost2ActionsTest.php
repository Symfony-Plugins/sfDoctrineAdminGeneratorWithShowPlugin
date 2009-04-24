<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$tmp_excel = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR. 'tmp';
if (!is_dir($tmp_excel))
{
  mkdir ($tmp_excel);
}

# purge all post!

$browser = new sfTestFunctional(new sfBrowser());

Doctrine::getTable('BlogPost')->findAll()->delete();

$blog_post = new BlogPost();
$blog_post->setTitle('my first post');
$blog_post->setExtract('a short text about my post');
$blog_post->setContent('my content of my post..');
$blog_post->save();

$blog_post = new BlogPost();
$blog_post->setTitle('my second post');
$blog_post->setExtract('another short text about my post');
$blog_post->setContent('a long text for my second post.');
$blog_post->save();

#
# check a admin gen with all features   
#
$browser->
  get('/blogPost2/index')->
  
  with('response')->begin()->
    checkElement('body'       ,'/Csv/')->
    checkElement('body'       ,'/Excel/')->
    checkElement('body'       ,'/Pdf/')->
    checkElement('body'       ,'/Xml/')->
  end()->
        
  click('Csv')->
  with('response')->begin()->
    isStatusCode(200)->
    isHeader('Content-Type','application/octet-stream')->
    isHeader('Content-Disposition','attachment; filename="blog_post_list.csv')->
    contains('id,author_id,category_id,title,extract,content,is_published,allow_comments,version,created_at,updated_at,slug')->
    contains(',,,"my first post","a short text about my post","my content of my post..",,1,1,"')->
  end()->
  
  get('/blogPost2/index')->
  click('Xml')->
  with('response')->begin()->
    isStatusCode(200)->
    isHeader('Content-Type','text/xml; charset=utf-8')->
    isHeader('Content-Disposition','attachment; filename=blog_post_list.xml')->
  end()->
  
  get('/blogPost2/index')->
  click('Pdf')->
  with('response')->begin()->
    isStatusCode(200)->
    isHeader('Content-Type','application/pdf')->
    isHeader('Content-Disposition','attachment; filename=blog_post_list.pdf')->
    contains('/%PDF/')->
  end()->
  
## use batch action
  get('/blogPost2/index')->
  with('response')->begin()->
  setField('ids[]',array(1, 2))->
    setField('sf_admin_batch_action', 'batchCsv')->
    click('go')->
    isStatusCode(200)->
  end()->

  
  get('/blogPost2/index')->
  click('Excel')->
  with('response')->begin()->
  isStatusCode(200)->
    isHeader('Content-Type','application/octet-stream')->
    isHeader('Content-Disposition','attachment; filename="blog_post_list.xls"')->
  end()
    
  
  
  
  ;
  