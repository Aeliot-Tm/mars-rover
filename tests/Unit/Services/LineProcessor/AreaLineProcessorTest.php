<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\LineProcessor;

use MarsRover\Dto\LineStateDto;
use MarsRover\Entity\Area;
use MarsRover\Services\LineParser\AreaLineParser;
use MarsRover\Services\LineProcessor\AreaLineProcessor;
use PHPUnit\Framework\TestCase;

/**
 * Class AreaLineProcessorTest
 */
final class AreaLineProcessorTest extends TestCase
{
    /**
     * @var AreaLineProcessor
     */
    private $processor;

    /**
     * @return void
     */
    public function testAreasCreation(): void
    {
        $dto = new LineStateDto();
        $dto->line = '1 1';
        $this->processor->process($dto);

        self::assertInstanceOf(Area::class, $dto->area);
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->processor = new AreaLineProcessor(new AreaLineParser());
    }
}
