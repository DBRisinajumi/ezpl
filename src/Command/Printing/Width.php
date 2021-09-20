<?php

namespace Dbr\Ezpl\Command\Printing;

use Dbr\Ezpl\Command\AbstractableCommand;

class Width extends AbstractableCommand
{
    protected $code = 'W';

    protected $width = 0;

    public function __construct($width)
    {
        if ($this->isInteger($width)) {
            $this->width = $width;
        }
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function toCommand()
    {
        return $this->getSetupPrefix().$this->getCode().$this->getWidth();
    }
}
