<?php

declare(strict_types=1);

namespace MarsRover\Services\LineProcessor;

use MarsRover\Dto\LineStateDto;

/**
 * Interface LineProcessorInterface
 */
interface LineProcessorInterface
{
    /**
     * @return string
     */
    public function getMaintainedRow(): string;

    /**
     * @param LineStateDto $stateDto
     *
     * @return void
     */
    public function process(LineStateDto $stateDto): void;
}
