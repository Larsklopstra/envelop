<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Heading component for email templates.
 *
 * Renders semantic heading tags (h1-h6) with predefined typography styles.
 * Each heading level has appropriate font size, weight, and margin defaults.
 */
class Heading extends Component
{
    public function __construct(
        public string $as = 'h1',
        public string $class = '',
    ) {
        if (! in_array($as, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true)) {
            throw new \InvalidArgumentException("Invalid heading level: {$as}. Must be h1, h2, h3, h4, h5, or h6.");
        }
    }

    public function style(): string
    {
        $defaults = match ($this->as) {
            'h1' => ['font-size' => '36px', 'font-weight' => '700', 'margin' => '0 0 20px 0'],
            'h2' => ['font-size' => '30px', 'font-weight' => '700', 'margin' => '0 0 16px 0'],
            'h3' => ['font-size' => '24px', 'font-weight' => '600', 'margin' => '0 0 14px 0'],
            'h4' => ['font-size' => '20px', 'font-weight' => '600', 'margin' => '0 0 12px 0'],
            'h5' => ['font-size' => '18px', 'font-weight' => '600', 'margin' => '0 0 10px 0'],
            'h6' => ['font-size' => '16px', 'font-weight' => '600', 'margin' => '0 0 8px 0'],
        };

        return atomic($this->class, $defaults);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <{{ $as }} {{ $attributes->merge(['style' => $style()]) }}>{{ $slot }}</{{ $as }}>
        BLADE;
    }
}
