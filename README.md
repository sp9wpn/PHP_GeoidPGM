# PHP GeoidPGM class

GeoidPGM - Read geoid undulation (height) from a GeographicLib .pgm file.
Supports EGM84, EGM96, and EGM2008 geoid grid files in the PGM format
produced by GeographicLib (e.g. egm96-5.pgm, egm2008-1.pgm).

AI-assited code. Based on Charles Karney's GeographicLib (C++ class Geoid) and PyGeodesy.

Download grid files from: [https://geographiclib.sourceforge.io/C++/doc/geoid.html#geoidinst]

## Usage
```php
   $geoid = new GeoidPGM('/path/to/egm2008-1.pgm');
   $h = $geoid->height($lat, $lon);          // cubic (default, more accurate)
   $h = $geoid->height($lat, $lon, false);   // bilinear (slightly faster)
   $geoid->close();                          // optional: release file handle
```

## Interpolation
 *   Bilinear: 4-point grid-cell corners
 *   Cubic: 12-point Karney stencil (2-D Lagrange over nodes {-1, 0, 1, 2})
