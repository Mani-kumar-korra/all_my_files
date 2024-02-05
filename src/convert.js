const fs = require('fs');
const path = require('path');
const potrace = require('potrace');
const cheerio = require('cheerio');

// Get the absolute path to the image file (assuming it's in the same directory as convert.js)
const imageFilePath = path.join(__dirname, 'rec.jpg');

// Read the input image file
const imageBuffer = fs.readFileSync(imageFilePath);

// Potrace options
const options = {
  color: 'black', // Output SVG color
  background: 'white', // Output SVG background color
  turnpolicy: 'black', // Set turnpolicy to 'black' to get only the borders
  turndetect: 1, // Set turndetect to 1 to turn off curve detection
};

// Convert the image buffer to SVG path data
potrace.trace(imageBuffer, options, (err, svg) => {
  if (err) {
    console.error('Error:', err);
  } else {
    // Parse the SVG string using Cheerio
    const $ = cheerio.load(svg);

    // Extract the 'd' attribute value from the 'path' element
    const dAttributeValue = $('path').attr('d');

    // Create a JavaScript file and store the 'd' attribute value in a variable
    const jsCode = `const svgPath = '${dAttributeValue}';\nmodule.exports = svgPath;`;

    // Save the JavaScript code to a .js file
    const outputPath = path.join(__dirname, 'svgPath.js');
    fs.writeFileSync(outputPath, jsCode);

    console.log('SVG path data (d attribute) saved to svgPath.js');
  }
});
