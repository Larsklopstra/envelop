---
title: Introduction
description: Learn what Envelop is and how it simplifies email template development in Laravel
---

# Introduction

Envelop is a Laravel package that makes creating email templates simple and maintainable. It combines Blade components with atomic CSS utilities to give you a powerful, email-client compatible templating system.

## What is Envelop

Envelop provides two core features that work together seamlessly:

**Email-Safe Components**: 15 Blade components specifically designed for email clients. Each component handles the complexity of table-based layouts and inline styling so you don't have to.

**Atomic CSS System**: A Tailwind-inspired utility class system that compiles to inline styles. Write familiar classes like `bg-blue-500` and `p-4` without worrying about email client compatibility.

## Key Features

### Atomic CSS for Email

Use utility classes you already know from Tailwind, but optimized for email:

```blade
<x-envelop::button href="https://example.com" class="bg-blue-500 text-white px-8 py-4 rounded-lg">
  Click Here
</x-envelop::button>
```

The atomic CSS system automatically converts these classes to inline styles that work across all email clients.

### Email-Safe Components

Every component is built with email compatibility in mind:

- Table-based layouts for consistent rendering
- Inline styles for maximum compatibility
- Semantic HTML where email clients support it
- Tested across Gmail, Outlook, Apple Mail, and more

### Laravel Integration

Envelop integrates seamlessly with Laravel's mail system:

```php
use Illuminate\Mail\Mailable;

class WelcomeEmail extends Mailable
{
    public function build()
    {
        return $this->view('emails.welcome');
    }
}
```

Use Envelop components in your mail views just like regular Blade components.

### Extensible Architecture

Customize Envelop to match your needs:

- **Themes**: Define your own color palettes and design tokens
- **Rules**: Create custom utility class patterns
- **Presets**: Package themes and rules together for reuse
- **Parsers**: Implement custom class parsing logic

## Why Envelop

**Email Client Compatibility**: Building emails that look good everywhere is hard. Envelop handles the complexity of table layouts, inline styles, and client-specific quirks for you.

**Developer Experience**: Write clean, readable Blade templates instead of wrestling with nested tables and style attributes. The atomic CSS system feels familiar if you've used Tailwind.

**Maintainability**: Component-based architecture makes templates easier to update and reuse. Change your design tokens in one place to update all emails.

**Laravel Native**: Built specifically for Laravel. No build tools, no JavaScript, just Blade components that work with your existing mail system.

## How It Works

1. **Write Blade**: Use Envelop components in your mail views with atomic CSS classes
2. **Compile**: The `atomic()` helper parses utility classes and generates inline styles
3. **Render**: Laravel renders your template with all styles inlined for email clients

## Complete Example

Here's a full welcome email demonstrating Envelop's component hierarchy and utility classes:

```blade
<x-envelop::html>
  <x-envelop::head title="Welcome to Our Service" />
  <x-envelop::body class="bg-slate-100">
    <x-envelop::preview>
      Welcome! Get started with these quick tips.
    </x-envelop::preview>

    <x-envelop::container class="bg-white">
      {{-- Header --}}
      <x-envelop::section class="bg-blue-600 p-8">
        <x-envelop::heading as="h1" class="text-white text-3xl font-bold text-center">
          Welcome to Envelop
        </x-envelop::heading>
        <x-envelop::text class="text-blue-100 text-center mt-2">
          Start building beautiful emails today
        </x-envelop::text>
      </x-envelop::section>

      {{-- Content --}}
      <x-envelop::section class="p-8">
        <x-envelop::text class="text-slate-700 mb-4">
          Thanks for joining us! We're excited to have you on board.
        </x-envelop::text>

        {{-- Two-Column Layout --}}
        <x-envelop::row>
          <x-envelop::column class="w-1/2 p-4 border-r border-slate-200">
            <x-envelop::heading as="h2" class="text-lg font-semibold mb-2">
              Documentation
            </x-envelop::heading>
            <x-envelop::text class="text-sm text-slate-600">
              Learn how to use all features with our guides.
            </x-envelop::text>
          </x-envelop::column>

          <x-envelop::column class="w-1/2 p-4">
            <x-envelop::heading as="h2" class="text-lg font-semibold mb-2">
              Support
            </x-envelop::heading>
            <x-envelop::text class="text-sm text-slate-600">
              Our team is ready to help you succeed.
            </x-envelop::text>
          </x-envelop::column>
        </x-envelop::row>

        {{-- Call to Action --}}
        <x-envelop::section class="text-center mt-8">
          <x-envelop::button
            href="https://example.com/get-started"
            class="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold"
          >
            Get Started Now
          </x-envelop::button>
        </x-envelop::section>
      </x-envelop::section>

      {{-- Footer --}}
      <x-envelop::section class="bg-slate-50 p-8 border-t border-slate-200">
        <x-envelop::text class="text-xs text-slate-500 text-center">
          © 2025 Your Company. All rights reserved.
        </x-envelop::text>
      </x-envelop::section>
    </x-envelop::container>
  </x-envelop::body>
</x-envelop::html>
```

This example demonstrates:
- **Component hierarchy**: Html → Head → Body → Container → Section → Row → Column
- **Utility classes**: Colors (`bg-blue-600`), spacing (`p-8`), typography (`text-3xl`), borders (`border-r`)
- **Layout components**: Row and Column for multi-column layouts
- **Content components**: Heading, Text, Button for actual content
- **Utility components**: Preview for email client preview text

## Next Steps

Ready to get started? [Install Envelop](/overview/installation) in your Laravel project and start building email templates.
