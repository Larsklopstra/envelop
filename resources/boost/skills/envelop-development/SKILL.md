---
name: envelop-development
description: Build email templates with Envelop's Blade components and atomic CSS utilities.
---

## When to use this skill

Use this skill when working with Envelop email templates in Laravel. Envelop provides email-safe Blade components and an atomic CSS utility system (similar to Tailwind) that compiles to inline styles for maximum email client compatibility.

All components are prefixed with `envelop::` and use the `class` prop with atomic utility strings instead of raw `style` attributes.

---

## Components

All 15 components are registered under the `envelop` namespace. Components accept a `class` prop for atomic CSS utilities and pass additional HTML attributes through `$attributes->merge()`.

### `<x-envelop::html>`

Root HTML element with XHTML doctype.

```blade
<x-envelop::html lang="en" dir="ltr">
    ...
</x-envelop::html>
```

| Prop   | Default | Description         |
| ------ | ------- | ------------------- |
| `lang` | `'en'`  | HTML lang attribute |
| `dir`  | `'ltr'` | Text direction      |

---

### `<x-envelop::head>`

Email `<head>` with essential meta tags (charset, viewport, MSO config).

```blade
<x-envelop::head title="Welcome to Acme" />
```

| Prop    | Default | Description                    |
| ------- | ------- | ------------------------------ |
| `title` | `null`  | Optional `<title>` tag content |

Supports a `$slot` for injecting custom styles or tags into `<head>`.

---

### `<x-envelop::font>`

Loads a font with optional web font URL and Outlook fallback.

```blade
<x-envelop::font
    font-family="Inter"
    fallback="Arial, sans-serif"
    web-font="https://fonts.googleapis.com/css2?family=Inter"
    font-weight="400"
    font-style="normal"
/>
```

| Prop         | Default               | Description             |
| ------------ | --------------------- | ----------------------- |
| `fontFamily` | required              | Font name               |
| `fallback`   | `'Arial, sans-serif'` | Outlook/fallback stack  |
| `webFont`    | `null`                | Google Fonts or CDN URL |
| `fontWeight` | `'400'`               | Font weight             |
| `fontStyle`  | `'normal'`            | Font style              |

---

### `<x-envelop::preview>`

Hidden preview text shown in inbox listings (truncated to 150 chars, padded).

```blade
<x-envelop::preview text="Your order has been confirmed — thank you!" />
```

| Prop   | Default  | Description                  |
| ------ | -------- | ---------------------------- |
| `text` | required | Preview text (max 150 chars) |

---

### `<x-envelop::body>`

Email `<body>` wrapped in a full-width reset table.

```blade
<x-envelop::body class="bg-gray-100">
    ...
</x-envelop::body>
```

| Prop    | Default | Description            |
| ------- | ------- | ---------------------- |
| `class` | `''`    | Atomic utility classes |

Default inline styles: `margin: 0; padding: 0; width: 100%`.

---

### `<x-envelop::container>`

Centered, max-width constrained table (defaults to `37.5em` / 600px).

```blade
<x-envelop::container class="bg-white">
    ...
</x-envelop::container>
```

| Prop    | Default | Description            |
| ------- | ------- | ---------------------- |
| `class` | `''`    | Atomic utility classes |

Default inline styles: `max-width: 37.5em; margin: 0 auto; width: 100%`.

---

### `<x-envelop::section>`

Full-width table for grouping content into logical sections.

```blade
<x-envelop::section class="px-6 py-8">
    ...
</x-envelop::section>
```

| Prop    | Default | Description            |
| ------- | ------- | ---------------------- |
| `class` | `''`    | Atomic utility classes |

---

### `<x-envelop::row>`

Table row container for column-based layouts. Wrap with `<x-envelop::column>` children.

```blade
<x-envelop::row>
    <x-envelop::column class="w-1/2 pr-4">Left</x-envelop::column>
    <x-envelop::column class="w-1/2 pl-4">Right</x-envelop::column>
</x-envelop::row>
```

| Prop    | Default | Description            |
| ------- | ------- | ---------------------- |
| `class` | `''`    | Atomic utility classes |

---

### `<x-envelop::column>`

Table cell (`<td>`) for building column layouts inside `<x-envelop::row>`.

```blade
<x-envelop::column class="w-1/3 px-4 py-2 bg-slate-50">
    ...
</x-envelop::column>
```

| Prop    | Default | Description            |
| ------- | ------- | ---------------------- |
| `class` | `''`    | Atomic utility classes |

---

### `<x-envelop::heading>`

