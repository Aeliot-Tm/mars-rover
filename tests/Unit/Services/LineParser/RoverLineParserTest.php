<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\LineParser;

use MarsRover\Exception\InvalidRowFormatException;
use MarsRover\Services\LineParser\RoverLineParser;
use PHPUnit\Framework\TestCase;

/**
 * Class RoverLineParserTest
 */
final class RoverLineParserTest extends TestCase
{
    /**
     * @var RoverLineParser
     */
    private $lineParser;

    /**
     * @dataProvider getDataForParseTest
     *
     * @param array  $expected
     * @param string $line
     *
     * @return void
     */
    public function testParse(array $expected, string $line): void
    {
        self::assertEquals($expected, $this->lineParser->parse($line));
    }

    /**
     * @dataProvider getDataForInvalidLineTest
     *
     * @param string $line
     *
     * @return void
     */
    public function testInvalidLine(string $line): void
    {
        $this->expectException(InvalidRowFormatException::class);
        $this->lineParser->parse($line);
    }

    /**
     * @return iterable
     */
    public function getDataForParseTest(): iterable
    {
        yield [[0, 0, 'N'], '0 0 N'];
        yield [[5, 5, 'N'], '5 5 N'];
        yield [[5, 12, 'N'], '5 12 N'];
        yield [[25, 12, 'N'], '25 12 N'];
        yield [[1, 1, 'E'], '1 1 E'];
        yield [[1, 1, 'S'], '1 1 S'];
        yield [[1, 1, 'W'], '1 1 W'];
    }

    /**
     * @return iterable
     */
    public function getDataForInvalidLineTest(): iterable
    {
        yield [''];
        yield [' 1 1 N'];
        yield ['1 1 N '];
        yield ['1  1 N'];
        yield ['1 1  N'];
        yield ['* 1 N'];
        yield ['1 * N'];
        yield ['1 1 *'];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->lineParser = new RoverLineParser();
    }
}
