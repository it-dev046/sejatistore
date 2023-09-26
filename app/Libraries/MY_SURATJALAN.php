<?php

namespace App\Libraries;

use TCPDF;

class MY_SURATJALAN extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = ROOTPATH . 'public/cetak/logosejati.png';
        /**
         * width : 50
         */
        $this->Image($image_file, 25, 0, 35);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        $this->Ln(4);
        $this->Cell(80);
        $this->Cell(0, 2, 'NOTA', 0, 1, '', 0, '', 0);
        // Title
        $this->SetFont('helvetica', '', 10);
        $this->Cell(82);
        $this->Cell(0, 2, 'INVOICE', 0, 1, '', 0, '', 0);
        $this->Ln(4);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
