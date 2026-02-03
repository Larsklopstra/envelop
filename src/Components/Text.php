<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Text component for email templates.
 *
 * Renders a paragraph with predefined typography defaults.
 * Includes readable font size, line height, and vertical spacing.
 */
class Text extends Component
{
    public function __construct(
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
            'font-size' => '14px',
            'line-height' => '24px',
            'margin' => '16px 0',
        ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <p {{ $attributes->merge(['style' => $style()]) }}>{{ $slot }}</p>
        BLADE;
    }
}
