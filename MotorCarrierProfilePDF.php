
<?php
/**
 * Created by PhpStorm.
 * User: Michael Harootoonyan
 * Date: 8/13/2018
 * Time: 7:07 PM
 */
require_once 'MyPDF.php';

class MotorCarrierProfilePDF extends MyPDF
{

    /**
     * @var FONT to be used with self::_setTextFont()
     */
    const FONT = [
        'caliNum' => ['family' => 'Arial', 'style' => 'B', 'size' => 12,
            'color' => ['r' => 0, 'g' => 0, 'b' => 0] // BLACK
        ],
        'checkMark' => ['family' => 'Arial', 'style' => 'B', 'size'=> 9,
            'color' => ['r' => 194, 'g' => 8, 'b' => 8] // RED
        ],
        'default' => ['family' => 'Arial', 'style' => 'B', 'size' => 12,
            'color' => ['r' => 0, 'g' => 0, 'b' => 0] // BLACK
        ],
    ];
    /**
     * @var NEW_PROFILE status: Are We Marking The Form As New? If So We Don't Need CaliNum
     */
    const NEW_PROFILE = 1;
    /**
     * @var UPDATE_PROFILE status: Are We Updating The Form? CaliforniaNumber Needed 7 Digits.
     */
    const UPDATE_PROFILE = 2;

    /**
     * PDF constructor is Taking all the FPDF methods and properties for our PDF
     */
    public function __construct() {
        parent::__construct();
    }


    /**
     * This is where the CA - 1234567   [] new  [] update.
     * Will be filled will the relative information.
     * @param $status new = 1, update = 2
     * @param $caliNum 7 digit number
     */
    public function caliNumCheckMark($status, $caliNum = null)
    {
        // Before we can print text, it's mandatory to select a font with self::setTextFont().
        if (self::NEW_PROFILE === $status) {
            $this->checkMark(144, 29);
        } else if (self::UPDATE_PROFILE === $status) {
            $this->setTextFont('caliNum');
            $this->SetXY(105,29);
            $this->Cell(0, 0,$caliNum, 0, 0, 'L');
            $this->checkMark(162, 29);
        }

    }

    public function checkMark($X, $Y)
    {
        $this->setTextFont('checkMark');
        $this->SetXY($X, $Y);
        $this->Cell(0, 0,'X', 0, 0, 'L');
    }

    public function einCheckMark($ein)
    {
        $this->checkMark(143, 87);
        $this->einOrSSNPlaceHolder($ein);
    }

    public function einOrSSNPlaceHolder($ein)
    {
        $this->setTextFont('default');
        $Y = 83;
        $this->SetXY(143, $Y);
        $this->Cell(0, 0,$ein[0], 0, 0, 'L');
        $this->SetXY(148, $Y);
        $this->Cell(0, 0,$ein[1], 0, 0, 'L');
        $this->SetXY(153, $Y);
        $this->Cell(0, 0,$ein[2], 0, 0, 'L');
        $this->SetXY(159, $Y);
        $this->Cell(0, 0,$ein[3], 0, 0, 'L');
        $this->SetXY(164, $Y);
        $this->Cell(0, 0,$ein[4], 0, 0, 'L');
        $this->SetXY(170, $Y);
        $this->Cell(0, 0,$ein[5], 0, 0, 'L');
        $this->SetXY(175, $Y);
        $this->Cell(0, 0,$ein[6], 0, 0, 'L');
        $this->SetXY(180, $Y);
        $this->Cell(0, 0,$ein[7], 0, 0, 'L');
        $this->SetXY(185, $Y);
        $this->Cell(0, 0, $ein[8], 0, 0, 'L');
    }


    public function page1()
    {
        $offsetX = 0; $offsetY = 5;
        $sizeX = 200;   $sizeY = 250;
        $this->AddPage();
        $this->Image('images/imgpsh_fullsize.jpg', $offsetX, $offsetY, $sizeX, $sizeY,'JPG');
    }

    public function page2()
    {
        $offsetX = 0; $offsetY = 15;
        $sizeX = 200;   $sizeY = 250;
        $this->AddPage();
        $this->Image('images/imgpsh_fullsize-2.jpg', $offsetX, $offsetY, $sizeX, $sizeY,'JPG');
    }

