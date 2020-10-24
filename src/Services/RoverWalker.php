<?php

declare(strict_types=1);

namespace MarsRover\Services;

use MarsRover\Dto\LineStateDto;
use MarsRover\Enum\LineSignificance;
use MarsRover\Input\LinesReaderInterface;
use MarsRover\Output\OutputInterface;

/**
 * Class RoverWalker
 */
final class RoverWalker
{
    /**
     * @var LinesReaderInterface
     */
    private $linesReader;

    /**
     * @var LineProcessorRegistry
     */
    private $lineProcessorRegistry;

    /**
     * RoverWalker constructor.
     *
     * @param LinesReaderInterface  $linesReader
     * @param LineProcessorRegistry $lineProcessorRegistry
     */
    public function __construct(LinesReaderInterface $linesReader, LineProcessorRegistry $lineProcessorRegistry)
    {
        $this->linesReader = $linesReader;
        $this->lineProcessorRegistry = $lineProcessorRegistry;
    }

    /**
     * @param OutputInterface $output
     *
     * @return void
     */
    public function run(OutputInterface $output): void
    {
        $lineNumber = 0;
        $stateDto = new LineStateDto();
        foreach ($this->linesReader->getLines() as $line) {
            $stateDto->line = $line;
            $lineSignificance = $this->getLineSignificance($lineNumber++);
            $processor = $this->lineProcessorRegistry->getProcessor($lineSignificance);
            $processor->process($stateDto);
            if (LineSignificance::MOVEMENT === $lineSignificance) {
                $output->writeLine((string) $stateDto->rover->getPosition());
            }
        }
    }

    /**
     * @param int $lineNumber
     *
     * @return string
     */
    private function getLineSignificance(int $lineNumber): string
    {
        if (0 === $lineNumber) {
            return LineSignificance::AREA;
        }

        return ($lineNumber % 2) ? LineSignificance::ROVER : LineSignificance::MOVEMENT;
    }
}
