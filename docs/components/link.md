---
title: Link
description: Anchor tag
---

# Link

The Link component renders an anchor tag with atomic CSS utilities. It provides a simple way to create hyperlinks in email templates with sensible defaults.

## Usage

```blade
<x-envelop::link href="https://example.com">
  Click here
</x-envelop::link>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `href` | `string` | `Yes` | - | URL the link points to |
| `target` | `string` | `No` | `'_blank'` | Link target attribute |
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
