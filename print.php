<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;

$connector = new WindowsPrintConnector("Microsoft Print To PDF");

$printer = new Printer($connector);

// $printer -> setJustification(Escpos::JUSTIFY_CENTER);

$printer->text("New Harbor Example");

$printer -> feed(2);

$printer -> cut();

//$printer -> pulse();

$printer -> close();




/*
 $profile = CapabilityProfile::load("simple");
 $connector = new WindowsPrintConnector("smb://computer/printer");
 $printer = new Printer($connector, $profile);
 */