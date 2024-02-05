from PIL import Image
import pytesseract

# Set the path to the tesseract executable (update with your path)
pytesseract.pytesseract.tesseract_cmd = '/usr/bin/tesseract'

# Load the image
img = Image.open("greenpillow.jpg")

# Perform OCR and get SVG text
svg_text = pytesseract.image_to_svg_string(img)

# Print or use the SVG text as needed
print(svg_text)
