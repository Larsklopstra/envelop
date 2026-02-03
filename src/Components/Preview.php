<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Preview text component for email templates.
 *
 * Renders hidden preview text that appears in email client inbox listings.
 * Automatically truncates to 150 characters and pads with zero-width spaces.
 */
class Preview extends Component
{
    public string $truncatedText;

    public string $padding;

    public function __construct(
        public string $text,
    ) {
        $this->truncatedText = mb_substr($text, 0, 150);
        $paddingLength = max(0, 150 - mb_strlen($this->truncatedText));
        $this->padding = str_repeat('&#8199;&#65279;&#847; ', $paddingLength);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <div style="display:none;overflow:hidden;line-height:1px;opacity:0;max-height:0;max-width:0;">
            {{ $truncatedText }}{!! $padding !!}
        </div>
        BLADE;
    }
}
