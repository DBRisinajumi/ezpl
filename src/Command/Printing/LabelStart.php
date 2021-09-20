<?php

namespace Dbr\Ezpl\Command\Printing;

use Dbr\Ezpl\Command\AbstractableCommand;

class LabelStart extends AbstractableCommand
{
    protected $code = 'L';

    public function toCommand()
    {
        return $this->getSetupPrefix().$this->getCode();
    }
}
