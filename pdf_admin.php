<?php
$ini = parse_ini_file('assets/app.ini');
include("assets/functions.php");
session_start();

if(!isset($_SESSION["Adminloggedin"]) || $_SESSION["Adminloggedin"] !== true){
    header("location: login.php");
    exit;
} 

define('FPDF_FONTPATH','assets/font/');
require('assets/fpdf.php');

$conn = new mysqli($ini['db_host'], $ini['db_username'], $ini['db_password'], $ini['db_name']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT application_id,first_name,postcode,application_status,application_date FROM customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    class PDF extends FPDF {

        // Simple table
        function BasicTable($header, $data)
        {
            $this->SetFont('Arial','B',12);
            // Header
            foreach($header as $col){
                $this->Cell(35,7,$col,1);
            }
            $this->Ln(); //new line after print the header
    
            $this->SetFont('Arial','',12);
            // Data
            foreach($data as $row)
            {
                foreach($row as $col)
                    $this->Cell(35,7,$col,1);
                $this->Ln();
            }
        }
    }

    while($row = $result->fetch_assoc()) {
        $res [] = $row;
    }

    $pdf = new PDF(); //create an object of PDF
    $pdf->SetFont('Arial','B',12);

    $pdf->AddPage();
    $pdf->Cell(60,25,'List of Users');
    $pdf->Ln(25);
    $pdf->SetFont('Arial','',12);
    $header = array("ID","Frist Name","Post Code","Status","Date Created");

    $pdf->BasicTable($header,$res);
    $pdf->Output();
}





?>