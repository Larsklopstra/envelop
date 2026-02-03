<?php

namespace LarsKlopstra\Envelop\Tests\Atomic\Parsers;

use LarsKlopstra\Envelop\Atomic\Parsers\DefaultParser;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Rule;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;
use LarsKlopstra\Envelop\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class DefaultParserTest extends TestCase
{
    private DefaultParser $parser;

    private Theme $theme;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = new DefaultParser;
        $this->theme = new Theme([]);
    }

    #[Test]
    public function it_parses_single_class_name(): void
    {
        $rules = [
            new Rule('/^red$/', new Style(['color' => 'red'])),
        ];

        $result = $this->parser->parse($this->theme, $rules, 'red');

        $this->assertSame('color:red', (string) $result);
    }

    #[Test]
    public function it_parses_multiple_space_separated_classes(): void
    {
        $rules = [
            new Rule('/^red$/', new Style(['color' => 'red'])),
            new Rule('/^bold$/', new Style(['font-weight' => 'bold'])),
        ];

        $result = $this->parser->parse($this->theme, $rules, 'red bold');

        $this->assertStringContainsString('color:red', (string) $result);
        $this->assertStringContainsString('font-weight:bold', (string) $result);
    }

    #[Test]
    public function it_skips_empty_strings_from_multiple_spaces(): void
    {
        $rules = [
            new Rule('/^red$/', new Style(['color' => 'red'])),
        ];

        $result = $this->parser->parse($this->theme, $rules, 'red  ');

        $this->assertSame('color:red', (string) $result);
    }

    #[Test]
    public function it_returns_empty_style_when_no_rules_match(): void
    {
        $rules = [
            new Rule('/^red$/', new Style(['color' => 'red'])),
        ];

        $result = $this->parser->parse($this->theme, $rules, 'blue');

        $this->assertSame('', (string) $result);
    }

    #[Test]
    public function it_first_matching_rule_wins(): void
    {
        $rules = [
            new Rule('/^color$/', new Style(['color' => 'first'])),
            new Rule('/^color$/', new Style(['color' => 'second'])),
        ];

        $result = $this->parser->parse($this->theme, $rules, 'color');

        $this->assertSame('color:first', (string) $result);
    }

    #[Test]
    public function it_callable_rules_receive_theme_and_matches(): void
    {
        $theme = new Theme(['colors' => ['red' => '#ff0000']]);
        $rules = [
            new Rule(
                '/^bg-(?<color>[a-z]+)$/',
                fn (Theme $t, array $m) => new Style([
                    'background' => $t->getFlattened('colors')[$m['color']] ?? null,
                ])
            ),
        ];

        $result = $this->parser->parse($theme, $rules, 'bg-red');

        $this->assertSame('background:#ff0000', (string) $result);
    }

    #[Test]
    public function it_static_style_rules_used_directly(): void
    {
        $rules = [
            new Rule('/^block$/', new Style(['display' => 'block'])),
        ];

        $result = $this->parser->parse($this->theme, $rules, 'block');

        $this->assertSame('display:block', (string) $result);
    }

    #[Test]
    public function it_null_returning_rules_continue_to_next_rule(): void
    {
        $rules = [
            new Rule('/^text-(?<value>.+)$/', fn () => null),
            new Rule('/^text-(?<value>.+)$/', new Style(['color' => 'fallback'])),
        ];

        $result = $this->parser->parse($this->theme, $rules, 'text-red');

        $this->assertSame('color:fallback', (string) $result);
    }

    #[Test]
    public function it_parses_class_names_without_caching(): void
    {
        $callCount = 0;
        $rules = [
            new Rule('/^red$/', function () use (&$callCount) {
                $callCount++;

                return new Style(['color' => 'red']);
            }),
        ];

        $this->parser->parse($this->theme, $rules, 'red');
        $this->parser->parse($this->theme, $rules, 'red');

        $this->assertSame(2, $callCount);
    }

    #[Test]
    public function it_same_class_parsed_twice_returns_same_result(): void
    {
        $rules = [
            new Rule('/^red$/', new Style(['color' => 'red'])),
        ];

        $result1 = $this->parser->parse($this->theme, $rules, 'red');
        $result2 = $this->parser->parse($this->theme, $rules, 'red');

        $this->assertSame((string) $result1, (string) $result2);
    }

    #[Test]
    public function it_different_classes_maintain_separate_cache_entries(): void
    {
        $rules = [
            new Rule('/^red$/', new Style(['color' => 'red'])),
            new Rule('/^blue$/', new Style(['color' => 'blue'])),
        ];

        $result1 = $this->parser->parse($this->theme, $rules, 'red');
        $result2 = $this->parser->parse($this->theme, $rules, 'blue');

        $this->assertSame('color:red', (string) $result1);
        $this->assertSame('color:blue', (string) $result2);
    }
}
