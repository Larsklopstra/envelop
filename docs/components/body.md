---
title: Body
description: Email body wrapper with table structure
---

# Body

The Body component renders the email body element wrapped in a table structure for maximum email client compatibility. It includes reset styles to normalize rendering across different email clients.

## Usage

```blade
<x-envelop::html>
  <x-envelop::head title="Welcome" />
  <x-envelop::body>
    <!-- Your email content -->
  </x-envelop::body>
</x-envelop::html>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
