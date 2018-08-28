<?php include_once 'autoload.php';?>
<?php
require('fpdf.php');

class PDF extends FPDF
{

function Header()
{

    $this->SetFont('Arial','B',15);
    
    $this->Cell(80);
    
    $this->Cell(40,10,'Business card',1,0,'C');
    // Line break
    $this->Ln(20);
}


function Footer()
{
    
    $this->SetY(-15);
    
    $this->SetFont('Arial','I',8);
    
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


?>