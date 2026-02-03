---
title: Container
description: Centered max-width wrapper (600px)
---

# Container

The Container component renders a centered, max-width constrained table for responsive email layouts. The default max-width is 600px (37.5em), which is optimal for email readability and mobile rendering.

## Usage

```blade
<x-envelop::body>
  <x-envelop::container>
    <x-envelop::text>
      Content constrained to 600px and centered
    </x-envelop::text>
  </x-envelop::container>
</x-envelop::body>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
