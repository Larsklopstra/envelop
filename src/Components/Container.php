<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Container component for email templates.
 *
 * Renders a centered, max-width constrained table for responsive email layouts.
 * Default max-width is 37.5em (600px) for optimal mobile rendering.
 */
class Container extends Component
{
    public function __construct(
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
            'max-width' => '37.5em',
            'margin' => '0 auto',
            'width' => '100%',
        ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <table
            {{ $attributes->merge([
                'align' => 'center',
                'width' => '100%',
                'role' => 'presentation',
                'cellspacing' => '0',
                'cellpadding' => '0',
                'border' => '0',
                'style' => $style(),
            ]) }}
        >
            <tbody>
                <tr>
                    <td>{{ $slot }}</td>
                </tr>
            </tbody>
        </table>
        BLADE;
    }
}
