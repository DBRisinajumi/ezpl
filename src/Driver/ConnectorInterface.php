<?php

namespace Dbr\Ezpl\Driver;

interface ConnectorInterface
{
    public function close();

    public function send($data);
}
