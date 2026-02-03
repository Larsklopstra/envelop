---
title: Section
description: Full-width content section
---

# Section

The Section component renders a full-width table for grouping content into logical sections. It provides a semantic wrapper with atomic CSS utilities support for organizing your email layout.

## Usage

```blade
<x-envelop::section class="p-8 bg-white">
  <x-envelop::heading as="h2">Section Title</x-envelop::heading>
  <x-envelop::text>Section content</x-envelop::text>
</x-envelop::section>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
