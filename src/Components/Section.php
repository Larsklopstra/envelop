<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Section component for email templates.
 *
 * Renders a full-width table for grouping content into logical sections.
 * Provides a semantic wrapper with atomic CSS utilities support.
 */
class Section extends Component
{
    public function __construct(
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <table {{ $attributes->merge([
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
