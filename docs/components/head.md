---
title: Head
description: Email head with meta tags
---

# Head

The Head component renders the head section with essential meta tags for email clients. It includes viewport settings, charset declaration, and MSO-specific configuration for optimal rendering.

## Usage

```blade
<x-envelop::html>
  <x-envelop::head title="Welcome Email" />
  <x-envelop::body>
    <!-- Email content -->
  </x-envelop::body>
</x-envelop::html>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `title` | `string` | `No` | `null` | Email title (for some email clients) |
