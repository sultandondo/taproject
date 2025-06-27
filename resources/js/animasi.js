import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/Addons.js';
import getStar from '../js/getstar';
import { getFresnel } from '../js/getfresnel';


document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // THREE.JS SETUP
    // ==========================================
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 10, 500000);
    const renderer = new THREE.WebGLRenderer({ antialias: true });
    
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.outputColorSpace = THREE.LinearSRGBColorSpace;

    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.minDistance = 7000;
    controls.maxDistance = 90000;
    camera.position.z = 20000;

    

    // ==========================================
    // MODULE 2: UI COMPONENTS & CONTROL PANEL
    // ==========================================

    // Control Panel
    const panel = document.createElement('div');
    Object.assign(panel.style, {
        position: 'fixed',
        top: '10px',
        left: '10px',
        zIndex: '20',
        background: '#1a1e2e',
        color: 'white',
        padding: '12px',
        borderRadius: '8px',
        fontFamily: 'sans-serif',
        width: '260px',
        maxHeight: '90vh',
        overflowY: 'auto',
        boxShadow: '0 2px 10px rgba(0, 0, 0, 0.3)'
    });
    document.body.appendChild(panel);

    // Informasi orbit - Collapsible Panel
    const orbitInfoPanel = document.createElement('div');
    Object.assign(orbitInfoPanel.style, {
        marginBottom: '2px',
        border: '1px solid #444',
        backgroundColor: '#2a2e3e'
    });

    const infoTitle = document.createElement('h4');
    infoTitle.innerHTML = '▶ Orbit Parameters';
    Object.assign(infoTitle.style, {
        margin: '0',
        fontSize: '14px',
        padding: '8px 12px',
        cursor: 'pointer',
        userSelect: 'none',
        backgroundColor: '#3a3e4e',
        color: '#ffffff',
        fontWeight: 'normal',
        borderBottom: '1px solid #555',
        transition: 'background-color 0.2s'
    });

    // Hover effect for title
    infoTitle.addEventListener('mouseenter', () => {
        infoTitle.style.backgroundColor = '#4a4e5e';
    });
    infoTitle.addEventListener('mouseleave', () => {
        infoTitle.style.backgroundColor = '#3a3e4e';
    });

    orbitInfoPanel.appendChild(infoTitle);

    const orbitInfoContent = document.createElement('div');
    Object.assign(orbitInfoContent.style, {
        padding: '10px',
        display: 'none',
        backgroundColor: '#2a2e3e'
    });

    const orbitInfo = document.createElement('pre');
    Object.assign(orbitInfo.style, {
        fontFamily: 'monospace',
        fontSize: '13px',
        color: 'white',
        margin: '0',
        whiteSpace: 'pre',
    });

    orbitInfoContent.appendChild(orbitInfo);
    orbitInfoPanel.appendChild(orbitInfoContent);

    // Toggle functionality
    let isOrbitInfoCollapsed = true;
    infoTitle.addEventListener('click', () => {
        isOrbitInfoCollapsed = !isOrbitInfoCollapsed;
        
        if (isOrbitInfoCollapsed) {
            orbitInfoContent.style.display = 'none';
            infoTitle.innerHTML = '▶ Orbit Parameters';
        } else {
            orbitInfoContent.style.display = 'block';
            infoTitle.innerHTML = '▼ Orbit Parameters';
        }
    });

    panel.appendChild(orbitInfoPanel);

    // Kontrol Panel Waktu - COLLAPSIBLE (MOVED HERE)
    const timeControlPanel = document.createElement('div');
    Object.assign(timeControlPanel.style, {
        marginBottom: '2px',
        border: '1px solid #444',
        backgroundColor: '#2a2e3e'
    });

    const timeControlTitle = document.createElement('h5');
    timeControlTitle.innerHTML = '▶ Time Control';
    Object.assign(timeControlTitle.style, {
        margin: '0',
        fontSize: '14px',
        padding: '8px 12px',
        cursor: 'pointer',
        userSelect: 'none',
        backgroundColor: '#3a3e4e',
        color: '#ffffff',
        fontWeight: 'normal',
        borderBottom: '1px solid #555',
        transition: 'background-color 0.2s'
    });

    // Hover effect for title
    timeControlTitle.addEventListener('mouseenter', () => {
        timeControlTitle.style.backgroundColor = '#4a4e5e';
    });
    timeControlTitle.addEventListener('mouseleave', () => {
        timeControlTitle.style.backgroundColor = '#3a3e4e';
    });

    timeControlPanel.appendChild(timeControlTitle);

    const timeControlContent = document.createElement('div');
    Object.assign(timeControlContent.style, {
        padding: '10px',
        display: 'none',
        backgroundColor: '#2a2e3e'
    });

    // Kontrol Bulan
    const monthControls = document.createElement('div');
    monthControls.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <label style="color: white; font-size: 12px;">Bulan:</label>
            <div style="display: flex; gap: 5px;">
                <button id="decreaseMonth" style="width: 25px; height: 25px; font-size: 12px;">−</button>
                <button id="increaseMonth" style="width: 25px; height: 25px; font-size: 12px;">+</button>
            </div>
        </div>
    `;
    timeControlContent.appendChild(monthControls);

    // Kontrol Panel Hari
    const dayControls = document.createElement('div');
    dayControls.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <label style="color: white; font-size: 12px;">Hari:</label>
            <div style="display: flex; gap: 5px;">
                <button id="decreaseDay" style="width: 25px; height: 25px; font-size: 12px;">−</button>
                <button id="increaseDay" style="width: 25px; height: 25px; font-size: 12px;">+</button>
            </div>
        </div>
    `;
    timeControlContent.appendChild(dayControls);

    // Kontrol Panel Jam
    const hourControls = document.createElement('div');
    hourControls.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <label style="color: white; font-size: 12px;">Jam:</label>
            <div style="display: flex; gap: 5px;">
                <button id="decreaseHour" style="width: 25px; height: 25px; font-size: 12px;">−</button>
                <button id="increaseHour" style="width: 25px; height: 25px; font-size: 12px;">+</button>
            </div>
        </div>
    `;
    timeControlContent.appendChild(hourControls);

    // Tombol Reset Waktu
    const resetTimeBtn = document.createElement('button');
    resetTimeBtn.textContent = 'Reset ke Waktu Sekarang';
    Object.assign(resetTimeBtn.style, {
        width: '100%',
        padding: '5px',
        marginTop: '8px',
        background: '#4a9eff',
        color: 'white',
        border: 'none',
        borderRadius: '3px',
        cursor: 'pointer',
        fontSize: '11px'
    });
    timeControlContent.appendChild(resetTimeBtn);

    // Speed Controls (MOVED HERE)
    const speedControls = document.createElement('div');
    speedControls.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; border-top: 1px solid #444; padding-top: 8px;">
            <label style="color: white; font-size: 12px;">Kecepatan:</label>
            <div style="display: flex; align-items: center; gap: 10px;">
                <button id="decreaseSpeedTime">−</button>
                <span style="color: white;"><span id="speedValueTime">0</span>x</span>
                <button id="increaseSpeedTime">+</button>
            </div>
        </div>
    `;
    timeControlContent.appendChild(speedControls);

    timeControlPanel.appendChild(timeControlContent);

    // Toggle functionality for time control panel
    let isTimeControlCollapsed = true;
    timeControlTitle.addEventListener('click', () => {
        isTimeControlCollapsed = !isTimeControlCollapsed;
        
        if (isTimeControlCollapsed) {
            timeControlContent.style.display = 'none';
            timeControlTitle.innerHTML = '▶ Time Control';
        } else {
            timeControlContent.style.display = 'block';
            timeControlTitle.innerHTML = '▼ Time Control';
        }
    });

    panel.appendChild(timeControlPanel);

    // ==========================================
    // GROUNDTRACK PANEL - COLLAPSIBLE
    // ==========================================
    const trailControlPanel = document.createElement('div');
    Object.assign(trailControlPanel.style, {
        marginBottom: '2px',
        border: '1px solid #444',
        backgroundColor: '#2a2e3e'
    });

    const trailControlTitle = document.createElement('h5');
    trailControlTitle.innerHTML = '▶ Groundtrack';
    Object.assign(trailControlTitle.style, {
        margin: '0',
        fontSize: '14px',
        padding: '8px 12px',
        cursor: 'pointer',
        userSelect: 'none',
        backgroundColor: '#3a3e4e',
        color: '#ffffff',
        fontWeight: 'normal',
        borderBottom: '1px solid #555',
        transition: 'background-color 0.2s'
    });

    // Hover effect for title
    trailControlTitle.addEventListener('mouseenter', () => {
        trailControlTitle.style.backgroundColor = '#4a4e5e';
    });
    trailControlTitle.addEventListener('mouseleave', () => {
        trailControlTitle.style.backgroundColor = '#3a3e4e';
    });

    trailControlPanel.appendChild(trailControlTitle);

    const trailControlContent = document.createElement('div');
    Object.assign(trailControlContent.style, {
        padding: '10px',
        display: 'none',
        backgroundColor: '#2a2e3e'
    });

    // Trail duration selector
    const trailDurationSelect = document.createElement('select');
    trailDurationSelect.innerHTML = `
        <option value="1">1 Jam</option>
        <option value="8">8 Jam</option>
        <option value="12">12 Jam</option>
        <option value="24" selected>1 Hari (24 Jam)</option>
    `;
    Object.assign(trailDurationSelect.style, {
        width: '100%',
        padding: '5px',
        backgroundColor: '#3a3e4e',
        color: 'white',
        border: '1px solid #555',
        borderRadius: '3px',
        fontSize: '12px',
        marginBottom: '8px'
    });
    trailControlContent.appendChild(trailDurationSelect);

    // Show prediction button
    const showPredictionBtn = document.createElement('button');
    showPredictionBtn.textContent = 'Show Trail Prediction';
    Object.assign(showPredictionBtn.style, {
        width: '100%',
        padding: '6px',
        marginBottom: '5px',
        background: '#4CAF50',
        color: 'white',
        border: 'none',
        borderRadius: '3px',
        cursor: 'pointer',
        fontSize: '11px'
    });
    trailControlContent.appendChild(showPredictionBtn);

    // Clear prediction button
    const clearPredictionBtn = document.createElement('button');
    clearPredictionBtn.textContent = 'Clear Prediction';
    Object.assign(clearPredictionBtn.style, {
        width: '100%',
        padding: '6px',
        marginBottom: '8px',
        background: '#f44336',
        color: 'white',
        border: 'none',
        borderRadius: '3px',
        cursor: 'pointer',
        fontSize: '11px'
    });
    trailControlContent.appendChild(clearPredictionBtn);

    // Tombol Ground Track - MOVED HERE
    const displayBtn = document.createElement('button');
    displayBtn.textContent = 'Display Ground Track';
    Object.assign(displayBtn.style, {
        width: '100%',
        padding: '6px',
        background: '#ddd',
        color: 'black',
        border: 'none',
        borderRadius: '4px',
        cursor: 'pointer',
        fontSize: '11px'
    });
    trailControlContent.appendChild(displayBtn);

    trailControlPanel.appendChild(trailControlContent);

    // Toggle functionality for trail control panel
    let isTrailControlCollapsed = true;
    trailControlTitle.addEventListener('click', () => {
        isTrailControlCollapsed = !isTrailControlCollapsed;
        
        if (isTrailControlCollapsed) {
            trailControlContent.style.display = 'none';
            trailControlTitle.innerHTML = '▶ Groundtrack';
        } else {
            trailControlContent.style.display = 'block';
            trailControlTitle.innerHTML = '▼ Groundtrack';
        }
    });

    panel.appendChild(trailControlPanel);

    // ==========================================
    // PREDICTION TRAIL SYSTEM
    // ==========================================
    let predictionTrail = [];
    let showingPrediction = false;
    let predictionCanvas = null;
    let predictionCtx = null;

    // Variabel Kontrol Kecepatan (MOVED HERE)
    let displaySpeed = 0;
    let speedFactor = 1;
    const speedValueTime = timeControlContent.querySelector("#speedValueTime");
    const minDisplaySpeed = 0;
    const maxDisplaySpeed = 5000;

    function updateSpeedValues() {
        speedValueTime.textContent = displaySpeed;
        speedFactor = displaySpeed === 0 ? 1 : displaySpeed;
    }

    timeControlContent.querySelector("#increaseSpeedTime").addEventListener("click", () => {
        if (displaySpeed + 100 <= maxDisplaySpeed) {
            displaySpeed += 100;
            updateSpeedValues();
        }
    });

    timeControlContent.querySelector("#decreaseSpeedTime").addEventListener("click", () => {
        if (displaySpeed - 100 >= minDisplaySpeed) {
            displaySpeed -= 100;
            updateSpeedValues();
        }
    });

    // Tombol Close
    const closeBtn = document.createElement('div');
    closeBtn.innerHTML = '&#10006;';
    Object.assign(closeBtn.style, {
        position: 'fixed',
        top: '20px',
        right: '30px',
        width: '32px',
        height: '32px',
        backgroundColor: 'red',
        color: 'white',
        display: 'none',
        alignItems: 'center',
        justifyContent: 'center',
        borderRadius: '4px',
        cursor: 'pointer',
        fontSize: '20px',
        zIndex: '40'
    });
    document.body.appendChild(closeBtn);


