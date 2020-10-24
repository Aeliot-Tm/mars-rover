<?php

declare(strict_types=1);

namespace MarsRover\Enum;

/**
 * Class OrientationEnum
 */
final class OrientationEnum
{
    public const EAST = 'E';
    public const NORTH = 'N';
    public const SOUTH = 'S';
    public const WEST = 'W';

    /**
     * OrientationEnum constructor.
     */
    private function __construct()
    {
        //NOTE: forbid creation of objects
    }
}
