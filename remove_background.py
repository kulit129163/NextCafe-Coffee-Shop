from PIL import Image
import os

# Paths
input_path = r'public\images\logo.png'
output_path = r'public\images\logo.png'
backup_path = r'public\images\logo_with_background.png'

# Load the image
img = Image.open(input_path)
img = img.convert("RGBA")

# Get image data
datas = img.getdata()

# Create new image data with transparency
new_data = []
for item in datas:
    # Check if pixel is brownish (the background color)
    # Brown background has RGB values around (60-90, 40-60, 30-50)
    # We'll make these pixels transparent
    r, g, b, a = item
    
    # If the pixel is brown-ish (background color), make it transparent
    # Adjust these thresholds based on the actual background color
    if r < 120 and g < 100 and b < 80 and (r > g) and (g > b * 0.8):
        # Make it fully transparent
        new_data.append((255, 255, 255, 0))
    else:
        # Keep the original pixel
        new_data.append(item)

# Update image data
img.putdata(new_data)

# Save backup of original
if not os.path.exists(backup_path):
    original = Image.open(input_path)
    original.save(backup_path)
    print(f"Backup saved to: {backup_path}")

# Save the new image
img.save(output_path, "PNG")
print(f"Background removed! New logo saved to: {output_path}")
print("The original logo has been backed up as logo_with_background.png")
