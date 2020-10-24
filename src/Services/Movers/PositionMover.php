<?php

declare(strict_types=1);

namespace MarsRover\Services\Movers;

use MarsRover\Entity\Area;
use MarsRover\Entity\Position;
use MarsRover\Enum\ActionEnum;
use MarsRover\Enum\OrientationEnum;
use MarsRover\Exception\OutOfAreaException;
use OutOfRangeException;
use function sprintf;

/**
 * Class PositionMover
 */
final class PositionMover implements MoverInterface
{
    /**
     * @param string   $action
     * @param Position $position
     * @param Area     $area
     *
     * @return void
     */
    public function move(string $action, Position $position, Area $area): void
    {
        if (!$this->isMoving($action)) {
            return;
        }

        [$x, $y] = $this->newPosition($position);
        if (!$area->isInBounds($x, $y)) {
            throw new OutOfAreaException(sprintf('Position "%d %d" out of area "%s"', $x, $y, (string) $area));
        }

        $position->setX($x);
        $position->setY($y);
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    private function isMoving(string $action): bool
    {
        return ActionEnum::MOVE === $action;
    }

    /**
     * @param Position $position
     *
     * @return array
     */
    private function newPosition(Position $position): array
    {
        $x = $position->getX();
        $y = $position->getY();
        switch ($orientation = $position->getOrientation()) {
            case OrientationEnum::NORTH:
                $y++;
                break;
            case OrientationEnum::EAST:
                $x++;
                break;
            case OrientationEnum::SOUTH:
                $y--;
                break;
            case OrientationEnum::WEST:
                $x--;
                break;
            default:
                throw new OutOfRangeException(sprintf('Invalid orientation: "%s"', $orientation));
        }

        return [$x, $y];
    }
}
