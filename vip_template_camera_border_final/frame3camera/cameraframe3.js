const video = document.getElementById('video');
const countdown = document.getElementById('countdown');
const captureBtn = document.getElementById('captureBtn');
const previewContainer = document.getElementById('previewContainer');
const aiCanvas = document.getElementById('aiCanvas');
const ctx = aiCanvas.getContext('2d');
const bgColorPicker = document.getElementById('bgColorPicker');
const colorPickerContainer = document.getElementById('colorPickerContainer');

let mode = 'normal';
let net;
let isSegmenting = false;

navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } })
  .then(stream => video.srcObject = stream)
  .catch(() => alert("Camera not available."));

document.querySelectorAll('input[name="mode"]').forEach(radio => {
  radio.addEventListener('change', async (e) => {
    mode = e.target.value;
    if (mode === 'ai') {
      aiCanvas.style.display = 'block';
      video.style.display = 'none';
      colorPickerContainer.style.display = 'block';
      if (!net) {
        net = await bodyPix.load();
      }
      segmentLoop();
    } else {
      aiCanvas.style.display = 'none';
      video.style.display = 'block';
      colorPickerContainer.style.display = 'none';
    }
  });
});

function segmentLoop() {
  if (mode !== 'ai') return;

  net.segmentPerson(video).then(segmentation => {
    const bgColor = bgColorPicker.value;
    const maskBackground = true;
    const foregroundColor = { r: 0, g: 0, b: 0, a: 0 };
    const backgroundColor = hexToRgb(bgColor);
    const coloredPartImage = bodyPix.toMask(segmentation, foregroundColor, backgroundColor);
    bodyPix.drawMask(aiCanvas, video, coloredPartImage, 1, 0, false);
    requestAnimationFrame(segmentLoop);
  });
}

function hexToRgb(hex) {
  const bigint = parseInt(hex.slice(1), 16);
  const r = (bigint >> 16) & 255;
  const g = (bigint >> 8) & 255;
  const b = bigint & 255;
  return { r, g, b, a: 255 };
}

function countdownTimer(seconds) {
  return new Promise(resolve => {
    let time = seconds;
    countdown.textContent = time;
    const interval = setInterval(() => {
      time--;
      countdown.textContent = time;
      if (time <= 0) {
        clearInterval(interval);
        countdown.textContent = '';
        resolve();
      }
    }, 1000);
  });
}

async function startCapture() {
  captureBtn.disabled = true;
  const capturedImages = [];

  for (let i = 0; i < 4; i++) {
    await countdownTimer(3);

    const canvas = document.createElement('canvas');
    canvas.width = 300;
    canvas.height = 225;
    const context = canvas.getContext('2d');

    if (mode === 'ai') {
      context.drawImage(aiCanvas, 0, 0, canvas.width, canvas.height);
    } else {
      context.drawImage(video, 0, 0, canvas.width, canvas.height);
    }

    const imageData = canvas.toDataURL("image/png");
    capturedImages.push(imageData);

    const img = document.createElement('img');
    img.src = imageData;
    previewContainer.appendChild(img);
  }

  localStorage.setItem('capturedPhotos', JSON.stringify(capturedImages));
  window.location.href = "frame3border.html";
}

captureBtn.addEventListener('click', startCapture);