# Envelop

[![Latest Version on Packagist](https://img.shields.io/packagist/v/larsklopstra/envelop.svg?style=flat-square)](https://packagist.org/packages/larsklopstra/envelop)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/larsklopstra/envelop/tests.yml?branch=master&label=tests&style=flat-square)](https://github.com/larsklopstra/envelop/actions?query=workflow%3Atests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/larsklopstra/envelop.svg?style=flat-square)](https://packagist.org/packages/larsklopstra/envelop)

Create beautiful, email-client compatible templates using Laravel Blade components and Tailwind-inspired atomic CSS utility classes. Envelop makes email development simple and maintainable.

## Features

- **📧 Email-Safe Components** - 15 Blade components designed for universal email client compatibility
- **🎨 Atomic CSS System** - Tailwind-inspired utility classes that compile to inline styles
- **🔗 Laravel Integration** - Works seamlessly with Laravel Mail, zero configuration needed
- **✨ Extensible Architecture** - Create custom themes, rules, and presets to match your brand
- **💻 Clean Blade Syntax** - Write maintainable templates without managing nested tables
- **✅ Battle-Tested** - Compatible with Gmail, Outlook, Apple Mail, and other major clients

## Requirements

- PHP 8.2 or higher
- Laravel 12.0 or higher

## Installation

Install Envelop via Composer:

```bash
composer require larsklopstra/envelop
```

Laravel's package auto-discovery will automatically register the service provider.

## Quick Start

Create a welcome email template:

```blade
<x-envelop::html>
  <x-envelop::head title="Welcome" />
  <x-envelop::body class="bg-slate-100">
    <x-envelop::container class="bg-white">
      <x-envelop::section class="bg-blue-600 p-8">
        <x-envelop::heading as="h1" class="text-white text-3xl font-bold text-center">
          Welcome to Our Service
        </x-envelop::heading>
      </x-envelop::section>

      <x-envelop::section class="p-8">
        <x-envelop::text class="text-slate-700 mb-6">
          Thanks for signing up! We're excited to have you on board.
        </x-envelop::text>

        <x-envelop::button
          href="https://example.com/get-started"
          class="bg-blue-600 text-white px-8 py-4 rounded-lg"
        >
          Get Started Now
        </x-envelop::button>
      </x-envelop::section>

      <x-envelop::section class="bg-slate-50 p-8 border-t border-slate-200">
        <x-envelop::text class="text-xs text-slate-500 text-center">
          © 2026 Your Company. All rights reserved.
        </x-envelop::text>
      </x-envelop::section>
    </x-envelop::container>
  </x-envelop::body>
</x-envelop::html>
```

The atomic CSS classes automatically convert to inline styles for maximum email client compatibility.

## Available Components

Envelop provides 15 email-safe components:

- `<x-envelop::html>` - Document root with email client doctype
- `<x-envelop::head>` - Document head with meta tags
- `<x-envelop::body>` - Body wrapper with base styles
- `<x-envelop::container>` - Centered content container
- `<x-envelop::section>` - Content section with table layout
- `<x-envelop::row>` - Multi-column row container
- `<x-envelop::column>` - Column for layouts
- `<x-envelop::heading>` - Responsive headings (h1-h6)
- `<x-envelop::text>` - Paragraph text
- `<x-envelop::button>` - Call-to-action button
- `<x-envelop::link>` - Text link
- `<x-envelop::img>` - Responsive image
- `<x-envelop::hr>` - Horizontal rule
- `<x-envelop::preview>` - Email preview text
- `<x-envelop::font>` - Custom font integration

## Atomic CSS Classes

Use familiar Tailwind-like utility classes that compile to email-safe inline styles:

```blade
<!-- Colors -->
<x-envelop::text class="text-blue-600 bg-slate-100">

<!-- Spacing -->
<x-envelop::section class="p-8 mx-4 mb-6">

<!-- Typography -->
<x-envelop::heading class="text-3xl font-bold text-center">

<!-- Borders -->
<x-envelop::section class="border border-slate-200 rounded-lg">

<!-- Sizing -->
<x-envelop::column class="w-1/2">
```

## Documentation

For complete documentation, including:
- Detailed component API
- Full atomic CSS reference
- Custom themes and presets
- Advanced usage examples

Visit [https://github.com/larsklopstra/envelop](https://github.com/larsklopstra/envelop)

## Testing

Run the test suite:

```bash
composer test
```

Run code style checks:

```bash
composer format
```

## Changelog

Please see the [releases page](https://github.com/larsklopstra/envelop/releases) for information on recent changes.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Security

If you discover any security-related issues, please email lars@klopstra.me instead of using the issue tracker.

## Credits

- [Lars Klopstra](https://github.com/larsklopstra)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
