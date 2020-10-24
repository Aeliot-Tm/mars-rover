<?php

declare(strict_types=1);

namespace MarsRover\Entity;

use function sprintf;

/**
 * Class Area
 */
final class Area
{
    /**
     * @var int
     */
    private $top;

    /**
     * @var int
     */
    private $right;

    /**
     * @var int
     */
    private $left;

    /**
     * @var int
     */
    private $bottom;

    /**
     * Area constructor.
     *
     * @param int $right
     * @param int $top
     * @param int $left
     * @param int $bottom
     */
    public function __construct(int $right, int $top, int $left = 0, int $bottom = 0)
    {
        $this->right = $right;
        $this->top = $top;
        $this->left = $left;
        $this->bottom = $bottom;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('%d %d, %d %d', $this->left, $this->bottom, $this->right, $this->top);
    }

    /**
     * @param int $x
     * @param int $y
     *
     * @return bool
     */
    public function isInBounds(int $x, int $y): bool
    {
        return ($x >= $this->left) && ($x <= $this->right) && ($y >= $this->bottom) && ($y <= $this->top);
    }
}
