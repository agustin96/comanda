<?php

require __DIR__ . '/config.php';
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;

$connector = new WindowsPrintConnector($PRINTER_NAME);

$printer = new Printer($connector);

// $printer -> setJustification(Escpos::JUSTIFY_CENTER);

$printer -> feed(2);

$printer->text("Texto de Ejemplo");

$printer -> feed(2);

$printer -> cut();

//$printer -> pulse();

$printer -> close();