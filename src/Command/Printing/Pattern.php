<?php

namespace Dbr\Ezpl\Command\Printing;

use Dbr\Ezpl\Command\AbstractableCommand;

class Pattern extends AbstractableCommand
{
    protected $code = 'Q';

    /**
     * @var int
     */
    protected $x = 0;

    /**
     * @var int
     */
    protected $y = 0;

    /**
     * @var int
     */
    protected $width = 0;

    /**
     * @var int
     */
    protected $height = 0;

    /**
     * @var string[]
     */
    protected $data = [];

    /**
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @param array $data
     */
    public function __construct(int $x, int $y = 0, int $width = 0, int $height = 0, array $data = [])
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param mixed|null $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }


    /**
     * Wx,y,mode,type,ec,mask,mul,len,roatae<CR>data
     * @return string
     */
    public function toCommand(): string
    {
        $commands = [
            $this->getCode() .
            $this->getX(),
            $this->getY(),
            $this->getWidth(),
            $this->getHeight()
        ];
        $command = implode(',', $commands);
        if ($data = $this->getData()) {
            $command .= "\r" . implode(' ', $data);
        }

        return $command;
    }

//    public function toCommand()
//    {
//        //$command = $this->getSetupPrefix().$this->getCode().$this->getHeight();
//        $command = $this->getCode().$this->getHeight();
//
//        if (! is_null($this->getSpacing())) {
//            return $command.','.$this->getSpacing();
//        }
//
//        return $command;
//    }
}
