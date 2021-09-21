<?php

namespace Dbr\Ezpl;

class Printer implements PrinterInterface
{
    protected $printer;

    protected $builder;

    public function __construct(Driver\ConnectorInterface $printer, BuilderInterface $builder)
    {
        $this->printer = $printer;
        $this->builder = $builder;
    }

    public function printer(): Driver\ConnectorInterface
    {
        return $this->printer;
    }

    public function builder(): BuilderInterface
    {
        return $this->builder;
    }

    public function send(BuilderInterface $builder): void
    {
        $this->builder = $builder;
        $commands = $this->builder->compose();
        $this->printer->send($commands);
    }

    public function sendAndRead(BuilderInterface $builder)
    {
        $this->send($builder);
        return $this->printer->read();
    }
}
