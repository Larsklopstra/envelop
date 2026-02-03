<?php

namespace LarsKlopstra\Envelop\Atomic\Contracts;

use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

/**
 * Contract for atomic CSS presets.
 *
 * Presets provide collections of parsing rules and theme configurations.
 * Multiple presets can be combined to extend functionality.
 */
interface Preset
{
    /**
     * Get all parsing rules for this preset.
     *
     * @return array<int, Rule>
     */
    public function getRules(): array;

    /**
     * Get the theme configuration for this preset.
     */
    public function getTheme(): Theme;
}
