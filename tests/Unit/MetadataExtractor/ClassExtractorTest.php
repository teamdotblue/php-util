<?php

declare(strict_types=1);

namespace TeamBlue\Util\Tests\Unit\MetadataExtractor;

use EventEngine\JsonSchema\JsonSchemaAwareRecord;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use TeamBlue\Util\MetadataExtractor\ClassExtractor;
use TeamBlue\Util\Tests\Object\Immutable\TestImmutable;
use TeamBlue\Util\Tests\Object\Interface\TestInterface;
use TeamBlue\Util\Tests\Object\TestObject;

class ClassExtractorTest extends TestCase
{
    private ClassExtractor $classExtractor;

    protected function setUp(): void
    {
        $this->classExtractor = new ClassExtractor();
    }

    public function testClassFromClassAndInterface(): void
    {
        $class = $this->classExtractor->classFromClassAndInterface(
            TestImmutable::class,
            JsonSchemaAwareRecord::class,
        );

        $this->assertEquals(TestImmutable::class, $class);
    }

    public function testClassFromReflectionClassAndInterface(): void
    {
        $class = $this->classExtractor->classFromReflectionClassAndInterface(
            new ReflectionClass(TestImmutable::class),
            JsonSchemaAwareRecord::class,
        );

        $this->assertEquals(TestImmutable::class, $class);
    }

    public function testForNonImplementedInterface(): void
    {
        $class = $this->classExtractor->classFromClassAndInterface(
            TestImmutable::class,
            TestInterface::class,
        );

        $this->assertNull($class);
    }

    public function testForNonExistingClass(): void
    {
        $this->expectException(ReflectionException::class);
        $this->classExtractor->classFromClassAndInterface(
            'test', //@phpstan-ignore-line
            TestInterface::class,
        );
    }

    public function testForNonExistingInterface(): void
    {
        $this->expectException(ReflectionException::class);
        $this->classExtractor->classFromClassAndInterface(
            TestImmutable::class,
            TestObject::class,
        );
    }
}
