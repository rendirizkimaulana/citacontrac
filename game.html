<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Simulasi Pemasangan Meteran Listrik</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #0d6efd, #6f42c1);
    color: #fff;
    margin: 0; padding: 0;
    min-height: 100vh;
    display: flex; justify-content: center; align-items: center;
  }
  .container {
    background: rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 25px 30px;
    width: 800px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    display: flex;
    gap: 40px;
  }
  .game-container {
    flex: 1;
    text-align: center;
  }
  h2 {
    margin-bottom: 15px;
  }
  select {
    margin-bottom: 20px;
    padding: 8px 12px;
    border-radius: 8px;
    border: none;
    font-size: 1rem;
  }
  .steps-list {
    list-style: none;
    padding-left: 0;
    text-align: left;
  }
  .steps-list li {
    background: rgba(255,255,255,0.2);
    margin-bottom: 12px;
    padding: 12px 15px;
    border-radius: 12px;
    cursor: pointer;
    user-select: none;
    transition: background-color 0.3s, transform 0.2s;
  }
  .steps-list li:hover {
    background: rgba(255,255,255,0.4);
    transform: scale(1.03);
  }
  .steps-list li.correct {
    background: #28a745;
    cursor: default;
    animation: correctPulse 0.6s ease;
  }
  .steps-list li.incorrect {
    background: #dc3545;
    cursor: default;
    animation: incorrectShake 0.4s ease;
  }
  #message {
    margin-top: 20px;
    font-weight: 700;
    min-height: 24px;
  }
  #score {
    margin-top: 10px;
    font-weight: 600;
  }
  #resetBtn {
    margin-top: 25px;
    width: 100%;
    padding: 12px;
    font-size: 1rem;
    border: none;
    border-radius: 12px;
    background: #ffc107;
    color: #333;
    cursor: pointer;
    display: none;
    transition: background-color 0.3s;
  }
  #resetBtn:hover {
    background: #e0a800;
  }

  @keyframes correctPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
  }
  @keyframes incorrectShake {
    0%, 100% { transform: translateX(0); }
    25%, 75% { transform: translateX(-6px); }
    50% { transform: translateX(6px); }
  }

  /* Meteran listrik style */
  .meter-container {
    flex: 1;
    background: rgba(255,255,255,0.15);
    border-radius: 20px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    box-shadow: inset 0 0 10px rgba(255,255,255,0.3);
  }
  .meter-body {
    width: 220px;
    height: 220px;
    background: radial-gradient(circle at center, #eee 55%, #ccc 95%);
    border-radius: 50%;
    position: relative;
    box-shadow:
      inset 0 4px 15px #bbb,
      0 4px 15px rgba(0,0,0,0.25);
  }
  .meter-center {
    width: 20px;
    height: 20px;
    background: #444;
    border-radius: 50%;
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 8px #222;
  }
  .meter-needle {
    width: 6px;
    height: 100px;
    background: #dc3545;
    position: absolute;
    top: 50%;
    left: 50%;
    transform-origin: bottom center;
    transform: translateX(-50%) rotate(0deg);
    border-radius: 3px;
    box-shadow: 0 0 6px #c82333;
    transition: transform 0.5s ease;
  }
  /* Tick marks */
  .tick {
    position: absolute;
    width: 4px;
    height: 12px;
    background: #555;
    top: 15px;
    left: 50%;
    transform-origin: center bottom;
    border-radius: 2px;
  }
</style>
</head>
<body>

<div class="container">
  <div class="game-container">
    <h2>Simulasi Pemasangan Meteran Listrik</h2>

    <label for="levelSelect">Pilih Level Simulasi:</label><br>
    <select id="levelSelect">
      <option value="prabayar">Meteran Prabayar</option>
      <option value="pascabayar">Meteran Pascabayar</option>
    </select>

    <ul class="steps-list" id="stepsList"></ul>

    <div id="message"></div>
    <div id="score"></div>
    <button id="resetBtn">Ulangi Simulasi</button>
  </div>

  <div class="meter-container" aria-label="Animasi meteran listrik">
    <div class="meter-body" role="img" aria-roledescription="Meteran listrik dengan jarum penunjuk">
      <div class="meter-needle" id="meterNeedle"></div>
      <!-- Tick marks 0 to 6 -->
      <div class="tick" style="transform: translateX(-50%) rotate(0deg) translateY(-90px);"></div>
      <div class="tick" style="transform: translateX(-50%) rotate(30deg) translateY(-90px);"></div>
      <div class="tick" style="transform: translateX(-50%) rotate(60deg) translateY(-90px);"></div>
      <div class="tick" style="transform: translateX(-50%) rotate(90deg) translateY(-90px);"></div>
      <div class="tick" style="transform: translateX(-50%) rotate(120deg) translateY(-90px);"></div>
      <div class="tick" style="transform: translateX(-50%) rotate(150deg) translateY(-90px);"></div>
      <div class="tick" style="transform: translateX(-50%) rotate(180deg) translateY(-90px);"></div>
      <div class="meter-center"></div>
    </div>
    <p style="margin-top: 15px; color: #eee; font-weight: 600;">Progres Pemasangan Meteran</p>
  </div>
</div>

<!-- Audio Feedback -->
<audio id="audioCorrect" src="https://actions.google.com/sounds/v1/cartoon/clang_and_wobble.ogg"></audio>
<audio id="audioWrong" src="https://actions.google.com/sounds/v1/cartoon/boing.ogg"></audio>

<script>
  const stepsData = {
    prabayar: [
      "Matikan sumber listrik utama",
      "Pasang kotak meteran pada tempat yang disediakan",
      "Hubungkan kabel ke terminal meteran",
      "Pasang meteran prabayar dan kencangkan baut",
      "Nyalakan kembali sumber listrik utama",
      "Cek tampilan layar meteran prabayar"
    ],
    pascabayar: [
      "Matikan sumber listrik utama",
      "Pasang kotak meteran dan kabel penghubung",
      "Pasang meteran pascabayar pada tempat yang sesuai",
      "Kencangkan baut meteran dengan benar",
      "Nyalakan kembali sumber listrik utama",
      "Periksa arus dan tegangan pada meteran",
      "Catat data pembacaan meteran"
    ]
  };

  const stepsList = document.getElementById('stepsList');
  const levelSelect = document.getElementById('levelSelect');
  const message = document.getElementById('message');
  const scoreDisplay = document.getElementById('score');
  const resetBtn = document.getElementById('resetBtn');
  const audioCorrect = document.getElementById('audioCorrect');
  const audioWrong = document.getElementById('audioWrong');
  const meterNeedle = document.getElementById('meterNeedle');

  let currentStep = 0;
  let score = 0;

  function updateNeedle() {
    const stepsCount = stepsData[levelSelect.value].length;
    // Rotate needle from 0deg to 180deg proportionally to progress
    const angle = (currentStep / stepsCount) * 180;
    meterNeedle.style.transform = `translateX(-50%) rotate(${angle}deg)`;
  }

  function loadSteps(level) {
    stepsList.innerHTML = '';
    stepsData[level].forEach((step, i) => {
      const li = document.createElement('li');
      li.textContent = step;
      li.dataset.step = i;
      stepsList.appendChild(li);
    });
    currentStep = 0;
    score = 0;
    message.textContent = 'Klik langkah sesuai urutan yang benar.';
    scoreDisplay.textContent = 'Skor: 0';
    resetBtn.style.display = 'none';
    updateNeedle();
  }

  levelSelect.addEventListener('change', () => {
    loadSteps(levelSelect.value);
  });

  stepsList.addEventListener('click', (e) => {
    if (e.target.tagName !== 'LI') return;
    if (e.target.classList.contains('correct') || e.target.classList.contains('incorrect')) return;

    const clickedStep = Number(e.target.dataset.step);
    if (clickedStep === currentStep) {
      // Benar
      e.target.classList.add('correct');
      audioCorrect.play();
      currentStep++;
      score += 10;
      message.textContent = 'Langkah benar! Lanjut ke langkah berikutnya.';
      scoreDisplay.textContent = `Skor: ${score}`;
      updateNeedle();

      if (currentStep === stepsData[levelSelect.value].length) {
        message.textContent = '🎉 Selamat! Anda berhasil menyelesaikan simulasi.';
        resetBtn.style.display = 'block';

        // Simpan skor ke localStorage
        localStorage.setItem(`simulasi_skor_${levelSelect.value}`, score);
      }
    } else {
      // Salah
      e.target.classList.add('incorrect');
      audioWrong.play();
      score -= 5;
      if(score < 0) score = 0;
      message.textContent = 'Langkah salah! Coba lagi.';
      scoreDisplay.textContent = `Skor: ${score}`;
    }
  });

  resetBtn.addEventListener('click', () => {
    loadSteps(levelSelect.value);
  });

  // Load default level steps on page load
  loadSteps(levelSelect.value);
</script>

</body>
</html>
