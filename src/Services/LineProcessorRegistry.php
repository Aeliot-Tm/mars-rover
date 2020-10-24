<?php

declare(strict_types=1);

namespace MarsRover\Services;

use InvalidArgumentException;
use LogicException;
use MarsRover\Services\LineProcessor\LineProcessorInterface;
use function array_key_exists;

/**
 * Class LineProcessorRegistry
 */
final class LineProcessorRegistry
{
    /**
     * @var LineProcessorInterface[]
     */
    private $processors = [];

    /**
     * LineProcessorRegistry constructor.
     *
     * @param LineProcessorInterface[] $processors
     */
    public function __construct(LineProcessorInterface ...$processors)
    {
        foreach ($processors as $processor) {
            $key = $processor->getMaintainedRow();
            if (array_key_exists($key, $this->processors)) {
                throw new LogicException('Invalid processors configuration');
            }
            $this->processors[$key] = $processor;
        }
    }

    /**
     * @param string $rowKey
     *
     * @return LineProcessorInterface
     */
    public function getProcessor(string $rowKey): LineProcessorInterface
    {
        if (!array_key_exists($rowKey, $this->processors)) {
            throw new InvalidArgumentException(sprintf('Requested not registered processor for the row "%s"', $rowKey));
        }

        return $this->processors[$rowKey];
    }
}
