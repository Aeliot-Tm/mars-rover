<?php

declare(strict_types=1);

namespace MarsRover\Services;

use LogicException;
use MarsRover\Entity\Area;
use MarsRover\Entity\Position;
use MarsRover\Entity\Rover;
use MarsRover\Enum\LineSignificance;
use MarsRover\Exception\OutOfAreaException;
use MarsRover\Exception\UndefinedLineSignificance;
use MarsRover\Input\LinesReaderInterface;
use MarsRover\Output\OutputInterface;
use MarsRover\Services\Movers\MoverInterface;
use function explode;
use function sprintf;
use function str_split;

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
     * @var MoverInterface
     */
    private $mover;

    /**
     * RoverWalker constructor.
     *
     * @param LinesReaderInterface $linesReader
     * @param MoverInterface       $mover
     */
    public function __construct(LinesReaderInterface $linesReader, MoverInterface $mover)
    {
        $this->linesReader = $linesReader;
        $this->mover = $mover;
    }

    /**
     * @param OutputInterface $output
     *
     * @return void
     */
    public function run(OutputInterface $output): void
    {
        $area = null;
        $rover = null;
        $lineNumber = 0;
        foreach ($this->linesReader->getLines() as $line) {
            switch ($lineSignificance = $this->getLineSignificance($lineNumber++)) {
                case LineSignificance::AREA:
                    $area = $this->createArea($line);
                    break;
                case LineSignificance::ROVER:
                    $rover = $this->createRover($area, $line);
                    break;
                case LineSignificance::MOVEMENT:
                    $output->writeLine((string) $this->getNewPosition($rover, $this->getInstructions($line)));
                    break;
                default:
                    throw new UndefinedLineSignificance('Invalid line significance: "%s"', $lineSignificance);
            }
        }
    }

    /**
     * @param string $line
     *
     * @return Area
     */
    private function createArea(string $line): Area
    {
        [$x, $y] = explode(' ', $line);

        return new Area((int) $x, (int) $y);
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

    /**
     * @param Area|null $area
     * @param string    $line
     *
     * @return Rover
     */
    private function createRover(?Area $area, string $line): Rover
    {
        if (null === $area) {
            throw new LogicException('Undefined Area');
        }

        [$x, $y, $orientation] = explode(' ', $line);

        $position = new Position((int) $x, (int) $y, $orientation);
        if (!$area->isInBounds($position->getX(), $position->getY())) {
            throw new OutOfAreaException(sprintf('Position "%s" out of area "%s"', (string) $position, (string) $area));
        }

        return new Rover($area, $position);
    }

    /**
     * @param Rover|null $rover
     * @param iterable   $instructions
     *
     * @return Position
     */
    private function getNewPosition(?Rover $rover, iterable $instructions): Position
    {
        if (null === $rover) {
            throw new LogicException('Undefined Rover');
        }

        foreach ($instructions as $instruction) {
            $rover->move($instruction, $this->mover);
        }

        return $rover->getPosition();
    }

    /**
     * @param string $line
     *
     * @return iterable
     */
    private function getInstructions(string $line): iterable
    {
        return str_split($line, 1);
    }
}
