<?php
/**
 * Create Favicon Files for studyrift
 */

// Create directories
@mkdir('public/images', 0755, true);
@mkdir('public/favicons', 0755, true);

// Blue color for studyrift (#0ea5e9)
$blueColor = [14, 165, 233];
$whiteColor = [255, 255, 255];

function createFavicon($width, $height, $filename) {
    global $blueColor, $whiteColor;
    
    $image = imagecreatetruecolor($width, $height);
    
    // Fill background with blue
    $blue = imagecolorallocate($image, $blueColor[0], $blueColor[1], $blueColor[2]);
    $white = imagecolorallocate($image, $whiteColor[0], $whiteColor[1], $whiteColor[2]);
    
    imagefill($image, 0, 0, $blue);
    
    // Draw simple white S letter
    $fontSize = $width > 100 ? 5 : 3;
    $textColor = $white;
    
    // Center the S letter
    $textBox = imagettfbbox($fontSize, 0, __DIR__ . '/resources/fonts/arial.ttf', 'S');
    $x = ($width - ($textBox[2] - $textBox[0])) / 2;
    $y = ($height - ($textBox[1] - $textBox[7])) / 2;
    
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, __DIR__ . '/resources/fonts/arial.ttf', 'S');
    
    // Save as PNG
    imagepng($image, $filename);
    imagedestroy($image);
    
    echo "✅ Created: $filename\n";
}

// Create favicon files
createFavicon(16, 16, 'public/favicon-16x16.png');
createFavicon(32, 32, 'public/favicon-32x32.png');
createFavicon(180, 180, 'public/apple-touch-icon.png');
createFavicon(192, 192, 'public/favicon-192x192.png');
createFavicon(512, 512, 'public/favicon-512x512.png');
createFavicon(256, 256, 'public/images/studyrift-logo.png');

echo "\n✨ All favicon files created successfully!\n";
?>
