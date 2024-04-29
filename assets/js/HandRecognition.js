document.addEventListener("DOMContentLoaded", function () {
  console.log("hello world!");
  const videoElement = document.getElementsByClassName("input_video")[0];
  const canvasElement = document.getElementsByClassName("video-container")[0]; // Use "output_canvas" instead of "video-container"
  const canvasCtx = canvasElement.getContext("2d");

  function countExtendedFingers(landmarks) {
  const fingerTips = [4, 8, 12, 16, 20]; // Indices of fingertip landmarks
  let count = 0;
  const tipThreshold = 0.9; // Adjust as needed
  for (let i = 0; i < fingerTips.length; i++) {
      const tipIndex = fingerTips[i];
      const tip = landmarks[tipIndex];
      const base = landmarks[tipIndex - 2];
      const middle = landmarks[tipIndex - 1];
      // Check if the tip is above the base and middle (open finger)
      if (tip && base && middle && tip.y < middle.y * tipThreshold && tip.y < base.y * tipThreshold) {
          count++;
      }
  }
  return count;
}
  // function countExtendedFingers(landmarks) {
  //   const fingerTips = [4, 8, 12, 16, 20]; // Indices of fingertip landmarks
  //   let count = 0;
  //   for (let i = 0; i < fingerTips.length; i++) {
  //     const tipIndex = fingerTips[i];
  //     const tip = landmarks[tipIndex];
  //     const base = landmarks[tipIndex - 2];
  //     const middle = landmarks[tipIndex - 1];
  //     // Check if the tip is above the base and middle (open finger)
  //     if (tip && base && middle && tip.y < middle.y && tip.y < base.y) {
  //       count++;
  //     }
  //   }
  //   return count;
  // }

// function finger(results) {
//     try {
//         const indexFingerTip = results[0][8].y; // Assuming the index finger tip is at index 8
//         var valueOfFinger = 1;
//         const MiddleFingerTip = results[0][12].y; // Assuming the index finger tip is at index 8

//         // Check if the y-coordinate of the index finger tip is greater than the y-coordinates of other landmarks
//         for (let i = 0; i < results[0].length; i++) {
//             if (i != 8 && indexFingerTip > results[0][i].y) { // Skip comparing with itself
//                 valueOfFinger = 0;
//                 break;
//             }
//         }
//         // if(valueOffFinger==0){
//         //     for (let i = 0; i < results[0].length; i++) {
//         //         if (i < 8 && indexFingerTip > results[0][i].y) {
//         //             valueOfFinger =1;
//         //         }
//         //         if ((valueOffFinger==1 ) && (i >12 && MiddleFingerTip > results[0][i].y)){
//         //             valueOfFinger =2;
//         //         }
//         //     }
//         // }
//         console.log(valueOfFinger);

//         if(valueOfFinger==1){
//             setTimeout(() => {
//                 window.location.href = '#menu';
//             }, 3000);
          
//         }
//         if(valueOfFinger==2){
//             setTimeout(() => {
//                 window.location.href = '#about';
//             }, 3000);
          
//         }
//         if(valueOfFinger==3){
//             setTimeout(() => {
//                 window.location.href = '#gallery';
//             }, 3000);
          
//         }
//     } catch (error) {
//         console.log("Error:", error);
//     }
// }
function handleGesture(fingerCount) {
  switch (fingerCount) {
      case 1:
          setTimeout(() => {
              window.location.href = '#about';
          }, 3000);
          break;
      case 2:
          setTimeout(() => {
              window.location.href = '#menu';
          }, 3000);
          break;
      case 3:
          setTimeout(() => {
              window.location.href = '#gallery';
          }, 3000);
          break;
      case 4:
          setTimeout(() => {
              window.location.href = '#blogs';
          }, 3000);
          break;
      case 5:
          setTimeout(() => {
              window.location.href = '#contact';
          }, 3000);
          break;
      default:
          // Handle unrecognized gestures or no gesture
          break;
  }
}
function onResults(results) {
  try {
      canvasCtx.save();
      canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
      canvasCtx.drawImage(
          results.image,
          0,
          0,
          canvasElement.width,
          canvasElement.height
      );
      if (results.multiHandLandmarks) {
          for (const landmarks of results.multiHandLandmarks) {
              drawConnectors(canvasCtx, landmarks, HAND_CONNECTIONS,
                  { color: '#00FF00', lineWidth: 5 });
              drawLandmarks(canvasCtx, landmarks, { color: '#FF0000', lineWidth: 2 });
              const fingerCount = countExtendedFingers(landmarks);
              console.log("Extended fingers:", fingerCount);
              handleGesture(fingerCount); // Handle gesture based on finger count
          }
      }
      canvasCtx.restore();
  } catch (error) {
      console.log("error", error);
  }
}

  const hands = new Hands({
    locateFile: (file) => {
      return `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`;
    }
  });
  hands.setOptions({
    maxNumHands: 1,
    modelComplexity: 1,
    minDetectionConfidence: 0.5,
    minTrackingConfidence: 0.5,
    selfieMode: true
  });
  hands.onResults(onResults);

  //camera setup for mediapipe
  const camera = new Camera(videoElement, {
    onFrame: async () => {
      await hands.send({ image: videoElement });
    },
    width: 400,
    height: 600
  });
  camera.start();
});