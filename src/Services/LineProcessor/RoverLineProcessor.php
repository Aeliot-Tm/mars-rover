<?php

declare(strict_types=1);

namespace MarsRover\Services\LineProcessor;

use LogicException;
use MarsRover\Dto\LineStateDto;
use MarsRover\Entity\Position;
use MarsRover\Entity\Rover;
use MarsRover\Enum\LineSignificance;
use MarsRover\Exception\OutOfAreaException;
use MarsRover\Services\LineParser\RoverLineParser;
use function sprintf;

/**
 * Class RoverLineProcessor
 */
final class RoverLineProcessor implements LineProcessorInterface
{
    /**
     * @var RoverLineParser
     */
    private $lineParser;

    /**
     * RoverLineProcessor constructor.
     *
     * @param RoverLineParser $lineParser
     */
    public function __construct(RoverLineParser $lineParser)
    {
        $this->lineParser = $lineParser;
    }

    /**
     * @return string
     */
    public function getMaintainedRow(): string
    {
        return LineSignificance::ROVER;
    }

    /**
     * @param LineStateDto $stateDto
     *
     * @return void
     */
    public function process(LineStateDto $stateDto): void
    {
        if (null === ($area = $stateDto->area)) {
            throw new LogicException('Undefined Area');
        }

        [$x, $y, $orientation] = $this->lineParser->parse($stateDto->line);

        $position = new Position((int) $x, (int) $y, $orientation);
        if (!$area->isInBounds($position->getX(), $position->getY())) {
            throw new OutOfAreaException(sprintf('Position "%s" out of area "%s"', (string) $position, (string) $area));
        }

        $stateDto->rover = new Rover($area, $position);
    }
}
