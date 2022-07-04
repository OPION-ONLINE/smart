<?php
require "../../email_templates/receipt_generator/fpdf.php" ;
ini_set("display_errors", 1); ini_set("display_startup_errors", 1); error_reporting(E_ALL);


$pdf = new FPDF();
$pdf->AddPage();

$today = date("F j, Y, g:i a"); 

$pdf->SetFont("Arial", "", 10);

$pdf->Image($_SERVER["DOCUMENT_ROOT"]."/me/newscratch/email_templates/images/opion-removebg-preview.png",10,10,10, 10);

$pdf->Cell(100, 12, "", 0, 1, "S");

$pdf->Line(10, 22, 200, 22);


$pdf->Cell(100, 10, "Booking ID: $reference", 0, 0, "S");
$pdf->Cell(100, 10, "Amount Paid: GHC $amount_paid", 0, 1, "S");

$pdf->Line(10, 32, 200, 32);

$pdf->Cell(100, 10, "Name: $username", 0, 0, "S");
$pdf->Cell(100, 10, "Date: " . $today , 0, 1, "S");

$pdf->Line(10, 42, 200, 42);

$pdf->Cell(100, 10, "Facility: $facility_name", 0, 0, "S");
$pdf->Cell(100, 10, "Type: $facility_type", 0, 1, "S");

$pdf->Line(10, 52, 200, 52);

$pdf->Cell(100, 10, "Floor: $selected_floor", 0, 0, "S");
$pdf->Cell(100, 10, "Room Type: $selected_room", 0, 1, "S");

$pdf->Line(10, 62, 200, 62);

$pdf->Cell(100, 10, "Mode Of Payment: $channel", 0, 0, "S");
$pdf->Cell(100, 10, "Plan: $plan", 0, 1, "S");

$pdf->Line(10, 72, 200, 72);

// $pdf->Output();

$filename = "$username-$reference.pdf";

$file = $_SERVER["DOCUMENT_ROOT"]."/me/newscratch/receipts/" . $filename;

$pdf->Output("F", $file , true);

$to = $useremail;
$subject = "confirmation";
$from = "peterparker@email.com";
 
  $headers = "Reply-To: shaldix.uk@gmail.com\r\n"; 
  $headers .= "Return-Path: shaldix.uk@gmail.com\r\n"; 
  $headers .= "From: shaldix.uk@gmail.com\r\n";  
  $headers .= "Organization: Opion Inc\r\n";

// Header for sender info 
$headers = "From: shaldix.uk@gmail.com"; 
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
 
// Compose a simple HTML email message
// Multipart boundary  
$message = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/me/newscratch/email_templates/transaction/success.html");

$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
    } 
} 
$message .= "--{$mime_boundary}--"; 

$email = $useremail;

if(mail($to,$subject,$message,$headers)) {
    // echo $message;
    
}
else echo "it did not work";
// header(\"Location: send.html?hello=yes\");


