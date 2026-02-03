<?php

namespace LarsKlopstra\Envelop\Atomic\ValueObjects;

/**
 * Represents a theme configuration with design tokens.
 *
 * Manages color palettes, spacing scales, typography, and other design properties.
 * Supports merging themes and flattening nested properties with shade variations.
 */
class Theme
{
    /**
     * @param  array<string, mixed>  $properties
     */
    public function __construct(public array $properties) {}

    public function merge(Theme $incoming): static
    {
        return new static(
            array_merge_recursive(
                $this->properties,
                $incoming->properties
            )
        );
    }

    public function getFlattened(string $key): array
    {
        $property = $this->properties[$key] ?? [];
        $flattened = [];

        foreach ($property as $name => $value) {
            if (! is_array($value)) {
                $flattened[$name] = $value;

                continue;
            }

            // Check if indexed array (e.g., ['18px', '28px'])
            if (array_is_list($value)) {
                $flattened[$name] = $value;

                continue;
            }

            // Associative array - flatten with shades
            foreach ($value as $shade => $shadeValue) {
                if ($shade === 'DEFAULT') {
                    $flattened[$name] = $shadeValue;
                } else {
                    $flattened["$name-$shade"] = $shadeValue;
                }
            }
        }

        return $flattened;
    }
}
