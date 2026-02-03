<?php

namespace LarsKlopstra\Envelop\Components;

use Illuminate\View\Component;

/**
 * Horizontal rule component for email templates.
 *
 * Renders a horizontal divider with consistent styling across email clients.
 * Default style is a subtle 1px top border.
 */
class Hr extends Component
{
    public function __construct(
        public string $class = '',
    ) {}

    public function style(): string
    {
        return atomic($this->class, [
            'width' => '100%',
            'border' => 'none',
            'border-top' => '1px solid #eaeaea',
        ]);
    }

    public function render(): string
    {
        return <<<'BLADE'
        <hr {{ $attributes->merge(['style' => $style()]) }} />
        BLADE;
    }
}
