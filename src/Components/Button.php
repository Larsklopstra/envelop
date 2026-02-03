<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Button component for email templates.
 *
 * Renders a button-styled anchor tag with atomic CSS utilities.
 */
class Button extends Component
{
    public function __construct(
        public string $href,
        public string $target = '_blank',
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
            'line-height' => '100%',
            'text-decoration' => 'none',
            'display' => 'inline-block',
            'max-width' => '100%',
            'mso-padding-alt' => '0px',
        ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <a {{ $attributes->merge([
            'href' => $href,
            'target' => $target,
            'style' => $style(),
        ]) }}>
            {{ $slot }}
        </a>
        BLADE;
    }
}
