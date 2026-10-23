<?php

declare(strict_types=1);

namespace TeamBlue\Util\Tests\Object\Immutable;

use EventEngine\JsonSchema\JsonSchemaAwareRecord;
use EventEngine\JsonSchema\JsonSchemaAwareRecordLogic;
use TeamBlue\Util\Tests\Object\Attribute\TestAttribute;

#[TestAttribute]
class TestImmutable implements JsonSchemaAwareRecord
{
    use JsonSchemaAwareRecordLogic;

    private readonly string $test; // @phpstan-ignore-line

    public static function __type(): string
    {
        return 'myType';
    }

    public function test(): string
    {
        return $this->test;
    }
}
