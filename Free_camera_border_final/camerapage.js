const video = document.getElementById('video');
const countdown = document.getElementById('countdown');
const captureBtn = document.getElementById('captureBtn');
const previewContainer = document.getElementById('previewContainer');
const capturedImages = [];

navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } })
  .then(stream => video.srcObject = stream)
  .catch(() => alert("Camera not available."));

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

  for (let i = 0; i < 2; i++) {
    await countdownTimer(3);

    const canvas = document.createElement('canvas');
    canvas.width = 300;
    canvas.height = 225;
    const ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    const imageData = canvas.toDataURL("image/png");
    capturedImages.push(imageData);

    const img = document.createElement('img');
    img.src = imageData;
    previewContainer.appendChild(img);
  }

  localStorage.setItem('capturedPhotos', JSON.stringify(capturedImages));
  window.location.href = "fborderpage.html" 
}

captureBtn.addEventListener('click', startCapture);
