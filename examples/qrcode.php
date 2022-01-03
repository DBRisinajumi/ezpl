<?php

use Dbr\Ezpl\Builder;
use Dbr\Ezpl\Command\CommandPipe;
use Dbr\Ezpl\Command\Image\QRCode;
use Dbr\Ezpl\Command\Service\Status;
use Dbr\Ezpl\Driver\NetworkConnector;
use Dbr\Ezpl\Printer;

require '../../../autoload.php';

$qrCode = (new QRCode('P100022342'))
    ->setHorizontal(20)
    ->setVertical(20)
    ->setInputMode(QRCode::INPUT_MODE_MIXING)
    ->setType(QRCode::TYPE_ORIGINAL)
    ->setErrorLevel(QRCode::ERROR_CORRECTION_MEDIUM)
    ->setMaskingFactor(QRCode::MASKING_AUTO)
    ->setMultiple(10)
    ->setRotate(0)
;

$command = (new Builder(new CommandPipe()))
    ->resetMemory()
    ->setLabelHeight(80, 2)
    ->setLabelWidth(80)
    ->setDensity(10)
    ->copies(1)
    ->labelStart()
    ->rectangle(10,10,637,637,3,3)
    ->qrcode($qrCode)
    ->text(14, 250, 10, 1, 1, 0, 0, '2021-09-20')
    ->text(18, 250, 70, 1, 1, 0, 0, '11.000 M3')
    ->text(10, 250, 200, 1, 1, 0, 0, 'P100022342')
    ->text(14, 10, 260, 1, 1, 0, 0, 'CLT60 C 3(20-20-20)V/V/5000/7000')
    ->labelEnd();

$connector = new NetworkConnector('192.168.88.198');
$printer = new Printer($connector);
//$compose = $printer->builder()->compose();
//echo str_replace("\r",PHP_EOL,$compose) . PHP_EOL;
$printer->send($command);


$command = (new Builder(new CommandPipe()))->requestStatus();
$r = $printer->sendAndRead($command);
$c = new Status($r);
echo 'r: ' . bin2hex($r) . PHP_EOL;
echo 'label: ' . $c->getLabel() . PHP_EOL;
sleep(3);
$r = $printer->sendAndRead($command);
$c = new Status($r);
echo 'r: ' . bin2hex($r) . PHP_EOL;
echo 'label: ' . $c->getLabel() . PHP_EOL;


$connector->close();