// ==========================================
// INFO POPUP 
// ==========================================

// Tombol Info (Tanda Tanya)
const infoButton = document.createElement('div');
infoButton.innerHTML = '?';
Object.assign(infoButton.style, {
    position: 'fixed',
    top: '10px',
    left: '300px', 
    width: '32px',
    height: '32px',
    backgroundColor: '#4a9eff',
    color: 'white',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    borderRadius: '50%',
    cursor: 'pointer',
    fontSize: '18px',
    fontWeight: 'bold',
    zIndex: '25',
    boxShadow: '0 2px 10px rgba(0, 0, 0, 0.3)',
    transition: 'all 0.3s ease',
    fontFamily: 'sans-serif'
});

// Hover effect untuk tombol info
infoButton.addEventListener('mouseenter', () => {
    infoButton.style.backgroundColor = '#3a8eef';
    infoButton.style.transform = 'scale(1.1)';
});

infoButton.addEventListener('mouseleave', () => {
    infoButton.style.backgroundColor = '#4a9eff';
    infoButton.style.transform = 'scale(1)';
});

document.body.appendChild(infoButton);

// Pop-up Modal
const infoModal = document.createElement('div');
Object.assign(infoModal.style, {
    position: 'fixed',
    top: '0',
    left: '0',
    width: '100%',
    height: '100%',
    backgroundColor: 'rgba(0, 0, 0, 0.7)',
    display: 'none',
    alignItems: 'center',
    justifyContent: 'center',
    zIndex: '1000',
    backdropFilter: 'blur(5px)'
});

// Konten Modal
const modalContent = document.createElement('div');
Object.assign(modalContent.style, {
    backgroundColor: '#1a1e2e',
    color: 'white',
    padding: '25px',
    borderRadius: '12px',
    maxWidth: '600px',
    maxHeight: '80vh',
    overflowY: 'auto',
    fontFamily: 'sans-serif',
    position: 'relative',
    boxShadow: '0 10px 30px rgba(0, 0, 0, 0.5)',
    border: '1px solid #444'
});

// Tombol Close pop up
const closeModalBtn = document.createElement('div');
closeModalBtn.innerHTML = '×';
Object.assign(closeModalBtn.style, {
    position: 'absolute',
    top: '10px',
    right: '15px',
    fontSize: '28px',
    cursor: 'pointer',
    color: '#ccc',
    transition: 'color 0.3s ease'
});

closeModalBtn.addEventListener('mouseenter', () => {
    closeModalBtn.style.color = '#ff6b6b';
});

closeModalBtn.addEventListener('mouseleave', () => {
    closeModalBtn.style.color = '#ccc';
});

modalContent.appendChild(closeModalBtn);

// Konten Informasi
const infoContent = document.createElement('div');
infoContent.innerHTML = `
    <h2 style="color: #4a9eff; margin-top: 0; margin-bottom: 20px; text-align: center; font-size: 24px;">
        Panduan Penggunaan 
    </h2>

    <div style="margin-bottom: 20px;">
        <h3 style="color: #ffb74d; margin-bottom: 10px; font-size: 18px;"> Time Control</h3>
        <p style="line-height: 1.6; margin-bottom: 10px;">
            Kontrol waktu simulasi satelit:
        </p>
        <ul style="margin-left: 20px; line-height: 1.6;">
            <li><strong>Bulan/Hari/Jam:</strong> Ketuk tombol untukmubah waktu simulasi dengan tombol +/-</li>
            <li><strong>Reset:</strong> Ketuk tombol untuk menyamakan dengan waktu real-time</li>
            <li><strong>Kecepatan:</strong> Ketuk tombol percepat simulasi (0x = real-time, hingga 5000x)</li>
        </ul>
    </div>

    <div style="margin-bottom: 20px;">
        <h3 style="color: #ffb74d; margin-bottom: 10px; font-size: 18px;"> Groundtrack</h3>
        <p style="line-height: 1.6; margin-bottom: 10px;">
            Visualisasi 2D jejak satelit di permukaan Bumi:
        </p>
        <ul style="margin-left: 20px; line-height: 1.6;">
            <li><strong>Durasi Trail:</strong> Pilih prediksi jejak dalam (1/8/12/24 jam) kedepan </li>
            <li><strong>Show Prediction:</strong> Ketuk tombol untuk tampilkan prediksi jalur satelit di groundtrack</li>
            <li><strong>Clear Prediction:</strong> Ketuk tombol untuk menghapus jejak prediksi yang lama</li>
            <li><strong>Display Ground Track:</strong> Ketuk tombol untuk tampilkan groundtrack</li>
        </ul>
    </div>`
    ;

modalContent.appendChild(infoContent);
infoModal.appendChild(modalContent);
document.body.appendChild(infoModal);

// Event Listeners
infoButton.addEventListener('click', () => {
    infoModal.style.display = 'flex';
});

closeModalBtn.addEventListener('click', () => {
    infoModal.style.display = 'none';
});

// Close modal ketika klik di luar konten
infoModal.addEventListener('click', (e) => {
    if (e.target === infoModal) {
        infoModal.style.display = 'none';
    }
});

// Close modal dengan tombol ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && infoModal.style.display === 'flex') {
        infoModal.style.display = 'none';
    }
});

// Animasi fade in/out
infoButton.addEventListener('click', () => {
    infoModal.style.display = 'flex';
    infoModal.style.opacity = '0';
    setTimeout(() => {
        infoModal.style.transition = 'opacity 0.3s ease';
        infoModal.style.opacity = '1';
    }, 10);
});

function closeModal() {
    infoModal.style.transition = 'opacity 0.3s ease';
    infoModal.style.opacity = '0';
    setTimeout(() => {
        infoModal.style.display = 'none';
    }, 300);
}

closeModalBtn.addEventListener('click', closeModal);

infoModal.addEventListener('click', (e) => {
    if (e.target === infoModal) {
        closeModal();
    }
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && infoModal.style.display === 'flex') {
        closeModal();
    }
});
    // Display Tanggal - Moved to top center
    const dateDisplay = document.createElement('div');
    dateDisplay.style.position = 'fixed';
    dateDisplay.style.top = '10px';
    dateDisplay.style.left = '50%';
    dateDisplay.style.transform = 'translateX(-50%)';
    dateDisplay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    dateDisplay.style.color = 'white';
    dateDisplay.style.padding = '10px 20px';
    dateDisplay.style.borderRadius = '8px';
    dateDisplay.style.fontFamily = 'monospace';
    dateDisplay.style.fontSize = '14px';
    dateDisplay.style.zIndex = '100';
    dateDisplay.style.textAlign = 'center';
    dateDisplay.style.border = '1px solid #444';
    dateDisplay.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.3)';
    document.body.appendChild(dateDisplay);

    // Info Satelit
    const satelliteDisplay = document.createElement('div');
    satelliteDisplay.style.position = 'fixed';
    satelliteDisplay.style.bottom = '10px';
    satelliteDisplay.style.left = '50%';
    satelliteDisplay.style.transform = 'translateX(-50%)';
    satelliteDisplay.style.color = 'white';
    satelliteDisplay.style.padding = '8px 12px';
    satelliteDisplay.style.borderRadius = '8px';
    satelliteDisplay.style.fontFamily = 'monospace';
    satelliteDisplay.style.fontSize = '12px';
    satelliteDisplay.style.zIndex = '100';
    satelliteDisplay.style.minWidth = '200px';
    satelliteDisplay.style.textAlign = 'center';
    document.body.appendChild(satelliteDisplay);

    // Current time display (separate from simulation time)
    const currentTimeDisplay = document.createElement('div');
    currentTimeDisplay.style.position = 'fixed';
    currentTimeDisplay.style.bottom = '10px';
    currentTimeDisplay.style.right = '10px';
    currentTimeDisplay.style.backgroundColor = 'rgba(0, 50, 100, 0.8)';
    currentTimeDisplay.style.color = 'white';
    currentTimeDisplay.style.padding = '8px 12px';
    currentTimeDisplay.style.borderRadius = '8px';
    currentTimeDisplay.style.fontFamily = 'monospace';
    currentTimeDisplay.style.fontSize = '12px';
    currentTimeDisplay.style.zIndex = '100';
    document.body.appendChild(currentTimeDisplay);

    // Update current time display
   async function getTimezoneFromIP() {
    try {
        // Menggunakan API gratis untuk mendapatkan timezone dari IP
        const response = await fetch('http://worldtimeapi.org/api/ip');
        const data = await response.json();
        return data.timezone;
    } catch (error) {
        console.error('Error getting timezone:', error);
        // Fallback ke timezone browser
        return Intl.DateTimeFormat().resolvedOptions().timeZone;
    }
}

async function updateCurrentTimeDisplay() {
    const timezone = await getTimezoneFromIP();
    const now = new Date();
    
    const userTime = now.toLocaleString('id-ID', {
        timeZone: timezone,
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    });
    
    currentTimeDisplay.textContent = `Time (${timezone}): ${userTime}`;
}

