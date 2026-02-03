<?php

namespace LarsKlopstra\Envelop\Tests\Atomic\Presets;

use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DefaultPresetTest extends TestCase
{
    private Atomic $atomic;

    protected function setUp(): void
    {
        parent::setUp();
        $this->atomic = new Atomic;
    }

    #[Test]
    public function it_text_resolves_alignment_left(): void
    {
        $result = $this->atomic->parse('text-left');

        $this->assertSame('text-align:left', (string) $result);
    }

    #[Test]
    public function it_text_resolves_alignment_center(): void
    {
        $result = $this->atomic->parse('text-center');

        $this->assertSame('text-align:center', (string) $result);
    }

    #[Test]
    public function it_text_resolves_alignment_right(): void
    {
        $result = $this->atomic->parse('text-right');

        $this->assertSame('text-align:right', (string) $result);
    }

    #[Test]
    public function it_text_resolves_alignment_justify(): void
    {
        $result = $this->atomic->parse('text-justify');

        $this->assertSame('text-align:justify', (string) $result);
    }

    #[Test]
    public function it_text_resolves_font_size_from_theme(): void
    {
        $result = $this->atomic->parse('text-lg');

        $this->assertStringContainsString('font-size:18px', (string) $result);
    }

    #[Test]
    public function it_text_resolves_color_from_theme(): void
    {
        $result = $this->atomic->parse('text-red');

        $this->assertSame('color:#ef4444', (string) $result);
    }

    #[Test]
    public function it_text_resolves_color_shade_from_theme(): void
    {
        $result = $this->atomic->parse('text-red-500');

        $this->assertSame('color:#ef4444', (string) $result);
    }

    #[Test]
    public function it_text_invalid_returns_empty(): void
    {
        $result = $this->atomic->parse('text-invalid');

        $this->assertSame('', (string) $result);
    }

    #[Test]
    public function it_font_resolves_family_sans(): void
    {
        $result = $this->atomic->parse('font-sans');

        $this->assertStringContainsString('font-family:', (string) $result);
        $this->assertStringContainsString('sans-serif', (string) $result);
    }

    #[Test]
    public function it_font_resolves_family_serif(): void
    {
        $result = $this->atomic->parse('font-serif');

        $this->assertStringContainsString('font-family:', (string) $result);
        $this->assertStringContainsString('Georgia', (string) $result);
    }

    #[Test]
    public function it_font_resolves_family_mono(): void
    {
        $result = $this->atomic->parse('font-mono');

        $this->assertStringContainsString('font-family:', (string) $result);
        $this->assertStringContainsString('monospace', (string) $result);
    }

    #[Test]
    public function it_font_resolves_weight_bold(): void
    {
        $result = $this->atomic->parse('font-bold');

        $this->assertSame('font-weight:700', (string) $result);
    }

    #[Test]
    public function it_font_resolves_weight_light(): void
    {
        $result = $this->atomic->parse('font-light');

        $this->assertSame('font-weight:300', (string) $result);
    }

    #[Test]
    public function it_font_invalid_returns_empty(): void
    {
        $result = $this->atomic->parse('font-invalid');

        $this->assertSame('', (string) $result);
    }

    #[Test]
    public function it_border_numeric_becomes_pixel_width(): void
    {
        $result = $this->atomic->parse('border-2');

        $this->assertSame('border-width:2px', (string) $result);
    }

    #[Test]
    public function it_border_style_solid(): void
    {
        $result = $this->atomic->parse('border-solid');

        $this->assertSame('border-style:solid', (string) $result);
    }

    #[Test]
    public function it_border_style_dashed(): void
    {
        $result = $this->atomic->parse('border-dashed');

        $this->assertSame('border-style:dashed', (string) $result);
    }

    #[Test]
    public function it_border_color_from_theme(): void
    {
        $result = $this->atomic->parse('border-red');

        $this->assertSame('border-color:#ef4444', (string) $result);
    }

    #[Test]
    public function it_border_invalid_returns_empty(): void
    {
        $result = $this->atomic->parse('border-invalid');

        $this->assertSame('', (string) $result);
    }

    #[Test]
    public function it_width_theme_value_full(): void
    {
        $result = $this->atomic->parse('w-full');

        $this->assertSame('width:100%', (string) $result);
    }

    #[Test]
    public function it_width_theme_value_half(): void
    {
        $result = $this->atomic->parse('w-1/2');

        $this->assertSame('width:50%', (string) $result);
    }

    #[Test]
    public function it_width_numeric_uses_multiplier(): void
    {
        $result = $this->atomic->parse('w-4');

        $this->assertSame('width:16px', (string) $result);
    }

    #[Test]
    public function it_width_zero_becomes_zero_px(): void
    {
        $result = $this->atomic->parse('w-0');

        $this->assertSame('width:0px', (string) $result);
    }

    #[Test]
    public function it_bg_arbitrary_value(): void
    {
        $result = $this->atomic->parse('bg-[#ff0000]');

        $this->assertSame('background-color:#ff0000', (string) $result);
    }

    #[Test]
    public function it_bg_theme_color(): void
    {
        $result = $this->atomic->parse('bg-red');

        $this->assertSame('background-color:#ef4444', (string) $result);
    }

    #[Test]
    public function it_bg_theme_shade(): void
    {
        $result = $this->atomic->parse('bg-red-500');

        $this->assertSame('background-color:#ef4444', (string) $result);
    }

    #[Test]
    public function it_bg_invalid_returns_empty(): void
    {
        $result = $this->atomic->parse('bg-invalid');

        $this->assertSame('', (string) $result);
    }

    #[Test]
    public function it_padding_numeric(): void
    {
        $result = $this->atomic->parse('p-4');

        $this->assertSame('padding:16px', (string) $result);
    }

    #[Test]
    public function it_padding_zero(): void
    {
        $result = $this->atomic->parse('p-0');

        $this->assertSame('padding:0px', (string) $result);
    }

    #[Test]
    public function it_padding_arbitrary(): void
    {
        $result = $this->atomic->parse('p-[20px]');

        $this->assertSame('padding:20px', (string) $result);
    }

    #[Test]
    public function it_padding_x_axis(): void
    {
        $result = $this->atomic->parse('px-4');

        $this->assertStringContainsString('padding-left:16px', (string) $result);
        $this->assertStringContainsString('padding-right:16px', (string) $result);
    }

    #[Test]
    public function it_padding_y_axis(): void
    {
        $result = $this->atomic->parse('py-4');

        $this->assertStringContainsString('padding-top:16px', (string) $result);
        $this->assertStringContainsString('padding-bottom:16px', (string) $result);
    }

    #[Test]
    public function it_padding_top(): void
    {
        $result = $this->atomic->parse('pt-4');

        $this->assertSame('padding-top:16px', (string) $result);
    }

    #[Test]
    public function it_border_default(): void
    {
        $result = $this->atomic->parse('border');

        $this->assertStringContainsString('border-width:1px', (string) $result);
        $this->assertStringContainsString('border-style:solid', (string) $result);
    }

    #[Test]
    public function it_border_top(): void
    {
        $result = $this->atomic->parse('border-t');

        $this->assertStringContainsString('border-top-width:1px', (string) $result);
        $this->assertStringContainsString('border-top-style:solid', (string) $result);
    }

    #[Test]
    public function it_border_x_axis(): void
    {
        $result = $this->atomic->parse('border-x');

        $this->assertStringContainsString('border-left-width:1px', (string) $result);
        $this->assertStringContainsString('border-right-width:1px', (string) $result);
    }

    #[Test]
    public function it_rounded_default(): void
    {
        $result = $this->atomic->parse('rounded');

        $this->assertStringContainsString('border-top-left-radius:4px', (string) $result);
        $this->assertStringContainsString('border-top-right-radius:4px', (string) $result);
        $this->assertStringContainsString('border-bottom-right-radius:4px', (string) $result);
        $this->assertStringContainsString('border-bottom-left-radius:4px', (string) $result);
    }

    #[Test]
    public function it_rounded_lg(): void
    {
        $result = $this->atomic->parse('rounded-lg');

        $this->assertStringContainsString('8px', (string) $result);
    }

    #[Test]
    public function it_rounded_top_lg(): void
    {
        $result = $this->atomic->parse('rounded-t-lg');

        $this->assertStringContainsString('border-top-left-radius:8px', (string) $result);
        $this->assertStringContainsString('border-top-right-radius:8px', (string) $result);
        $this->assertStringNotContainsString('border-bottom', (string) $result);
    }

    #[Test]
    public function it_display_block(): void
    {
        $result = $this->atomic->parse('block');

        $this->assertSame('display:block', (string) $result);
    }

    #[Test]
    public function it_display_inline(): void
    {
        $result = $this->atomic->parse('inline');

        $this->assertSame('display:inline', (string) $result);
    }

    #[Test]
    public function it_display_hidden(): void
    {
        $result = $this->atomic->parse('hidden');

        $this->assertSame('display:none', (string) $result);
    }

    #[Test]
    public function it_uppercase(): void
    {
        $result = $this->atomic->parse('uppercase');

        $this->assertSame('text-transform:uppercase', (string) $result);
    }

    #[Test]
    public function it_lowercase(): void
    {
        $result = $this->atomic->parse('lowercase');

        $this->assertSame('text-transform:lowercase', (string) $result);
    }

    #[Test]
    public function it_underline(): void
    {
        $result = $this->atomic->parse('underline');

        $this->assertSame('text-decoration:underline', (string) $result);
    }

    #[Test]
    public function it_line_through(): void
    {
        $result = $this->atomic->parse('line-through');

        $this->assertSame('text-decoration:line-through', (string) $result);
    }

    #[Test]
    public function it_shadow_default(): void
    {
        $result = $this->atomic->parse('shadow');

        $this->assertStringContainsString('box-shadow:', (string) $result);
    }

    #[Test]
    public function it_shadow_lg(): void
    {
        $result = $this->atomic->parse('shadow-lg');

        $this->assertStringContainsString('box-shadow:', (string) $result);
    }

    #[Test]
    public function it_opacity(): void
    {
        $result = $this->atomic->parse('opacity-50');

        $this->assertSame('opacity:0.5', (string) $result);
    }
}
