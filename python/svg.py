const fs = require('fs');
const potrace = require('potrace');

// Read the input image file
const imageBuffer = fs.readFileSync('greenpillow.jpg');

// Potrace options
const options = {
  color: 'black', // Output SVG color
  background: 'white', // Output SVG background color
};

// Convert the image buffer to SVG
potrace.trace(imageBuffer, options, (err, svg) => {
  if (err) {
    console.error('Error:', err);
  } else {
    // Save the SVG to a file
    fs.writeFileSync('topnew1.svg', svg);
    console.log('SVG conversion complete. Output saved to topnew1.svg');
  }
});
