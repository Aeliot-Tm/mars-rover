<?php

declare(strict_types=1);

namespace MarsRover\Entity;

use function sprintf;

/**
 * Class Position
 */
final class Position
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var string
     */
    private $orientation;

    /**
     * Position constructor.
     *
     * @param int    $x
     * @param int    $y
     * @param string $orientation
     */
    public function __construct(int $x, int $y, string $orientation)
    {
        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%d %d %s', $this->x, $this->y, $this->orientation);
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
     * @return string
     */
    public function getOrientation(): string
    {
        return $this->orientation;
    }

    /**
     * @param string $orientation
     */
    public function setOrientation(string $orientation): void
    {
        $this->orientation = $orientation;
    }
}