// Panggil sekali untuk setup, lalu update setiap detik
updateCurrentTimeDisplay();
setInterval(() => {
    // Update tanpa fetch API lagi untuk performa
    const now = new Date();
    const timezone = currentTimeDisplay.dataset.timezone || Intl.DateTimeFormat().resolvedOptions().timeZone;
    
    const userTime = now.toLocaleString('id-ID', {
        timeZone: timezone,
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    });
    
    currentTimeDisplay.textContent = `Time (${timezone}): ${userTime}`;
}, 1000);
    
    // Update real time every second
    setInterval(updateCurrentTimeDisplay, 1000);
    updateCurrentTimeDisplay();

    // ==========================================
    // LOGO DI KANAN ATAS
    // ==========================================
    const logoContainer = document.createElement('div');
    Object.assign(logoContainer.style, {
        position: 'fixed',
        top: '10px',
        right: '10px',
        zIndex: '25',
        padding: '8px 12px',
        borderRadius: '8px',
        display: 'flex',
        alignItems: 'center',
        gap: '8px',
    });
    document.body.appendChild(logoContainer);

    // Logo image
    const logoImg = document.createElement('img');
    logoImg.src = 'teksture/logo.png';
    Object.assign(logoImg.style, {
        width: '75px',
        height: '75px',
        borderRadius: '4px'
    });
    logoContainer.appendChild(logoImg);

    // ==========================================
    // MODULE 3: LEAFLET.JS MAP SYSTEM (FIXED)
    // ==========================================
    
    // Load Leaflet CSS
    const leafletCSS = document.createElement('link');
    leafletCSS.rel = 'stylesheet';
    leafletCSS.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
    document.head.appendChild(leafletCSS);

    // Load Leaflet JS
    const leafletScript = document.createElement('script');
    leafletScript.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    document.head.appendChild(leafletScript);

    // Create map container
    const mapContainer = document.createElement('div');
    mapContainer.id = 'mapContainer';
    Object.assign(mapContainer.style, {
        position: 'absolute',
        border: 'none',
        zIndex: '30',
        display: 'none',
        boxSizing: 'border-box',
        pointerEvents: 'auto'
    });
    document.body.appendChild(mapContainer);

    // Canvas untuk terminator dan trail (overlay di atas peta)
    const canvasGT = document.createElement('canvas');
    Object.assign(canvasGT.style, {
        position: 'absolute',
        border: 'none',
        zIndex: '32',
        display: 'none',
        boxSizing: 'border-box',
        pointerEvents: 'none',
        touchAction: 'none'
    });
    document.body.appendChild(canvasGT);

    const ctxGT = canvasGT.getContext('2d');
    let widthGT = 0, heightGT = 0;
    let leafletMap = null;

    // Trail Optimasi 
    let trailCanvas = null;
    let trailCtx = null;
    let lastTrailUpdate = 0;
    let trailNeedsUpdate = true;

    // ==========================================
    // LEAFLET COORDINATE CONVERSION FUNCTIONS (NEW)
    // ==========================================
    
    // Fungsi konversi koordinat menggunakan Leaflet map
    function convertCoordsToPixel(coords) {
        if (!leafletMap) return null;
        
        const [lon, lat] = coords;
        const latLng = L.latLng(lat, lon);
        const point = leafletMap.latLngToContainerPoint(latLng);
        
        // Periksa apakah titik berada dalam viewport
        const bounds = leafletMap.getBounds();
        if (bounds.contains(latLng)) {
            return [point.x, point.y];
        }
        return null;
    }

    // Fungsi untuk redraw semua overlay saat peta berubah
    function redrawOverlays() {
        if (!leafletMap || mapContainer.style.display === 'none') return;
        
        console.log('Redrawing overlays after map change');
        trailNeedsUpdate = true;
        nightOverlayCanvas = null; // Force terminator recalculation
        frameCounter = 0;
        
        // Clear dan redraw canvas overlay
        if (ctxGT) {
            ctxGT.clearRect(0, 0, widthGT, heightGT);
        }
    }

    function updateCanvasSize() {
        const aspect = 2.5;
        let w = window.innerWidth;
        let h = w / aspect;

        if (w <= 768 && h > window.innerHeight) {
            h = window.innerHeight;
            w = h * aspect;
        }

        if (w > 2000) w = 2000;
        h = w / aspect;
        if (h > window.innerHeight) {
            h = window.innerHeight;
            w = h * aspect;
        }

        // Update map container
        mapContainer.style.width = `${w}px`;
        mapContainer.style.height = `${h}px`;
        mapContainer.style.top = `${(window.innerHeight - h) / 2}px`;
        mapContainer.style.left = `${(window.innerWidth - w) / 2}px`;

        // PENTING: Canvas overlay harus sama persis dengan map container
        canvasGT.width = w;
        canvasGT.height = h;
        Object.assign(canvasGT.style, {
            width: `${w}px`,
            height: `${h}px`,
            top: `${(window.innerHeight - h) / 2}px`,
            left: `${(window.innerWidth - w) / 2}px`
        });

        widthGT = w;
        heightGT = h;
        
        trailNeedsUpdate = true;
        
        // Update prediction canvas size if it exists
        if (predictionCanvas) {
            predictionCanvas.width = widthGT;
            predictionCanvas.height = heightGT;
        }

        // Invalidate map size and force redraw
        if (leafletMap) {
            setTimeout(() => {
                leafletMap.invalidateSize();
                redrawOverlays(); // Redraw semua overlay setelah resize
            }, 100);
        }
    }

    window.addEventListener('resize', updateCanvasSize);

    // Membuat Canvas Hitam
    function createBlackBackgroundCanvas() {
        const canvas = document.createElement('canvas');
        canvas.id = 'canvasBackground';
        Object.assign(canvas.style, {
            position: 'absolute',
            top: '0',
            left: '0',
            zIndex: '0',
            pointerEvents: 'none'
        });
        document.body.appendChild(canvas);

        function resizeAndPaint() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            const ctx = canvas.getContext('2d');
            ctx.fillStyle = 'black';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }

        resizeAndPaint();
        window.addEventListener('resize', resizeAndPaint);
    }

    // Enhanced Leaflet Map Initialization dengan event listeners
    function initLeafletMap() {
        if (!window.L) {
            setTimeout(initLeafletMap, 100);
            return;
        }

        if (leafletMap) {
            leafletMap.remove();
        }

        leafletMap = L.map('mapContainer', {
            center: [0, 0],
            zoom: 2,
            zoomControl: true,
            attributionControl: false,
            maxZoom: 10,
            minZoom: 2,
            worldCopyJump: false,  // Tambahkan ini
            maxBounds: [[-90, -180], [90, 180]],  // Batasi ke satu dunia
            maxBoundsViscosity: 1.0  // Mencegah panning keluar bounds
        });


        // Define base layers
const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 10,
    minZoom: 0, 
});

const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '© Esri, Maxar, Earthstar Geographics',
    maxZoom: 10,
    minZoom: 0,
 
});

// Add default layer
osmLayer.addTo(leafletMap);

// Create layer control
const baseLayers = {
    "Street Map": osmLayer,
    "Satellite": satelliteLayer
};

L.control.layers(baseLayers).addTo(leafletMap);

        // TAMBAHKAN EVENT LISTENERS untuk sinkronisasi overlay
        leafletMap.on('moveend', redrawOverlays);
        leafletMap.on('zoomend', redrawOverlays);
        leafletMap.on('resize', redrawOverlays);
        
        console.log('Leaflet map initialized with overlay sync events');
    }

    // Menampilkan Groundtrack
    function showGroundTrackCanvas() {
        mapContainer.style.display = 'block';
        mapContainer.style.pointerEvents = 'auto';
        canvasGT.style.display = 'block';
        closeBtn.style.display = 'flex';
        panel.style.display = 'none';
        logoContainer.style.display = 'none';

        if (!document.getElementById('canvasBackground')) {
            createBlackBackgroundCanvas();
        }

        // Initialize Leaflet map if not already done
        if (!leafletMap) {
            initLeafletMap();
        }
    }

    // Menyembunyikan Groundtrack
    function hideGroundTrackCanvas() {
        mapContainer.style.display = 'none';
        canvasGT.style.display = 'none';
        closeBtn.style.display = 'none';
        panel.style.display = 'block';
        logoContainer.style.display = 'flex'

        const canvasBG = document.getElementById('canvasBackground');
        if (canvasBG) canvasBG.remove();
    }

    displayBtn.addEventListener('click', showGroundTrackCanvas);
    closeBtn.addEventListener('click', hideGroundTrackCanvas);

    updateCanvasSize();
    

    // ==========================================
    // MODULE 4: EARTH & CELESTIAL OBJECTS
    // ==========================================
    const loader = new THREE.TextureLoader();
    const geometri = new THREE.SphereGeometry(6371, 64, 64);
    
    // Grup Bumi
    const grupbumi = new THREE.Group();
    scene.add(grupbumi);
    
    const material = new THREE.MeshPhongMaterial({
        map: loader.load('teksture/bumisiang.jpg'),
        bumpMap: loader.load('teksture/bump.jpg'),
        specularMap: loader.load('teksture/mask.png'),
    });
    const bumi = new THREE.Mesh(geometri, material);
    grupbumi.add(bumi);

    // City lights
    const city = new THREE.MeshBasicMaterial({
        map: loader.load('teksture/bumimalam.jpg'),
        blending: THREE.AdditiveBlending,
    });
    const citylight = new THREE.Mesh(geometri, city);
    grupbumi.add(citylight);

    // Fresnel
    const fresnel = getFresnel();
    const bersinar = new THREE.Mesh(geometri, fresnel);
    bersinar.scale.setScalar(1.01);
    grupbumi.add(bersinar);

    // Awan
    const awan = new THREE.MeshStandardMaterial({
        map: loader.load('teksture/berawan.jpg'),
        blending: THREE.AdditiveBlending,
    });
    const awanku = new THREE.Mesh(geometri, awan);
   awanku.scale.setScalar(1.003);
   grupbumi.add(awanku);

   // Bintang
   const bintang = getStar({ numStars: 1000 });
   scene.add(bintang);

   // Milky Way background
   new THREE.TextureLoader().load('teksture/milkyway.jpg', function (texture) {
       const rt = new THREE.WebGLCubeRenderTarget(texture.image.height);
       rt.fromEquirectangularTexture(renderer, texture);
       scene.background = rt.texture;
   });

   // ==========================================
   // ENHANCED REALISTIC SUN SYSTEM WITH PROPER SEASONAL BEHAVIOR
   // ==========================================

   // UNTUK ROTASI BUMI 3D (berputar ke kanan saat speed naik)
function calculateEarthRotationPosition(simulatedTime) {
    const hoursFromMidnight = simulatedTime.getUTCHours() +
                                simulatedTime.getUTCMinutes() / 60 + 
                           simulatedTime.getUTCSeconds() / 3600;
  
  // UNTUK 3D: Rotasi ke kanan saat waktu maju
  const hourlyRotation = (hoursFromMidnight - 12) * 15;
  
  const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
 const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;
 const yearlyRotation = (dayOfYear - 1) * 0.9856;
 
 const totalRotation = hourlyRotation + yearlyRotation;
 
 let normalizedRotation = ((totalRotation % 360) + 360) % 360;
 if (normalizedRotation > 180) {
     normalizedRotation -= 360;
 }
 
 return normalizedRotation;
}

// FUNGSI YANG DIPERBAIKI: Posisi matahari untuk groundtrack (terminator tidak bergeser saat ubah bulan/hari)
function calculateRealisticSunPosition(simulatedTime) {
 const hoursFromMidnight = simulatedTime.getUTCHours() + 
                          simulatedTime.getUTCMinutes() / 60 + 
                          simulatedTime.getUTCSeconds() / 3600;
 
 const hourlyLongitude = (12 - hoursFromMidnight) * 15;
 
 // HAPUS bagian yearlyOffset yang menyebabkan pergeseran berdasarkan hari
 // const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
 // const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;
 // const yearlyOffset = (dayOfYear - 1) * 0.9856;
 
 const groundTrackOffset = 105;
 
 // Hanya gunakan hourlyLongitude dan groundTrackOffset, tanpa yearlyOffset
 const totalSunLongitude = hourlyLongitude + groundTrackOffset;
 
 let normalizedLongitude = ((totalSunLongitude % 360) + 360) % 360;
 if (normalizedLongitude > 180) {
     normalizedLongitude -= 360;
 }
 
 return normalizedLongitude;
}

function calculateRealisticSunDeclination(simulatedTime) {
    // Komponen MUSIMAN - hanya berdasarkan hari dalam tahun (bulan/hari)
    const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
    const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;
    
    // Deklinasi berdasarkan MUSIM saja (ini yang bergerak naik-turun)
    const declination = -23.45 * Math.cos(THREE.MathUtils.degToRad((360 / 365.25) * (dayOfYear + 10)));
    
    return declination;
}

