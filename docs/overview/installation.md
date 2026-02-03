---
title: Installation
description: Get started with Envelop in your Laravel project
---

# Installation

Get Envelop up and running in your Laravel application in just a few steps.

## Requirements

- PHP 8.2 or higher
- Laravel 12.0 or higher

## Install via Composer

Install Envelop using Composer:

```bash
composer require larsklopstra/envelop
```

Laravel's package auto-discovery will automatically register the Envelop service provider.

## Component Registration

Envelop components are automatically available in your Blade views with the `envelop::` prefix:

```blade
<x-envelop::html>
  <x-envelop::head title="Welcome" />
  <x-envelop::body>
    <!-- Your email content -->
  </x-envelop::body>
</x-envelop::html>
```

## Basic Usage

Create a new Mailable class:

```bash
php artisan make:mail WelcomeEmail
```

In your Mailable class (`app/Mail/WelcomeEmail.php`):

```php
<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class WelcomeEmail extends Mailable
{
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Our Service',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }
}
```

Create your email view (`resources/views/emails/welcome.blade.php`):

```blade
<x-envelop::html>
  <x-envelop::head title="Welcome" />
  <x-envelop::body>
    <x-envelop::container>
      <x-envelop::section class="bg-white p-8">
        <x-envelop::heading as="h1" class="text-slate-900 mb-4">
          Welcome to Our Service!
        </x-envelop::heading>

        <x-envelop::text class="text-slate-700 mb-6">
          Thanks for signing up. We're excited to have you on board.
        </x-envelop::text>

        <x-envelop::button
          href="https://example.com/get-started"
          class="bg-blue-600 text-white px-8 py-4 rounded-lg"
        >
          Get Started
        </x-envelop::button>
      </x-envelop::section>
    </x-envelop::container>
  </x-envelop::body>
</x-envelop::html>
```

Send your email:

```php
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

Mail::to('user@example.com')->send(new WelcomeEmail());
```

## What's Next

Now that Envelop is installed, explore what you can do:

- [Learn about atomic CSS](/atomic/introduction) and available utility classes
- [Browse components](/components/html) to see what's available
- [Customize themes](/atomic/themes) to match your brand
- [Create custom presets](/atomic/presets) for reusable designs

## Verification

To verify Envelop is working, send a test email using the example above. The email should render with inline styles and work across all major email clients.

If you encounter any issues, check that:
- You're using PHP 8.2+ and Laravel 12.0+
- The package was installed successfully with Composer
- Your views are using the `x-envelop::` component prefix
