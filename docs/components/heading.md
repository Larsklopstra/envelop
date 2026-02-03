---
title: Heading
description: Semantic headings (h1-h6)
---

# Heading

The Heading component renders semantic heading tags (h1-h6) with predefined typography styles. Each heading level has appropriate font size, weight, and margin defaults optimized for email readability.

## Usage

```blade
<x-envelop::heading as="h1">
  Main Heading
</x-envelop::heading>

<x-envelop::heading as="h2" class="text-blue-600">
  Subheading with custom color
</x-envelop::heading>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `as` | `string` | `No` | `'h1'` | Heading level: h1, h2, h3, h4, h5, or h6 |
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
