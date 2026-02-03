<?php

namespace LarsKlopstra\Envelop\Atomic\Parsers;

use LarsKlopstra\Envelop\Atomic\Contracts\Parser;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

/**
 * Default CSS class parser for atomic utilities.
 *
 * Parses space-separated class names and converts them to inline CSS styles
 * by matching against theme-based rules.
 */
class DefaultParser implements Parser
{
    /**
     * @param  array<int, Rule>  $rules
     */
    public function parse(Theme $theme, array $rules, string $className): Style
    {
        $style = new Style([]);
        $classList = explode(' ', $className);

        foreach ($classList as $class) {
            if (blank($class)) {
                continue;
            }

            foreach ($rules as $rule) {
                if (preg_match($rule->pattern, $class, $matches)) {
                    $incomingStyle = is_callable($rule->style)
                        ? ($rule->style)($theme, $matches)
                        : $rule->style;

                    if ($incomingStyle === null) {
                        continue;
                    }

                    $style = $style->merge($incomingStyle);

                    break;
                }
            }
        }

        return $style;
    }
}
