
  public function executePdf(sfWebRequest $request)
  {
    $this-><?php echo $this->getPluralName() ?> = Doctrine::getTable('<?php echo $this->getModelClass() ?>')->findAll();
    $this->exportToPdf();
  }

    public function executeBatchPdf(sfWebRequest $request)
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
      $this->exportToPdf();
    }
  }
  
  public function exportToPdf()
  {
    $this->display = $this->configuration->getPdfDisplay();
    $htmlcontent = $this->getPartial('<?php echo $this->getModuleName()?>/pdfs', array('<?php echo $this->getPluralName() ?>' =>  $this-><?php echo $this->getPluralName() ?>, 'display' => $this->display));
    
    $this->configuration->pdfConfigurationf();
    
    // PLEASE SET THE FOLLOWING CONSTANTS:

    $request = sfContext::getInstance ()->getRequest ();
    $url = 'http' . ($request->isSecure () ? 's' : '') . '://' . $request->getHost () . '/';

    /**
     * installation path
     */
    define ("K_PATH_MAIN", sfConfig::get('sf_tcpdf_dir'));

    /**
     * url path
     */
    define ("K_PATH_URL", $url);

    /**
     * path for PDF fonts
     */
    define ("K_PATH_FONTS", K_PATH_MAIN. "fonts".DIRECTORY_SEPARATOR);

    /**
     * cache directory for temporary files (full path)
     */
    define ("K_PATH_CACHE", K_PATH_MAIN."cache".DIRECTORY_SEPARATOR);

    /**
     * cache directory for temporary files (url path)
     */
    define ("K_PATH_URL_CACHE", K_PATH_URL."cache".DIRECTORY_SEPARATOR);

    /**
     *images directory
     */
    define ("K_PATH_IMAGES", sfConfig::get('sf_web_dir')."/images/");

    /**
     * blank image
     */
    define ("K_BLANK_IMAGE", sfConfig::get('sf_web_dir')."/sfTCPDFPlugin/images/_blank.png");

    //if (defined('K_TCPDF_EXTERNAL_CONFIG')) return;

    define('K_TCPDF_EXTERNAL_CONFIG', true);

    /**
     * page format
     */
    define ("PDF_PAGE_FORMAT", "A4");

    /**
     * page orientation (P=portrait, L=landscape)
     */
    define ("PDF_PAGE_ORIENTATION", "P");

    /**
     * document creator
     */
    define ("PDF_CREATOR", "TCPDF");

    /**
     * document author
     */
    define ("PDF_AUTHOR", "Pierre Cahard");

    /**
     * header title
     */
    define ("PDF_HEADER_TITLE", $this->configuration->getValue('pdf.title') );

    /**
     * header description string
     */
    define ("PDF_HEADER_STRING", $this->configuration->getValue('pdf.title') );

    /**
     * image logo
     */
    if( !sfConfig::get('pdf_logo', false))
    {
      $logo = sfConfig::get('pdf_logo');
    }else
    {
      $logo = null;
    }
    define ("PDF_HEADER_LOGO", $logo);

    /**
     * header logo image width [mm]
     */
    define ("PDF_HEADER_LOGO_WIDTH", 20);

    /**
     *  document unit of measure [pt=point, mm=millimeter, cm=centimeter, in=inch]
     */
    define ("PDF_UNIT", "mm");

    /**
     * header margin
     */
    define ("PDF_MARGIN_HEADER", 5);

    /**
     * footer margin
     */
    define ("PDF_MARGIN_FOOTER", 10);

    /**
     * top margin
     */
    define ("PDF_MARGIN_TOP", 27);

    /**
     * bottom margin
     */
    define ("PDF_MARGIN_BOTTOM", 25);

    /**
     * left margin
     */
    define ("PDF_MARGIN_LEFT", 15);

    /**
     * right margin
     */
    define ("PDF_MARGIN_RIGHT", 15);

    /**
     * main font name
     */
    define ("PDF_FONT_NAME_MAIN", "FreeSerif"); //vera

    /**
     * main font size
     */
    define ("PDF_FONT_SIZE_MAIN", 10);

    /**
     * data font name
     */
    define ("PDF_FONT_NAME_DATA", "FreeSerif"); //verase

    /**
     * data font size
     */
    define ("PDF_FONT_SIZE_DATA", 8);

    /**
     *  scale factor for images (number of points in user unit)
     */
    define ("PDF_IMAGE_SCALE_RATIO", 4);

    /**
     * magnification factor for titles
     */
    define("HEAD_MAGNIFICATION", 1.1);

    /**
     * height of cell repect font height
     */
    define("K_CELL_HEIGHT_RATIO", 1.25);

    /**
     * title magnification respect main font size
     */
    define("K_TITLE_MAGNIFICATION", 1.3);

    /**
     * reduction factor for small font
     */
    define("K_SMALL_RATIO", 2/3);
    
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true); 

    require_once(sfConfig::get('sf_tcpdf_dir').DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'eng.php');
    
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor("Pierre Cahard");
    $pdf->SetTitle("Formulaire d'une prestation");
    $pdf->SetSubject("Gexpertise");
    $pdf->SetKeywords("Formulaire d'une prestation");
    
    // set default header data
   // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
    
    //set some language-dependent strings
    $pdf->setLanguageArray($l); 
    
    //initialize document
    $pdf->AliasNbPages();
    
    // add a page
    $pdf->AddPage();
    
    // ---------------------------------------------------------
 
    
    // set core font
    // $pdf->SetFont("helvetica", "", 10);
    
    // output the HTML content
    // $pdf->writeHTML($htmlcontent, true, 0, true, true);
    
    // $pdf->Ln();
    
    // set UTF-8 font
    $pdf->SetFont("dejavusans", "", 10);
    
    // output the HTML content
    $pdf->writeHTML($htmlcontent, true, 0, true, true);
    
    // reset pointer to the last page
    $pdf->lastPage();
    
    // ---------------------------------------------------------

    $this->setLayout(false);
    $this->setTemplate(false);
    $this->content = '' ;
    
    //Close and output PDF document
    $pdf->Output($this->configuration->getPdfFilename().".pdf", "I", "I");
    die;
  }