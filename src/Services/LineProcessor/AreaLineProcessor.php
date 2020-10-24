<?php

declare(strict_types=1);

namespace MarsRover\Services\LineProcessor;

use MarsRover\Dto\LineStateDto;
use MarsRover\Entity\Area;
use MarsRover\Enum\LineSignificance;
use MarsRover\Services\LineParser\AreaLineParser;

/**
 * Class AreaLineProcessor
 */
final class AreaLineProcessor implements LineProcessorInterface
{
    /**
     * @var AreaLineParser
     */
    private $lineParser;

    /**
     * AreaLineProcessor constructor.
     *
     * @param AreaLineParser $lineParser
     */
    public function __construct(AreaLineParser $lineParser)
    {
        $this->lineParser = $lineParser;
    }

    /**
     * @return string
     */
    public function getMaintainedRow(): string
    {
        return LineSignificance::AREA;
    }

    /**
     * @param LineStateDto $stateDto
     *
     * @return void
     */
    public function process(LineStateDto $stateDto): void
    {
        $stateDto->area = new Area(...$this->lineParser->parse($stateDto->line));
    }
}
