<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Link component for email templates.
 *
 * Renders an anchor tag with atomic CSS utilities.
 */
class Link extends Component
{
    public function __construct(
        public string $href,
        public string $target = '_blank',
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
            'color' => '#067df7',
            'text-decoration' => 'none',
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
