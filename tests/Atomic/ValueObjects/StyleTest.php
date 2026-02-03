<?php

namespace LarsKlopstra\Envelop\Tests\Atomic\ValueObjects;

use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class StyleTest extends TestCase
{
    #[Test]
    public function it_converts_to_string_format(): void
    {
        $style = new Style(['color' => 'red', 'font-size' => '16px']);

        $result = (string) $style;

        $this->assertSame('color:red;font-size:16px', $result);
    }

    #[Test]
    public function it_filters_null_values(): void
    {
        $style = new Style(['color' => 'red', 'background' => null]);

        $result = (string) $style;

        $this->assertSame('color:red', $result);
    }

    #[Test]
    public function it_filters_empty_string_values(): void
    {
        $style = new Style(['color' => 'red', 'background' => '']);

        $result = (string) $style;

        $this->assertSame('color:red', $result);
    }

    #[Test]
    public function it_merge_creates_new_instance(): void
    {
        $original = new Style(['color' => 'red']);
        $incoming = new Style(['background' => 'blue']);

        $merged = $original->merge($incoming);

        $this->assertNotSame($original, $merged);
        $this->assertNotSame($incoming, $merged);
    }

    #[Test]
    public function it_merge_later_properties_override(): void
    {
        $original = new Style(['color' => 'red']);
        $incoming = new Style(['color' => 'blue']);

        $merged = $original->merge($incoming);

        $this->assertSame('color:blue', (string) $merged);
    }

    #[Test]
    public function it_empty_style_converts_to_empty_string(): void
    {
        $style = new Style([]);

        $this->assertSame('', (string) $style);
    }
}
