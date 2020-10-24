<?php

declare(strict_types=1);

namespace MarsRover\Dto;

use MarsRover\Entity\Area;
use MarsRover\Entity\Rover;

/**
 * Class LineStateDto
 */
final class LineStateDto
{
    /**
     * @var Area|null
     */
    public $area;

    /**
     * @var string
     */
    public $line;

    /**
     * @var Rover|null
     */
    public $rover;
}
