<?php

declare(strict_types=1);

namespace MarsRover\Services\Movers;

use MarsRover\Entity\Area;
use MarsRover\Entity\Position;

/**
 * Interface MoverInterface
 */
interface MoverInterface
{
    /**
     * @param string   $action
     * @param Position $position
     * @param Area     $area
     *
     * @return void
     */
    public function move(string $action, Position $position, Area $area): void;
}
