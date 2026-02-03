<?php

namespace LarsKlopstra\Envelop\Tests\Atomic\ValueObjects;

use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;
use LarsKlopstra\Envelop\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ThemeTest extends TestCase
{
    #[Test]
    public function it_get_flattened_returns_empty_array_for_missing_key(): void
    {
        $theme = new Theme([]);

        $result = $theme->getFlattened('colors');

        $this->assertSame([], $result);
    }

    #[Test]
    public function it_get_flattened_handles_non_nested_values(): void
    {
        $theme = new Theme([
            'colors' => [
                'white' => '#ffffff',
                'black' => '#000000',
            ],
        ]);

        $result = $theme->getFlattened('colors');

        $this->assertSame('#ffffff', $result['white']);
        $this->assertSame('#000000', $result['black']);
    }

    #[Test]
    public function it_get_flattened_adds_shade_suffix_for_nested_values(): void
    {
        $theme = new Theme([
            'colors' => [
                'red' => [
                    '50' => '#fef2f2',
                    '500' => '#ef4444',
                ],
            ],
        ]);

        $result = $theme->getFlattened('colors');

        $this->assertSame('#fef2f2', $result['red-50']);
        $this->assertSame('#ef4444', $result['red-500']);
    }

    #[Test]
    public function it_get_flattened_uses_base_name_for_default_key(): void
    {
        $theme = new Theme([
            'colors' => [
                'red' => [
                    'DEFAULT' => '#ef4444',
                    '500' => '#ef4444',
                ],
            ],
        ]);

        $result = $theme->getFlattened('colors');

        $this->assertSame('#ef4444', $result['red']);
        $this->assertArrayNotHasKey('red-DEFAULT', $result);
    }

    #[Test]
    public function it_merge_recursively_merges_nested_arrays(): void
    {
        $theme1 = new Theme([
            'colors' => ['red' => '#ff0000'],
        ]);
        $theme2 = new Theme([
            'colors' => ['blue' => '#0000ff'],
        ]);

        $merged = $theme1->merge($theme2);

        $flattened = $merged->getFlattened('colors');
        $this->assertSame('#ff0000', $flattened['red']);
        $this->assertSame('#0000ff', $flattened['blue']);
    }

    #[Test]
    public function it_merge_preserves_both_theme_values(): void
    {
        $theme1 = new Theme([
            'fontSize' => ['sm' => '14px'],
        ]);
        $theme2 = new Theme([
            'colors' => ['red' => '#ff0000'],
        ]);

        $merged = $theme1->merge($theme2);

        $this->assertSame(['sm' => '14px'], $merged->getFlattened('fontSize'));
        $this->assertSame(['red' => '#ff0000'], $merged->getFlattened('colors'));
    }
}