// Hitung posisi matahari dalam orbit tahunan Bumi (untuk animasi orbit 3D)
function calculateSunYearlyOrbitPosition(simulatedTime) {
    // Day of year calculation for orbital position
    const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
    const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;
    
    // Earth's orbital position around sun (from Earth's perspective, sun appears to orbit)
    const orbitalAngle = (dayOfYear / 365.25) * 2 * Math.PI;
    
    // Apply orbital eccentricity for more realistic positioning
    const eccentricity = 0.0167; // Earth's orbital eccentricity
    const meanAnomaly = orbitalAngle;
    const trueAnomaly = meanAnomaly + 2 * eccentricity * Math.sin(meanAnomaly);
    
    return {
        angle: trueAnomaly,
        dayOfYear: dayOfYear
    };
}

// Hitung efek kemiringan aksial untuk musim yang realistis
function calculateEarthAxisTilt(simulatedTime) {
    const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
    const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;
    
    // Maximum tilt on solstices, zero on equinoxes
    const tiltAngle = 23.45 * Math.sin(THREE.MathUtils.degToRad((360 / 365.25) * (dayOfYear - 81)));
    
    return tiltAngle;
}

// ==========================================
// ENHANCED EARTH ROTATION SYNCHRONIZATION WITH SUN POSITION
// ==========================================

// Fungsi untuk menghitung di mana Bumi harus dirotasi berdasarkan posisi matahari
function calculateRequiredEarthRotation(simulatedTime) {
 // GUNAKAN KALKULASI TERPISAH UNTUK ROTASI 3D
 const earthRotationLongitude = calculateEarthRotationPosition(simulatedTime);
 
 const offsetDegrees = -100; //offset untuk bumi
 const adjustedRotation = earthRotationLongitude + offsetDegrees;
 const requiredRotationRadians = THREE.MathUtils.degToRad(adjustedRotation);
 
 console.log(`Earth 3D rotation: ${THREE.MathUtils.radToDeg(requiredRotationRadians).toFixed(2)}°`);
 
 return requiredRotationRadians;
}


// ENHANCED: Fungsi untuk menyinkronkan rotasi Bumi dengan posisi matahari DAN directional light
function synchronizeEarthRotationWithSun() {
 // ROTASI BUMI 3D (ke kanan saat speed naik)
 const requiredRotation = calculateRequiredEarthRotation(simulatedTime);
 
 bumi.rotation.y = requiredRotation;
 citylight.rotation.y = requiredRotation;
 bersinar.rotation.y = requiredRotation;
 awanku.rotation.y = requiredRotation;
 
 // SUN POSITION UNTUK 3D LIGHTING (ikuti rotasi Bumi)
 const sunOrbitInfo = calculateSunYearlyOrbitPosition(simulatedTime);
 const earthAxisTilt = calculateEarthAxisTilt(simulatedTime);
 
 grupOrbitMatahari.rotation.y = sunOrbitInfo.angle;
 grupOrbitMatahari.rotation.z = THREE.MathUtils.degToRad(earthAxisTilt);
 
 matahari.position.set(jarakKeMatahari, 0, 0); //mengatur trueanomaly matahari
 
 const sunWorldPosition = new THREE.Vector3();
 matahari.getWorldPosition(sunWorldPosition);
 
 cahaya.position.copy(sunWorldPosition.clone().normalize().multiplyScalar(140000));
 cahaya.target.position.set(0, 0, 0);
 cahaya.target.updateMatrixWorld();
 
 console.log(`Earth 3D synchronized - Rotation: ${THREE.MathUtils.radToDeg(requiredRotation).toFixed(2)}°`);

}
// ==========================================
// ENHANCED TIME CONTROL EVENT LISTENERS WITH PROPER SYNCHRONIZATION
// ==========================================

// Function to safely modify date and synchronize Earth rotation with sun AND lighting
function modifySimulatedTimeWithSync(modifier) {
 const oldTime = new Date(simulatedTime);
 const newTime = new Date(simulatedTime);
 modifier(newTime);
 
 simulatedTime = newTime;
 
 console.log(`=== TIME CHANGE EVENT ===`);
 console.log(`Time changed from ${oldTime.toISOString()} to ${simulatedTime.toISOString()}`);
 
 // PERBAIKAN: Sinkronisasi langsung setelah perubahan waktu
 synchronizeEarthRotationWithSun();
 
 // Update satellite position for all orbit types when time changes manually
 if (orbitType === "GEO") {
     updateGEOSatellitePosition();
 } else {
     // For non-GEO orbits, advance the true anomaly based on time change
     const deltaTimeSeconds = (simulatedTime.getTime() - oldTime.getTime()) / 1000;
     const angleRate = getTrueAnomalyRate(a * Km, e, trueanomaly, orbitType);
     trueanomaly -= angleRate * deltaTimeSeconds;
 }
 
 // Clear all trails when time is manually changed
 groundTrack.length = 0;
 trailPoints.length = 0;
 
 // Force night overlay recalculation when time changes manually
 nightOverlayCanvas = null;
 frameCounter = 0;
 trailNeedsUpdate = true;
 
 // Clear prediction when time is manually changed
 if (showingPrediction) {
     predictionTrail = [];
     showingPrediction = false;
 }
 
 console.log(`=== SYNC COMPLETE ===`);
}


// Enhanced reset time to current with proper synchronization
function resetTimeToCurrentWithSync() {
 const oldTime = new Date(simulatedTime);
 const now = new Date();
 const newTime = new Date(now.getTime() + 7 * 60 * 60 * 1000); // UTC+7
 
 simulatedTime = newTime;
 
 console.log(`=== TIME RESET EVENT ===`);
 console.log(`Time reset from ${oldTime.toISOString()} to ${simulatedTime.toISOString()}`);
 
 // PERBAIKAN: Sinkronisasi langsung setelah reset
 synchronizeEarthRotationWithSun();
 
 // For GEO satellites, update satellite position when time changes manually
 if (orbitType === "GEO") {
     updateGEOSatellitePosition();
 }
 
 // Clear all trails when time is manually changed
 groundTrack.length = 0;
 trailPoints.length = 0;
 
 // Force recalculation
 nightOverlayCanvas = null;
 frameCounter = 0;
 trailNeedsUpdate = true;
 
 // Clear prediction when time is reset
 if (showingPrediction) {
     predictionTrail = [];
     showingPrediction = false;
 }
 
 console.log(`=== RESET COMPLETE ===`);
}

// Membuat Matahari
const grupOrbitMatahari = new THREE.Group();
scene.add(grupOrbitMatahari);
const matahariRadius = 30000;
const sunGeometry = new THREE.SphereGeometry(matahariRadius, 32, 32);
const sunMaterial = new THREE.MeshBasicMaterial({
   map: loader.load('teksture/sun.jpg'),
});
const matahari = new THREE.Mesh(sunGeometry, sunMaterial);
grupOrbitMatahari.add(matahari);

// Directional Light 
const cahaya = new THREE.DirectionalLight(0xffffff, 3);
scene.add(cahaya); 
const jarakKeMatahari = 300000;

// ==========================================
// MODULE 5: SISTEM SATELIT
// ==========================================
const grupSatelit = new THREE.Group();
grupbumi.add(grupSatelit);

// Fungsi Untuk Membuat Satelit
function createAdvancedSatellite() {
const satelliteGroup = new THREE.Group();

// ===== BODY UTAMA =====
// Body utama silinder seperti di gambar
const bodyGeometry = new THREE.CylinderGeometry(60, 60, 200, 16);
const bodyMaterial = new THREE.MeshStandardMaterial({ 
   color: 0xdddddd,
   metalness: 0.7,
   roughness: 0.3,
   emissive: 0x222222
});
const satelliteBody = new THREE.Mesh(bodyGeometry, bodyMaterial);
satelliteGroup.add(satelliteBody);

// ===== RING UNTUK BODY =====
for (let i = 0; i < 4; i++) {
   const ringGeometry = new THREE.CylinderGeometry(65, 65, 8, 16);
   const ringMaterial = new THREE.MeshStandardMaterial({ 
       color: 0x999999,
       metalness: 0.8,
       roughness: 0.2
   });
   const ring = new THREE.Mesh(ringGeometry, ringMaterial);
   ring.position.y = -75 + (i * 50);
   satelliteGroup.add(ring);
}

// ===== MESIN BAWAH =====
const lowerEngineGeometry = new THREE.CylinderGeometry(35, 45, 40, 12);
const lowerEngineMaterial = new THREE.MeshStandardMaterial({ 
   color: 0x444444,
   metalness: 0.9,
   roughness: 0.1
});
const lowerEngine = new THREE.Mesh(lowerEngineGeometry, lowerEngineMaterial);
lowerEngine.position.y = -120;
satelliteGroup.add(lowerEngine);

// ===== SOLAR PANELS =====
// Solar panel geometry - lebih tipis da
const panelGeometry = new THREE.BoxGeometry(350, 150, 1);

// Load texture untuk solar panel
const panelTexture = loader.load('teksture/panel.jpg');
panelTexture.wrapS = THREE.RepeatWrapping;
panelTexture.wrapT = THREE.RepeatWrapping;
panelTexture.repeat.set(6, 4);

const panelMaterial = new THREE.MeshStandardMaterial({ 
   map: panelTexture,
   color: 0xc0c0c0,  // Silver
   metalness: 0.1,
   roughness: 0.7,
   emissive: 0x000522
});

// Solar Panel Kiri
const leftPanel = new THREE.Mesh(panelGeometry, panelMaterial);
leftPanel.position.set(-250, 0, 0);
satelliteGroup.add(leftPanel);

// Solar Panel Kanan
const rightPanel = new THREE.Mesh(panelGeometry, panelMaterial);
rightPanel.position.set(250, 0, 0);
satelliteGroup.add(rightPanel);

// ===== SOLAR PANEL SUPPORT ARMS =====
// Penghubung panel ke body
const armGeometry = new THREE.BoxGeometry(120, 15, 15);
const armMaterial = new THREE.MeshStandardMaterial({ 
   color: 0xaaaaaa,
   metalness: 0.6,
   roughness: 0.4
});

const leftArm = new THREE.Mesh(armGeometry, armMaterial);
leftArm.position.set(-130, 0, 0);
satelliteGroup.add(leftArm);

const rightArm = new THREE.Mesh(armGeometry, armMaterial);
rightArm.position.set(130, 0, 0);
satelliteGroup.add(rightArm);

// ===== ANTENNA PARABOLIC =====
// Mounting base untuk antena
const mountingBaseGeometry = new THREE.CylinderGeometry(35, 40, 15, 16);
const mountingBaseMaterial = new THREE.MeshStandardMaterial({
   color: 0x666666,
   metalness: 0.8,
   roughness: 0.3
});
const mountingBase = new THREE.Mesh(mountingBaseGeometry, mountingBaseMaterial);
mountingBase.position.set(0, 107, 0);
satelliteGroup.add(mountingBase);

// Main parabolic reflector surface - sangat cekung
const dishGeometry = new THREE.CylinderGeometry(100, 40, 30, 48);
const dishMaterial = new THREE.MeshStandardMaterial({ 
   color: 0xf8f8f8,
   metalness: 0.95,
   roughness: 0.02,
   emissive: 0x111111
});
const antenna = new THREE.Mesh(dishGeometry, dishMaterial);
antenna.position.set(0, 126, 0); // Lurus, tidak miring
satelliteGroup.add(antenna);

// ===== LNB DAN 3 SUPPORT ARMS =====

// LNB unit - komponen utama penerima sinyal
const lnbGeometry = new THREE.CylinderGeometry(8, 12, 25, 16);
const lnbMaterial = new THREE.MeshStandardMaterial({
   color: 0x2c2c2c,
   metalness: 0.7,
   roughness: 0.3
});
const lnb = new THREE.Mesh(lnbGeometry, lnbMaterial);
lnb.position.set(0, 155, 0); // Posisi di fokus parabola
lnb.rotation.x = Math.PI / 2; // Rotasi agar menghadap ke dish
satelliteGroup.add(lnb);

// LNB Horn (waveguide opening)
const hornGeometry = new THREE.ConeGeometry(6, 8, 8);
const hornMaterial = new THREE.MeshStandardMaterial({
   color: 0x1a1a1a,
   metalness: 0.9,
   roughness: 0.1
});
const horn = new THREE.Mesh(hornGeometry, hornMaterial);
horn.position.set(0, 155, -8);
horn.rotation.x = Math.PI / 2;
satelliteGroup.add(horn);

// LNB connector/output
const connectorGeometry = new THREE.CylinderGeometry(3, 3, 6, 8);
const connectorMaterial = new THREE.MeshStandardMaterial({
   color: 0x666666,
   metalness: 0.8,
   roughness: 0.2
});
const connector = new THREE.Mesh(connectorGeometry, connectorMaterial);
connector.position.set(0, 155, 12);
connector.rotation.x = Math.PI / 2;
satelliteGroup.add(connector);

// Support Arm 1 
const arm1Geometry = new THREE.CylinderGeometry(2, 2, 50, 12);
const supportArm1 = new THREE.Mesh(arm1Geometry, armMaterial);
supportArm1.position.set(
   Math.cos(0) * 25, // x position
   140, // y position (tengah antara dish dan LNB)
   Math.sin(0) * 25  // z position
);
// Rotasi arm mengarah ke LNB
supportArm1.lookAt(0, 155, 0);
supportArm1.rotateX(Math.PI / 2);
satelliteGroup.add(supportArm1);

// Support Arm 2 (120 derajat kedua)
const arm2Geometry = new THREE.CylinderGeometry(2, 2, 50, 12);
const supportArm2 = new THREE.Mesh(arm2Geometry, armMaterial);
supportArm2.position.set(
   Math.cos(2 * Math.PI / 3) * 25, // x position
   140,
   Math.sin(2 * Math.PI / 3) * 25  // z position
);
supportArm2.lookAt(0, 155, 0);
supportArm2.rotateX(Math.PI / 2);
satelliteGroup.add(supportArm2);

// Support Arm 3 (120 derajat ketiga)
const arm3Geometry = new THREE.CylinderGeometry(2, 2, 50, 12);
const supportArm3 = new THREE.Mesh(arm3Geometry, armMaterial);
supportArm3.position.set(
   Math.cos(4 * Math.PI / 3) * 25, // x position
   140,
   Math.sin(4 * Math.PI / 3) * 25  // z position
);
supportArm3.lookAt(0, 155, 0);
supportArm3.rotateX(Math.PI / 2);
satelliteGroup.add(supportArm3);

// LNB mounting bracket
const bracketGeometry = new THREE.BoxGeometry(20, 8, 8);
const bracketMaterial = new THREE.MeshStandardMaterial({
   color: 0x666666,
   metalness: 0.6,
   roughness: 0.4
});
const lnbBracket = new THREE.Mesh(bracketGeometry, bracketMaterial);
lnbBracket.position.set(0, 155, 0);
satelliteGroup.add(lnbBracket);

// LNA housing
const lnaHousingGeometry = new THREE.BoxGeometry(18, 12, 15);
const lnaHousingMaterial = new THREE.MeshStandardMaterial({
   color: 0x444444,
   metalness: 0.6,
   roughness: 0.4
});
const lnaHousing = new THREE.Mesh(lnaHousingGeometry, lnaHousingMaterial);
lnaHousing.position.set(0, 120, 0);
satelliteGroup.add(lnaHousing);

// ===== ANTENA KECIL =====
// Antena komunikasi kecil di sekitar body
for (let i = 0; i < 6; i++) {
   const smallAntennaGeometry = new THREE.CylinderGeometry(3, 3, 40, 8);
   const smallAntennaMaterial = new THREE.MeshStandardMaterial({ 
       color: 0xdddddd,
       metalness: 0.6,
       roughness: 0.2
   });
   const smallAntenna = new THREE.Mesh(smallAntennaGeometry, smallAntennaMaterial);
   
   const angle = (i / 6) * Math.PI * 2;
   const radius = 70;
   smallAntenna.position.set(
       Math.cos(angle) * radius,
       -30 + (i % 2) * 20,
       Math.sin(angle) * radius
   );
   smallAntenna.rotation.z = angle + Math.PI / 2;
   satelliteGroup.add(smallAntenna);
}

return satelliteGroup;
}