    public function part1($data)
    {

        function companyName($instance, $name)
        {
            $instance->setTextFont('default');
            $instance->setXY(12,132);
            $instance->Cell(0,0, $name);
        }

        function einOnly($instance, $ein)
        {
            $instance->setTextFont('default');
            $Y = 131;
            $instance->SetXY(143, $Y);
            $instance->Cell(0, 0,$ein[0], 0, 0, 'L');
            $instance->SetXY(148, $Y);
            $instance->Cell(0, 0,$ein[1], 0, 0, 'L');
            $instance->SetXY(153, $Y);
            $instance->Cell(0, 0,$ein[2], 0, 0, 'L');
            $instance->SetXY(159, $Y);
            $instance->Cell(0, 0,$ein[3], 0, 0, 'L');
            $instance->SetXY(164, $Y);
            $instance->Cell(0, 0,$ein[4], 0, 0, 'L');
            $instance->SetXY(170, $Y);
            $instance->Cell(0, 0,$ein[5], 0, 0, 'L');
            $instance->SetXY(175, $Y);
            $instance->Cell(0, 0,$ein[6], 0, 0, 'L');
            $instance->SetXY(180, $Y);
            $instance->Cell(0, 0,$ein[7], 0, 0, 'L');
            $instance->SetXY(185, $Y);
            $instance->Cell(0, 0, $ein[8], 0, 0, 'L');
        }

        function fillNameFields($instance, $data)
        {
            // first name
            $instance->SetXY(12, 99);
            $instance->Cell(0, 0, $data['first_name'], 0, 0, 'L');
            // middle initial
            $instance->SetXY(50, 99);
            $instance->Cell(0, 0, $data['middle_initial'], 0, 0, 'L');
            // last name
            $instance->SetXY(62, 99);
            $instance->Cell(0, 0, $data['last_name'], 0, 0, 'L');


        }

        function fillDriverLicenseFields($instance, $data)
        {
            $instance->SetXY(135, 99);
            $instance->Cell(0, 0, $data['driver_license'], 0, 0, 'L');
            $instance->SetXY(165, 99);
            $instance->Cell(0, 0, $data['driver_license_state'], 0, 0, 'L');
        }

        function partnerShip($instance, $X, $Y)
        {
            $instance->checkMark($X, $Y);
        }

        function qualificationNo($instance, $data)
        {
            $letter = $data['qualificationNo'][0];

            $Y = 142;
            $instance->SetXY(138, $Y);
            $instance->Cell(0, 0,$letter, 0, 0, 'L');
            $instance->SetXY(148, $Y);
            $instance->Cell(0, 0,$data['qualificationNo'][1], 0, 0, 'L');
            $instance->SetXY(153, $Y);
            $instance->Cell(0, 0,$data['qualificationNo'][2], 0, 0, 'L');
            $instance->SetXY(159, $Y);
            $instance->Cell(0, 0,$data['qualificationNo'][3], 0, 0, 'L');
            $instance->SetXY(164, $Y);
            $instance->Cell(0, 0,$data['qualificationNo'][4], 0, 0, 'L');
            $instance->SetXY(170, $Y);
            $instance->Cell(0, 0,$data['qualificationNo'][5], 0, 0, 'L');
            $instance->SetXY(175, $Y);
            $instance->Cell(0, 0,$data['qualificationNo'][6], 0, 0, 'L');
            $instance->SetXY(180, $Y);
            $instance->Cell(0, 0,$data['qualificationNo'][7], 0, 0, 'L');


            //numbers only




        }

        if (isset($data['corporation']) && $data['corporation'] == true) {
            $this->checkMark(12,115);
            if (isset($data['corporation_type1']) && $data['corporation_type1'] == true) {
                $this->checkMark(16,119);
            }

            if (isset($data['corporation_type2']) && $data['corporation_type2'] == true) {
                $this->checkMark(16,122);
            }

        }

        if (isset($data['individual']) && $data['individual'] == true) {
            $this->checkMark(12,82);
        }

        if (isset($data['limited_liability_company'])  && $data['limited_liability_company'] == true) {
            $this->checkMark(12,126);
        }

        if (isset($data['partnership']) && $data['partnership'] == true) {
            $this->checkMark(12,111);
        }


        $this->setTextFont('default');
        fillNameFields($this, $data);
        fillDriverLicenseFields($this, $data);
        einOnly($this, $data['ein']);
        companyName($this, $data['company_name']);
        qualificationNo($this, $data);

    }

    public function part2()
    {

    }

    /**
     * Sets the texts font and color provided the following configurations.
     * @param string $config any one of array key values inside
     * the configurations from self::FONT
     */
    public function setTextFont($config)
    {
        $this->SetFont(
            self::FONT[$config]['family'],
            self::FONT[$config]['style'],
            self::FONT[$config]['size']
        );

        $this->SetTextColor(
            self::FONT[$config]['color']['r'],
            self::FONT[$config]['color']['g'],
            self::FONT[$config]['color']['b']
        );
    }

    public function ssnCheckMark($ssn)
    {
        $this->checkMark(163, 87);
        $this->einOrSSNPlaceHolder($ssn);
    }

    public function view($status)
    {
        $data = [
            'type' => $status,

            // part1 data
            'company_name' => 'COMPANY NAME',
            'corporation' => true,
            'corporation_type1' => true,
            'corporation_type2' => true,
            'driver_license' => "D6979915",
            'driver_license_state' => "CA",
            'ein' => '123456789',
            'first_name' => "Michael",
            'individual' => true,
            'last_name' => "Harootoonyan",
            'limited_liability_company' => true,
            'middle_initial' => 'M',
            'partnership' => true,
            'ssn' => '123456789',
            'qualificationNo' => 'A1234567',

        ];

        $this->page1($data);

        // cant be both in real version just for demo to show marks
        $this->caliNumCheckMark($status, '1234567');
        $this->caliNumCheckMark(1);


        // part 1 of the form calls its function first name
        $this->part1($data);


        // cant be both in real version just for demo to show moarks
        $this->einCheckMark('123456789');
        $this->ssnCheckMark('123456789');


        $this->page2();
        $this->Output();
    }

}