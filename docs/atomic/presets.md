---
title: Presets
description: Extend Envelop with custom utility classes
---

# Presets

Presets in Envelop package together parsing rules and themes into reusable modules. Create custom presets to extend Envelop with your own utility classes or brand-specific design systems.

## What are Presets

A preset is a class that implements the `Preset` interface and provides:

1. **Rules**: Regex patterns that match utility class names and generate CSS
2. **Theme**: Design tokens that rules can reference

## Preset Interface

```php
namespace LarsKlopstra\Envelop\Atomic\Contracts;

use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

interface Preset
{
    /**
     * Get all parsing rules for this preset.
     *
     * @return array<int, Rule>
     */
    public function getRules(): array;

    /**
     * Get the theme configuration for this preset.
     */
    public function getTheme(): Theme;
}
```

## Basic Preset Structure

A preset must implement two methods:

```php
use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Rule;

class MyPreset implements Preset
{
    public function getRules(): array
    {
        return [
            // Array of Rule objects
        ];
    }

    public function getTheme(): Theme
    {
        return new Theme([
            // Theme configuration array
        ]);
    }
}
```

## The DefaultPreset

Envelop ships with `DefaultPreset`, which provides all the standard Tailwind-inspired utilities documented in the [Rules](/atomic/rules) section.

The DefaultPreset includes:
- Complete Tailwind color palette
- Typography utilities (sizes, weights, alignment)
- Spacing (padding, margin)
- Sizing (width, height)
- Borders and radius
- Display, opacity, shadows
- Arbitrary value support

```php
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

$preset = new DefaultPreset();
$rules = $preset->getRules();    // 100+ parsing rules
$theme = $preset->getTheme();    // Full design token system
```

## Brand Preset Example

Create a preset for your company brand:

```php
use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

class AcmeBrandPreset implements Preset
{
    public function getRules(): array
    {
        // Inherit all default rules
        return (new DefaultPreset())->getRules();
    }

    public function getTheme(): Theme
    {
        return new Theme([
            'colors' => [
                'brand' => [
                    'primary' => '#ff6b6b',
                    'secondary' => '#4ecdc4',
                    'accent' => '#ffe66d',
                    'dark' => '#2d3436',
                    'light' => '#f8f9fa',
                ],
            ],
            'fontSize' => [
                'brand-title' => ['36px', '44px'],
                'brand-subtitle' => ['24px', '32px'],
                'brand-body' => ['16px', '24px'],
            ],
            'fontFamily' => [
                'brand' => '"Helvetica Neue", Helvetica, Arial, sans-serif',
            ],
        ]);
    }
}
```

Use brand utilities in your emails:

```blade
<x-envelop::heading class="text-brand-title text-brand-primary font-brand">
  Welcome to Acme
</x-envelop::heading>

<x-envelop::button class="bg-brand-primary text-white">
  Get Started
</x-envelop::button>
```

## Custom Utility Example

Add a custom spacing utility that uses your own scale:

```php
class CustomSpacingPreset implements Preset
{
    public function getRules(): array
    {
        return [
            new Rule(
                pattern: '/^space-(?<value>[a-z]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'padding' => $theme->getFlattened('customSpacing')[$matches['value']] ?? null,
                ]),
            ),
        ];
    }

    public function getTheme(): Theme
    {
        return new Theme([
            'customSpacing' => [
                'xs' => '8px',
                'sm' => '16px',
                'md' => '24px',
                'lg' => '32px',
                'xl' => '48px',
            ],
        ]);
    }
}
```

Usage:

```blade
<x-envelop::section class="space-md">
  24px padding
</x-envelop::section>
```

## Creating Custom Utility Rules

Add completely new utility classes to your preset:

```php
use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Rule;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Style;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

class CustomUtilitiesPreset implements Preset
{
    public function getRules(): array
    {
        return [
            // Include default rules
            ...(new DefaultPreset())->getRules(),

            // Add custom "card" utility
            new Rule(
                pattern: '/^card$/',
                style: new Style([
                    'background-color' => '#ffffff',
                    'border' => '1px solid #e5e7eb',
                    'border-radius' => '8px',
                    'padding' => '24px',
                    'box-shadow' => '0 1px 3px rgba(0, 0, 0, 0.1)',
                ]),
            ),

            // Add custom "button-lg" utility
            new Rule(
                pattern: '/^button-lg$/',
                style: new Style([
                    'padding' => '16px 32px',
                    'font-size' => '18px',
                    'font-weight' => '600',
                    'border-radius' => '8px',
                ]),
            ),

            // Add responsive spacing utility
            new Rule(
                pattern: '/^space-(?<size>[a-z]+)$/',
                style: fn (Theme $theme, array $matches) => new Style([
                    'padding' => match ($matches['size']) {
                        'compact' => '8px',
                        'cozy' => '16px',
                        'comfortable' => '24px',
                        'spacious' => '32px',
                        default => null,
                    },
                ]),
            ),
        ];
    }

    public function getTheme(): Theme
    {
        return new Theme([]);
    }
}
```

Usage:

```blade
<x-envelop::section class="card">
  <x-envelop::text>Card-styled section</x-envelop::text>
</x-envelop::section>

<x-envelop::button class="button-lg bg-blue-600 text-white">
  Large Button
</x-envelop::button>

<x-envelop::section class="space-comfortable">
  Comfortable padding
</x-envelop::section>
```

## Combining Multiple Presets

Use multiple presets together by passing an array to the `Atomic` class:

```php
use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

$atomic = new Atomic([
    new DefaultPreset(),       // Standard utilities
    new AcmeBrandPreset(),     // Brand colors
    new CustomSpacingPreset(), // Custom spacing
]);
```

Presets are processed in order:
- **Rules are concatenated**: All rules from all presets are available (later rules don't override earlier ones)
- **Themes are merged**: Later themes override earlier ones

## Theme Merging Mechanics

When combining presets, themes are deeply merged:

```php
class BasePreset implements Preset
{
    public function getRules(): array { return []; }

    public function getTheme(): Theme
    {
        return new Theme([
            'colors' => [
                'blue' => ['500' => '#3b82f6'],
                'red' => ['500' => '#ef4444'],
            ],
        ]);
    }
}

class BrandPreset implements Preset
{
    public function getRules(): array { return []; }

    public function getTheme(): Theme
    {
        return new Theme([
            'colors' => [
                'blue' => ['500' => '#custom-blue'],  // Overrides base
                'brand' => ['primary' => '#ff0000'],   // Adds new color
            ],
        ]);
    }
}

// Combined theme:
// 'colors' => [
//     'blue' => ['500' => '#custom-blue'],    // Overridden
//     'red' => ['500' => '#ef4444'],          // From base
//     'brand' => ['primary' => '#ff0000'],    // From brand
// ]
```

## Rule Anatomy

Understanding Rule objects:

```php
new Rule(
    pattern: '/^bg-(?<color>[a-z0-9-]+)$/',
    style: function (Theme $theme, array $matches) {
        return new Style([
            'background-color' => $theme->getFlattened('colors')[$matches['color']] ?? null,
        ]);
    },
)
```

**pattern**: Regex with named capture groups
- Matches utility class names
- Use `(?<name>...)` for capturing values
- Example: `/^p-(?<value>[0-9]+)$/` matches `p-4`, `p-8`

**style**: Closure or Style object
- Receives `Theme` and regex `$matches`
- Returns `Style` object or `null` if invalid
- Return `null` when theme lookup fails

### Static vs Dynamic Rules

Static rules always return the same styles:

```php
new Rule(
    pattern: '/^border$/',
    style: new Style([
        'border-width' => '1px',
        'border-style' => 'solid',
    ]),
)
```

Dynamic rules look up values from the theme:

```php
new Rule(
    pattern: '/^text-(?<size>[a-z0-9]+)$/',
    style: fn (Theme $theme, array $matches) => new Style([
        'font-size' => $theme->getFlattened('fontSize')[$matches['size']] ?? null,
    ]),
)
```

## Multi-Property Rules

A single rule can set multiple CSS properties:

```php
new Rule(
    pattern: '/^card$/',
    style: new Style([
        'background-color' => '#ffffff',
        'border' => '1px solid #e5e7eb',
        'border-radius' => '8px',
        'padding' => '24px',
        'box-shadow' => '0 1px 3px rgba(0, 0, 0, 0.1)',
    ]),
)
```

Now `class="card"` applies all those styles at once.

## Registering Presets Globally

Register your presets in a service provider to make them available across your entire application:

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;
use App\Envelop\Presets\AcmeBrandPreset;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Atomic::class, function () {
            return new Atomic([
                new DefaultPreset(),
                new AcmeBrandPreset(),
            ]);
        });
    }
}
```

Now all emails in your application will use your brand preset.

## Email-Safe Custom Utilities

When creating custom utilities for email, keep these guidelines in mind:

### Safe Properties

Stick to well-supported CSS properties:
- `background-color`, `color`
- `padding`, `margin`
- `width`, `height`, `max-width`
- `font-size`, `font-weight`, `font-family`
- `text-align`, `line-height`
- `border` (solid borders work best)
- `border-radius` (with caution - inconsistent in Outlook 2007-2019)

### Properties to Avoid

Properties with poor email client support:
- `display: flex`, `display: grid` - Not supported in email
- `position: absolute`, `position: fixed` - Not supported
- `box-shadow` - Stripped by Outlook 2007-2019
- `opacity` - Not supported in Outlook 2007-2019
- CSS variables - Not supported in most email clients
- Transforms and animations - Not supported
- Complex gradients - Very limited support
- Pseudo-classes (`:hover`, `:focus`, `:active`) - Not supported

See the [Rules documentation](/atomic/rules#microsoft-outlook-mso-compatibility) for more details on email client limitations.

### Table-Based Layouts

For complex layouts, use components instead of utility classes:

```blade
<!-- Good: Use Row/Column components -->
<x-envelop::row>
  <x-envelop::column class="w-1/2">Left</x-envelop::column>
  <x-envelop::column class="w-1/2">Right</x-envelop::column>
