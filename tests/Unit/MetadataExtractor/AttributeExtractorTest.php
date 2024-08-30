<?php

declare(strict_types=1);

namespace TeamBlue\Util\Tests\Unit\MetadataExtractor;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use TeamBlue\Util\MetadataExtractor\AttributeExtractor;
use TeamBlue\Util\Tests\Object\Attribute\TestAttribute;
use TeamBlue\Util\Tests\Object\Immutable\TestImmutable;
use TeamBlue\Util\Tests\Object\Immutable\TestImmutableWithoutAttribute;
use TeamBlue\Util\Tests\Object\TestObject;

class AttributeExtractorTest extends TestCase
{
    private AttributeExtractor $attibuteExtractor;

    protected function setUp(): void
    {
        $this->attibuteExtractor = new AttributeExtractor();
    }

    public function testAttributeInstanceFromClassAndAttribute(): void
    {
        $attribute = $this->attibuteExtractor->attributeInstanceFromClassAndAttribute(
            TestImmutable::class,
            TestAttribute::class,
        );

        $this->assertInstanceOf(TestAttribute::class, $attribute);
    }

    public function testAttributeInstanceFromInstanceAndAttribute(): void
    {
        $attribute = $this->attibuteExtractor->attributeInstanceFromInstanceAndAttribute(
            TestImmutable::fromArray(['test' => 'test']),
            TestAttribute::class,
        );

        $this->assertInstanceOf(TestAttribute::class, $attribute);
    }

    public function testAttributeInstanceFromReflectionClassAndAttribute(): void
    {
        $attribute = $this->attibuteExtractor->attributeInstanceFromReflectionClassAndAttribute(
            new ReflectionClass(TestImmutable::class),
            TestAttribute::class,
        );

        $this->assertInstanceOf(TestAttribute::class, $attribute);
    }

    public function testForNonExistingAttribute(): void
    {
        $attribute = $this->attibuteExtractor->attributeInstanceFromClassAndAttribute(
            TestImmutable::class,
            TestObject::class,
        );

        $this->assertNull($attribute);
    }

    public function testForClassWithoutAttribute(): void
    {
        $attribute = $this->attibuteExtractor->attributeInstanceFromClassAndAttribute(
            TestImmutableWithoutAttribute::class,
            TestObject::class,
        );

        $this->assertNull($attribute);
    }
}
