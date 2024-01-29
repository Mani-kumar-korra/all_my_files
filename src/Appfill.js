// src/FabricCanvas.js
import React, { useEffect } from 'react';
import { fabric } from 'fabric';
import pattern from "./img/sub.jpg";
const FabricCanvas = () => {
  useEffect(() => {
    const canvas = new fabric.Canvas('fabricCanvas');

    // Create a semi-circle
    const semiCirclePathData = 'M 86 3.063 C 69.021 4.216, 54.122 6.253, 34.944 10.043 C 16.546 13.680, 10.038 16.635, 5.007 23.638 C 1.909 27.952, 1.472 29.340, 1.138 35.946 L 0.762 43.393 13.066 55.224 C 19.834 61.731, 26.436 67.322, 27.738 67.649 C 29.050 67.978, 34.205 67.086, 39.303 65.647 C 60.897 59.551, 81.186 57.022, 108.500 57.020 C 130.420 57.019, 149.515 59.030, 161.512 62.605 C 166.456 64.077, 171.671 65.485, 173.102 65.733 C 179.804 66.894, 198.054 52.727, 202.437 42.961 C 206.995 32.804, 206.749 30.214, 200.210 19.563 C 197.174 14.618, 183.241 10.521, 145.500 3.476 C 139.867 2.424, 99.529 2.144, 86 3.063';
    const semiCircle = new fabric.Path(semiCirclePathData, {
      fill: 'orange',
      left: 100,
      top: 150,
      originX: 'center',
      originY: 'center',
      angle: 270,
    });
    canvas.add(semiCircle);



// const triangle = new fabric.Triangle({
//   width: 50,
//   height: 50,
//   fill: 'red',
//   left: 100,
//   top: 100,
// });

// canvas.add(triangle);

    // Load pattern image
    const patternImageSrc = pattern;
    fabric.Image.fromURL(patternImageSrc, (patternImage) => {
      // Set the pattern fill for the semi-circle
      semiCircle.set({
        fill: new fabric.Pattern({
          source: patternImage.getElement(),
          repeat: 'repeat',
        }),
      });

      // Render the canvas
      canvas.renderAll();
    });

    // Clean up on unmount
    return () => {
      canvas.dispose();
    };
  }, []); // Empty dependency array ensures useEffect runs only once

  return <canvas id="fabricCanvas" width="1400" height="1400"></canvas>;
};

export default FabricCanvas