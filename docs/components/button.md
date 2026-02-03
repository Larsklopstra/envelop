---
title: Button
description: Anchor styled as button
---

# Button

The Button component renders a button-styled anchor tag with atomic CSS utilities. Perfect for call-to-action links in emails.

## Usage

```blade
<x-envelop::button
  href="https://example.com"
  class="bg-blue-600 text-white px-8 py-4 rounded-lg"
>
  Click Here
</x-envelop::button>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `href` | `string` | `Yes` | - | URL the button links to |
| `target` | `string` | `No` | `'_blank'` | Link target attribute |
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
