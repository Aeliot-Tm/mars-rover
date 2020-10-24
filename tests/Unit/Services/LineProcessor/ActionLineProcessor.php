<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\LineProcessor;

use MarsRover\Dto\LineStateDto;
use MarsRover\Entity\Rover;
use MarsRover\Services\LineParser\ActionsLineParser;
use MarsRover\Services\LineProcessor\ActionsLineProcessor;
use MarsRover\Services\Movers\MoverInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use function str_repeat;

/**
 * Class ActionLineProcessor
 */
final class ActionLineProcessor extends TestCase
{
    /**
     * @dataProvider getDataForActionApplyingCountTest
     *
     * @param int $count
     *
     * @return void
     */
    public function testActionApplyingCount(int $count): void
    {
        /** @var MoverInterface $mover */
        $mover = $this->createMock(MoverInterface::class);
        $processor = new ActionsLineProcessor(new ActionsLineParser(), $mover);

        $dto = new LineStateDto();
        $dto->line = str_repeat('L', $count);

        /** @var ObjectProphecy|Rover $rover */
        $rover = $this->prophesize(Rover::class);
        /** @var MethodProphecy $methodProphecy */
        $methodProphecy = $rover->move('L', $mover);
        $methodProphecy->shouldBeCalledTimes($count);
        $dto->rover = $rover->reveal();

        $processor->process($dto);
    }

    /**
     * @return iterable
     */
    public function getDataForActionApplyingCountTest(): iterable
    {
        yield [1];
        yield [5];
    }
}