const satellite = createAdvancedSatellite();
grupSatelit.add(satellite);

// Tambahkan Point Light di dekat satelit
const satelliteLight = new THREE.PointLight(0xffffff, 1, 100);
satelliteLight.position.set(0, 0, 100); // Di dekat satelit
scene.add(satelliteLight);

// ==========================================
// FOOTPRINT 3D EARTH
// ==========================================
function createAdvancedCurvedFootprint() {
 // Buat ring geometry yang melengkung mengikuti permukaan bumi
 const innerRadius = 0;
 const outerRadius = 1;
 const thetaSegments = 64;
 const phiSegments = 8;
 
 const geometry = new THREE.BufferGeometry();
 const vertices = [];
 const indices = [];
 
 // Buat vertices untuk ring yang melengkung
 for (let i = 0; i <= phiSegments; i++) {
     const radius = innerRadius + (outerRadius - innerRadius) * (i / phiSegments);
     
     for (let j = 0; j <= thetaSegments; j++) {
         const theta = (j / thetaSegments) * Math.PI * 2;
         
         const x = Math.cos(theta) * radius;
         const y = Math.sin(theta) * radius;
         
         const sphereRadius = 1.001;
         const distanceFromCenter = Math.sqrt(x*x + y*y);
         
         let z;
         if (distanceFromCenter <= sphereRadius) {
             // GANTI: Kelengkungan ke arah NEGATIF (ke dalam/belakang)
             z = -(Math.sqrt(sphereRadius*sphereRadius - x*x - y*y) - sphereRadius);
             z *= 0.11; //Mengatur seberapa melengkung
         } else {
             z = 0;
         }
         
         vertices.push(x, y, z);
         
         if (i < phiSegments && j < thetaSegments) {
             const current = i * (thetaSegments + 1) + j;
             const next = current + thetaSegments + 1;
             
             indices.push(current, next, current + 1);
             indices.push(next, next + 1, current + 1);
         }
     }
 }
 
 geometry.setIndex(indices);
 geometry.setAttribute('position', new THREE.Float32BufferAttribute(vertices, 3));
 geometry.computeVertexNormals();
 
 const material = new THREE.MeshBasicMaterial({
     color: 0x00ff00,
     transparent: true,
     opacity: 0.6,
     side: THREE.DoubleSide,
     depthWrite: false
 });
 
 const footprintMesh = new THREE.Mesh(geometry, material);
 
 // Border ring
 const borderGeometry = new THREE.RingGeometry(0.98, 1, 64);
 borderGeometry.rotateX(Math.PI / 2);
 
 const borderPositions = borderGeometry.attributes.position.array;
 for (let i = 0; i < borderPositions.length; i += 3) {
     const x = borderPositions[i];
     const y = borderPositions[i + 1];
     const distanceFromCenter = Math.sqrt(x*x + y*y);
     
     if (distanceFromCenter > 0) {
         const sphereRadius = 1.001;
         // GANTI: Border juga kelengkung ke arah NEGATIF
         const z = -(Math.sqrt(Math.max(0, sphereRadius*sphereRadius - x*x - y*y)) - sphereRadius);
         borderPositions[i + 2] = z * 0.05;
     }
 }
 borderGeometry.attributes.position.needsUpdate = true;
 borderGeometry.computeVertexNormals();
 
 const borderMaterial = new THREE.MeshBasicMaterial({
     color: 0x00ff00,
     transparent: true,
     opacity: 0.8,
     side: THREE.DoubleSide,
     depthWrite: false
 });
 
 const borderMesh = new THREE.Mesh(borderGeometry, borderMaterial);
 
 const footprintGroup = new THREE.Group();
 footprintGroup.add(footprintMesh);
 footprintGroup.add(borderMesh);
 
 return footprintGroup;
}

const footprintMesh = createAdvancedCurvedFootprint();
bersinar.add(footprintMesh);

function updateFootprintOnEarth(satelliteLon, satelliteLat, altitude) {
 const earthRadius = 6371;
 
 let satelliteAltitude;
 if (orbitType === "GEO") {
     satelliteAltitude = altitude; // GEO tetap 35000 km
 } else {
     // LEO/MEO: Gunakan altitude REAL-TIME dari posisi satelit saat ini
     const worldPos = new THREE.Vector3();
     satellite.getWorldPosition(worldPos);
     satelliteAltitude = worldPos.length() - earthRadius;
     
     // Debug: Lihat perubahan altitude
     console.log(`Current altitude: ${satelliteAltitude.toFixed(0)} km`);
 }
 
 // Rumus footprint yang benar
 const beamAngleRad = THREE.MathUtils.degToRad(beamwidth / 2);
 const footprintRadiusKm = (satelliteAltitude + earthRadius) * Math.tan(beamAngleRad);
 
 footprintMesh.scale.setScalar(footprintRadiusKm);
 
 const satLatRad = THREE.MathUtils.degToRad(satelliteLat);
 const satLonRad = THREE.MathUtils.degToRad(satelliteLon);
 
 const x = earthRadius * 1.01 * Math.cos(satLatRad) * Math.cos(satLonRad);
 const y = earthRadius * 1.01 * Math.sin(satLatRad);
 const z = -earthRadius * 1.01 * Math.cos(satLatRad) * Math.sin(satLonRad);
 
 footprintMesh.position.set(x, y, z);
 footprintMesh.lookAt(0, 0, 0);
}

// Garis Dari Satelit Ke Pusat Bumi
const lineMaterial = new THREE.LineBasicMaterial({ color: 0x00ffff });
const lineGeometry = new THREE.BufferGeometry().setFromPoints([
   new THREE.Vector3(0, 0, 0),
   new THREE.Vector3(0, 0, 0),
]);
const garisKeBumi = new THREE.Line(lineGeometry, lineMaterial);
scene.add(garisKeBumi);

// Sistem Trail Sistem
const maxTrailPoints = 2000;
const trailPositions = new Float32Array(maxTrailPoints * 4);
const trailGeometry = new THREE.BufferGeometry();
trailGeometry.setAttribute('position', new THREE.BufferAttribute(trailPositions, 3));
const trailMaterial = new THREE.LineBasicMaterial({ color: 0xffff00 });
const trail = new THREE.Line(trailGeometry, trailMaterial);
bersinar.add(trail);
const trailPoints = [];
const groundTrack = [];

// ==========================================
// DETEKSI CANVAS CROSSING
// ==========================================
let canvasCrossings = 0;
let lastLongitude = null;
let lastLatitude = null;
let hasCompletedFirstPass = false;
const targetCrossings = 20; // Target satelit melewati canvas

// Fungsi Mendeteksi Canvas Crossing
function detectCanvasCrossing(currentLon, currentLat) {
    if (lastLongitude === null || lastLatitude === null) {
        lastLongitude = currentLon;
        lastLatitude = currentLat;
        return;
    }

    const lonDiff = Math.abs(currentLon - lastLongitude);
    
    if (lonDiff > 300) {
        if (hasCompletedFirstPass) {
            canvasCrossings++;
            console.log(`Canvas crossing detected! Count: ${canvasCrossings}/${targetCrossings}`);
            
            // Clear trail after target crossings
            if (canvasCrossings >= targetCrossings) {
               console.log(`Clearing trail after ${canvasCrossings} canvas crossings`);
                groundTrack.length = 0;
                trailNeedsUpdate = true;
                canvasCrossings = 0; // Reset counter
            }
        } else {
            hasCompletedFirstPass = true;
        }
    }

    // PERBAIKAN: Tambahkan baris yang hilang
    lastLongitude = currentLon;
    lastLatitude = currentLat;
}

let orbitCount = 0;
let previousTrueAnomaly = 0;
let hasCompletedFirstOrbit = false;


