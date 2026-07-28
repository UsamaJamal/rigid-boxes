# Image Rename Reference

## Renamed Insert Images (All lowercase, shorter names)

| Old Name | New Name |
|----------|----------|
| `Corrugated-Box-Divider-Inserts.webp` | `corrugated-divider.webp` |
| `Folding-Carton-Box-Divider-Inserts.webp` | `folding-divider.webp` |
| `HIPS-Blister-Insert.webp` | `hips-insert.webp` |
| `Natural-Kraft-Corrugated-Insert.webp` | `kraft-corrugated.webp` |
| `Natural-Kraft-Paperboard-Insert.webp` | `kraft-paperboard.webp` |
| `PETG-Blister-Insert.webp` | `petg-insert.webp` |
| `PVC-Blister-Insert.webp` | `pvc-insert.webp` |
| `Standard-White-Corrugated-Insert.webp` | `white-corrugated.webp` |

## Renamed Additional Options Images

| Old Name | New Name |
|----------|----------|
| `Blind-Debossing.webp` | `blind-deboss.webp` |
| `Blind-Embossing.webp` | `blind-embossing.webp` |
| `Cold-Foil-Printing.webp` | `cold-foil.webp` |
| `Combination-Embossing.webp` | `combo-emboss.webp` |
| `Hot-Foil-Stamping.webp` | `hot-foil.webp` |
| `Registered-Embossing.webp` | `registered-emboss.webp` |
| `Window-Patching.webp` | `window-patch.webp` |

## Usage in Code

All images are located in: `public/uploads/`

### In Blade Templates (Add-ons):
```php
{{ asset('uploads/corrugated-divider.webp') }}
{{ asset('uploads/folding-divider.webp') }}
{{ asset('uploads/hips-insert.webp') }}
{{ asset('uploads/kraft-corrugated.webp') }}
{{ asset('uploads/kraft-paperboard.webp') }}
{{ asset('uploads/petg-insert.webp') }}
{{ asset('uploads/pvc-insert.webp') }}
{{ asset('uploads/white-corrugated.webp') }}
```

### In Blade Templates (Additional Options):
```php
{{ asset('uploads/blind-deboss.webp') }}
{{ asset('uploads/blind-embossing.webp') }}
{{ asset('uploads/cold-foil.webp') }}
{{ asset('uploads/combo-emboss.webp') }}
{{ asset('uploads/hot-foil.webp') }}
{{ asset('uploads/registered-emboss.webp') }}
{{ asset('uploads/window-patch.webp') }}
```

### Database Update SQL (if needed)
See `update_image_names.sql` for SQL commands to update database references.

## Date Renamed
January 28, 2026
