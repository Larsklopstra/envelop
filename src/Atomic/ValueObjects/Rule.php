<?php

namespace LarsKlopstra\Envelop\Atomic\ValueObjects;

use Closure;

/**
 * Represents a CSS utility parsing rule.
 *
 * Matches class names against a regex pattern and produces CSS styles.
 * The style can be static or dynamically generated via a closure.
 */
readonly class Rule
{
    /**
     * @param  string  $pattern  Regex pattern to match class names
     * @param  (Closure(Theme, array<string, string>): Style|null)|Style|null  $style  Style to apply when matched
     */
    public function __construct(
        public string $pattern,
        public Closure|Style|null $style,
    ) {}
}
