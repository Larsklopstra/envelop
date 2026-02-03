<?php

namespace LarsKlopstra\Envelop\Atomic;

use Illuminate\Support\Collection;
use LarsKlopstra\Envelop\Atomic\Contracts\Parser;
use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\Parsers\DefaultParser;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

/**
 * Main atomic CSS engine.
 *
 * Converts utility class names into inline CSS styles for email templates.
 * Combines multiple presets and uses a parser to generate styles from themes and rules.
 */
class Atomic
{
    /**
     * @param  array<int, Preset>  $presets
     */
    public function __construct(
        private array $presets = [new DefaultPreset],
        private Parser $parser = new DefaultParser,
    ) {}

    private function getTheme(): Theme
    {
        return Collection::make($this->presets)
            ->map(fn (Preset $preset) => $preset->getTheme())
            ->reduce(fn (Theme $theme, Theme $presetTheme) => $theme->merge($presetTheme), new Theme([]));
    }

    /**
     * @return array<int, Rule>
     */
    private function getRules(): array
    {
        return Collection::make($this->presets)
            ->flatMap(fn (Preset $preset) => $preset->getRules())
            ->all();
    }

    public function parse(string $classList): Style
    {
        return $this->parser->parse(
            $this->getTheme(),
            $this->getRules(),
            $classList,
        );
    }
}
