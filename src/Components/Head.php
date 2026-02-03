<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Head component for email templates.
 *
 * Renders the head section with essential meta tags for email clients.
 * Includes viewport settings, charset declaration, and MSO-specific configuration.
 */
class Head extends Component
{
    public function __construct(
        public ?string $title = null,
    ) {}

    public function render(): string
    {
        return <<<'BLADE'
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="x-apple-disable-message-reformatting" />
            <meta name="color-scheme" content="light" />
            <meta name="supported-color-schemes" content="light" />
            @if($title)<title>{{ $title }}</title>@endif
            <!--[if mso]>
            <noscript>
                <xml>
                    <o:OfficeDocumentSettings>
                        <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                </xml>
            </noscript>
            <![endif]-->
            {{ $slot }}
        </head>
        BLADE;
    }
}
