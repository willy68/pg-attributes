<?php

declare(strict_types=1);

namespace Pg\Attributes;

use koriym\Attributes\AttributeReader;
use ReflectionClass;
use ReflectionMethod;

class AttributesReader
{
    public function __construct(private readonly AttributeReader $reader)
    {
    }

    /**
     * @param ReflectionMethod $method
     * @param string $attributeClassName
     * @return object|null
     */
    public function getMethodAttribute(ReflectionMethod $method, string $attributeClassName): ?object
    {
        return $this->reader->getMethodAnnotation($method, $attributeClassName);
    }

    /**
     * @param ReflectionMethod $method
     * @param string $attributeClassName
     * @return iterable|null
     */
    public function getMethodAttributes(ReflectionMethod $method, string $attributeClassName): ?iterable
    {
        $attributes = $this->reader->getMethodAnnotations($method);

        foreach ($attributes as $annotation) {
            if ($annotation instanceof $attributeClassName) {
                yield $annotation;
            }
        }
        return null;
    }

    /**
     * @param ReflectionClass $class
     * @param string $attributeClassName
     * @return object|null
     */
    public function getClassAttribute(ReflectionClass $class, string $attributeClassName): ?object
    {
        return $this->reader->getClassAnnotation($class, $attributeClassName);
    }

    /**
     * @param ReflectionClass $class
     * @param string $attributeClassName
     * @return iterable|null
     */
    public function getClassAttributes(ReflectionClass $class, string $attributeClassName): ?iterable
    {
        $attributes = $this->reader->getClassAnnotations($class);

        foreach ($attributes as $annotation) {
            if ($annotation instanceof $attributeClassName) {
                yield $annotation;
            }
        }
        return null;
    }

    public function getReader(): AttributeReader
    {
        return $this->reader;
    }
}
