<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Image component for email templates.
 *
 * Renders an image with email-safe defaults and optional dimensions.
 * Automatically includes display block and removes borders/outlines.
 */
class Img extends Component
{
    public function __construct(
        public string $src,
        public string $alt = '',
        public ?string $width = null,
        public ?string $height = null,
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
            'display' => 'block',
            'outline' => 'none',
            'border' => 'none',
            'text-decoration' => 'none',
        ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <img {{ $attributes->merge(array_filter([
            'src' => $src,
            'alt' => $alt,
            'width' => $width,
            'height' => $height,
            'style' => $style(),
        ])) }} />
        BLADE;
    }
}
