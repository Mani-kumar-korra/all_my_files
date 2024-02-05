import React, { useEffect, useRef, useState } from 'react';
import { fabric } from 'fabric';
import wholeImage from './rec.jpg';
import './style.css';
import svgPath from './svgPath';

function App() {
  const [canvas, setCanvas] = useState(null);
  const imgRef = useRef(null);

  useEffect(() => {
    const fabricCanvas = new fabric.Canvas('canvas');
    setCanvas(fabricCanvas);

    fabric.Image.fromURL(wholeImage, function (img) {
      imgRef.current = img;
      fabricCanvas.setDimensions({
        width: img.width,
        height: img.height,
      });
      img.set({ left: 0, top: 0 });
      fabricCanvas.setBackgroundImage(img, fabricCanvas.renderAll.bind(fabricCanvas));

      const mattressSVG = svgPath;
      const mattress = new fabric.Path(mattressSVG, {
      
        fill: '#282828',
        opacity: 0.7,
      });

      fabricCanvas.add(mattress);
    });
  }, []); // Empty dependency array ensures this useEffect runs only once on component mount

  const changeColor = (color, alpha) => {
    if (canvas && canvas.getObjects().length > 0) {
      const mattressObject = canvas.getObjects()[0];

      if (mattressObject && mattressObject.set) {
        mattressObject.set({
          fill: color,
          opacity: alpha,
        });

        canvas.renderAll();
      } else {
        console.error('Error: mattressObject is not defined or does not have a set method');
      }
    } else {
      console.error('Error: canvas is not defined or has no objects');
    }
  };

  return (
    <div>
      <h1>Your React App</h1>
      <canvas id="canvas"></canvas>

      <div>
        <button onClick={() => changeColor('green', 0.6)}>Gray (Transparent)</button>
        <button onClick={() => changeColor('#046489', 0.6)}>Blue (Transparent)</button>
        <button onClick={() => changeColor('#60371', 0.6)}>Black (Transparent)</button>
        <button onClick={() => changeColor('#f34976', 0.6)}>Pink (Transparent)</button>
        <button onClick={() => changeColor('#5e3a8c', 0.6)}>Purple (Transparent)</button>
      </div>
    </div>
  );
}

export default App;