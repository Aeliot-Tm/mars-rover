<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\Movers;

use MarsRover\Entity\Area;
use MarsRover\Entity\Position;
use MarsRover\Services\Movers\Rotator;
use PHPUnit\Framework\TestCase;

/**
 * Class RotatorTest
 */
final class RotatorTest extends TestCase
{
    /**
     * @var Rotator
     */
    private $mover;

    /**
     * @dataProvider getDataForRotation
     *
     * @param string   $expectedOrientation
     * @param string   $action {@see \MarsRover\Enum\ActionEnum}
     * @param Position $position
     * @param Area     $area
     *
     * @return void
     */
    public function testRotation(string $expectedOrientation, string $action, Position $position, Area $area): void
    {
        $this->mover->move($action, $position, $area);
        self::assertEquals($expectedOrientation, $position->getOrientation());
    }

    /**
     * @return iterable
     */
    public function getDataForRotation(): iterable
    {
        //normal rotation
        yield ['W', 'L', new Position(0, 0, 'N'), new Area(0, 0)];
        yield ['E', 'R', new Position(0, 0, 'N'), new Area(0, 0)];

        yield ['N', 'L', new Position(0, 0, 'E'), new Area(0, 0)];
        yield ['S', 'R', new Position(0, 0, 'E'), new Area(0, 0)];

        yield ['E', 'L', new Position(0, 0, 'S'), new Area(0, 0)];
        yield ['W', 'R', new Position(0, 0, 'S'), new Area(0, 0)];

        yield ['S', 'L', new Position(0, 0, 'W'), new Area(0, 0)];
        yield ['N', 'R', new Position(0, 0, 'W'), new Area(0, 0)];

        //test not changed
        yield ['N', 'any_not_rotation_action', new Position(0, 0, 'N'), new Area(0, 0)];
        yield ['N', 'M', new Position(0, 0, 'N'), new Area(0, 0)];
        yield ['E', 'M', new Position(0, 0, 'E'), new Area(0, 0)];
        yield ['S', 'M', new Position(0, 0, 'S'), new Area(0, 0)];
        yield ['W', 'M', new Position(0, 0, 'W'), new Area(0, 0)];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->mover = new Rotator();
    }
}
