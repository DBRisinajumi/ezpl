<?php

namespace Dbr\Ezpl\Command\Draw;

use Dbr\Ezpl\Command\AbstractableCommand;

class Rectangle extends AbstractableCommand
{
    /** @var int */
    protected $horizontal = 0;

    /** @var int */
    protected $vertical = 0;

    /** @var int */
    protected $horizontal1 = 100;

    /** @var int */
    protected $vertical1 = 100;

    /** @var int */
    protected $thicknessLeftRightBorder = 2;

    /** @var int */
    protected $thicknessUpperBottomBorder = 2;

    /**
     * @return int
     */
    public function getHorizontal(): int
    {
        return $this->horizontal;
    }

    /**
     * @param int $horizontal
     */
    public function setHorizontal(int $horizontal): void
    {
        $this->horizontal = $horizontal;
    }

    /**
     * @return int
     */
    public function getVertical(): int
    {
        return $this->vertical;
    }

    /**
     * @param int $vertical
     */
    public function setVertical(int $vertical): void
    {
        $this->vertical = $vertical;
    }

    /**
     * @return int
     */
    public function getHorizontal1(): int
    {
        return $this->horizontal1;
    }

    /**
     * @param int $horizontal1
     */
    public function setHorizontal1(int $horizontal1): void
    {
        $this->horizontal1 = $horizontal1;
    }

    /**
     * @return int
     */
    public function getVertical1(): int
    {
        return $this->vertical1;
    }

    /**
     * @param int $vertical1
     */
    public function setVertical1(int $vertical1): void
    {
        $this->vertical1 = $vertical1;
    }

    /**
     * @return int
     */
    public function getThicknessLeftRightBorder(): int
    {
        return $this->thicknessLeftRightBorder;
    }

    /**
     * @param int $thicknessLeftRightBorder
     */
    public function setThicknessLeftRightBorder(int $thicknessLeftRightBorder): void
    {
        $this->thicknessLeftRightBorder = $thicknessLeftRightBorder;
    }

    /**
     * @return int
     */
    public function getThicknessUpperBottomBorder(): int
    {
        return $this->thicknessUpperBottomBorder;
    }

    /**
     * @param int $thicknessUpperBottomBorder
     */
    public function setThicknessUpperBottomBorder(int $thicknessUpperBottomBorder): void
    {
        $this->thicknessUpperBottomBorder = $thicknessUpperBottomBorder;
    }

    /**
     * @param int $horizontal
     * @param int $vertical
     * @param int $horizontal1
     * @param int $vertical1
     * @param int $thicknessLeftRightBorder
     * @param int $thicknessUpperBottomBorder
     */
    public function __construct(
        int $horizontal,
        int $vertical,
        int $horizontal1,
        int $vertical1,
        int $thicknessLeftRightBorder = 2,
        int $thicknessUpperBottomBorder = 2
    ) {
        $this->code = 'R';
        $this->horizontal = $horizontal;
        $this->vertical = $vertical;
        $this->horizontal1 = $horizontal1;
        $this->vertical1 = $vertical1;
        $this->thicknessLeftRightBorder = $thicknessLeftRightBorder;
        $this->thicknessUpperBottomBorder = $thicknessUpperBottomBorder;
    }

    public function toCommand(): string
    {
        $commands = [
            $this->getCode() . $this->getHorizontal(),
            $this->getVertical(),
            $this->getHorizontal1(),
            $this->getVertical1(),
            $this->getThicknessLeftRightBorder(),
            $this->getThicknessUpperBottomBorder()
        ];

        return implode(',', $commands);
    }
}
