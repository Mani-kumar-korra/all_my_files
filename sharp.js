const sharp = require('sharp');
const fs = require('fs');

function traceImage(inputImagePath, outputSvgPath) {
  sharp(inputImagePath)
    .greyscale() // Convert to grayscale for better edge detection
    .edge() // Perform edge detection
    .toFile(outputSvgPath, (err, info) => {
      if (err) {
        console.error(err);
      } else {
        console.log('Image traced and converted to SVG:', outputSvgPath);
      }
    });
}

// Example usage
const inputImagePath = './greenpillow.jpg';
const outputSvgPath = 'output1.svg';

traceImage(inputImagePath, outputSvgPath);
