<?php

declare(strict_types=1);

namespace TeamBlue\Util\Tests\Unit;

use PHPUnit\Framework\TestCase;
use TeamBlue\Util\ScalarUtil;
use TeamBlue\Util\Tests\Object\Immutable\TestImmutable;

class ScalarUtilTest extends TestCase
{
    public function testToScalar(): void
    {
        $immutable = TestImmutable::fromArray(['test' => 'test']);
        $scalar = true;

        $this->assertEquals(['test' => 'test'], ScalarUtil::toScalar($immutable));
        $this->assertTrue(ScalarUtil::toScalar($scalar));
    }

    public function testRecursiveToScalar(): void
    {
        $immutable = TestImmutable::fromArray(['test' => 'test']);

        $array = [
            'test' => 'test',
            'immutable' => $immutable,
            'nestedImmutable' => ['immutable' => $immutable],
        ];

        $this->assertEquals(
            [
                'test' => 'test',
                'immutable' => ['test' => 'test'],
                'nestedImmutable' => [
                    'immutable' => ['test' => 'test'],
                ],
            ],
            ScalarUtil::toScalar($array),
        );
    }
}
