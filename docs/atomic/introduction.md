---
title: Introduction
description: Understanding atomic CSS in email templates
---

# Introduction

Envelop's atomic CSS system brings Tailwind-style utility classes to email templates. Write familiar classes that automatically compile to inline styles for maximum email client compatibility.

## What is Atomic CSS

Atomic CSS is a design approach where each utility class applies a single CSS property. Instead of writing custom CSS or inline styles manually, you compose designs by combining small, reusable utility classes.

## Terminology

Understanding the key concepts in Envelop's atomic system:

- **Preset**: A class implementing the Preset interface that provides rules and a theme
- **Rule**: A regex pattern that matches utility classes and generates CSS
- **Theme**: Design tokens (colors, spacing, typography, etc.) that rules can reference
- **Design Tokens**: Individual values in a theme (e.g., a specific color or spacing value)
- **Atomic CSS**: Utility-first CSS where each class does one thing
- **Parser**: The component that processes utility classes and converts them to inline styles

```blade
<!-- Instead of this -->
<a href="..." style="background-color: #3b82f6; color: #ffffff; padding: 16px 32px;">
  Click Here
</a>

<!-- Write this -->
<x-envelop::button href="..." class="bg-blue-600 text-white px-8 py-4">
  Click Here
</x-envelop::button>
```

## How It Works in Envelop

Envelop's atomic system parses utility classes through the `atomic()` helper function and generates inline styles:

```php
atomic('bg-blue-600 text-white px-8 py-4')
// Returns: "background-color: #2563eb; color: #ffffff; padding-left: 32px; padding-right: 32px; padding-top: 16px; padding-bottom: 16px;"
```

### The Parsing Flow

1. **Input**: Utility classes are passed to the `atomic()` helper
2. **Matching**: Each class is matched against parsing rules using regex patterns
3. **Resolving**: Matched rules look up values in the theme (e.g., `blue-600` → `#2563eb`)
4. **Merging**: All resolved styles are combined into a single inline style string
5. **Output**: Inline CSS ready for email clients

## The atomic() Helper

The `atomic()` helper function is the core of Envelop's CSS system. It's available globally in your Blade templates:

```php
atomic(string $classes, array $defaults = []): string
```

**Parameters**:
- `$classes`: Space-separated utility class names
- `$defaults`: Optional array of default CSS properties to merge with

**Returns**: Inline CSS style string

### Basic Example

```blade
<div style="{{ atomic('bg-slate-100 p-4 rounded') }}">
  Content
</div>
```

Output:
```blade
<div style="background-color: #f1f5f9; padding: 16px; border-radius: 4px;">
  Content
</div>
```

### With Defaults

Components use defaults to ensure email-safe base styles:

```php
public function style(): string
{
    return atomic($this->class, [
        'display' => 'inline-block',
        'text-decoration' => 'none',
    ]);
}
```

User classes override defaults, so `class="underline"` would change `text-decoration` from `none` to `underline`.

## Available Utility Classes

Envelop includes comprehensive utilities organized by category:

### Colors
Background colors, text colors, border colors with full Tailwind palette support.

### Typography
Font sizes, weights, families, line heights, letter spacing, text alignment, transforms, and decoration.

### Spacing
Padding and margin with numeric scale and directional variants (px, py, pt, pr, pb, pl).

### Sizing
Width, height, max-width, min-width, max-height, min-height with numeric and percentage values.

### Borders
Border widths, styles, colors, and radius with directional controls.

### Display & Layout
Display modes, vertical alignment.

### Effects
Box shadows and opacity.

## Arbitrary Values

For one-off values not in the theme, use arbitrary value syntax with square brackets:

```blade
<x-envelop::text class="text-[#ff0000] p-[20px] w-[500px]">
  Custom values
</x-envelop::text>
```

Arbitrary values work for:
- Colors: `bg-[#ff0000]`, `text-[rgb(255,0,0)]`
- Sizes: `w-[500px]`, `h-[100%]`
- Spacing: `p-[20px]`, `m-[1em]`
- Any other property: `leading-[1.8]`, `rounded-[10px]`

**Important**: While Envelop will process arbitrary values for any CSS property, not all properties are email-safe. Stick to well-supported properties like colors, spacing, typography, and borders. Properties like `display: flex`, `transform`, and `position: absolute` will not work in most email clients.

## Class Precedence

When multiple classes affect the same CSS property, the last one wins:

```blade
class="bg-blue-500 bg-red-500"
<!-- Results in: background-color: #ef4444 (red) -->
```

This matches Tailwind's behavior and lets you conditionally override classes in your Blade templates.

## Email Client Compatibility

All utility classes compile to inline styles, which is the most reliable way to style emails:

- **Works in all clients**: Inline styles are universally supported
- **No external CSS**: Everything is inlined, no `<style>` tags needed
- **MSO-safe**: Compatible with Microsoft Outlook's rendering engine
- **Mobile-friendly**: Styles work on desktop and mobile email clients

## Next Steps

- [Explore available rules](/atomic/rules) to see all utility classes
- [Learn about themes](/atomic/themes) to customize design tokens
- [Create presets](/atomic/presets) to package your own utilities
