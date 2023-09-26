<?php

namespace App\Libraries;

use TCPDF;

class MY_TCPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = ROOTPATH . 'cetak/logosejati.png';
        /**
         * width : 50
         */
        $this->Image($image_file, 25, 0, 35);
        // Set font
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
