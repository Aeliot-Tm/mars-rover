<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\Movers;

use MarsRover\Entity\Area;
use MarsRover\Entity\Position;
use MarsRover\Services\Movers\AwareMover;
use MarsRover\Services\Movers\MoverInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Class AwareMoverTest
 */
final class AwareMoverTest extends TestCase
{
    /**
     * @dataProvider getMoversCounts
     *
     * @param int $moversCount
     *
     * @return void
     */
    public function testInjectedMovers(int $moversCount): void
    {
        $area = new Area(0, 0);
        $position = new Position(0, 0, 'N');
        $movers = [];
        for ($i = 0; $i < $moversCount; $i++) {
            $movers[] = $this->createMoverProphesize($position, $area);
        }

        $awareMover = new AwareMover(...$movers);
        $awareMover->move('*', $position, $area);
    }

    /**
     * @param Position $position
     * @param Area     $area
     *
     * @return MoverInterface
     */
    private function createMoverProphesize(Position $position, Area $area): MoverInterface
    {
        /** @var ObjectProphecy|MoverInterface $moverProphecy */
        $moverProphecy = $this->prophesize(MoverInterface::class);
        /** @var MethodProphecy $methodProphecy */
        $methodProphecy = $moverProphecy->move('*', $position, $area);
        $methodProphecy->shouldBeCalledTimes(1);
        /** @var MoverInterface $mover */
        $mover = $moverProphecy->reveal();

        return $mover;
    }

    /**
     * @return int[][]
     */
    public function getMoversCounts(): array
    {
        return [[1], [2], [3], [4], [5]];
    }
}
