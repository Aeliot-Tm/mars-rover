<?php

declare(strict_types=1);

use MarsRover\Input\StdInputReader;
use MarsRover\Services\LineParser\ActionsLineParser;
use MarsRover\Services\LineParser\AreaLineParser;
use MarsRover\Services\LineParser\RoverLineParser;
use MarsRover\Services\LineProcessor\ActionsLineProcessor;
use MarsRover\Services\LineProcessor\AreaLineProcessor;
use MarsRover\Services\LineProcessor\RoverLineProcessor;
use MarsRover\Services\LineProcessorRegistry;
use MarsRover\Services\Movers\AwareMover;
use MarsRover\Services\Movers\PositionMover;
use MarsRover\Services\Movers\Rotator;
use MarsRover\Services\RoverWalker;

return [
    ActionsLineProcessor::class => [ActionsLineParser::class, AwareMover::class],
    AreaLineProcessor::class => [AreaLineParser::class],
    AwareMover::class => [Rotator::class, PositionMover::class],
    LineProcessorRegistry::class => [ActionsLineProcessor::class, AreaLineProcessor::class, RoverLineProcessor::class],
    RoverLineProcessor::class => [RoverLineParser::class],
    RoverWalker::class => [StdInputReader::class, LineProcessorRegistry::class],
];
