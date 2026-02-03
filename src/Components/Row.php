<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Row component for email templates.
 *
 * Renders a table row container for creating column-based layouts.
 * Works with Column components to build responsive grid structures.
 */
class Row extends Component
{
    public function __construct(
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
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
                <tr>{{ $slot }}</tr>
            </tbody>
        </table>
        BLADE;
    }
}
