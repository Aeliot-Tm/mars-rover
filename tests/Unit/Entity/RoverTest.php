<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Entity;

use MarsRover\Entity\Area;
use MarsRover\Entity\Position;
use MarsRover\Entity\Rover;
use MarsRover\Services\Movers\MoverInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class RoverTest
 */
final class RoverTest extends TestCase
{
    /**
     * @return void
     */
    public function testMoveCall(): void
    {
        $rover = new Rover($area = new Area(0, 0), $position = new Position(0, 0, 'N'));
        /** @var ObjectProphecy|MoverInterface $moverProphecy */
        $moverProphecy = $this->prophesize(MoverInterface::class);
        /** @var MethodProphecy $methodProphecy */
        $methodProphecy = $moverProphecy->move('L', $position, $area);
        $methodProphecy->shouldBeCalledTimes(1);
        /** @var MoverInterface $mover */
        $mover = $moverProphecy->reveal();
        $rover->move('L', $mover);
    }
}
