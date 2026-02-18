<?php
require_once('GeoidPGM.php');

$pgmFile = $argv[1] ?? null;
if ($pgmFile === null) {
    fwrite(STDERR, "Usage: php GeoidPGM.php <path/to/egm96-5.pgm> [lat] [lon]\n");
    fwrite(STDERR, "Example: php GeoidPGM.php egm2008-1.pgm 51.477928 -0.001545\n");
    exit(1);
}

$lat = isset($argv[2]) ? (float) $argv[2] : 51.477928;  // Greenwich Observatory
$lon = isset($argv[3]) ? (float) $argv[3] : -0.001545;

$geoid = new GeoidPGM($pgmFile);

echo "Grid info:\n";
foreach ($geoid->info() as $k => $v) {
    printf("  %-14s %s\n", $k, $v);
}

$hCubic    = $geoid->height($lat, $lon, true);
$hBilinear = $geoid->height($lat, $lon, false);

printf("\nCoordinates : lat=%+.6f  lon=%+.6f\n", $lat, $lon);
printf("Cubic       : %+.4f m\n", $hCubic);
printf("Bilinear    : %+.4f m\n", $hBilinear);

$geoid->close();
?>
