<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * HTML root component for email templates.
 *
 * Renders the DOCTYPE and root html element with XHTML namespace.
 * Includes language and text direction attributes for internationalization.
 */
class Html extends Component
{
    public function __construct(
        public string $lang = 'en',
        public string $dir = 'ltr',
    ) {}

    public function render(): string
    {
        return <<<'BLADE'
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html {{ $attributes->merge([
            'xmlns' => 'http://www.w3.org/1999/xhtml',
            'lang' => $lang,
            'dir' => $dir,
        ]) }}>
        {{ $slot }}
        </html>
        BLADE;
    }
}
