<?php

declare(strict_types=1);

namespace MarsRover\Services\Movers;

use MarsRover\Entity\Area;
use MarsRover\Entity\Position;

/**
 * Class AwareMover
 */
final class AwareMover implements MoverInterface
{
    /**
     * @var MoverInterface[]
     */
    private $movers;

    /**
     * AwareMover constructor.
     *
     * @param MoverInterface ...$movers
     */
    public function __construct(MoverInterface ...$movers)
    {
        $this->movers = $movers;
    }

    /**
     * @param string   $action
     * @param Position $position
     * @param Area     $area
     *
     * @return void
     */
    public function move(string $action, Position $position, Area $area): void
    {
        foreach ($this->movers as $mover) {
            $mover->move($action, $position, $area);
        }
    }
}
