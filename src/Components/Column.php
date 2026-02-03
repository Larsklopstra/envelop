<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Column component for email templates.
 *
 * Renders a table cell (td) with atomic CSS utilities.
 * Used to create column layouts in email-compatible table structures.
 */
class Column extends Component
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
        <td {{ $attributes->merge(['style' => $style()]) }}>{{ $slot }}</td>
        BLADE;
    }
}
