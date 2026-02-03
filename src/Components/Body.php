<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Body component for email templates.
 *
 * Renders the body element wrapped in a table structure for email client compatibility.
 * Includes reset styles to normalize rendering across email clients.
 */
class Body extends Component
{
    public function __construct(
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
            'margin' => '0',
            'padding' => '0',
            'width' => '100%',
        ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <body {{ $attributes->merge(['style' => $style()]) }}>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tbody>
                    <tr>
                        <td>
                            {{ $slot }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        BLADE;
    }
}