Semantic heading (`h1`–`h6`) with typography defaults per level.

```blade
<x-envelop::heading as="h1" class="text-gray-900">
    Welcome aboard
</x-envelop::heading>
```

| Prop    | Default | Description              |
| ------- | ------- | ------------------------ |
| `as`    | `'h1'`  | Heading level: `h1`–`h6` |
| `class` | `''`    | Atomic utility classes   |

Default styles per level:

| Level | Font size | Weight | Margin bottom |
| ----- | --------- | ------ | ------------- |
| h1    | 36px      | 700    | 20px          |
| h2    | 30px      | 700    | 16px          |
| h3    | 24px      | 600    | 14px          |
| h4    | 20px      | 600    | 12px          |
| h5    | 18px      | 600    | 10px          |
| h6    | 16px      | 600    | 8px           |

---

### `<x-envelop::text>`

Paragraph (`<p>`) with readable typography defaults.

```blade
<x-envelop::text class="text-gray-700">
    Thanks for signing up. Your account is ready.
</x-envelop::text>
```

| Prop    | Default | Description            |
| ------- | ------- | ---------------------- |
| `class` | `''`    | Atomic utility classes |

Default inline styles: `font-size: 14px; line-height: 24px; margin: 16px 0`.

---

### `<x-envelop::button>`

Button-styled anchor tag (`<a>`).

```blade
<x-envelop::button
    href="https://example.com/confirm"
    class="bg-blue-600 text-white px-6 py-3 rounded-md font-semibold"
>
    Confirm your email
</x-envelop::button>
```

| Prop     | Default    | Description            |
| -------- | ---------- | ---------------------- |
| `href`   | required   | Link URL               |
| `target` | `'_blank'` | Link target            |
| `class`  | `''`       | Atomic utility classes |

Default inline styles: `line-height: 100%; text-decoration: none; display: inline-block; max-width: 100%; mso-padding-alt: 0px`.

---

### `<x-envelop::link>`

Inline anchor tag (`<a>`) for body text links.

```blade
<x-envelop::link href="https://example.com" class="text-blue-600">
    Visit our website
</x-envelop::link>
```

| Prop     | Default    | Description            |
| -------- | ---------- | ---------------------- |
| `href`   | required   | Link URL               |
| `target` | `'_blank'` | Link target            |
| `class`  | `''`       | Atomic utility classes |

Default inline styles: `color: #067df7; text-decoration: none`.

---

### `<x-envelop::img>`

Email-safe `<img>` with display block and no borders.

```blade
<x-envelop::img
    src="https://example.com/logo.png"
    alt="Acme logo"
    width="150"
    height="40"
    class="mx-auto"
/>
```

| Prop     | Default  | Description            |
| -------- | -------- | ---------------------- |
| `src`    | required | Image URL              |
| `alt`    | `''`     | Alt text               |
| `width`  | `null`   | Width in px            |
| `height` | `null`   | Height in px           |
| `class`  | `''`     | Atomic utility classes |

Default inline styles: `display: block; outline: none; border: none; text-decoration: none`.

---

### `<x-envelop::hr>`

Horizontal divider line.

```blade
<x-envelop::hr class="border-gray-200 my-6" />
```

| Prop    | Default | Description            |
| ------- | ------- | ---------------------- |
| `class` | `''`    | Atomic utility classes |

Default inline styles: `width: 100%; border: none; border-top: 1px solid #eaeaea`.

---

## Atomic CSS Utilities

The `class` prop accepts space-separated utility strings, similar to Tailwind CSS. Utilities compile to inline styles at render time — no CSS file is needed.

The full list of available utilities, color palettes, scales, and tokens is defined in `vendor/larsklopstra/envelop/src/Atomic/Presets/DefaultPreset.php`.

### Examples

```
bg-blue-600    → background-color: #2563eb
text-gray-900  → color: #111827
p-4            → padding: 16px
px-6           → padding-left: 24px; padding-right: 24px
mx-auto        → margin-left: auto; margin-right: auto
text-sm        → font-size: 14px; line-height: 20px
font-bold      → font-weight: 700
leading-6      → line-height: 24px
rounded-md     → border-radius: 6px
border-2       → border: 2px solid
w-1/2          → width: 50%
shadow-md      → box-shadow: 0 4px 6px …
opacity-50     → opacity: 0.5
```

### Arbitrary values

Use square brackets for one-off values not in the scale:

```
text-[#ff6600]   → color: #ff6600
bg-[#1a1a2e]     → background-color: #1a1a2e
w-[600px]        → width: 600px
p-[12px]         → padding: 12px
rounded-[10px]   → border-radius: 10px
border-[#cccccc] → border-color: #cccccc
```

