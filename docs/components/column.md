---
title: Column
description: Table cell for column layouts
---

# Column

The Column component renders a table cell (td) with atomic CSS utilities. Use it with the Row component to create column-based layouts in emails.

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
