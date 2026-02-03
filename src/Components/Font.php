<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Font component for email templates.
 *
 * Renders font declarations with optional web font support and fallbacks.
 * Includes MSO-specific styles for Outlook compatibility.
 */
class Font extends Component
{
    public function __construct(
        public string $fontFamily,
        public string $fallback = 'Arial, sans-serif',
        public ?string $webFont = null,
        public string $fontWeight = '400',
        public string $fontStyle = 'normal',
    ) {}

    public function render(): string
    {
        return <<<'BLADE'
        @if($webFont)
        <!--[if mso]>
        <style type="text/css">
            * { font-family: {{ $fallback }} !important; }
        </style>
        <![endif]-->
        <!--[if !mso]><!-->
        <link href="{{ $webFont }}" rel="stylesheet" type="text/css" />
        <style type="text/css">
            * { font-family: '{{ $fontFamily }}', {{ $fallback }}; font-weight: {{ $fontWeight }}; font-style: {{ $fontStyle }}; }
        </style>
        <!--<![endif]-->
        @else
        <style type="text/css">
            * { font-family: {{ $fontFamily }}, {{ $fallback }}; font-weight: {{ $fontWeight }}; font-style: {{ $fontStyle }}; }
        </style>
        @endif
        BLADE;
    }
}
