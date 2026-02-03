---
title: Html
description: Root HTML element
---

# Html

The Html component renders the DOCTYPE and root html element with XHTML namespace. It includes language and text direction attributes for internationalization support.

## Usage

```blade
<x-envelop::html>
  <x-envelop::head title="Email" />
  <x-envelop::body>
    <!-- Email content -->
  </x-envelop::body>
</x-envelop::html>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `lang` | `string` | `No` | `'en'` | Language code (ISO 639-1) |
| `dir` | `string` | `No` | `'ltr'` | Text direction: 'ltr' or 'rtl' |
