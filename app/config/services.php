<?php

declare(strict_types=1);

use MarsRover\Input\StdInputReader;
use MarsRover\Services\Movers\AwareMover;
use MarsRover\Services\Movers\PositionMover;
use MarsRover\Services\Movers\Rotator;
use MarsRover\Services\RoverWalker;

return [
    RoverWalker::class => [StdInputReader::class, AwareMover::class],
    AwareMover::class => [Rotator::class, PositionMover::class],
];
