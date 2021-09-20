<?php

namespace Dbr\Ezpl;

use Driver\ConnectorInterface;

interface PrinterInterface
{
    public function printer();

    public function generate();
}