// ==========================================
// MODULE 6: ORBITAL MECHANICS & PARAMETERS
// ==========================================
const Km = 1000;
const earthRadius = 6378;
const G = 6.674e-11;
const M = 5.972e24;

// Orbit configuration
let orbitType = "LEO";
let apogee = 500;
let perigee = 500;
let deginklination = 40;
let inclination = THREE.MathUtils.degToRad(deginklination);
let argPerigeeDeg = 0;
let argPerigee = THREE.MathUtils.degToRad(argPerigeeDeg);
let RAANDeg = 30;
let RAAN = THREE.MathUtils.degToRad(RAANDeg);
let degtrueanomaly = 120;
let trueanomaly = THREE.MathUtils.degToRad(degtrueanomaly);
let altitude = 35000;
let geoLongitude = 0;
let geoLongitudeRad = THREE.MathUtils.degToRad(geoLongitude);
let beamwidth = 20; // Dalam derajat


function updateOrbitInfo() {
 if (orbitType === "GEO") {orbitInfo.textContent = `
 Orbit Type           : ${orbitType}
 Altitude             : ${altitude} km
 Longitude Spacecraft : ${geoLongitude}°
 Inclination          : 0°
 Beamwidth            : ${beamwidth}°`;
     } 
     else {
         orbitInfo.textContent = `
 Orbit Type     : ${orbitType}
 Apogee         : ${apogee} km
 Perigee        : ${perigee} km
 Inclination    : ${deginklination}°
 Arg Perigee    : ${argPerigeeDeg}°
 RAAN           : ${RAANDeg}°
 True Anomaly   : ${degtrueanomaly}°
 Beamwidth      : ${beamwidth}°`;
     }
 }
updateOrbitInfo();

// ==========================================
// PREDIKSI GROUNDTRACK TRAIL (UPDATED WITH LEAFLET)
// ==========================================

// Calculate satellite position for a given time
function calculateSatellitePositionAtTime(targetTime, currentTrueAnomaly) {
   if (orbitType === "GEO") {
       // For GEO satellites, position is fixed relative to Earth
       return {
           longitude: geoLongitude,
           latitude: 0,
           altitude: altitude
       };
   }
   
   // For non-GEO orbits, simulate orbital motion
   const deltaTimeSeconds = (targetTime.getTime() - simulatedTime.getTime()) / 1000;
   const angleRate = getTrueAnomalyRate(a * Km, e, currentTrueAnomaly, orbitType);
   const futureTrueAnomaly = currentTrueAnomaly - angleRate * deltaTimeSeconds;
   
   // Calculate position in orbital plane
   let r;
   if (e === 0) {
       r = a;
   } else {
       r = (a * (1 - e * e)) / (1 + e * Math.cos(futureTrueAnomaly));
   }
   
   let x = Math.cos(futureTrueAnomaly) * r;
   let z = Math.sin(futureTrueAnomaly) * r;
   
   // Apply orbital transformations
   let pos = new THREE.Vector3(x, 0, z);
   const transformMatrix = new THREE.Matrix4()
       .multiply(matrixRAAN)
       .multiply(matrixInclination)
       .multiply(matrixArgPerigee);
   pos.applyMatrix4(transformMatrix);
   
   // Calculate Earth rotation at target time
   const futureEarthRotation = calculateRequiredEarthRotation(targetTime);
   
   // Convert to lat/lon considering Earth rotation
   const relPos = pos.clone();
   relPos.applyMatrix4(new THREE.Matrix4().makeRotationY(-futureEarthRotation));
   
   const r_mag = relPos.length();
   const lat = THREE.MathUtils.radToDeg(Math.asin(relPos.y / r_mag));
   const lon = THREE.MathUtils.radToDeg(Math.atan2(-relPos.z, relPos.x));
   const lonNormalized = ((lon + 180) % 360) - 180;
   
   return {
       longitude: lonNormalized,
       latitude: lat,
       altitude: r - earthRadius
   };
}

// Generate prediction trail
function generatePredictionTrail(durationHours) {
   predictionTrail = [];
   const startTime = new Date(simulatedTime);
   const endTime = new Date(startTime.getTime() + durationHours * 60 * 60 * 1000);
   
   // Calculate time step based on duration for smooth trail
   let timeStepMinutes;
   if (durationHours <= 1) {
       timeStepMinutes = 1; // 1 minute steps for 1 hour
   } else if (durationHours <= 8) {
       timeStepMinutes = 2; // 2 minute steps for 8 hours
   } else if (durationHours <= 12) {
       timeStepMinutes = 3; // 3 minute steps for 12 hours
   } else {
       timeStepMinutes = 5; // 5 minute steps for 24 hours
   }
   
   const currentTrueAnomalySnapshot = trueanomaly;
   
   for (let time = new Date(startTime); time <= endTime; time.setMinutes(time.getMinutes() + timeStepMinutes)) {
       const position = calculateSatellitePositionAtTime(time, currentTrueAnomalySnapshot);
       predictionTrail.push({
           coords: [position.longitude, position.latitude],
           time: new Date(time),
           altitude: position.altitude
       });
   }
   
   console.log(`Generated prediction trail with ${predictionTrail.length} points for ${durationHours} hours`);
}

// Initialize prediction canvas
function initPredictionCanvas() {
   if (!predictionCanvas) {
       predictionCanvas = document.createElement('canvas');
       predictionCanvas.width = widthGT;
       predictionCanvas.height = heightGT;
       predictionCtx = predictionCanvas.getContext('2d');
   }
   
   if (predictionCanvas.width !== widthGT || predictionCanvas.height !== heightGT) {
       predictionCanvas.width = widthGT;
       predictionCanvas.height = heightGT;
   }
}

// Update prediction canvas dengan koordinat Leaflet
function updatePredictionCanvas() {
    if (!showingPrediction || predictionTrail.length < 2 || !leafletMap) return;
    
    initPredictionCanvas();
    predictionCtx.clearRect(0, 0, widthGT, heightGT);
    
    // PERBAIKAN: Set clipping rectangle tepat di batas canvas
    predictionCtx.save();
    predictionCtx.beginPath();
    predictionCtx.rect(0, 0, widthGT, heightGT);
    predictionCtx.clip();
    
    predictionCtx.strokeStyle = '#FF6B6B';
    predictionCtx.lineWidth = 3;
    predictionCtx.lineCap = 'round';
    predictionCtx.lineJoin = 'round';
    
    // Handle date line crossing untuk prediction
    let segments = [];
    let currentSegment = [];
    
    for (let i = 0; i < predictionTrail.length - 1; i++) {
        const current = predictionTrail[i];
        const next = predictionTrail[i + 1];
        
        currentSegment.push(current);
        
        const lonDiff = Math.abs(next.coords[0] - current.coords[0]);
        if (lonDiff > 180) {
            if (currentSegment.length > 1) {
                segments.push(currentSegment);
            }
            currentSegment = [];
        }
    }
    
    if (predictionTrail.length > 0) {
        currentSegment.push(predictionTrail[predictionTrail.length - 1]);
    }
    
    if (currentSegment.length > 1) {
        segments.push(currentSegment);
    }
    
    // Draw prediction segments menggunakan koordinat Leaflet
    segments.forEach(segment => {
        if (segment.length < 2) return;
        
        predictionCtx.beginPath();
        let pathStarted = false;
        
        for (let i = 0; i < segment.length; i++) {
            const point = segment[i];
            const pixel = convertCoordsToPixel(point.coords);
            
            if (pixel) {
                if (!pathStarted) {
                    predictionCtx.moveTo(pixel[0], pixel[1]);
                    pathStarted = true;
                } else {
                    predictionCtx.lineTo(pixel[0], pixel[1]);
                }
            }
        }
        
        if (pathStarted) {
            predictionCtx.stroke();
        }
    });
    
    predictionCtx.restore(); // PENTING: Hapus clipping

}

// Event listeners for prediction controls
showPredictionBtn.addEventListener('click', () => {
   const selectedDuration = parseInt(trailDurationSelect.value);
   generatePredictionTrail(selectedDuration);
   showingPrediction = true;
   updateOrbitInfo();
   
   showPredictionBtn.textContent = `Showing ${selectedDuration}h Prediction`;
   showPredictionBtn.style.background = '#FF6B6B';
});

clearPredictionBtn.addEventListener('click', () => {
   predictionTrail = [];
   showingPrediction = false;
   updateOrbitInfo();
   
   showPredictionBtn.textContent = 'Show Trail Prediction';
   showPredictionBtn.style.background = '#4CAF50';
});

// Membuat Orbit
function createInclinedOrbit(perigeeRadius, apogeeRadius, inclinationAngle, argPerigeeAngle, raanAngle) {
   const points = [];
   const segments = 120;
   const a = (apogeeRadius + perigeeRadius) / 2;
   const e = (apogeeRadius - perigeeRadius) / (apogeeRadius + perigeeRadius);

   for (let i = 0; i <= segments; i++) {
       let sudut = (i / segments) * Math.PI * 2;
       const r = (a * (1 - e * e)) / (1 + e * Math.cos(sudut));
       const x = r * Math.cos(sudut);
       const z = r * Math.sin(sudut);
       points.push(new THREE.Vector3(x, 0, z));
   }

   const geometry = new THREE.BufferGeometry().setFromPoints(points);
   const material = new THREE.LineBasicMaterial({ color: 0xff0000 });
   const orbit = new THREE.LineLoop(geometry, material);
   const rotRAAN = new THREE.Matrix4().makeRotationY(raanAngle);
   const rotArgPerigee = new THREE.Matrix4().makeRotationY(argPerigeeAngle);
   const rotInclination = new THREE.Matrix4().makeRotationX(inclinationAngle);
   const transformMatrix = new THREE.Matrix4()
       .multiply(rotRAAN)
       .multiply(rotInclination)
       .multiply(rotArgPerigee);
   orbit.applyMatrix4(transformMatrix);
   return orbit;
}

// Untuk Orbit GEO
let orbit;
if (orbitType === "GEO") {
   const radius = earthRadius + altitude;
   apogee = altitude;
   perigee = altitude;
   orbit = createInclinedOrbit(radius, radius, 0, 0, geoLongitudeRad);
   inclination = 0;
} else {
   const r_apogee = earthRadius + apogee;
   const r_perigee = earthRadius + perigee;
   orbit = createInclinedOrbit(r_perigee, r_apogee, inclination, argPerigee, RAAN);
}
grupSatelit.add(orbit);

// Fungsi untuk True Anomaly
function getTrueAnomalyRate(a, e, anomaly, orbitType) {
   if (e === 0) {
       const r = a;
       if (orbitType === "GEO") {
           const T = 23 * 60 * 60 + 56 * 60;
           return (2 * Math.PI) / T;
       } else {
           return Math.sqrt(G * M / Math.pow(r, 3));
       }
   }
   const r = (a * (1 - e * e)) / (1 + e * Math.cos(anomaly));
   const h = Math.sqrt(G * M * a * (1 - e * e));
   return h / (r * r);
}

const r_apogee = earthRadius + apogee;
const r_perigee = earthRadius + perigee;
const a = (r_apogee + r_perigee) / 2;
const e = (r_apogee - r_perigee) / (r_apogee + r_perigee);
const matrixRAAN = new THREE.Matrix4().makeRotationY(RAAN);
const matrixArgPerigee = new THREE.Matrix4().makeRotationY(argPerigee);
const matrixInclination = new THREE.Matrix4().makeRotationX(inclination);

// ==========================================
// SATELIT GEO POSITION CALCULATION
// ==========================================
let lastEarthRotation = 0;

