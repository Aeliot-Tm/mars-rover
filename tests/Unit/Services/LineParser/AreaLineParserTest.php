<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\LineParser;

use MarsRover\Exception\InvalidRowFormatException;
use MarsRover\Services\LineParser\AreaLineParser;
use PHPUnit\Framework\TestCase;

/**
 * Class AreaLineParserTest
 */
final class AreaLineParserTest extends TestCase
{
    /**
     * @var AreaLineParser
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
        yield [[0, 0], '0 0'];
        yield [[5, 5], '5 5'];
        yield [[5, 12], '5 12'];
        yield [[25, 12], '25 12'];
    }

    /**
     * @return iterable
     */
    public function getDataForInvalidLineTest(): iterable
    {
        yield [''];
        yield [' 1 1'];
        yield ['1 1 '];
        yield ['1  1'];
        yield ['1'];
        yield [' 1'];
        yield ['1 '];
        yield [' 1 '];
        yield ['* 1'];
        yield ['1 *'];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->lineParser = new AreaLineParser();
    }
}
