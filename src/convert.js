

const express = require('express');
const multer = require('multer');
const fs = require('fs');
const path = require('path');
const potrace = require('potrace');
const cheerio = require('cheerio');
const cors = require('cors'); // Import cors module


const app = express();
const port = 3001;


// Set up Multer to handle file uploads
const storage = multer.memoryStorage();
const upload = multer({ storage: storage });
console.log(upload);


app.use(express.json());
app.use(cors()); // Enable CORS for all routes


app.post('/api/generate-svg', upload.single('image'), (req, res) => {
 try {
   // Access the uploaded image buffer from req.file.buffer
   console.log(req.file);
   const imageBuffer = req.file.buffer;


   // Potrace options
   const options = {
     color: 'black',
     background: 'white',
     turnpolicy: 'black',
     turndetect: 1,
   };


   // Convert the image buffer to SVG path data
   potrace.trace(imageBuffer, options, (err, svg) => {
     if (err) {
       console.error('Error:', err);
       res.status(500).json({ error: 'Internal Server Error' });
     } else {
       // Parse the SVG string using Cheerio
       const $ = cheerio.load(svg);


       // Extract the 'd' attribute value from the 'path' element
       const dAttributeValue = $('path').attr('d');


       // Send the SVG path back to the frontend
       res.json({ svgPath: dAttributeValue });
     }
   });
 } catch (error) {
   console.error('Error processing image:', error);
   res.status(500).json({ error: 'Internal Server Error' });
 }
});


app.listen(port, () => {
 console.log(`Server is running on http://localhost:${port}`);
});