// Fungsi untuk memperbarui posisi satelit GEO berdasarkan rotasi Bumi 
function updateGEOSatellitePosition() {
   if (orbitType !== "GEO") return;
   
   const radius = earthRadius + altitude;
   const currentEarthRotation = bumi.rotation.y;
   const geoLongitudeRad = THREE.MathUtils.degToRad(geoLongitude);
   const totalRotation = geoLongitudeRad + currentEarthRotation;
   
   // Posisikan satelit pada garis bujur tertentu relatif terhadap rotasi Bumi
   const x = radius * Math.cos(totalRotation);
   const z = -radius * Math.sin(totalRotation);
   const y = 0; // Equatorial orbit (Khatulistiwa)
   
   // Mengatur posisi satelit (sekarang berputar bersama Bumi)
   satellite.position.set(x, y, z);
   
   // Update ritasi terakhir tracker
   lastEarthRotation = currentEarthRotation;
   console.log(`GEO satellite positioned at Earth-relative longitude ${geoLongitude}° (rotation: ${THREE.MathUtils.radToDeg(currentEarthRotation).toFixed(2)}°)`);
}

// Fungsi yang dioptimalkan untuk memeriksa apakah posisi satelit GEO perlu diperbarui
function shouldUpdateGEOPosition() {
   if (orbitType !== "GEO") return false;
   const currentEarthRotation = bumi.rotation.y;
   const rotationDiff = Math.abs(currentEarthRotation - lastEarthRotation);
   
   //Hanya perbarui jika Bumi telah berotasi secara signifikan (lebih dari 0,001 radian ≈ 0,057 derajat)
   return rotationDiff > 0.001;
}

// ==========================================
// KALKULASI SIANG (DAYLIGHT)
// ==========================================

function isPointInDaylight(longitude, latitude, sunLongitude, sunDeclination) {
    const latRad = THREE.MathUtils.degToRad(latitude);
    const sunDecRad = THREE.MathUtils.degToRad(sunDeclination);
    
    // PERBAIKAN: Hitung hour angle dengan wrapping yang benar
    let hourAngle = longitude - sunLongitude;
    
    // Normalize hour angle ke range -180 sampai 180
    while (hourAngle > 180) hourAngle -= 360;
    while (hourAngle < -180) hourAngle += 360;
    
    const hourAngleRad = THREE.MathUtils.degToRad(hourAngle);

    const sinElevation = Math.sin(latRad) * Math.sin(sunDecRad) +
        Math.cos(latRad) * Math.cos(sunDecRad) * Math.cos(hourAngleRad);

    return sinElevation > 0;
}

// Enhanced night overlay with smooth gradients and twilight zones (UPDATED WITH LEAFLET)
let nightOverlayCanvas = null;
let lastSunLon = null;
let lastSunDec = null;
let frameCounter = 0;

function createEnhancedNightOverlayCanvas(sunLongitude, sunDeclination, width, height) {
    if (!leafletMap) return null;
    
    const canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;
    const ctx = canvas.getContext('2d');
    
    const step = 8; // Optimize for performance
    
    for (let x = 0; x < width; x += step) {
        for (let y = 0; y < height; y += step) {
            // Convert pixel ke koordinat geografis menggunakan Leaflet
            const containerPoint = L.point(x, y);
            const latLng = leafletMap.containerPointToLatLng(containerPoint);
            
            if (!latLng) continue;
            
            let lon = latLng.lng;
            const lat = latLng.lat;
            
            // Check if point is in valid range untuk latitude
            if (lat < -90 || lat > 90) continue;
            
            // PERBAIKAN: Normalize longitude untuk wrapping kontinyu
            // Jangan batasi longitude, biarkan wrap around
            while (lon > 180) lon -= 360;
            while (lon < -180) lon += 360;
            
            const isDaylight = isPointInDaylight(lon, lat, sunLongitude, sunDeclination);
            
            if (!isDaylight) {
                const latRad = THREE.MathUtils.degToRad(lat);
                const sunDecRad = THREE.MathUtils.degToRad(sunDeclination);
                const hourAngle = THREE.MathUtils.degToRad(lon - sunLongitude);
                const sinElevation = Math.sin(latRad) * Math.sin(sunDecRad) +
                                   Math.cos(latRad) * Math.cos(sunDecRad) * Math.cos(hourAngle);
                const elevationDegrees = THREE.MathUtils.radToDeg(Math.asin(sinElevation));
                
                //Untuk mengatur warna terminator
                const darkness = Math.min(1.0, Math.abs(elevationDegrees) / 60 + 0.5); // Lebih gelap
                const alpha = 0.4 + (darkness * 0.4); // Alpha lebih tinggi
                const blue = Math.floor(30 + (darkness * 10)); 
                ctx.fillStyle = `rgba(0, 6, ${blue}, ${alpha})`;

                ctx.fillRect(x, y, step, step);
            }
        }
    }

    return canvas;
}

function drawEnhancedNightOverlay(ctx, sunLongitude, sunDeclination, width, height) {
   frameCounter++;

   // Update lebih jarang untuk performansi
   const shouldUpdate = !nightOverlayCanvas ||!lastSunLon ||
       Math.abs(lastSunLon - sunLongitude) > 0.5 ||
       Math.abs(lastSunDec - sunDeclination) > 0.2 ||
       frameCounter % 120 === 0; // Update setiap 2 detik untuk overlay

   if (shouldUpdate) {
       nightOverlayCanvas = createEnhancedNightOverlayCanvas(sunLongitude, sunDeclination, width, height);
       lastSunLon = sunLongitude;
       lastSunDec = sunDeclination;
   }

   if (nightOverlayCanvas) {
       ctx.save();
       ctx.filter = 'blur(8px)';
       ctx.drawImage(nightOverlayCanvas, 0, 0);
       ctx.restore();
   }
}

// ==========================================
// FOOTPRINT SYSTEM FOR GROUND TRACK (UPDATED WITH LEAFLET)
// ==========================================
function drawFootprintOnGroundTrack(ctx, satelliteLon, satelliteLat, altitude) {
 if (!leafletMap) return;
 
 const earthRadius = 6371;
 
 let satelliteAltitude;
 if (orbitType === "GEO") {
     satelliteAltitude = altitude;
 } else {
     const worldPos = new THREE.Vector3();
     satellite.getWorldPosition(worldPos);
     satelliteAltitude = worldPos.length() - earthRadius;
 }
 
 const beamAngleRad = THREE.MathUtils.degToRad(beamwidth / 2);
 const footprintRadiusKm = (satelliteAltitude + earthRadius) * Math.tan(beamAngleRad);
 
 // Convert to Leaflet coordinates
 const centerPixel = convertCoordsToPixel([satelliteLon, satelliteLat]);
 if (!centerPixel) return;
 
 // Calculate radius in pixels based on current zoom level
 const radiusLatLng = L.latLng(satelliteLat + (footprintRadiusKm / earthRadius * 180 / Math.PI), satelliteLon);
 const radiusPixel = convertCoordsToPixel([radiusLatLng.lng, radiusLatLng.lat]);
 
 if (!radiusPixel) return;
 
 const radiusPixels = Math.abs(radiusPixel[1] - centerPixel[1]);
 
 ctx.save();
 ctx.strokeStyle = 'rgba(0, 255, 0, 0.8)';
 ctx.fillStyle = 'rgba(0, 255, 0, 0.2)';
 ctx.lineWidth = 2;
 ctx.beginPath();
 ctx.arc(centerPixel[0], centerPixel[1], radiusPixels, 0, Math.PI * 2);
 ctx.fill();
 ctx.stroke();
 ctx.restore();
}

// ==========================================
// MODULE 8: OPTIMIZED SMOOTH TRAIL RENDERING (UPDATED WITH LEAFLET)
// ==========================================

// Inisialisasi kanvas jejak jika diperlukan
function initTrailCanvas() {
   if (!trailCanvas) {
       trailCanvas = document.createElement('canvas');
       trailCanvas.width = widthGT;
       trailCanvas.height = heightGT;
       trailCtx = trailCanvas.getContext('2d');
   }
   
   // Ubah ukuran trail canvas jika ukuran canvas utama berubah
   if (trailCanvas.width !== widthGT || trailCanvas.height !== heightGT) {
       trailCanvas.width = widthGT;
       trailCanvas.height = heightGT;
       trailNeedsUpdate = true;
   }
}

// Update trail canvas dengan koordinat Leaflet
function updateTrailCanvas() {
   if (!trailNeedsUpdate || groundTrack.length < 2 || !leafletMap) return;
   
   trailCtx.clearRect(0, 0, widthGT, heightGT);
   
   const step = Math.max(1, Math.floor(groundTrack.length / 3000));
   trailCtx.strokeStyle = '#FFD700';
   trailCtx.lineWidth = 2 + (widthGT / 1000);
   trailCtx.lineCap = 'round';
   trailCtx.lineJoin = 'round';
   
   // Handle date line crossing dengan koordinat Leaflet
   let segments = [];
   let currentSegment = [];
   
   for (let i = 0; i < groundTrack.length - 1; i++) {
       const current = groundTrack[i];
       const next = groundTrack[i + 1];
       
       currentSegment.push(current);
       const lonDiff = Math.abs(next.coords[0] - current.coords[0]);
       if (lonDiff > 180) {
           if (currentSegment.length > 1) {
               segments.push(currentSegment);
           }
           currentSegment = [];
       }
   }
   
   if (groundTrack.length > 0) {
       currentSegment.push(groundTrack[groundTrack.length - 1]);
   }
   
   if (currentSegment.length > 1) {
       segments.push(currentSegment);
   }
   
   // Draw segments menggunakan koordinat Leaflet
   segments.forEach(segment => {
       if (segment.length < 2) return;
       
       trailCtx.beginPath();
       let pathStarted = false;
       
       for (let i = 0; i < segment.length; i += Math.max(1, step)) {
           const point = segment[i];
           const pixel = convertCoordsToPixel(point.coords); // GUNAKAN LEAFLET CONVERSION
           
           if (pixel) {
               if (!pathStarted) {
                   trailCtx.moveTo(pixel[0], pixel[1]);
                   pathStarted = true;
               } else {
                   trailCtx.lineTo(pixel[0], pixel[1]);
               }
           }
       }
       
       if (pathStarted) {
           trailCtx.stroke();
       }
   });
   
   trailNeedsUpdate = false;
   lastTrailUpdate = groundTrack.length;
}

// ==========================================
// SISTEM DETEKSI PENYELESAIAN ORBIT
// ==========================================
function detectOrbitCompletion(currentTrueAnomaly) {
   // Normalize angles to 0-2π range
   const normalizedCurrent = ((currentTrueAnomaly % (2 * Math.PI)) + (2 * Math.PI)) % (2 * Math.PI);
   const normalizedPrevious = ((previousTrueAnomaly % (2 * Math.PI)) + (2 * Math.PI)) % (2 * Math.PI);
   
   if (hasCompletedFirstOrbit && normalizedPrevious > 5.5 && normalizedCurrent < 0.8) {
       orbitCount++;
       updateOrbitInfo();
   }
   if (!hasCompletedFirstOrbit && Math.abs(normalizedCurrent - normalizedPrevious) > 0.1) {
       hasCompletedFirstOrbit = true;
   }
   
   previousTrueAnomaly = currentTrueAnomaly;
}

// ==========================================
// MODULE 9: ENHANCED TIME SIMULATION
// ==========================================
let now = new Date();
let simulatedTime = new Date(now.getTime() + 7 * 60 * 60 * 1000); // UTC+7 waktu simulasi Indonesia WIB

// Deteksi Musim dan Tanggal
function getSeasonInfo(date) {
   const year = date.getFullYear()
   
   // Approximate solstices and equinoxes
   const springEquinox = new Date(year, 2, 20); // March 20
   const summerSolstice = new Date(year, 5, 21); // June 21
   const autumnEquinox = new Date(year, 8, 23); // September 23
   const winterSolstice = new Date(year, 11, 21); // December 21
   
   if (date < springEquinox || date >= winterSolstice) {
       return 'Winter Solstice';
   } else if (date < summerSolstice) {
       return 'Spring Equinox';
   } else if (date < autumnEquinox) {
       return 'Summer Solstice';
   } else {
       return 'Autumn Equinox';
   }
}

