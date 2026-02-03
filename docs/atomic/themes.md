---
title: Themes
description: Customize design tokens and color palettes
---

# Themes

Themes in Envelop define the design tokens used by utility classes. Customize colors, spacing, typography, and more to match your brand.

## What are Themes

A theme is a collection of design tokens that utility classes reference. For example, when you use `bg-blue-500`, Envelop looks up `colors.blue.500` in the theme to get `#3b82f6`.

Themes are defined as associative arrays with nested values:

```php
new Theme([
    'colors' => [
        'blue' => [
            '500' => '#3b82f6',
            '600' => '#2563eb',
        ],
    ],
    'spacing' => [
        '4' => '16px',
        '8' => '32px',
    ],
])
```

## Default Theme

Envelop includes a comprehensive default theme with Tailwind's color palette and design tokens. It provides:

### Colors

Full Tailwind color palette with all shades (50-950):
- Grays: slate, gray, zinc, neutral, stone
- Colors: red, orange, amber, yellow, lime, green, emerald, teal, cyan, sky, blue, indigo, violet, purple, fuchsia, pink, rose
- Base: white, black, transparent

### Typography

```php
'fontSize' => [
    'xs' => ['12px', '16px'],    // [font-size, line-height]
    'sm' => ['14px', '20px'],
    'base' => ['16px', '24px'],
    'lg' => ['18px', '28px'],
    // ... up to 9xl
],

'fontFamily' => [
    'sans' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, ...',
    'serif' => 'ui-serif, Georgia, Cambria, "Times New Roman", Times, serif',
    'mono' => 'ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, ...',
],
```

**Web Fonts**: Email clients have very limited support for `@font-face` and `@import` declarations. Always provide fallback system fonts in your font stack. Envelop does not support web font loading for email compatibility reasons.

```php

'fontWeight' => [
    'thin' => '100',
    'normal' => '400',
    'bold' => '700',
    // ... all weights
],

'lineHeight' => [
    'none' => '1',
    'tight' => '1.25',
    'normal' => '1.5',
    'relaxed' => '1.625',
    'loose' => '2',
    // ... plus fixed pixel values
],

'letterSpacing' => [
    'tighter' => '-0.8px',
    'tight' => '-0.4px',
    'normal' => '0px',
    'wide' => '0.4px',
    'wider' => '0.8px',
    'widest' => '1.6px',
],
```

### Spacing & Sizing

```php
'size' => [
    '0' => '0px',
    '1' => '4px',
    '2' => '8px',
    '4' => '16px',
    '8' => '32px',
    // ... up to 96 (384px)
    'full' => '100%',
    '1/2' => '50%',
    '1/3' => '33.333333%',
    // ... fractional percentages
],
```

### Borders & Effects

```php
'borderWidth' => [
    '0' => '0px',
    'DEFAULT' => '1px',
    '2' => '2px',
    '4' => '4px',
    '8' => '8px',
],

'borderRadius' => [
    'none' => '0px',
    'sm' => '2px',
    'DEFAULT' => '4px',
    'lg' => '8px',
    'full' => '9999px',
    // ... all sizes
],

'boxShadow' => [
    'sm' => '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
    'DEFAULT' => '0 1px 3px 0 rgba(0, 0, 0, 0.1), ...',
    // ... all shadow sizes
],

'opacity' => [
    '0' => '0',
    '50' => '0.5',
    '100' => '1',
    // ... 5% increments
],
```

## Creating Custom Themes

Define your own theme for brand-specific colors and tokens:

```php
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

$brandTheme = new Theme([
    'colors' => [
        'brand' => [
            'primary' => '#ff6b6b',
            'secondary' => '#4ecdc4',
            'accent' => '#ffe66d',
        ],
        'gray' => [
            '100' => '#f7f7f7',
            '500' => '#6c757d',
            '900' => '#212529',
        ],
    ],
    'fontSize' => [
        'body' => ['16px', '24px'],
        'heading' => ['32px', '40px'],
    ],
]);
```

Use your theme with the Atomic class:

```php
use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

// Create a preset with your theme
class BrandPreset implements Preset
{
    public function getTheme(): Theme
    {
        return new Theme([
            'colors' => [
                'brand' => [
                    'primary' => '#ff6b6b',
                ],
            ],
        ]);
    }

    public function getRules(): array
    {
        return (new DefaultPreset())->getRules();
    }
}

// Use it
$atomic = new Atomic([new BrandPreset()]);
```

## Merging Themes

Themes can be merged together, with later themes overriding earlier ones:

```php
$baseTheme = new Theme([
    'colors' => [
        'blue' => ['500' => '#3b82f6'],
        'red' => ['500' => '#ef4444'],
    ],
]);

$brandTheme = new Theme([
    'colors' => [
        'blue' => ['500' => '#custom-blue'],
        'brand' => ['primary' => '#ff6b6b'],
    ],
]);

$merged = $baseTheme->merge($brandTheme);
// Result:
// 'colors' => [
//     'blue' => ['500' => '#custom-blue'],  // Overridden
//     'red' => ['500' => '#ef4444'],        // Kept from base
//     'brand' => ['primary' => '#ff6b6b'],  // Added
// ]
```

When using multiple presets, Envelop automatically merges their themes in order:

```php
$atomic = new Atomic([
    new DefaultPreset(),
    new BrandPreset(),  // Overrides DefaultPreset values
]);
```

## Flattened Theme Values

The theme system flattens nested values for easy lookup. Nested keys are joined with hyphens:

```php
$theme = new Theme([
    'colors' => [
        'blue' => [
            '500' => '#3b82f6',
            '600' => '#2563eb',
        ],
    ],
]);

$flattened = $theme->getFlattened('colors');
// [
//     'blue-500' => '#3b82f6',
//     'blue-600' => '#2563eb',
// ]
```

This is how `bg-blue-500` gets resolved to `#3b82f6`.

### DEFAULT Values

Use `DEFAULT` as a key to define fallback values:

```php
'colors' => [
    'blue' => [
        '500' => '#3b82f6',
        'DEFAULT' => '#3b82f6',  // Used when no shade specified
    ],
],
```

Now both `bg-blue` and `bg-blue-500` resolve to the same color.

## Font Size Arrays

Font sizes can include both font-size and line-height as an array:

```php
'fontSize' => [
    'xl' => ['20px', '28px'],  // [font-size, line-height]
],
```

When you use `text-xl`, Envelop sets both properties:

```css
font-size: 20px;
line-height: 28px;
```

Single values work too:

```php
'fontSize' => [
    'custom' => '18px',  // Just font-size
],
```

## Brand-Specific Example

Complete example for a company brand:

```php
use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

class AcmePreset implements Preset
{
    public function getTheme(): Theme
    {
        return new Theme([
            'colors' => [
                'acme' => [
                    'red' => '#e63946',
                    'blue' => '#457b9d',
                    'yellow' => '#f1faee',
                    'dark' => '#1d3557',
                ],
            ],
            'fontSize' => [
                'display' => ['48px', '56px'],
                'title' => ['32px', '40px'],
                'body' => ['16px', '24px'],
                'small' => ['14px', '20px'],
            ],
            'fontFamily' => [
                'display' => '"Montserrat", sans-serif',
                'body' => '"Open Sans", sans-serif',
            ],
        ]);
    }

    public function getRules(): array
    {
        // Inherit all default rules
        return (new DefaultPreset())->getRules();
    }
}
```

Use in your emails:

```blade
<x-envelop::heading as="h1" class="font-display text-display text-acme-dark">
  Welcome to Acme Corp
</x-envelop::heading>

<x-envelop::text class="font-body text-body text-acme-blue">
  Thanks for joining us!
</x-envelop::text>

<x-envelop::button href="..." class="bg-acme-red text-acme-yellow">
  Get Started
</x-envelop::button>
```

## Accessing Theme Values

Within custom presets or parsers, access theme values:

```php
// Access nested value directly via properties
$color = $theme->properties['colors']['blue']['500'] ?? null;

// Get flattened values (converts nested keys to hyphenated format)
$colors = $theme->getFlattened('colors');  // ['blue-500' => '#3b82f6', ...]
$color = $colors['blue-500'] ?? null;

// Check if key exists
if (isset($theme->properties['colors']['brand']['primary'])) {
    // ...
}
```

## Best Practices

**Start with defaults**: Extend `DefaultPreset` instead of replacing it entirely. You get all the standard utilities plus your custom tokens.

**Use semantic names**: Name colors by purpose (`primary`, `secondary`, `accent`) rather than just color names (`red`, `blue`).

**Match your brand guide**: Pull values directly from your brand guidelines to ensure consistency across web and email.

**Test thoroughly**: Custom color values should have enough contrast for accessibility and render well in all email clients.

**Keep it simple**: Don't overcomplicate your theme. Most emails only need a handful of brand colors and sizes.

## Next Steps

- [Explore Rules](/atomic/rules) to see all available utility classes
- [Create Presets](/atomic/presets) to package themes with custom utilities
- [Learn about the Parser](/atomic/parser) for advanced theme integration
