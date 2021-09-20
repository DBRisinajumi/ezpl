<?php

namespace Dbr\Ezpl\Command;

interface CommandPipeInterface
{
    public function addCommand(CommandInterface $command);

    public function removeCommand(CommandInterface $command);

    public function getCommands();

    public function flushCommands();
}
