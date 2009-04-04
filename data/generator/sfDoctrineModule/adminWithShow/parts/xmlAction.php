  public function executeXml(sfWebRequest $request)
  {
    $this-><?php echo $this->getPluralName() ?> = Doctrine::getTable('<?php echo $this->getModelClass() ?>')->findAll();
    $this->exportToXml();
  }
  
  public function executeBatchXml(sfWebRequest $request)
  {
  
    $ids = $request->getParameter('ids');

    $this-><?php echo $this->getPluralName() ?> = Doctrine_Query::create()
      ->from('<?php echo $this->getModelClass() ?>')
      ->whereIn('id', $ids)
      ->execute();

    if ( ! $this-><?php echo $this->getPluralName() ?> )
    {
      $this->getUser()->setFlash('error', 'A problem occurs when exporting the selected items.');
    }else
    {
      $this->exportToXml();
    }
  }
  
  public function exportToXml()
  {
    $this->separator = ';';
    
    $this->xw = new xmlWriter();
    $this->xw->openMemory();
    $this->xw->startDocument('1.0', 'UTF-8');
    $this->xw->setIndent(1);
    $this->xw->startElement('root');
    
    foreach($this-><?php echo $this->getPluralName() ?> as $<?php echo $this->getSingularName() ?>)
    {
      $this->xw->startElement('structure');
      foreach($this->configuration->getXmlDisplay() as $display)
      {
        $this->xw->writeElement($display, $<?php echo $this->getSingularName() ?>->get($display));
      }
      $this->xw->endElement();    
    }
    $this->xw->endElement();
    $this->xw->endDtd();

    $this->content = $this->xw->outputMemory(true) ;
    
    $this->setLayout(false);
    $this->setTemplate('export');
        
    $this->getResponse()->clearHttpHeaders();
    $this->getResponse()->setContentType('text/xml');
    $this->getResponse()->addHttpMeta('content-disposition: ', 'attachment; filename=' . $this->configuration->getXmlFilename() . '.xml', true);
    
    
    if($this->getRequest()->getMethod() == sfWebRequest::POST)
    {
      $this->getResponse()->setContent($this->content);
      $this->getResponse()->send();
      $this->setTemplate(false);
      // for an obscure raison, sfResponse return a error with sfView::NONE 
      // so stop with die the script..
      die;
      //return sfView::NONE;
    }       
       
  }
