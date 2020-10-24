<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\Movers;

use MarsRover\Entity\Area;
use MarsRover\Entity\Position;
use MarsRover\Exception\OutOfAreaException;
use MarsRover\Services\Movers\PositionMover;
use PHPUnit\Framework\TestCase;

/**
 * Class PositionMoverTest
 */
final class PositionMoverTest extends TestCase
{
    /**
     * @var PositionMover
     */
    private $mover;

    /**
     * @dataProvider getDataForMovingInBound
     *
     * @param array    $expectedPosition
     * @param string   $action
     * @param Position $position
     * @param Area     $area
     *
     * @return void
     */
    public function testMovingInBounds(array $expectedPosition, string $action, Position $position, Area $area): void
    {
        $this->mover->move($action, $position, $area);
        self::assertEquals($expectedPosition, [$position->getX(), $position->getY()]);
    }

    /**
     * @dataProvider getDataForMovingOutBound
     *
     * @param Position $position
     * @param Area     $area
     *
     * @return void
     */
    public function testMovingOutBounds(Position $position, Area $area): void
    {
        $this->expectException(OutOfAreaException::class);
        $this->mover->move('M', $position, $area);
        $this->mover->move('M', $position, $area);
    }

    /**
     * @return iterable
     */
    public function getDataForMovingInBound(): iterable
    {
        //normal moving
        yield [[1, 2], 'M', new Position(1, 1, 'N'), new Area(2, 2)];
        yield [[2, 1], 'M', new Position(1, 1, 'E'), new Area(2, 2)];
        yield [[1, 0], 'M', new Position(1, 1, 'S'), new Area(2, 2)];
        yield [[0, 1], 'M', new Position(1, 1, 'W'), new Area(2, 2)];
        //not moving
        yield [[1, 1], 'any_not_moving_action', new Position(1, 1, 'W'), new Area(2, 2)];
        yield [[1, 1], 'L', new Position(1, 1, 'W'), new Area(2, 2)];
        yield [[1, 1], 'R', new Position(1, 1, 'W'), new Area(2, 2)];
    }

    /**
     * @return iterable
     */
    public function getDataForMovingOutBound(): iterable
    {
        yield [new Position(1, 1, 'N'), new Area(2, 2)];
        yield [new Position(1, 1, 'E'), new Area(2, 2)];
        yield [new Position(1, 1, 'S'), new Area(2, 2)];
        yield [new Position(1, 1, 'W'), new Area(2, 2)];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->mover = new PositionMover();
    }
}
