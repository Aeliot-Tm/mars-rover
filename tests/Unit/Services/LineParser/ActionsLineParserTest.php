<?php

declare(strict_types=1);

namespace MarsRover\Test\Unit\Services\LineParser;

use MarsRover\Exception\InvalidRowFormatException;
use MarsRover\Services\LineParser\ActionsLineParser;
use PHPUnit\Framework\TestCase;

/**
 * Class ActionsLineParserTest
 */
final class ActionsLineParserTest extends TestCase
{
    /**
     * @var ActionsLineParser
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
        yield [['L'], 'L'];
        yield [['R'], 'R'];
        yield [['M'], 'M'];
        yield [['L', 'R', 'M'], 'LRM'];
        yield [['M', 'L', 'R', 'R', 'M'], 'MLRRM'];
    }

    /**
     * @return iterable
     */
    public function getDataForInvalidLineTest(): iterable
    {
        yield [''];
        yield [' L'];
        yield ['L '];
        yield [' R'];
        yield ['R '];
        yield [' M'];
        yield ['M '];
        yield ['*'];
    }

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->lineParser = new ActionsLineParser();
    }
}
