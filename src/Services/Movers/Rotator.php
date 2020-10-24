<?php

declare(strict_types=1);

namespace MarsRover\Services\Movers;

use InvalidArgumentException;
use LogicException;
use MarsRover\Entity\Area;
use MarsRover\Entity\Position;
use MarsRover\Enum\ActionEnum;
use MarsRover\Enum\OrientationEnum;
use function array_key_exists;
use function in_array;
use function sprintf;

/**
 * Class Rotator
 */
final class Rotator implements MoverInterface
{
    private const ROTATION_MAPS = [
        ActionEnum::ROTATE_TO_LEFT => [
            OrientationEnum::NORTH => OrientationEnum::WEST,
            OrientationEnum::WEST => OrientationEnum::SOUTH,
            OrientationEnum::SOUTH => OrientationEnum::EAST,
            OrientationEnum::EAST => OrientationEnum::NORTH,
        ],
        ActionEnum::ROTATE_TO_RIGHT => [
            OrientationEnum::NORTH => OrientationEnum::EAST,
            OrientationEnum::EAST => OrientationEnum::SOUTH,
            OrientationEnum::SOUTH => OrientationEnum::WEST,
            OrientationEnum::WEST => OrientationEnum::NORTH,
        ],
    ];

    /**
     * @param string   $action
     * @param Position $position
     * @param Area     $area
     *
     * @return void
     */
    public function move(string $action, Position $position, Area $area): void
    {
        if (!$this->isRotation($action)) {
            return;
        }

        $position->setOrientation($this->getNewOrientation($action, $position->getOrientation()));
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    private function isRotation(string $action): bool
    {
        return in_array($action, ActionEnum::getRotations(), true);
    }

    /**
     * @param string $action
     * @param string $orientation
     *
     * @return string
     */
    private function getNewOrientation(string $action, string $orientation): string
    {
        $map = $this->getRotationMap($action);
        if (!array_key_exists($orientation, $map)) {
            throw new LogicException(sprintf('Not configured rotation of position: "%s"', $orientation));
        }

        return $map[$orientation];
    }

    /**
     * @param string $action
     *
     * @return string[]
     */
    private function getRotationMap(string $action): array
    {
        if (!array_key_exists($action, self::ROTATION_MAPS)) {
            throw new InvalidArgumentException(sprintf('Invalid rotation action: "%s"', $action));
        }

        return self::ROTATION_MAPS[$action];
    }
}
