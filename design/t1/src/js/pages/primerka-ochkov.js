const MODEL_URL = 'assets/vendor/face-api';

export function initTryOn(GLASSES) {
  let selectedGlasses = GLASSES[0];
  let uploadedImg = null;
  let faceLandmarks = null;
  let faceBox = null;
  let modelsReady = false;

  const statusEl = document.getElementById('tryonStatus');
  const placeholderEl = document.getElementById('tryonPlaceholder');
  const canvas = document.getElementById('tryonCanvas');
  const ctx = canvas.getContext('2d');
  const fileInput = document.getElementById('tryonFileInput');
  const resetBtn = document.getElementById('tryonResetBtn');
  const glassesListEl = document.getElementById('tryonGlassesList');

  function setStatus(text, isError) {
    statusEl.textContent = text;
    statusEl.classList.toggle('is-error', Boolean(isError));
  }

  function renderGlassesList() {
    glassesListEl.innerHTML = GLASSES.map(g => `
      <button type="button" class="tryon-glasses-card${g.id === selectedGlasses.id ? ' is-active' : ''}" data-id="${g.id}">
        <img src="${g.img}" alt="${g.name}">
        <span>${g.name}</span>
      </button>
    `).join('');
  }
  renderGlassesList();

  glassesListEl.addEventListener('click', (e) => {
    const btn = e.target.closest('.tryon-glasses-card');
    if (!btn) return;
    selectedGlasses = GLASSES.find(g => g.id === Number(btn.dataset.id));
    renderGlassesList();
    if (faceLandmarks) drawOverlay();
  });

  async function loadModels() {
    try {
      await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL);
      await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
      modelsReady = true;
      setStatus('Загрузите своё фото, чтобы примерить очки.');
    } catch (err) {
      console.error('[Примерка очков] Не удалось загрузить модель:', err);
      setStatus('Не удалось загрузить модель распознавания лица. Проверьте соединение с интернетом и обновите страницу.', true);
    }
  }
  loadModels();

  fileInput.addEventListener('change', () => {
    const file = fileInput.files[0];
    if (!file) return;
    if (!modelsReady) {
      setStatus('Модель ещё загружается, попробуйте через несколько секунд.', true);
      return;
    }
    setStatus('Определяем лицо на фото…');
    const url = URL.createObjectURL(file);
    const img = new Image();
    img.onload = async () => {
      uploadedImg = img;
      canvas.width = img.naturalWidth;
      canvas.height = img.naturalHeight;
      canvas.classList.add('is-visible');
      placeholderEl.style.display = 'none';
      resetBtn.style.display = '';
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.drawImage(img, 0, 0);

      const detection = await faceapi.detectSingleFace(img, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks();
      if (!detection) {
        faceLandmarks = null;
        faceBox = null;
        setStatus('Не удалось найти лицо на фото. Попробуйте другое фото — анфас, при хорошем освещении.', true);
        return;
      }
      faceLandmarks = detection.landmarks;
      faceBox = detection.detection.box;
      setStatus('Готово! Выберите оправу справа, чтобы примерить другую модель.');
      drawOverlay();
    };
    img.src = url;
  });

  function drawOverlay() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(uploadedImg, 0, 0);

    const centroid = (pts) => ({
      x: pts.reduce((s, p) => s + p.x, 0) / pts.length,
      y: pts.reduce((s, p) => s + p.y, 0) / pts.length,
    });
    const leftC = centroid(faceLandmarks.getLeftEye());
    const rightC = centroid(faceLandmarks.getRightEye());
    let midX = (leftC.x + rightC.x) / 2;
    let midY = (leftC.y + rightC.y) / 2;
    let dx = rightC.x - leftC.x;
    let dy = rightC.y - leftC.y;
    let eyeDist = Math.sqrt(dx * dx + dy * dy);
    let angle = Math.atan2(dy, dx);

    /* Eye landmarks can be unreliable on unusual head poses (strong tilt, chin up/down,
       extreme close-ups) — the 68-point model is trained mostly on frontal faces.
       Cross-check against the (generally more robust) face detection box, and fall
       back to a box-proportional estimate if the landmark-based numbers look physically
       implausible for a human face, instead of trusting a bad detection blindly. */
    if (faceBox) {
      const eyeDistRatio = eyeDist / faceBox.width;
      const eyeYRatio = (midY - faceBox.y) / faceBox.height;
      const implausible = eyeDistRatio < 0.25 || eyeDistRatio > 0.65 || eyeYRatio < 0.1 || eyeYRatio > 0.6;
      if (implausible) {
        eyeDist = faceBox.width * 0.35;
        midX = faceBox.x + faceBox.width / 2;
        midY = faceBox.y + faceBox.height * 0.38;
        angle = 0;
      }
    }

    const glassesImg = new Image();
    glassesImg.onload = () => {
      const targetWidth = eyeDist * 2.6;
      const targetHeight = targetWidth * (glassesImg.naturalHeight / glassesImg.naturalWidth);
      ctx.save();
      ctx.translate(midX, midY);
      ctx.rotate(angle);
      ctx.drawImage(glassesImg, -targetWidth / 2, -targetHeight / 2, targetWidth, targetHeight);
      ctx.restore();
    };
    glassesImg.src = selectedGlasses.img;
  }

  resetBtn.addEventListener('click', () => {
    uploadedImg = null;
    faceLandmarks = null;
    faceBox = null;
    fileInput.value = '';
    canvas.classList.remove('is-visible');
    placeholderEl.style.display = '';
    resetBtn.style.display = 'none';
    setStatus(modelsReady ? 'Загрузите своё фото, чтобы примерить очки.' : 'Загружаем модель распознавания лица…');
  });
}
