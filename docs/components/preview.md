---
title: Preview
description: Hidden preview text
---

# Preview

The Preview component renders hidden preview text that appears in email client inbox listings. It automatically truncates to 150 characters and pads with zero-width spaces to prevent other content from showing.

## Usage

```blade
<x-envelop::html>
  <x-envelop::head title="Email" />
  <x-envelop::body>
    <x-envelop::preview text="This text appears in inbox previews" />

    <x-envelop::container>
      <!-- Your email content -->
    </x-envelop::container>
  </x-envelop::body>
</x-envelop::html>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `text` | `string` | `Yes` | - | Preview text to display (auto-truncated to 150 chars) |
