<?php

namespace Dbr\Ezpl\Command\Printing;

use Dbr\Ezpl\Command\AbstractableCommand;

class LabelEnd extends AbstractableCommand
{
    protected $code = 'E';

    public function toCommand()
    {
        return $this->getCode();
    }
}
