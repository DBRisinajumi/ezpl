<?php

namespace Dbr\Ezpl\Command\Memory;

use Dbr\Ezpl\Command\AbstractableCommand;

class Format extends AbstractableCommand
{
    protected $code = 'MDEL';

    public function toCommand()
    {
        return $this->getControlPrefix().$this->getCode();
    }
}
