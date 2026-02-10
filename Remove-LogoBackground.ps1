Add-Type -AssemblyName System.Drawing

$inputPath = "public\images\logo.png"
$outputPath = "public\images\logo.png"
$backupPath = "public\images\logo_with_background.png"

if (-not (Test-Path $backupPath)) {
    Copy-Item $inputPath $backupPath -Force
    Write-Host "Backup created: $backupPath"
}

$bitmap = [System.Drawing.Bitmap]::FromFile((Resolve-Path $inputPath))
$newBitmap = New-Object System.Drawing.Bitmap($bitmap.Width, $bitmap.Height)

for ($y = 0; $y -lt $bitmap.Height; $y++) {
    for ($x = 0; $x -lt $bitmap.Width; $x++) {
        $pixel = $bitmap.GetPixel($x, $y)
        
        $isBrown = ($pixel.R -lt 120) -and ($pixel.G -lt 100) -and ($pixel.B -lt 85) -and ($pixel.R -gt $pixel.B)
        
        if ($isBrown) {
            $transparent = [System.Drawing.Color]::FromArgb(0, 0, 0, 0)
            $newBitmap.SetPixel($x, $y, $transparent)
        }
        else {
            $newBitmap.SetPixel($x, $y, $pixel)
        }
    }
    if ($y % 100 -eq 0) { Write-Host "Progress: $y / $($bitmap.Height)" }
}

$bitmap.Dispose()
$newBitmap.Save((Resolve-Path $outputPath), [System.Drawing.Imaging.ImageFormat]::Png)
$newBitmap.Dispose()

Write-Host "Done! Background removed from logo.png"
