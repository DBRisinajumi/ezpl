<?php

namespace Dbr\Ezpl;

use Dbr\Ezpl\Command\CommandPipeInterface;
use Dbr\Ezpl\Command\Draw\Rectangle;
use Dbr\Ezpl\Command\Service\Status;

class Builder implements BuilderInterface
{
    protected $commandPipe;

    public function __construct(Command\CommandPipeInterface $commandPipe)
    {
        $this->commandPipe = $commandPipe;
    }

    public function getCommandPipe(): CommandPipeInterface
    {
        return $this->commandPipe;
    }

    public function resetMemory(): self
    {
        $this->commandPipe->addCommand(new Command\Memory\Format);

        return $this;
    }

    public function setLabelWidth($width): self
    {
        $this->commandPipe->addCommand(new Command\Printing\Width($width));

        return $this;
    }

    public function setLabelHeight($height, $spacing = null): self
    {
        $this->commandPipe->addCommand(new Command\Printing\Height($height, $spacing));

        return $this;
    }

    public function setPattern(int $x, int $y = 0, int $width = 0, int $height = 0, array $data = []): self
    {
        $this->commandPipe->addCommand(new Command\Printing\Pattern($x, $y, $width, $height));

        return $this;
    }

    public function setDensity($density): self
    {
        $this->commandPipe->addCommand(new Command\Printing\Density($density));

        return $this;
    }

    public function copies($copies): self
    {
        $this->commandPipe->addCommand(new Command\Printing\Copy($copies));

        return $this;
    }

    public function labelStart(): self
    {
        $this->commandPipe->addCommand(new Command\Printing\LabelStart);

        return $this;
    }

    public function labelEnd(): self
    {
        $this->commandPipe->addCommand(new Command\Printing\LabelEnd);

        return $this;
    }

    public function barcode($type, $horizontal, $vertical, $narrow, $wide, $height, $rotation, $text, $value) : self
    {
        $this->commandPipe->addCommand(new Command\Image\Barcode($type, $horizontal, $vertical, $narrow, $wide, $height, $rotation, $text, $value));

        return $this;
    }

    public function qrcode(Command\Image\QRCode $QRCode) : self
    {
        $this->commandPipe->addCommand($QRCode);

        return $this;
    }

    public function text($size, $horizontal, $vertical, $magnifyHorizontal, $magnifyVertical, $gap, $rotation, $value) : self
    {
        $this->commandPipe->addCommand(new Command\Text\Font($size, $horizontal, $vertical, $magnifyHorizontal, $magnifyVertical, $gap, $rotation, $value));

        return $this;
    }
    public function rectangle(
        int $horizontal,
        int $vertical,
        int $horizontal1,
        int $vertical1,
        int $thicknessLeftRightBorder = 2,
        int $thicknessUpperBottomBorder = 2
    ) : self {
        $this->commandPipe->addCommand(new Rectangle($horizontal, $vertical, $horizontal1, $vertical1, $thicknessLeftRightBorder, $thicknessUpperBottomBorder));
        return $this;
    }

    public function requestStatus(): self
    {
        $this->commandPipe->addCommand(new Status());

        return $this;
    }

    public function compose(): string
    {
        $commands = $this->commandPipe->getCommands();
        if (empty($commands)) {
            throw new Command\Exception\EmptyCommandException("There are no commands available");
        }

        return implode("\n", $commands)."\n";
    }

}
