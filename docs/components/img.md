---
title: Img
description: Image with email-safe defaults
---

# Img

The Img component renders an image with email-safe defaults and optional dimensions. It automatically includes display block and removes borders and outlines for consistent rendering.

## Usage

```blade
<x-envelop::img
  src="https://example.com/image.jpg"
  alt="Description of image"
  width="600"
  height="400"
/>
```

## Props

| Prop | Type | Required | Default | Description |
|------|------|----------|---------|-------------|
| `src` | `string` | `Yes` | - | Image URL (absolute path) |
| `alt` | `string` | `No` | `''` | Alternative text for accessibility |
| `width` | `string` | `No` | `null` | Image width in pixels |
| `height` | `string` | `No` | `null` | Image height in pixels |
| `class` | `string` | `No` | `''` | Atomic CSS utility classes |
