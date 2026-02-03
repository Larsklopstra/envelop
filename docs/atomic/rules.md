---
title: Rules
description: Understanding utility class patterns
---

# Rules

Envelop provides utility classes for styling email templates through pattern-based naming conventions. All classes compile to inline styles for maximum email client compatibility.

## How Rules Work

Rules use pattern matching to convert utility classes into CSS:

1. **Pattern**: Class name follows a predictable pattern (e.g., `bg-blue-600`)
2. **Theme lookup**: The rule extracts values and looks them up in the theme
3. **Output**: Generates inline CSS (e.g., `background-color: #2563eb`)

Understanding these patterns lets you compose any utility without memorizing lists.

## Rule Patterns

### Color-Based Rules

Colors follow the pattern `prefix-colorname-shade` or `prefix-colorname`:

```blade
<x-envelop::section class="bg-blue-600 text-white border border-slate-300">
  Colored section
</x-envelop::section>
```

**Pattern**: `bg-*`, `text-*`, `border-*` + color name + optional shade

**Example values**:
- `bg-blue-500`, `text-slate-900`, `border-red-600`
- `bg-white`, `bg-black`, `bg-transparent`

**Arbitrary colors**: `bg-[#ff0000]`, `text-[rgb(255,0,0)]`

See [DefaultPreset colors](https://github.com/larsklopstra/envelop/blob/master/src/Atomic/Presets/DefaultPreset.php) for the complete palette (slate, gray, red, orange, blue, etc.) and shades (50-950).

### Numeric Scale Rules

Spacing and sizing utilities follow a 4px-based scale where numbers multiply by 4:

```blade
<x-envelop::section class="p-4 m-8 w-64">
  <!-- p-4 = 16px padding -->
  <!-- m-8 = 32px margin -->
  <!-- w-64 = 256px width -->
</x-envelop::section>
```

**Pattern**: `prefix-number` (typically `number × 4 = pixels`)

**Common prefixes**:
- Padding: `p-4`, `px-4` (horizontal), `py-4` (vertical), `pt-4`, `pr-4`, `pb-4`, `pl-4`
- Margin: `m-4`, `mx-4`, `my-4`, `mt-4`, `mr-4`, `mb-4`, `ml-4`
- Width/Height: `w-64`, `h-32`, `min-w-0`, `max-w-96`

**Special values**: `w-full` (100%), `w-auto`, `mx-auto` (center)

**Arbitrary values**: `p-[20px]`, `w-[500px]`, `h-[80%]`

### Named Token Rules

Typography and effects use named tokens from the theme:

```blade
<x-envelop::text class="text-xl font-bold leading-tight tracking-wide">
  Styled text
</x-envelop::text>

<x-envelop::section class="shadow-lg rounded-xl opacity-75">
  Card with effects
</x-envelop::section>
```

**Pattern**: `prefix-tokenname`

**Font sizes**: `text-xs`, `text-sm`, `text-base`, `text-lg`, `text-xl`, `text-2xl`, `text-3xl`, etc.

**Font weights**: `font-thin`, `font-light`, `font-normal`, `font-medium`, `font-semibold`, `font-bold`, `font-extrabold`

**Font families**: `font-sans`, `font-serif`, `font-mono`

**Line height**: `leading-none`, `leading-tight`, `leading-normal`, `leading-relaxed`, `leading-loose`

**Letter spacing**: `tracking-tighter`, `tracking-tight`, `tracking-normal`, `tracking-wide`, `tracking-wider`

**Border radius**: `rounded-sm`, `rounded`, `rounded-md`, `rounded-lg`, `rounded-xl`, `rounded-full`, `rounded-none`

**Note**: `border-radius` has inconsistent rendering in Outlook 2007-2019. Test thoroughly in your target email clients.

**Shadows**: `shadow-sm`, `shadow`, `shadow-md`, `shadow-lg`, `shadow-xl`, `shadow-none`

**Note**: `box-shadow` is stripped by Outlook 2007-2019 and has inconsistent support across email clients. Use with caution.

**Opacity**: `opacity-0`, `opacity-50`, `opacity-75`, `opacity-100` (0-100 in increments of 5)

**Note**: `opacity` is not supported in Outlook 2007-2019 and has limited support in older email clients.

See the [Themes documentation](themes.md) for all available token values.

### Directional Variants

Many utilities support directional modifiers to target specific sides or corners:

```blade
<x-envelop::section class="pt-8 border-l-2 rounded-tr-lg">
  Directional utilities
</x-envelop::section>
```

**Pattern**: `prefix-direction-value`

**Directions**:
- `t` (top), `r` (right), `b` (bottom), `l` (left)
- `x` (horizontal), `y` (vertical)
- Corner combos: `tl`, `tr`, `br`, `bl`

**Examples**:
- `pt-4` (padding-top), `pl-8` (padding-left)
- `border-t` (top border), `border-x-2` (left + right borders)
- `rounded-tr-lg` (top-right corner), `rounded-l-xl` (left corners)

### Arbitrary Values

For one-off values not in your theme, use square brackets:

```blade
<x-envelop::section class="bg-[#ff0000] p-[20px] w-[37.5em] font-[Georgia,serif]">
  Custom values
</x-envelop::section>
```

**Pattern**: `prefix-[value]`

Arbitrary values bypass theme lookup and use the exact value provided. Works with colors, sizes, spacing, typography, and most other utilities.

**Important**: While Envelop will process arbitrary values for any CSS property, not all properties are email-safe. Stick to well-supported properties listed in the Email Client Considerations section below. Properties like `display: flex`, `transform`, and `position: absolute` will not work in most email clients.

## Common Utility Reference

Quick reference of utility prefixes and their CSS properties:

| Utility | CSS Property | Example |
|---------|-------------|---------|
| `bg-*` | background-color | `bg-blue-600` |
| `text-*` | color, font-size, text-align | `text-slate-900`, `text-xl`, `text-center` |
| `font-*` | font-family, font-weight | `font-sans`, `font-bold` |
| `leading-*` | line-height | `leading-normal` |
| `tracking-*` | letter-spacing | `tracking-wide` |
| `p-*`, `px-*`, `py-*`, `pt-*`, etc. | padding | `p-4`, `px-8` |
| `m-*`, `mx-*`, `my-*`, `mt-*`, etc. | margin | `m-4`, `mx-auto` |
| `w-*`, `h-*` | width, height | `w-64`, `h-full` |
| `min-w-*`, `max-w-*` | min-width, max-width | `max-w-96` |
| `min-h-*`, `max-h-*` | min-height, max-height | `min-h-64` |
| `border-*` | border properties | `border`, `border-slate-300`, `border-2` |
| `rounded-*` | border-radius | `rounded-lg` |
| `shadow-*` | box-shadow | `shadow-lg` |
| `opacity-*` | opacity | `opacity-75` |

### Text Utilities

**Alignment**: `text-left`, `text-center`, `text-right`, `text-justify`

**Transform**: `uppercase`, `lowercase`, `capitalize`, `normal-case`

**Decoration**: `underline`, `line-through`, `no-underline`

### Display & Layout

**Display**: `block`, `inline`, `inline-block`, `hidden`

**Vertical align**: `align-top`, `align-middle`, `align-bottom`, `align-baseline`

### Border Styles

`border-solid`, `border-dashed`, `border-dotted`

## Practical Examples

### Email Header

```blade
<x-envelop::section class="bg-slate-900 text-white p-8">
  <x-envelop::heading class="text-3xl font-bold mb-4">
    Welcome Back
  </x-envelop::heading>
  <x-envelop::text class="text-slate-300 leading-relaxed">
    We're excited to have you here.
  </x-envelop::text>
</x-envelop::section>
```

### Call-to-Action Button

```blade
<x-envelop::button
  href="https://example.com"
  class="bg-blue-600 text-white font-semibold px-8 py-4 rounded-lg shadow-md"
>
  Get Started Now
</x-envelop::button>
```

### Two-Column Layout

```blade
<x-envelop::row>
  <x-envelop::column class="w-1/2 p-4 border-r border-slate-200">
    <x-envelop::text class="text-sm text-slate-600">
      Left column content
    </x-envelop::text>
  </x-envelop::column>
  <x-envelop::column class="w-1/2 p-4">
    <x-envelop::text class="text-sm text-slate-600">
      Right column content
    </x-envelop::text>
  </x-envelop::column>
</x-envelop::row>
```

### Card Component

```blade
<x-envelop::section class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm">
  <x-envelop::heading class="text-xl font-bold text-slate-900 mb-2">
    Card Title
  </x-envelop::heading>
  <x-envelop::text class="text-slate-600 leading-relaxed mb-4">
    Card description with custom spacing and typography.
  </x-envelop::text>
  <x-envelop::button class="bg-[#ff6b6b] text-white px-6 py-3 rounded">
    Custom Color Button
  </x-envelop::button>
</x-envelop::section>
```

## Email Client Considerations

### Reliable Support

These properties work well across most email clients:
- Background and text colors
- Padding and margin
- Width and height
- Font properties (size, weight, family)
- Text alignment and basic typography
- Borders and border-radius (with some limitations)

### Limited Support

Use with caution or test thoroughly:
- **Shadows**: Inconsistent rendering in Outlook and some clients
- **Opacity**: Mixed support, especially in older clients
- **CSS Variables**: Not supported in most email clients
- **Complex gradients**: Very limited support

### Not Supported

Avoid these in email:
- **Flexbox and Grid**: Not supported in email clients
- **Position** (absolute, fixed): Not supported
- **Transforms and animations**: Not supported
- **Pseudo-classes**: `:hover`, `:focus`, `:active`, and other pseudo-classes are not supported in email clients. All styles must be applied directly to elements.
- **Modern CSS features**: aspect-ratio, clamp, etc.

For reliable layouts, use the table-based Row and Column components instead of flexbox utilities.

## Microsoft Outlook (MSO) Compatibility

Microsoft Outlook 2007-2019 uses the Word rendering engine, which has unique CSS limitations:

- **Box Model**: Padding on table cells may be ignored
- **Borders**: Border-radius is not supported
- **Shadows**: Box-shadow is completely stripped
- **Opacity**: Not supported
- **Margins**: Often ignored on table elements

Envelop's table-based component structure is designed to work around these limitations. Always test your emails in Outlook when targeting enterprise users.

## Finding Available Utilities

To discover all available utilities and their values:

1. **Presets documentation**: [Learn about the DefaultPreset](presets.md#the-defaultpreset)
2. **Themes documentation**: [Explore theme token structure](themes.md)
3. **DefaultPreset source code**: [View on GitHub](https://github.com/larsklopstra/envelop/blob/master/src/Atomic/Presets/DefaultPreset.php)

The source code is the single source of truth for all available utilities, colors, sizes, and tokens.

## Customizing Utilities

To add your own utilities or customize the available values:

1. Create a custom preset extending or replacing DefaultPreset
2. Define your own theme with brand colors and tokens
3. Add custom rules for specialized utilities

See the [Presets documentation](presets.md) for complete customization guides.

## Next Steps

- [Explore Themes](/atomic/themes) to customize design tokens and colors
- [Create Presets](/atomic/presets) to package your own utilities
- [Learn about the Parser](/atomic/parser) for advanced customization
