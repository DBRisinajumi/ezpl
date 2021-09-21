<?php

namespace Dbr\Ezpl;

interface PrinterInterface
{
    public function printer();
    public function builder();
    public function send(BuilderInterface $builder): void;
    public function sendAndRead(BuilderInterface $builder);
}
