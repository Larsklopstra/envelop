<?php

namespace LarsKlopstra\Envelop\Tests\Atomic;

use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Atomic\Contracts\Parser;
use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Rule;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;
use LarsKlopstra\Envelop\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AtomicTest extends TestCase
{
    #[Test]
    public function it_can_be_instantiated_with_defaults(): void
    {
        $atomic = new Atomic;

        $this->assertInstanceOf(Atomic::class, $atomic);
    }

    #[Test]
    public function it_parses_with_default_preset(): void
    {
        $atomic = new Atomic;

        $result = $atomic->parse('text-red');

        $this->assertSame('color:#ef4444', (string) $result);
    }

    #[Test]
    public function it_merges_multiple_presets(): void
    {
        $customPreset = new class implements Preset
        {
            public function getRules(): array
            {
                return [
                    new Rule('/^custom$/', new Style(['custom' => 'value'])),
                ];
            }

            public function getTheme(): Theme
            {
                return new Theme([]);
            }
        };

        $atomic = new Atomic(presets: [new DefaultPreset, $customPreset]);

        $result = $atomic->parse('custom text-red');

        $this->assertStringContainsString('custom:value', (string) $result);
        $this->assertStringContainsString('color:#ef4444', (string) $result);
    }

    #[Test]
    public function it_custom_parser_injection(): void
    {
        $customParser = new class implements Parser
        {
            public function parse(Theme $theme, array $rules, string $className): Style
            {
                return new Style(['injected' => 'parser']);
            }
        };

        $atomic = new Atomic(parser: $customParser);

        $result = $atomic->parse('anything');

        $this->assertSame('injected:parser', (string) $result);
    }

    #[Test]
    public function it_empty_string_returns_empty_style(): void
    {
        $atomic = new Atomic;

        $result = $atomic->parse('');

        $this->assertSame('', (string) $result);
    }

    #[Test]
    public function it_whitespace_only_returns_empty_style(): void
    {
        $atomic = new Atomic;

        $result = $atomic->parse('   ');

        $this->assertSame('', (string) $result);
    }

    #[Test]
    public function it_parses_background_text_padding_combo(): void
    {
        $atomic = new Atomic;

        $result = $atomic->parse('bg-red text-white p-4');

        $this->assertStringContainsString('background-color:#ef4444', (string) $result);
        $this->assertStringContainsString('color:#ffffff', (string) $result);
        $this->assertStringContainsString('padding:16px', (string) $result);
    }

    #[Test]
    public function it_parses_typography_combo(): void
    {
        $atomic = new Atomic;

        $result = $atomic->parse('text-lg font-bold');

        $this->assertStringContainsString('font-size:18px', (string) $result);
        $this->assertStringContainsString('font-weight:700', (string) $result);
    }

    #[Test]
    public function it_parses_border_combo(): void
    {
        $atomic = new Atomic;

        $result = $atomic->parse('border rounded-lg');

        $this->assertStringContainsString('border-width:1px', (string) $result);
        $this->assertStringContainsString('border-style:solid', (string) $result);
        $this->assertStringContainsString('8px', (string) $result);
    }

    #[Test]
    public function it_parses_sizing_combo(): void
    {
        $atomic = new Atomic;

        $result = $atomic->parse('w-full max-w-[600px]');

        $this->assertStringContainsString('width:100%', (string) $result);
        $this->assertStringContainsString('max-width:600px', (string) $result);
    }
}
