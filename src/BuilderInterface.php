<?php

namespace Dbr\Ezpl;

interface BuilderInterface
{
    public function getCommandPipe();
    
    public function compose();
}
