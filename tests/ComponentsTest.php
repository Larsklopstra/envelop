<?php

namespace LarsKlopstra\Envelop\Tests;

use Illuminate\Support\Facades\Blade;
use LarsKlopstra\Envelop\EnvelopServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use PHPUnit\Framework\Attributes\Test;

class ComponentsTest extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            EnvelopServiceProvider::class,
        ];
    }

    #[Test]
    public function it_renders_html_component(): void
    {
        $html = Blade::render('<x-envelop::html lang="en" dir="ltr">Content</x-envelop::html>');

        $this->assertStringContainsString('<!DOCTYPE html PUBLIC', $html);
        $this->assertStringContainsString('lang="en"', $html);
        $this->assertStringContainsString('dir="ltr"', $html);
    }

    #[Test]
    public function it_renders_head_component(): void
    {
        $html = Blade::render('<x-envelop::head title="Test Email" />');

        $this->assertStringContainsString('<title>Test Email</title>', $html);
        $this->assertStringContainsString('charset=UTF-8', $html);
        $this->assertStringContainsString('x-apple-disable-message-reformatting', $html);
    }

    #[Test]
    public function it_renders_body_component_with_atomic_styles(): void
    {
        $html = Blade::render('<x-envelop::body class="bg-white">Body content</x-envelop::body>');

        $this->assertStringContainsString('<body', $html);
        $this->assertStringContainsString('margin:0', $html);
        $this->assertStringContainsString('padding:0', $html);
        $this->assertStringContainsString('width:100%', $html);
        $this->assertStringContainsString('background-color:#ffffff', $html);
    }

    #[Test]
    public function it_renders_preview_component(): void
    {
        $html = Blade::render('<x-envelop::preview text="This is a preview text" />');

        $this->assertStringContainsString('This is a preview text', $html);
        $this->assertStringContainsString('display:none', $html);
        $this->assertStringContainsString('opacity:0', $html);
    }

    #[Test]
    public function it_renders_container_component(): void
    {
        $html = Blade::render('<x-envelop::container>Container content</x-envelop::container>');

        $this->assertStringContainsString('<table', $html);
        $this->assertStringContainsString('max-width:37.5em', $html);
        $this->assertStringContainsString('margin:0 auto', $html);
    }

    #[Test]
    public function it_renders_button_component_with_styles(): void
    {
        $html = Blade::render('<x-envelop::button href="https://example.com" target="_blank" class="bg-blue-500 text-white px-6 py-3">Click me</x-envelop::button>');

        $this->assertStringContainsString('href="https://example.com"', $html);
        $this->assertStringContainsString('target="_blank"', $html);
        $this->assertStringContainsString('display:inline-block', $html);
        $this->assertStringContainsString('text-decoration:none', $html);
        $this->assertStringContainsString('background-color:#3b82f6', $html);
        $this->assertStringContainsString('color:#ffffff', $html);
    }

    #[Test]
    public function it_renders_heading_component_with_dynamic_tag(): void
    {
        $html = Blade::render('<x-envelop::heading as="h2" class="text-center">Hello World</x-envelop::heading>');

        $this->assertStringContainsString('<h2', $html);
        $this->assertStringContainsString('</h2>', $html);
        $this->assertStringContainsString('font-size:30px', $html);
        $this->assertStringContainsString('font-weight:700', $html);
        $this->assertStringContainsString('text-align:center', $html);
    }

    #[Test]
    public function it_renders_text_component(): void
    {
        $html = Blade::render('<x-envelop::text class="text-lg">This is some text</x-envelop::text>');

        $this->assertStringContainsString('<p', $html);
        $this->assertStringContainsString('font-size:18px', $html);
        $this->assertStringContainsString('line-height:28px', $html);
    }

    #[Test]
    public function it_renders_hr_component(): void
    {
        $html = Blade::render('<x-envelop::hr />');

        $this->assertStringContainsString('<hr', $html);
        $this->assertStringContainsString('border:none', $html);
        $this->assertStringContainsString('border-top:1px solid #eaeaea', $html);
    }

    #[Test]
    public function it_renders_img_component(): void
    {
        $html = Blade::render('<x-envelop::img src="https://example.com/image.png" alt="Test image" width="200" height="100" />');

        $this->assertStringContainsString('src="https://example.com/image.png"', $html);
        $this->assertStringContainsString('alt="Test image"', $html);
        $this->assertStringContainsString('width="200"', $html);
        $this->assertStringContainsString('height="100"', $html);
        $this->assertStringContainsString('display:block', $html);
    }

    #[Test]
    public function it_renders_link_component(): void
    {
        $html = Blade::render('<x-envelop::link href="mailto:test@example.com">Contact us</x-envelop::link>');

        $this->assertStringContainsString('href="mailto:test@example.com"', $html);
        $this->assertStringContainsString('color:#067df7', $html);
        $this->assertStringContainsString('text-decoration:none', $html);
    }

    #[Test]
    public function it_renders_section_component(): void
    {
        $html = Blade::render('<x-envelop::section class="px-6">Section content</x-envelop::section>');

        $this->assertStringContainsString('<table', $html);
        $this->assertStringContainsString('padding-left:24px', $html);
        $this->assertStringContainsString('padding-right:24px', $html);
    }

    #[Test]
    public function it_renders_row_component(): void
    {
        $html = Blade::render('<x-envelop::row><td>Column</td></x-envelop::row>');

        $this->assertStringContainsString('<table', $html);
        $this->assertStringContainsString('<tr>', $html);
        $this->assertStringContainsString('width:100%', $html);
    }

    #[Test]
    public function it_renders_column_component(): void
    {
        $html = Blade::render('<x-envelop::column class="text-center">Column content</x-envelop::column>');

        $this->assertStringContainsString('<td', $html);
        $this->assertStringContainsString('text-align:center', $html);
    }

    #[Test]
    public function it_renders_font_component_without_web_font(): void
    {
        $html = Blade::render('<x-envelop::font fontFamily="Arial" fallback="sans-serif" />');

        $this->assertStringContainsString('font-family: Arial, sans-serif', $html);
        $this->assertStringContainsString('<style type="text/css">', $html);
    }

    #[Test]
    public function it_renders_font_component_with_web_font(): void
    {
        $html = Blade::render('<x-envelop::font fontFamily="Roboto" fallback="Arial, sans-serif" webFont="https://fonts.googleapis.com/css2?family=Roboto" />');

        $this->assertStringContainsString('https://fonts.googleapis.com/css2?family=Roboto', $html);
        $this->assertStringContainsString('<!--[if mso]>', $html);
        $this->assertStringContainsString('<!--[if !mso]><!-->', $html);
    }
}
