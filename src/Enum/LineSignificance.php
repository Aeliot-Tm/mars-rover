<?php

declare(strict_types=1);

namespace MarsRover\Enum;

/**
 * Class LineSignificance
 */
final class LineSignificance
{
    public const AREA = 'A';
    public const ROVER = 'R';
    public const MOVEMENT = 'M';

    /**
     * LineSignificance constructor.
     */
    private function __construct()
    {
        //NOTE: forbid creation of objects
    }
}
