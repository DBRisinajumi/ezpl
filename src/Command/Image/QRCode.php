<?php

namespace Dbr\Ezpl\Command\Image;

use Dbr\Ezpl\Command\AbstractableCommand;

class QRCode extends AbstractableCommand
{
    public const INPUT_MODE_NUMERIC = 1;
    public const INPUT_MODE_ALPHA_NUMERIC = 2;
    public const INPUT_MODE_8_BIT = 3;
    public const INPUT_MODE_KANJI = 4;
    public const INPUT_MODE_MIXING = 4;

    public const TYPE_ORIGINAL = 1;
    public const TYPE_ENHANCED = 2;
    public const TYPE_MICRO = 3;

    public const ERROR_CORRECTION_LOW = 'L';
    public const ERROR_CORRECTION_MEDIUM = 'M';
    public const ERROR_CORRECTION_MEDIUM_HIGH = 'Q';
    public const ERROR_CORRECTION_HIGH = 'H';

    public const MASKING_0 = 0;
    public const MASKING_1 = 1;
    public const MASKING_2 = 2;
    public const MASKING_3 = 3;
    public const MASKING_4 = 4;
    public const MASKING_5 = 5;
    public const MASKING_6 = 6;
    public const MASKING_7 = 7;
    public const MASKING_AUTO = 8;

    public const ROTATE_0 = 0;
    public const ROTATE_90 = 1;
    public const ROTATE_180 = 2;
    public const ROTATE_270 = 3;

    /** @var int */
    private $horizontal = 0;

    /** @var int */
    private $vertical = 0;

    /** @var int */
    private $inputMode = self::INPUT_MODE_ALPHA_NUMERIC;

    /** @var int */
    private $type = self::TYPE_ORIGINAL;

    /** @var string */
    private $errorLevel = self::ERROR_CORRECTION_MEDIUM;

    /** @var int */
    private $multiple = 7;

    /** @var int */
    private $rotate = self::ROTATE_0;

    private $maskingFactor = self::MASKING_AUTO;

    /**
     * @var string
     */
    private $data;

    public function __construct(string $data)
    {
        $this->code = 'W';
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getRotate(): int
    {
        return $this->rotate;
    }

    /**
     * @param int $rotate
     * @return \Dbr\Ezpl\Command\Image\QRCode
     */
    public function setRotate(int $rotate): self
    {
        $this->rotate = $rotate;
        return $this;
    }

    /**
     * @return int
     */
    public function getMultiple(): int
    {
        return $this->multiple;
    }

    /**
     * @param int $multiple
     * @return \Dbr\Ezpl\Command\Image\QRCode
     */
    public function setMultiple(int $multiple): self
    {
        $this->multiple = $multiple;
        return $this;
    }

    /**
     * @return int
     */
    public function getHorizontal(): int
    {
        return $this->horizontal;
    }

    /**
     * @param int $horizontal
     * @return \Dbr\Ezpl\Command\Image\QRCode
     */
    public function setHorizontal(int $horizontal): self
    {
        $this->horizontal = $horizontal;
        return $this;
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
     * @return \Dbr\Ezpl\Command\Image\QRCode
     */
    public function setVertical(int $vertical): self
    {
        $this->vertical = $vertical;
        return $this;
    }

    /**
     * @return int
     */
    public function getInputMode(): int
    {
        return $this->inputMode;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getErrorLevel(): string
    {
        return $this->errorLevel;
    }

    /**
     * @return int
     */
    public function getMaskingFactor(): int
    {
        return $this->maskingFactor;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        if ($this->inputMode === self::INPUT_MODE_8_BIT) {
            /**
             * N O T   T E S T E D
             *
             * if input mode is set to 8-bit data mode, the first four digits of bar code data
             * must indicate the data length in bytes. For example, if first four digits
             * are 0015, that means the data length of following bar code content must be 15 bytes.
             *
             */
            return str_pad($this->getLength(), '0', 4, STR_PAD_LEFT) . $this->data;
        }
        return $this->data;
    }

    public function setInputMode(int $mode): self
    {
        $this->inputMode = $mode;
        return $this;
    }

    /**
     * @param int $type
     * @return \Dbr\Ezpl\Command\Image\QRCode
     */
    public function setType(int $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $errorLevel
     * @return \Dbr\Ezpl\Command\Image\QRCode
     */
    public function setErrorLevel(string $errorLevel): self
    {
        $this->errorLevel = $errorLevel;
        return $this;
    }

    /**
     * @param int $maskingFactor
     * @return \Dbr\Ezpl\Command\Image\QRCode
     */
    public function setMaskingFactor(int $maskingFactor): self
    {
        $this->maskingFactor = $maskingFactor;
        return $this;
    }

    /**
     * Wx,y,mode,type,ec,mask,mul,len,roatae<CR>data
     * @return string
     */
    public function toCommand(): string
    {
        $commands = [
            $this->getCode() .
            $this->getHorizontal(),
            $this->getVertical(),
            $this->getInputMode(),
            $this->getType(),
            $this->getErrorLevel(),
            $this->getMaskingFactor(),
            $this->getMultiple(),
            $this->getLength(),
            $this->getRotate()
        ];

        return implode(',', $commands) . "\r" . $this->getData();
    }

    private function getLength(): int
    {
        return strlen($this->data);
    }
}
