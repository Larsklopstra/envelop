<?php

namespace LarsKlopstra\Envelop\Atomic\ValueObjects;

use Stringable;

/**
 * Represents a collection of CSS properties for inline styles.
 *
 * Converts key-value pairs into inline CSS strings.
 */
class Style implements Stringable
{
    /**
     * @param  array<string, string|null>  $properties
     */
    public function __construct(public array $properties) {}

    public function merge(Style $incoming): Style
    {
        return new Style([
            ...$this->properties,
            ...$incoming->properties,
        ]);
    }

    public function __toString(): string
    {
        $list = [];

        foreach ($this->properties as $property => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $list[] = "{$property}:{$value}";
        }

        return implode(';', $list);
    }
}
