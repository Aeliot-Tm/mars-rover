<?php

declare(strict_types=1);

namespace MarsRover\Entity;

use MarsRover\Services\Movers\MoverInterface;

/**
 * Class Rover
 */
final class Rover
{
    /**
     * @var Area
     */
    private $area;

    /**
     * @var Position
     */
    private $position;

    /**
     * Rover constructor.
     *
     * @param Area     $area
     * @param Position $position
     */
    public function __construct(Area $area, Position $position)
    {
        $this->area = $area;
        $this->position = $position;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @param string         $instruction
     * @param MoverInterface $mover
     *
     * @return void
     */
    public function move(string $instruction, MoverInterface $mover): void
    {
        $mover->move($instruction, $this->position, $this->area);
    }
}
