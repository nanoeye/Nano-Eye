<?php

class pdfController extends Controller
{
	private $pdf;
	
	public function __construct()
	{
		parent::__construct();
		$this->pdf = $this->getLibrary('fpdf');
        $this->access_init();
	}
	
	public function index()
	{
		$this->view->setJs(array('main'));
		
	}
	
	public function dopdf($num=false,$applet=false)
	{
		$this->view->assign('title', 'PDF Maker');

/*    ob_start();
    $this->pdf->AddPage();
    $this->pdf->SetFont('Arial','B',16);
    $this->pdf->Cell(40,10,'Hello World!');
    $this->pdf->Output();
    ob_end_flush(); */

		require_once ROOT. 'public' . DS . 'media' . DS . 'dopdf.php';
	}
}