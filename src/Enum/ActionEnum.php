<?php

declare(strict_types=1);

namespace MarsRover\Enum;

/**
 * Class ActionEnum
 */
final class ActionEnum
{
    public const MOVE = 'M';
    public const ROTATE_TO_LEFT = 'L';
    public const ROTATE_TO_RIGHT = 'R';

    /**
     * @return string[]
     */
    public static function getRotations(): array
    {
        return [self::ROTATE_TO_LEFT, self::ROTATE_TO_RIGHT];
    }

    /**
     * ActionEnum constructor.
     */
    private function __construct()
    {
        //NOTE: forbid creation of objects
    }
}
