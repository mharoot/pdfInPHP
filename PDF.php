
<?php
require_once 'fpdf/fpdf.php';

class PDF extends FPDF
{
    public function __construct()
    {
        parent::__construct();
        define('NEW_PROFILE', 1);
        define('UPDATE_PROFILE', 2);
    }

    public function head($status)
    {
        $sizeX = 270; $sizeY = 360; $offsetX = -35; $offsetY = -40;

        // page 1
        $this->AddPage(); 
        $this->Image('images/imgpsh_fullsize.jpg',$offsetX, $offsetY, $sizeX, $sizeY,'JPG');

        // Before we can print text, it's mandatory to select a font with SetFont(). We choose Arial bold 12:
        $this->SetFont('Arial','B',12);


        $this->Cell(85);
        $this->Cell(85,22,'CaliforniaNumber');

        if (NEW_PROFILE === $status) {
            $this->Cell(-33);
            $this->Cell(0, 20,'X', 0, 0, 'L');
        } else if (UPDATE_PROFILE === $status) {
            $this->Cell(-13);
            $this->Cell(0, 20,'X', 0, 0, 'L');
        }
    }

    public function page2()
    {
        $sizeX = 270; $sizeY = 360; $offsetX = -35; $offsetY = -40;
        $this->AddPage(); 
        $this->Image('images/CA number application chp362 page 2.jpg',$offsetX, $offsetY+5, $sizeX, $sizeY,'JPG');
    }

    public function view($status)
    {
        $this->head($status);
        $this->page2();
        $this->Output();
    }

}

?>