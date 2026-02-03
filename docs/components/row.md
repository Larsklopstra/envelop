---
title: Row
description: Table row for columns
---

# Row

The Row component renders a table row container for creating column-based layouts. It works with Column components to build responsive grid structures that are compatible with all email clients.

## Usage

```blade
<x-envelop::row>
  <x-envelop::column class="w-1/2">
    Left column
  </x-envelop::column>
  <x-envelop::column class="w-1/2">
    Right column
  </x-envelop::column>
</x-envelop::row>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
