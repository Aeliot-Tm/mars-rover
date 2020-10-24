<?php

declare(strict_types=1);

namespace MarsRover\Services\LineProcessor;

use LogicException;
use MarsRover\Dto\LineStateDto;
use MarsRover\Enum\LineSignificance;
use MarsRover\Services\LineParser\ActionsLineParser;
use MarsRover\Services\Movers\MoverInterface;

/**
 * Class ActionsLineProcessor
 */
final class ActionsLineProcessor implements LineProcessorInterface
{
    /**
     * @var ActionsLineParser
     */
    private $lineParser;

    /**
     * @var MoverInterface
     */
    private $mover;

    /**
     * ActionsLineProcessor constructor.
     *
     * @param ActionsLineParser $lineParser
     * @param MoverInterface    $mover
     */
    public function __construct(ActionsLineParser $lineParser, MoverInterface $mover)
    {
        $this->lineParser = $lineParser;
        $this->mover = $mover;
    }

    /**
     * @return string
     */
    public function getMaintainedRow(): string
    {
        return LineSignificance::MOVEMENT;
    }

    /**
     * @param LineStateDto $stateDto
     *
     * @return void
     */
    public function process(LineStateDto $stateDto): void
    {
        if (null === ($rover = $stateDto->rover)) {
            throw new LogicException('Undefined Rover');
        }

        foreach ($this->lineParser->parse($stateDto->line) as $action) {
            $rover->move($action, $this->mover);
        }
    }
}
