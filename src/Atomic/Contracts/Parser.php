<?php

namespace LarsKlopstra\Envelop\Atomic\Contracts;

use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

/**
 * Contract for CSS class parsers.
 *
 * Parsers convert class names into Style objects by matching against rules
 * and resolving values from the theme.
 */
interface Parser
{
    /**
     * Parse class names into a Style object.
     *
     * @param  Theme  $theme  Design token configuration
     * @param  array<int, Rule>  $rules  Parsing rules to match against
     * @param  string  $className  Space-separated class names
     * @return Style Combined CSS styles
     */
    public function parse(Theme $theme, array $rules, string $className): Style;
}
