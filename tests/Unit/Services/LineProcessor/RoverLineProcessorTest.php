<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\LineProcessor;

use LogicException;
use MarsRover\Dto\LineStateDto;
use MarsRover\Entity\Area;
use MarsRover\Entity\Rover;
use MarsRover\Exception\OutOfAreaException;
use MarsRover\Services\LineParser\RoverLineParser;
use MarsRover\Services\LineProcessor\RoverLineProcessor;
use PHPUnit\Framework\TestCase;

/**
 * Class RoverLineProcessorTest
 */
final class RoverLineProcessorTest extends TestCase
{
    /**
     * @var RoverLineProcessor
     */
    private $processor;

    /**
     * @return void
     */
    public function testRoverCreation(): void
    {
        $dto = $this->createLineStateDto('0 0 N', new Area(0, 0));
        $this->processor->process($dto);

        self::assertInstanceOf(Rover::class, $dto->rover);
    }

    /**
     * @return void
     */
    public function testExceptionWithoutArea(): void
    {
        $this->expectException(LogicException::class);

        $dto = $this->createLineStateDto('0 0 N');
        $this->processor->process($dto);
    }

    /**
     * @dataProvider getDataForOutOfAreaTest
     *
     * @param string $line
     * @param Area   $area
     *
     * @return void
     */
    public function testExceptionOutOfArea(string $line, Area $area): void
    {
        $this->expectException(OutOfAreaException::class);

        $dto = $this->createLineStateDto($line, $area);
        $this->processor->process($dto);
    }

    /**
     * @return iterable
     */
    public function getDataForOutOfAreaTest(): iterable
    {
        yield ['0 2 N', new Area(1, 1)];
        yield ['2 0 N', new Area(1, 1)];
    }

    /**
     * @param string    $line
     * @param Area|null $area
     *
     * @return LineStateDto
     */
    private function createLineStateDto(string $line, Area $area = null): LineStateDto
    {
        $dto = new LineStateDto();
        $dto->line = $line;
        $dto->area = $area;

        return $dto;
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->processor = new RoverLineProcessor(new RoverLineParser());
    }
}
