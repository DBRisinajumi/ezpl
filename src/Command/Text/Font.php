<?php

namespace Dbr\Ezpl\Command\Text;

use Dbr\Ezpl\Command\AbstractableCommand;

class Font extends AbstractableCommand
{
    use SizeTrait;

    protected $code ='A';

    /** @var string */
    protected $font = 'C'; //size 10

    /** @var int */
    protected $horizontal = 0;

    /** @var int */
    protected $vertical = 0;

    /** @var int */
    protected $magnifyHorizontal = 0;

    /** @var int */
    protected $magnifyVertical = 0;

    /** @var int */
    protected $gap = 0;

    /** @var int */
    protected $rotation = 0;

    protected $value;

    public function __construct($size, $horizontal, $vertical, $magnifyHorizontal, $magnifyVertical, $gap, $rotation, $value)
    {
        if ($this->isInteger($size)) {
            $this->font = $this->convert($size);
        }

        if ($this->isInteger($horizontal)) {
            $this->horizontal = $horizontal;
        }

        if ($this->isInteger($vertical)) {
            $this->vertical = $vertical;
        }

        if ($this->isInteger($magnifyHorizontal)) {
            $this->magnifyHorizontal = $magnifyHorizontal;
        }

        if ($this->isInteger($magnifyVertical)) {
            $this->magnifyVertical = $magnifyVertical;
        }

        if ($this->isInteger($gap)) {
            $this->gap = $gap;
        }

        if ($this->isInteger($rotation)) {
            $this->rotation = $rotation;
        }

        $this->value = $value;
    }

    public function getFont(): string
    {
        return $this->font;
    }

    public function getHorizontal(): int
    {
        return $this->horizontal;
    }

    public function getVertical(): int
    {
        return $this->vertical;
    }

    public function getMagnifyHorizontal(): int
    {
        return $this->magnifyHorizontal;
    }

    public function getMagnifyVertical(): int
    {
        return $this->magnifyVertical;
    }

    public function getGap(): int
    {
        return $this->gap;
    }

    public function getRotation(): int
    {
        return $this->rotation;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function toCommand(): string
    {
        $commands = [
            $this->getCode().$this->getFont(),
            $this->getHorizontal(),
            $this->getVertical(),
            $this->getMagnifyHorizontal(),
            $this->getMagnifyVertical(),
            $this->getGap(),
            $this->getRotation(),
            $this->getValue()
        ];

        return implode(',', $commands);
    }
}