// ==========================================
// MODULE 10: MAIN ANIMATION LOOP WITH SYNCHRONIZED EARTH ROTATION
// ==========================================
function animate() {
 requestAnimationFrame(animate);

 let deltaTime = 1 / 60;
 
 if (orbitType === "GEO") {
     if (shouldUpdateGEOPosition()) {
         updateGEOSatellitePosition();
     }
 } else {
     const angleRate = getTrueAnomalyRate(a * Km, e, trueanomaly, orbitType);
     trueanomaly -= angleRate * deltaTime * speedFactor;
     detectOrbitCompletion(trueanomaly);
 }

 // ROTASI BUMI 3D (ke kanan saat speed naik)
 if (speedFactor > 0) {
     let deltaMillis = deltaTime * 1000 * speedFactor;
     simulatedTime = new Date(simulatedTime.getTime() + deltaMillis);
     synchronizeEarthRotationWithSun();
 }
 
 awanku.rotation.y += 0.00005 * speedFactor * deltaTime;
 bintang.rotation.y -= 2 * 10e-6;

   // ==========================================
   // ENHANCED LIGHTING AND TERMINATOR CALCULATION
   // ==========================================
   
   // Calculate current sun position for terminator calculation using synchronized time
   const currentSunLongitude = calculateRealisticSunPosition(simulatedTime);
   const currentSunDeclination = calculateRealisticSunDeclination(simulatedTime);
   
   // Hitung posisi satelit berdasarkan jenis orbit
   if (orbitType !== "GEO") {
       let i;
       if (e === 0) {
           i = a;
       } else {
           i = (a * (1 - e * e)) / (1 + e * Math.cos(trueanomaly));
       }
       let x = Math.cos(trueanomaly) * i;
       let z = Math.sin(trueanomaly) * i;

       let pos = new THREE.Vector3(x, 0, z);
       const transformMatrix = new THREE.Matrix4()
           .multiply(matrixRAAN)
           .multiply(matrixInclination)
           .multiply(matrixArgPerigee);
       pos.applyMatrix4(transformMatrix);
       satellite.position.set(pos.x, pos.y, pos.z);
   }

   // Update garis ke satelit
   const positions = garisKeBumi.geometry.attributes.position.array;
   positions[3] = satellite.position.x;
   positions[4] = satellite.position.y;
   positions[5] = satellite.position.z;
   garisKeBumi.geometry.attributes.position.needsUpdate = true;

   // Hitung posisi dunia dan proyeksi ke permukaan
   const worldPos = new THREE.Vector3();
   satellite.getWorldPosition(worldPos);
   const surfacePos = worldPos.clone().normalize().multiplyScalar(earthRadius * 1.01);
   bersinar.worldToLocal(surfacePos);

   // Update trail
   trailPoints.unshift(surfacePos.clone());
  if (trailPoints.length > maxTrailPoints) trailPoints.pop();

   for (let i = 0; i < trailPoints.length; i++) {
       trailGeometry.attributes.position.setXYZ(i, trailPoints[i].x, trailPoints[i].y, trailPoints[i].z);
   }

   trailGeometry.setDrawRange(0, trailPoints.length);
   trailGeometry.attributes.position.needsUpdate = true;

   // Hitung posisi ground track dengan rotasi Bumi yang sudah disinkronkan
   const relPos = worldPos.clone();
   const rotasiTotalBumi = bumi.rotation.y;
   relPos.applyMatrix4(new THREE.Matrix4().makeRotationY(-rotasiTotalBumi));

   const r = relPos.length();
   const lat = THREE.MathUtils.radToDeg(Math.asin(relPos.y / r));
   const lon = THREE.MathUtils.radToDeg(Math.atan2(-relPos.z, relPos.x));
   const lonNormalized = ((lon + 180) % 360) - 180;

   // Untuk satelit GEO, groundtrack harus tetap berada pada garis bujur yang ditentukan
   let displayLon, displayLat;
   if (orbitType === "GEO") {
       displayLon = geoLongitude;
       displayLat = 0; // Equatorial orbit
   } else {
       displayLon = lonNormalized;
       displayLat = lat;
       // Mendeteksi penyeberangan kanvas untuk mengelola pembersihan jalur (hanya untuk non-GEO)
       detectCanvasCrossing(lonNormalized, lat);
   }

   // Update footprint pada Bumi 3D dengan altitude real-time
     let currentAltitude;
     if (orbitType === "GEO") {
         currentAltitude = altitude;
     } else {
         const worldPos = new THREE.Vector3();
         satellite.getWorldPosition(worldPos);
         currentAltitude = worldPos.length() - earthRadius;
     }
     updateFootprintOnEarth(displayLon, displayLat, currentAltitude);

   // Tambahkan ke groundtrack hanya jika satelit bergerak (non-GEO) atau secara berkala untuk GEO
   if (orbitType !== "GEO" || frameCounter % 60 === 0) {
       groundTrack.push({
           coords: [displayLon, displayLat],
           time: new Date(simulatedTime.getTime())
       });
   }

   // SISTEM TRAIL
   let maxGroundTrackPoints;
   
       // Titik Trail untuk di groundtrack
   if (orbitType === "GEO") { // For GEO, keep minimal trail since satellite doesn't move
       maxGroundTrackPoints = 0;
   } else {
       if (canvasCrossings === 0) {
           maxGroundTrackPoints = 1000;
       } else if (canvasCrossings === 1) {
           maxGroundTrackPoints = 2500;
       } else if (canvasCrossings === 2) {
           maxGroundTrackPoints = 5000;
       } else if (canvasCrossings === 3) {
           maxGroundTrackPoints = 10000;
       } else {
           maxGroundTrackPoints = 1000;
       }
   }

   if (groundTrack.length > maxGroundTrackPoints && canvasCrossings < targetCrossings) {
       // Agar Trail tidak hilang sampai target crossing tercapai
   } else if (groundTrack.length > maxGroundTrackPoints && canvasCrossings >= targetCrossings) {
       const trimAmount = Math.floor(maxGroundTrackPoints * 0.1);
       groundTrack.splice(0, trimAmount);
   }

   updateOrbitInfo();

   // Groundtrack dan Terminator yang di kalkulasi (hanya jika map container terlihat)
   if (mapContainer.style.display === 'block') {
       // Clear canvas overlay
       ctxGT.clearRect(0, 0, widthGT, heightGT);
  
       // Draw night overlay (terminator) on canvas overlay
       drawEnhancedNightOverlay(ctxGT, currentSunLongitude, currentSunDeclination, widthGT, heightGT);

       initTrailCanvas();
       
       let shouldUpdateTrail = false;
       if (speedFactor === 1) {
           shouldUpdateTrail = groundTrack.length - lastTrailUpdate >= 15;
       } else {
           shouldUpdateTrail = groundTrack.length - lastTrailUpdate >= 50;
       }
       
       if (shouldUpdateTrail || trailNeedsUpdate) {
           trailNeedsUpdate = true;
       }
       
       updateTrailCanvas();
       
       // Menggambar cached trail on canvas overlay
       if (trailCanvas) {
           ctxGT.drawImage(trailCanvas, 0, 0);
       }
       
       // Draw prediction trail if showing
       if (showingPrediction) {
           updatePredictionCanvas();
           if (predictionCanvas) {
               ctxGT.drawImage(predictionCanvas, 0, 0);
           }
       }

       // Gambar footprint di ground track
       drawFootprintOnGroundTrack(ctxGT, displayLon, displayLat, currentAltitude);

       // Gambarkan posisi satelit saat ini - UPDATED WITH LEAFLET
       const currentSatellitePixel = convertCoordsToPixel([displayLon, displayLat]);
       if (currentSatellitePixel) {
           // Penanda satelit dengan visibilitas yang ditingkatkan di groundtrack
           ctxGT.fillStyle = '#FF0000';
           ctxGT.beginPath();
           ctxGT.arc(currentSatellitePixel[0], currentSatellitePixel[1], 6, 0, Math.PI * 2);
           ctxGT.fill();

           // Border Putih
           ctxGT.strokeStyle = '#FFFFFF';
           ctxGT.lineWidth = 3;
           ctxGT.stroke();
           
       }
   }

   // Display dengan informasi musim
   const satelliteInDaylight = isPointInDaylight(displayLon, displayLat, currentSunLongitude, currentSunDeclination);
   const season = getSeasonInfo(simulatedTime);
   const timeStatus = satelliteInDaylight ? " ☀️ DAY" : " 🌙 NIGHT";
   const formatted = simulatedTime.toISOString().replace('T', ' ').substring(0, 19);
   
   //Display Info Bumi - Updated for top center position
   dateDisplay.innerHTML = `
       <div style="font-weight: bold; margin-bottom: 8px; color: #ffff00; font-size: 16px;"> Waktu Simulasi: ${formatted}</div>
       <div style="color: #88ff88; font-size: 12px;"> Musim: ${season}</div>
   `;

   // Display Posisi satelit
   satelliteDisplay.innerHTML = `
       <div style="font-weight: bold; margin-bottom: 3px; color:rgb(255, 255, 255);">
       <div>Posisi Satelit: ${displayLon.toFixed(2)}°, ${displayLat.toFixed(2)}°${timeStatus}</div>
   `;

   controls.update();
   renderer.render(scene, camera);
}

// ==========================================
// EVENT LISTENERS FOR MANUAL TIME CONTROLS WITH ENHANCED SYNCHRONIZATION
// ==========================================

// Month controls
timeControlPanel.querySelector("#increaseMonth").addEventListener("click", () => {
   modifySimulatedTimeWithSync(date => {
       date.setMonth(date.getMonth() + 1);
   });
});

timeControlPanel.querySelector("#decreaseMonth").addEventListener("click", () => {
   modifySimulatedTimeWithSync(date => {
       date.setMonth(date.getMonth() - 1);
   });
});

// Day controls
timeControlPanel.querySelector("#increaseDay").addEventListener("click", () => {
   modifySimulatedTimeWithSync(date => {
       date.setDate(date.getDate() + 1);
   });
});

timeControlPanel.querySelector("#decreaseDay").addEventListener("click", () => {
   modifySimulatedTimeWithSync(date => {
       date.setDate(date.getDate() - 1);
   });
});

// Hour controls
timeControlPanel.querySelector("#increaseHour").addEventListener("click", () => {
   modifySimulatedTimeWithSync(date => {
       date.setHours(date.getHours() + 1);
   });
});

timeControlPanel.querySelector("#decreaseHour").addEventListener("click", () => {
   modifySimulatedTimeWithSync(date => {
       date.setHours(date.getHours() - 1);
   });
});

// Enhanced reset time button
resetTimeBtn.addEventListener("click", resetTimeToCurrentWithSync);

// Inisialisasi sinkronisasi rotasi Bumi saat memulai
synchronizeEarthRotationWithSun();

// Inisialisai GEO posisi satelit saat memulai
if (orbitType === "GEO") {
   updateGEOSatellitePosition();
}

animate();

// ========================================
// ENHANCED WINDOW RESIZE HANDLER
// ========================================
function handleWindowResize() {
   camera.aspect = window.innerWidth / window.innerHeight;
   camera.updateProjectionMatrix();
   renderer.setSize(window.innerWidth, window.innerHeight);
   updateCanvasSize();
}
window.addEventListener('resize', handleWindowResize, false);

});
export function initAnimasi() {
    console.log("animasi.js dimuat");

    // Semua isi kode sekarang sudah langsung jalan di DOMContentLoaded,
    // jadi cukup trigger itu secara manual (jika perlu)

    const event = new Event("DOMContentLoaded");
    document.dispatchEvent(event);
}
