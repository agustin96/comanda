<?php
require __DIR__ . '/config.php';
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;

$data = json_decode($_POST["data"], false);

if (!$data) {
    echo json_encode(["status" => false]);
    exit;
}

$name = $data->nombre ? $data->nombre : '';
$address_street = $data->direccion ? $data->direccion : '';
$address_number = $data->numero ? $data->numero : '';
$address_detail = $data->depto ? $data->depto : '';
$phone = $data->telefono ? $data->telefono : '';
$pay_mode = ($data->medio_pago) ? ($data->medio_pago == 1 ? 'Efectivo' : 'MercadoPago') : '';
//$pay_status = $data->nombre ? $data->direccion : '';
$order_id = $data->id_pedido ? $data->id_pedido : '';
$order_total = $data->total ? $data->total : '';
$created_at = $data->fecha_hora ? $data->fecha_hora : '';
$items = $data->items ? $data->items : [];

$connector = new WindowsPrintConnector($PRINTER_NAME);

$printer = new Printer($connector);

// $printer -> setJustification(Escpos::JUSTIFY_CENTER);

$printer->text("----------------------------------------");
$printer->text($COMMERCE_NAME);
$printer->text("----------------------------------------");
$printer->text("****************************************");
$printer->text("DELIVERY");
$printer->text("NO FISCAL");
$printer->text("****************************************");
$printer -> feed(2);
$printer->text($name);
$printer -> feed();
$printer->text("Telefono: " . $phone);
$printer -> feed();
$printer->text("Vehiculo: " . $address_street);
$printer -> feed();
$printer->text("Fila: " . $address_number);
$printer -> feed();
$printer->text("Patente: " . $address_detail);
$printer -> feed();
$printer->text("Pedido: " . $order_id);
$printer -> feed();
$printer->text("Total: " . $order_total);
$printer -> feed();
$printer->text("Forma de Pago: " . $pay_mode);
$printer -> feed(2);
$printer->text("Fecha: " . $created_at);
$printer -> feed(2);
$printer->text("onion.com.ar/" . $LINK_NAME);
$printer -> feed();

$printer -> cut();

//$printer -> pulse();

$printer -> close();

echo json_encode(["status" => true]);

/*
 $profile = CapabilityProfile::load("simple");
 $connector = new WindowsPrintConnector("smb://computer/printer");
 $printer = new Printer($connector, $profile);
 */