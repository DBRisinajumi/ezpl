
EZPL command generator for label thermal printer. This library is for anyone who wants to integrate directly with their printers without any 3rd party application.

This library was tested using **Godex G500** model and with a **50mmx45mm** label sticker paper.

#### Installation

```composer require fashionvalet/stickie```

#### Generating EZPL Commands

```php
<?php

use Dbr\Ezpl\Builder;
use Dbr\Ezpl\CommandPipe;

$command = (new Builder(new CommandPipe))
    ->resetMemory()
    ->setLabelWidth(50)
    ->setLabelHeight(30)
    ->setDensity(10)
    ->copies(1)
    ->labelStart()
    ->text(10, 15, 5, 1, 1, 0, 0, 'Item: Brina Flowy Chiffon Skirt - UK 6')
    ->text(10, 15, 30, 1, 1, 0, 0, 'Brand: Aere')
    ->text(10, 15, 90, 1, 1, 0, 0, 'SKU: 1504051610-UK 6')
    ->text(10, 15, 120, 1, 1, 0, 0, 'Price: RM 1,000.00')
    ->barcode('CODE128', 72, 160, 2, 10, 30, 0, 3, 'AR0009287')
    ->labelEnd()
    ->compose();
```

This will generate the EZPL output as below

```
~MDEL\n
^W50\n
^Q30\n
^H10\n
^P1\n
^L\n
AB, 15, 5, 1, 1, 0, 0, Item: Brina Flowy Chiffon Skirt - UK 6\n
AB, 15, 60, 1, 1, 0, 0, Brand: Aere\n
AB, 15, 90, 1, 1, 0, 0, SKU: 1504051610-UK 6\n
AB, 15, 120, 1, 1, 0, 0, Price: RM 1,000.00\n
BQ, 72, 160, 2, 10, 30, 0, 3,AR0009287\n
E\n
```

#### Printing The Output

```php
<?php

use Dbr\Ezpl\Printer;
use Dbr\Ezpl\Builder;
use Dbr\Ezpl\CommandPipe;
use Dbr\Ezpl\Driver\LinuxConnector;

$command = (new Builder(new CommandPipe))
    ->resetMemory()
    ->setLabelWidth(50)
    ->setLabelHeight(30)
    ->setDensity(10)
    ->copies(1)
    ->labelStart()
    ->text(10, 15, 5, 1, 1, 0, 0, 'Item: Brina Flowy Chiffon Skirt - UK 6')
    ->text(10, 15, 30, 1, 1, 0, 0, 'Brand: Aere')
    ->text(10, 15, 90, 1, 1, 0, 0, 'SKU: 1504051610-UK 6')
    ->text(10, 15, 120, 1, 1, 0, 0, 'Price: RM 1,000.00')
    ->barcode('CODE128', 72, 160, 2, 10, 30, 0, 3, 'AR0009287')
    ->labelEnd();

$connector = new LinuxConnector('/dev/usb/lp0');
$printer = new Printer($connector, $command);

$printer->generate();
```

##notes
 - GODEX G500 resulution is 8 tot/mmm