</x-envelop::row>

<!-- Avoid: Flexbox utilities (poor email support) -->
<div class="flex">...</div>
```

## Testing Your Preset

Test your custom preset:

```php
use LarsKlopstra\Envelop\Atomic\Atomic;

$atomic = new Atomic([new MyPreset()]);

$styles = $atomic->parse('my-custom-class');
echo (string) $styles;  // See the generated inline CSS
```

Send a test email to verify rendering in actual email clients.

## Best Practices

**Extend, don't replace**: Include `DefaultPreset` unless you're building a completely custom system.

```php
// Good: Extends defaults
public function getRules(): array
{
    return [
        ...(new DefaultPreset())->getRules(),
        // Your custom rules
    ];
}
```

**Keep rules simple**: Complex regex patterns are hard to maintain. Keep utility classes predictable.

**Theme-driven**: Use theme lookups instead of hardcoding values. This makes customization easier.

**Document your utilities**: If others will use your preset, document which classes are available.

**Test in email clients**: Always test custom utilities in Gmail, Outlook, and Apple Mail before deploying.

**Namespace custom classes**: Use prefixes for custom utilities to avoid conflicts.

```php
new Rule(pattern: '/^acme-card$/', ...),
new Rule(pattern: '/^acme-button$/', ...),
```

**Keep email compatibility in mind**: Only add utilities that work in email clients. Avoid `display: flex`, `transform`, `backdrop-filter`, and other properties with poor email support.

## Next Steps

- [Learn about the Parser interface](/atomic/parser) for advanced customization
- [Explore Themes](/atomic/themes) for design token configuration
- [Review Rules](/atomic/rules) to see available default utilities
- [Explore components](/components/html) to see presets in action
- Review the [DefaultPreset source](https://github.com/larsklopstra/envelop/blob/master/src/Atomic/Presets/DefaultPreset.php) for implementation examples
