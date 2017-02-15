<?php

    ob_start();
	$this->pdf->AddPage();
	$this->pdf->SetCreator("Al Amin","utf8");
	$this->pdf->SetTitle("NE PDF Maker","utf8");
	$this->pdf->SetMargins("1", "1", "1");
	$this->pdf->SetFont('Arial','B',16);
	$this->pdf->Cell(40,10, utf8_decode($num . ' ' . $applet));
	$this->pdf->SetFont('Arial','B',36);
	$this->pdf->Cell(60,10,'Powered by Nano Eye.',0,1,'C');
	$this->pdf->Output();
    ob_end_flush(); 