---

## `atomic()` Helper

You can call the `atomic()` helper directly in PHP for programmatic style generation:

```php
$style = atomic('bg-blue-600 text-white px-6 py-3 rounded-md', [
    'display' => 'inline-block',  // defaults, overridden by class utilities
]);
// Returns an inline style string
```

---

## Custom Presets

Extend or replace the default preset by implementing `LarsKlopstra\Envelop\Atomic\Contracts\Preset`:

```php
use LarsKlopstra\Envelop\Atomic\Contracts\Preset;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Rule;
use LarsKlopstra\Envelop\Atomic\ValueObjects\Theme;

class MyPreset implements Preset
{
    public function getRules(): array
    {
        return [
            new Rule(
                pattern: '/^brand-primary$/',
                resolver: fn () => ['color' => '#ff6600'],
            ),
        ];
    }

    public function getTheme(): Theme
    {
        return new Theme([
            'colors' => [
                'brand' => ['primary' => '#ff6600', 'secondary' => '#003366'],
            ],
        ]);
    }
}
```

Register your preset alongside the default in `AppServiceProvider`:

```php
use LarsKlopstra\Envelop\Atomic\Atomic;
use LarsKlopstra\Envelop\Atomic\Presets\DefaultPreset;

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

---

## Full Email Template Example

```blade
<x-envelop::html lang="en">
    <x-envelop::head title="Order Confirmed">
        <x-envelop::font
            font-family="Inter"
            fallback="Arial, sans-serif"
            web-font="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap"
        />
    </x-envelop::head>

    <x-envelop::body class="bg-gray-100">
        <x-envelop::preview text="Your order #12345 has been confirmed — thank you for shopping with us!" />

        <x-envelop::container class="bg-white rounded-lg shadow-md my-8">

            {{-- Header --}}
            <x-envelop::section class="bg-blue-600 rounded-t-lg px-8 py-6">
                <x-envelop::img
                    src="https://example.com/logo-white.png"
                    alt="Acme"
                    width="120"
                    height="32"
                />
            </x-envelop::section>

            {{-- Body --}}
            <x-envelop::section class="px-8 py-8">
                <x-envelop::heading as="h1" class="text-gray-900">
                    Order Confirmed!
                </x-envelop::heading>

                <x-envelop::text class="text-gray-600">
                    Hi Jane, your order <strong>#12345</strong> has been received and is being processed.
                </x-envelop::text>

                <x-envelop::hr class="border-gray-200 my-6" />

                {{-- Order summary columns --}}
                <x-envelop::row>
                    <x-envelop::column class="w-1/2 pr-4">
                        <x-envelop::text class="text-sm font-semibold text-gray-500 m-0">
                            Shipping to
                        </x-envelop::text>
                        <x-envelop::text class="text-sm text-gray-800 mt-1 m-0">
                            123 Main St, San Francisco CA 94105
                        </x-envelop::text>
                    </x-envelop::column>
                    <x-envelop::column class="w-1/2 pl-4">
                        <x-envelop::text class="text-sm font-semibold text-gray-500 m-0">
                            Order total
                        </x-envelop::text>
                        <x-envelop::text class="text-sm text-gray-800 mt-1 m-0">
                            $49.99
                        </x-envelop::text>
                    </x-envelop::column>
                </x-envelop::row>

                <x-envelop::hr class="border-gray-200 my-6" />

                {{-- CTA Button --}}
                <x-envelop::section class="text-center py-4">
                    <x-envelop::button
                        href="https://example.com/orders/12345"
                        class="bg-blue-600 text-white px-8 py-4 rounded-md font-semibold text-base"
                    >
                        Track your order
                    </x-envelop::button>
                </x-envelop::section>
            </x-envelop::section>

            {{-- Footer --}}
            <x-envelop::section class="bg-gray-50 rounded-b-lg px-8 py-6">
                <x-envelop::text class="text-xs text-gray-500 text-center m-0">
                    Questions? <x-envelop::link href="mailto:support@example.com" class="text-blue-600">
                        Contact support
                    </x-envelop::link>
                </x-envelop::text>
                <x-envelop::text class="text-xs text-gray-400 text-center m-0 mt-2">
                    © 2025 Acme Inc. · 123 Main St, San Francisco CA 94105
                </x-envelop::text>
            </x-envelop::section>

        </x-envelop::container>
    </x-envelop::body>
</x-envelop::html>
```
