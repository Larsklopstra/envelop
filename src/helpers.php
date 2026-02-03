<?php

use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;

if (! function_exists('atomic')) {
    function atomic(string $classes, array $defaults = []): string
    {
        $atomic = app(Atomic::class);

        $defaultStyle = new Style($defaults);
        $atomicStyle = $atomic->parse($classes);

        return (string) $defaultStyle->merge($atomicStyle);
    }
}
