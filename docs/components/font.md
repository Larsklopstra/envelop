---
title: Font
description: Font declarations with web font support
---

# Font

The Font component renders font declarations with optional web font support and fallbacks. It includes MSO-specific styles for Outlook compatibility, ensuring your custom fonts degrade gracefully.

## Usage

```blade
<x-envelop::head>
  <x-envelop::font
    font-family="Inter"
    fallback="Arial, sans-serif"
    web-font="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
  />
</x-envelop::head>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `fontFamily` | `string` | `Yes` | - | Primary font family name |
| `fallback` | `string` | `No` | `'Arial, sans-serif'` | Fallback font stack |
| `webFont` | `string` | `No` | `null` | URL to web font stylesheet |
| `fontWeight` | `string` | `No` | `'400'` | Default font weight |
| `fontStyle` | `string` | `No` | `'normal'` | Default font style |
