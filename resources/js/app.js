import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/Addons.js';
import getStar from '../js/getstar';
import { getFresnel } from '../js/getfresnel';

document.addEventListener("DOMContentLoaded", async function () {

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 10, 500000);
const renderer = new THREE.WebGLRenderer({ antialias: true });
 
renderer.setSize(window.innerWidth, window.innerHeight);
document.body.appendChild(renderer.domElement);
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.setClearColor(0x000000, 1.0);
renderer.outputColorSpace = THREE.LinearSRGBColorSpace;

const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true;
controls.minDistance = 7000;
controls.maxDistance = 90000;
camera.position.z = 20000;

// UI/UX & CONTROL PANEL //

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
    boxShadow: '0 2px 10px rgba(0, 0, 0, 0.3)',
    pointerEvents: 'auto',
    touchAction: 'none'
});
document.body.appendChild(panel);

// Collapsible Panel
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
    backgroundColor: '#2a2e3e',
    maxHeight: '200px',  
    overflowY: 'auto'    
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

// Kontrol Panel Waktu 
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
    backgroundColor: '#2a2e3e',
    maxHeight: '250px',  
overflowY: 'auto'  
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

// Speed Controls 
const speedControls = document.createElement('div');
speedControls.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; border-top: 1px solid #444; padding-top: 8px;">
        <label style="color: white; font-size: 12px;">Kecepatan:</label>
        <div style="display: flex; align-items: center; gap: 10px;">
            <button id="decreaseSpeedTime">−</button>
            <span style="color: white;"><span id="speedValueTime">1</span>x</span>
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

// Groundtrack Panel //
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
    backgroundColor: '#2a2e3e',
    maxHeight: '200px', 
overflowY: 'auto' 
});

// Pemilihan Durasi Trail
const trailDurationSelect = document.createElement('select');
trailDurationSelect.innerHTML = `
    <option value="1">1 Jam</option>
    <option value="8">8 Jam</option>
    <option value="12">12 Jam</option>
    <option value="24" selected>1 Hari (24 Jam)</option>
    <option value="168">7 Hari</option>
    <option value="720">30 Hari</option>
    <option value="2160">90 Hari</option>
    <option value="4320">180 Hari</option>
    <option value="8760">360 Hari</option>
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

// Tombol Show Prediction
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

// Tombol Clear Prediction 
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

// Tombol Ground Track
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

// Tombol groundtrack
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

// API WAKTU DAN LOKASI
let userTimezone ;
let simulatedTime = new Date(); 
let userLocationData = null;

async function getTimezoneFromIP() {
console.log('Detecting timezone from IP location...');
const apis = [
    {
        name: 'ipapi.co',
        url: 'https://ipapi.co/json/',
        parser: async (response) => {
            const data = await response.json();
            console.log(`   Location: ${data.city}, ${data.country}`);
            userLocationData = {
                latitude: data.latitude,
                longitude: data.longitude,
                city: data.city,
                country: data.country
            };
            return data.timezone;
        }
    },
    {
        name: 'ipinfo.io', 
        url: 'https://ipinfo.io/json',
        parser: async (response) => {
            const data = await response.json();
            console.log(`   Location: ${data.city}, ${data.country}`);
            userLocationData = {
                latitude: data.lat,
                longitude: data.lon,
                city: data.city,
                country: data.country
            };
            return data.timezone;
        }
    },
    {
        name: 'ipwhois.io',
        url: 'https://ipwhois.io/json/',
        parser: async (response) => {
            const data = await response.json();
            return data.timezone;
        }
    }
];

// Mencoba tiap API
for (const api of apis) {
    try {
        console.log(`Trying ${api.name}...`);
        
        const timeoutPromise = new Promise((_, reject) => {
            setTimeout(() => reject(new Error('Timeout after 3s')), 3000);
        });

        const fetchPromise = fetch(api.url);
        const response = await Promise.race([fetchPromise, timeoutPromise]);
        
        if (!response.ok) {
            throw new Error(`HTTPS ${response.status}: ${response.statusText}`);
        }
        
        const timezone = await api.parser(response);
        
        if (timezone && timezone.includes('/') && timezone.length > 5) {
            console.log(`${api.name} success: ${timezone}`);
            return timezone;
        } else {
            throw new Error('Invalid timezone format');
        }
        
    } catch (error) {
        console.log(`${api.name} failed: ${error.message}`);
        continue; // Coba API berikutnya jika salah satu API Error
    }
}

// Jika semua API gagal, Oper ke browser
const browserTz = Intl.DateTimeFormat().resolvedOptions().timeZone;
console.log(`All location APIs failed, using browser timezone: ${browserTz}`);
return browserTz;
}

async function initializeTimeSystem() {
console.log('=== INITIALIZING TIME SYSTEM ===');

try {
    userTimezone = await getTimezoneFromIP();
    console.log('User timezone detected:', userTimezone);
    
} catch (error) {
    console.error('Timezone detection failed:', error);
    
    userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    console.log('Using browser timezone as fallback:', userTimezone);
}

const now = new Date();
simulatedTime = new Date(now.getTime());

console.log('Time system initialized with timezone:', userTimezone);
console.log('Initial simulation time:', simulatedTime.toISOString());
console.log('=== INITIALIZATION COMPLETE ===');
}

// Update fungsi display waktu real-time
function updateCurrentTimeDisplay() {
    const now = new Date();
    const userTime = now.toLocaleString('id-ID', {
        timeZone: userTimezone,
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    });
    
    currentTimeDisplay.dataset.timezone = userTimezone;
    currentTimeDisplay.textContent = `Real Time (${userTimezone}): ${userTime}`;
}
await initializeTimeSystem();

// PREDICTION TRAIL SYSTEM //
let predictionTrail = [];
let showingPrediction = false;
let predictionCanvas = null;
let predictionCtx = null;
let showingTerminatorPrediction = false;
let hideOriginalTerminator = false;

// Variabel Kontrol Kecepatan 
let displaySpeed = 1;
let speedFactor = 1;
const speedValueTime = timeControlContent.querySelector("#speedValueTime");
const minDisplaySpeed = 0;
const maxDisplaySpeed = 5000;

// Variabel untuk hold functionality
let holdInterval = null;
let holdTimeout = null;

function updateSpeedValues() {
    speedValueTime.textContent = displaySpeed;
    speedFactor = displaySpeed === 0 ? 0 : displaySpeed;
}

// Fungsi untuk increase speed
function increaseSpeed() {
    if (displaySpeed + 1 <= maxDisplaySpeed) {
        displaySpeed += 1;
        updateSpeedValues();
    }
}

// Fungsi untuk decrease speed
function decreaseSpeed() {
    if (displaySpeed - 1 >= minDisplaySpeed) {
        displaySpeed -= 1;
        updateSpeedValues();
    }
}

// Fungsi untuk memulai hold
function startHold(action) {
    // Eksekusi sekali langsung
    action();
    
    // Tunggu 500ms sebelum mulai repeat
    holdTimeout = setTimeout(() => {
        // Mulai repeat setiap 150ms
        holdInterval = setInterval(action, 150);
    }, 500);
}

// Fungsi untuk menghentikan hold
function stopHold() {
    if (holdInterval) {
        clearInterval(holdInterval);
        holdInterval = null;
    }
    if (holdTimeout) {
        clearTimeout(holdTimeout);
        holdTimeout = null;
    }
}

// Get button elements
const increaseBtn = timeControlContent.querySelector("#increaseSpeedTime");
const decreaseBtn = timeControlContent.querySelector("#decreaseSpeedTime");

// Event listeners untuk increase button
increaseBtn.addEventListener('mousedown', () => startHold(increaseSpeed));
increaseBtn.addEventListener('mouseup', stopHold);
increaseBtn.addEventListener('mouseleave', stopHold);

// Event listeners untuk decrease button
decreaseBtn.addEventListener('mousedown', () => startHold(decreaseSpeed));
decreaseBtn.addEventListener('mouseup', stopHold);
decreaseBtn.addEventListener('mouseleave', stopHold);

// Mencegah text selection saat hold
increaseBtn.addEventListener('selectstart', (e) => e.preventDefault());
decreaseBtn.addEventListener('selectstart', (e) => e.preventDefault());

// Touch events untuk mobile
increaseBtn.addEventListener('touchstart', (e) => {
    e.preventDefault();
    startHold(increaseSpeed);
});
increaseBtn.addEventListener('touchend', (e) => {
    e.preventDefault();
    stopHold();
});

decreaseBtn.addEventListener('touchstart', (e) => {
    e.preventDefault();
    startHold(decreaseSpeed);
});
decreaseBtn.addEventListener('touchend', (e) => {
    e.preventDefault();
    stopHold();
});

// Tombol Close
const closeBtn = document.createElement('div');
closeBtn.innerHTML = '&#10006;';
Object.assign(closeBtn.style, {
    position: 'fixed',
    top: '10px',
    right: '5px',
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

// INFO POPUP //
// Tombol Info 
const infoButton = document.createElement('div');
infoButton.innerHTML = '?';
Object.assign(infoButton.style, {
    position: 'fixed',
    top: '100px',
    right: '35px', 
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

infoButton.addEventListener('mouseenter', () => {
    infoButton.style.backgroundColor = '#3a8eef';
    infoButton.style.transform = 'scale(1.1)';
});

infoButton.addEventListener('mouseleave', () => {
    infoButton.style.backgroundColor = '#4a9eff';
    infoButton.style.transform = 'scale(1)';
});

document.body.appendChild(infoButton);

// Pop-up 
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

// Tombol Close Untuk Pop up
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
            <li><strong>Bulan/Hari/Jam:</strong> Ketuk tombol untuk mengubah waktu simulasi dengan tombol +/-</li>
            <li><strong>Reset ke Waktu sekarang: </strong> Ketuk tombol reset ke waktu sekarang agar kembali ke waktu semula</li>
            <li><strong>Kecepatan:</strong> Ketuk tombol percepat simulasi (0x = berhenti, hingga 5000x)</li>
        </ul>
    </div>

    <div style="margin-bottom: 20px;">
        <h3 style="color: #ffb74d; margin-bottom: 10px; font-size: 18px;"> Groundtrack</h3>
        <p style="line-height: 1.6; margin-bottom: 10px;">
            Visualisasi 2D jejak satelit di permukaan Bumi:
        </p>
        <ul style="margin-left: 20px; line-height: 1.6;">
            <li><strong>Durasi Trail:</strong> Pilih prediksi jejak dalam (1 jam - 360 hari) kedepan</li>
            <li><strong>Show Prediction:</strong> Ketuk tombol untuk tampilkan prediksi jalur satelit di groundtrack</li>
            <li><strong>Clear Prediction:</strong> Ketuk tombol untuk menghapus jejak prediksi</li>
            <li><strong>Display Ground Track:</strong> Ketuk tombol untuk tampilkan groundtrack</li>
        </ul>
    </div>
    
    <div style="margin-bottom: 20px;">
        <h3 style="color: #ffb74d; margin-bottom: 10px; font-size: 18px;"> NOTE: </h3>
        </p>
        <ul style="color:  #fff23fff; margin-left: 20px; line-height: 1.6;">
            <li>Trail dan terminator dibuat berwarna merah</li>
            <li>Jika ingin mengganti prediksi, ketuk tombol clear prediction terlebih dahulu</li>
            <li>Jika waktu simulasi berbeda dengan waktu real time, ketuk tombol reset ke waktu sekarang untuk menyamakan dengan waktu real time</li>
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

infoModal.addEventListener('click', (e) => {
    if (e.target === infoModal) {
        infoModal.style.display = 'none';
    }
});

// Tombol ESC Pop-up
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && infoModal.style.display === 'flex') {
        infoModal.style.display = 'none';
    }
});
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

// Display Tanggal 
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

// Tombol Back To Home
const NextContainer = document.createElement('div');
Object.assign(NextContainer.style, {
   position: 'fixed',
   bottom: '10px',
   left: '10px',
   display: 'flex',
   gap: '10px',
   zIndex: '100'
});

const nextBtn = document.createElement('button');
nextBtn.innerHTML = 'Back To Home ▶';
Object.assign(nextBtn.style, {
   backgroundColor: '#003264',
   color: 'white',
   border: 'none',
   borderRadius: '8px',
   padding: '8px 16px',
   fontSize: '12px',
   fontFamily: 'monospace',
   cursor: 'pointer',
   fontWeight: 'bold',
   boxShadow: '0 2px 8px rgba(0, 50, 100, 0.8)',
   transition: 'all 0.3s ease'
});

nextBtn.addEventListener('mouseenter', () => {
   nextBtn.style.backgroundColor = '#3a8eef';
   nextBtn.style.transform = 'translateY(-2px)';
});

nextBtn.addEventListener('mouseleave', () => {
   nextBtn.style.backgroundColor = '#003264';
   nextBtn.style.transform = 'translateY(0)';
});

nextBtn.addEventListener('click', () => {
   console.log('Navigating to home...');
   window.location.href = '../home'; // Menuju ke home
});

NextContainer.appendChild(nextBtn);
document.body.appendChild(NextContainer);

// Panel Waktu Real Time
const currentTimeDisplay = document.createElement('div');
currentTimeDisplay.style.position = 'fixed';
currentTimeDisplay.style.right = '10px';
currentTimeDisplay.style.backgroundColor = 'rgba(0, 50, 100, 0.8)';
currentTimeDisplay.style.color = 'white';
currentTimeDisplay.style.padding = '8px 12px';
currentTimeDisplay.style.borderRadius = '8px';
currentTimeDisplay.style.fontFamily = 'monospace';
currentTimeDisplay.style.fontSize = '12px';
currentTimeDisplay.style.zIndex = '100';
document.body.appendChild(currentTimeDisplay);

// Update Real Time Setiap Detik
setInterval(updateCurrentTimeDisplay, 1000);
updateCurrentTimeDisplay();

// LOGO //
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

const logoImg = document.createElement('img');
  logoImg.src = '../teksture/logo.png';
  Object.assign(logoImg.style, {
      width: '75px',
      height: '75px',
      borderRadius: '4px'
  });
  logoContainer.appendChild(logoImg);


// LEAFLET.JS MAP SYSTEM //
const leafletCSS = document.createElement('link');
leafletCSS.rel = 'stylesheet';
leafletCSS.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
document.head.appendChild(leafletCSS);

const leafletScript = document.createElement('script');
leafletScript.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
document.head.appendChild(leafletScript);

// Buat Map
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

// Canvas untuk terminator dan trail  
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
let trailCanvas = null;
let trailCtx = null;
let lastTrailUpdate = 0;
let trailNeedsUpdate = true;


// LEAFLET Konversi Koordinat //
function convertCoordsToPixel(coords) {
if (!leafletMap) return null;

const [lon, lat] = coords;
const latLng = L.latLng(lat, lon);
const point = leafletMap.latLngToContainerPoint(latLng);
const bounds = leafletMap.getBounds();
if (bounds.contains(latLng)) {
   return [point.x, point.y];
}
return null;
}

function redrawOverlays() {
if (!leafletMap || mapContainer.style.display === 'none') return;

console.log('Redrawing overlays after map change');
trailNeedsUpdate = true;
nightOverlayCanvas = null;
frameCounter = 0;

if (ctxGT) {
   ctxGT.clearRect(0, 0, widthGT, heightGT);
}
}

function preventAutoFocus() { // Cegah Auto Fokus
if (document.activeElement && document.activeElement !== document.body) {
   document.activeElement.blur();
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

mapContainer.style.width = `${w}px`;
mapContainer.style.height = `${h}px`;
mapContainer.style.top = `${(window.innerHeight - h) / 2}px`;
mapContainer.style.left = `${(window.innerWidth - w) / 2}px`;

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

if (predictionCanvas) {
   predictionCanvas.width = widthGT;
   predictionCanvas.height = heightGT;
}

if (leafletMap && mapContainer.style.display === 'block') {

   const currentCenter = leafletMap.getCenter();
   const currentZoom = leafletMap.getZoom();
   
   setTimeout(() => {
       leafletMap.invalidateSize({ animate: false });
       leafletMap.setView(currentCenter, currentZoom, { animate: false });
       
       redrawOverlays();
       preventAutoFocus(); // Mencegah auto-focus setelah canvas resize
   }, 100);
}
}

panel.addEventListener('touchstart', (e) => {
e.stopPropagation();
}, { passive: true });

panel.addEventListener('touchmove', (e) => {
e.stopPropagation();
}, { passive: true });

// Canvas Hitam Untuk Background Peta
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
   worldCopyJump: false,  
   maxBounds: [[-90, -180], [90, 180]],  // Batas Peta 
   maxBoundsViscosity: 1.0  
});


// Layer Peta
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

osmLayer.addTo(leafletMap);

const baseLayers = {
"Street Map": osmLayer,
"Satellite": satelliteLayer
};

L.control.layers(baseLayers).addTo(leafletMap);

// Marker Lokasi
if (userLocationData) {
 const userMarker = L.marker([userLocationData.latitude, userLocationData.longitude], {
     icon: L.icon({
         iconUrl: 'data:image/svg+xml;base64,' + btoa(`
             <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                 <circle cx="15" cy="15" r="12" fill="#4285F4" stroke="#ffffff" stroke-width="3"/>
                 <circle cx="15" cy="15" r="6" fill="#ffffff"/>
             </svg>
         `),
         iconSize: [30, 30],
         iconAnchor: [15, 15],
         popupAnchor: [0, -15]
     })
 });
 
 userMarker.addTo(leafletMap);
 userMarker.bindPopup(`
     <div style="font-family: sans-serif; text-align: center;">
         <b>Lokasi Anda</b><br>
         ${userLocationData.city}, ${userLocationData.country}<br>
         <small>${userLocationData.latitude.toFixed(4)}°, ${userLocationData.longitude.toFixed(4)}°</small>
     </div>
 `);
}

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
panel.style.display = 'block';
panel.style.position = 'fixed';
panel.style.top = '10px';
panel.style.left = '10px';
panel.style.zIndex = '100'; 
logoContainer.style.display = 'none'; // logo hilang saat GT terbuka

if (!document.getElementById('canvasBackground')) {
 createBlackBackgroundCanvas();
}

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
panel.style.position = 'fixed';
panel.style.top = '10px';
panel.style.left = '10px';
panel.style.zIndex = '20'; 

logoContainer.style.display = 'flex'; //Logo Tertampil Kembali

const canvasBG = document.getElementById('canvasBackground');
if (canvasBG) canvasBG.remove();
}
function enhancePanelVisibility() {
if (mapContainer.style.display === 'block') {
 panel.style.background = 'rgba(26, 30, 46, 0.95)';
 panel.style.backdropFilter = 'blur(10px)';
 panel.style.border = '1px solid #555';
 panel.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.7)';
} else {
 panel.style.background = '#1a1e2e';
 panel.style.backdropFilter = 'none';
 panel.style.border = 'none';
 panel.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.3)';
}
}

displayBtn.addEventListener('click', () => {
showGroundTrackCanvas();
enhancePanelVisibility();
updateResponsiveUI();
});

closeBtn.addEventListener('click', () => {
hideGroundTrackCanvas();
enhancePanelVisibility();
updateResponsiveUI();
});

updateCanvasSize();


// UI RESPONSIF UNTUK MOBILE //

// Fungsi untuk mendeteksi ukuran layar
function updateResponsiveUI() {
const isMobile = window.innerWidth <= 1024;
const isSmallMobile = window.innerWidth <= 480;

// CONTROL PANEL UNTUK MOBILE
if (isMobile) {
 Object.assign(panel.style, {
    width: isSmallMobile ? '240px' : '260px',
    fontSize: '11px',
    padding: '8px',
    maxHeight: '60vh', 
    overflowY: 'auto',
    top: isSmallMobile ? '60px' : '15px' 
 });
 
 
const titles = panel.querySelectorAll('h4, h5');
titles.forEach(title => {
    title.style.fontSize = isSmallMobile ? '12px' : '13px';
    title.style.padding = isSmallMobile ? '6px 8px' : '7px 10px';
});
 
// Perkecil button di panel
const buttons = panel.querySelectorAll('button');
buttons.forEach(btn => {
    btn.style.fontSize = isSmallMobile ? '10px' : '11px';
    btn.style.padding = isSmallMobile ? '4px' : '5px';
});
 
// Perkecil dropdown
const selects = panel.querySelectorAll('select');
selects.forEach(select => {
    select.style.fontSize = isSmallMobile ? '10px' : '11px';
    select.style.padding = isSmallMobile ? '3px' : '4px';
});
 
} else {
 Object.assign(panel.style, {
     width: '260px',
     fontSize: '12px',
     padding: '12px',
     maxHeight: '90vh',
     top: '10px'
 });
}

// DATE DISPLAY RESPONSIVE 
if (isMobile) {
 Object.assign(dateDisplay.style, {
     fontSize: isSmallMobile ? '12px' : '12px',
     padding: isSmallMobile ? '6px 10px' : '8px 15px',
     top: isSmallMobile ? '5px' : '18px',
     maxWidth: isSmallMobile ? '90%' : '20%',
     lineHeight: isSmallMobile ? '1.2' : '1.4'
     
 });
 

const updateDateDisplayMobile = () => {
    const formattedSimTime = simulatedTime.toLocaleString('id-ID', {
        timeZone: userTimezone,
        year: '2-digit', 
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    });
     
const season = getSeasonInfo(simulatedTime);
     
     if (isSmallMobile) {
         dateDisplay.innerHTML = `
             <div style="color: #ffff00; font-weight: bold;">${formattedSimTime}</div>
             <div style="color: #88ff88; font-size: 9px;">${season}</div>
         `;
     } else {
         dateDisplay.innerHTML = `
             <div style="color: #ffff00; font-weight: bold; margin-bottom: 4px;">${formattedSimTime}</div>
             <div style="color: #88ff88; font-size: 10px;">${season}</div>
         `;
     }
 };
 
 
window.updateDateDisplayMobile = updateDateDisplayMobile;
 
} else {
 // Desktop: Ukuran normal
 Object.assign(dateDisplay.style, {
     fontSize: '14px',
     padding: '10px 20px',
     top: '10px',
     maxWidth: 'none',
     lineHeight: '1.6'
 });
}

// DISPLAY POSISI SATELIT //

if (isMobile) {
Object.assign(satelliteDisplay.style, {
  fontSize: isSmallMobile ? '9px' : '11px',
  padding: isSmallMobile ? '6px 8px' : '7px 10px',
  bottom: isSmallMobile ? '1px' : '6px',
  left: isSmallMobile ? '5px' : '15px',  
  transform: 'none', 
  maxWidth: isSmallMobile ? '90%' : '85%',
  minWidth: isSmallMobile ? '180px' : '200px'
});
} else {
 Object.assign(satelliteDisplay.style, {
     fontSize: '12px',
     padding: '8px 12px',
     bottom: '10px',
     maxWidth: 'none',
     left: '50%', 
     transform: 'translateX(-50%)',
     minWidth: '200px'
 });
}


// BACK TO HOME MOBILE
if (isMobile) {
   Object.assign(NextContainer.style, {
       bottom: isSmallMobile ? '40px' : '35px',
       left: isSmallMobile ? '5px' : '15px',  
       gap: isSmallMobile ? '6px' : '8px'
   });
   
   [nextBtn].forEach(btn => {
       Object.assign(btn.style, {
           padding: isSmallMobile ? '6px 12px' : '7px 14px',
           fontSize: isSmallMobile ? '10px' : '11px'
       });
   });
} else {
   Object.assign(NextContainer.style, {
       bottom: '10px',
       left: '10px',
       gap: '10px'
   });
   
   [nextBtn].forEach(btn => {
       Object.assign(btn.style, {
           padding: '8px 16px',
           fontSize: '12px'
       });
   });
}

// DISPLAY REAL TIME 
if (isMobile) {
 Object.assign(currentTimeDisplay.style, {
     fontSize: isSmallMobile ? '9px' : '12px',
     padding: isSmallMobile ? '5px 8px' : '6px 10px',
     bottom: isSmallMobile ? '5px' : '8px',
     right: isSmallMobile ? '5px' : '15px',
     maxWidth: isSmallMobile ? '90%' : '85%',
     minWidth: isSmallMobile ? '50px' : '200px'
 });
 
 
const updateCurrentTimeDisplayMobile = () => {
const now = new Date();

const userTime = now.toLocaleString('id-ID', {
    timeZone: userTimezone,
    year: isSmallMobile ? '2-digit' : 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: isSmallMobile ? undefined : '2-digit', // Hilangkan detik di small mobile
    hour12: false
});

const timezoneName = userTimezone.split('/').pop() || userTimezone;
    
    if (isSmallMobile) {
        currentTimeDisplay.textContent = `Real: ${userTime}`;
    } else {
        currentTimeDisplay.textContent = `Real (${timezoneName}): ${userTime}`;
    }
};
 
 window.updateCurrentTimeDisplayMobile = updateCurrentTimeDisplayMobile;
 
} else {
 Object.assign(currentTimeDisplay.style, {
     fontSize: '12px',
     padding: '8px 12px',
     bottom: '10px',
     right: '10px',
     maxWidth: 'none'
 });
}

// LOGO RESPONSIF //
if (isMobile) {
 Object.assign(logoContainer.style, {
     top: isSmallMobile ? '5px' : '8px',
     right: isSmallMobile ? '5px' : '10px',
     padding: isSmallMobile ? '4px 6px' : '6px 8px'
 });
 
 Object.assign(logoImg.style, {
     width: isSmallMobile ? '50px' : '60px',
     height: isSmallMobile ? '50px' : '60px'
 });
} else {

 Object.assign(logoContainer.style, {
     top: '10px',
     right: '10px',
     padding: '8px 12px'
 });
 
 Object.assign(logoImg.style, {
     width: '75px',
     height: '75px'
 });
}


// TOMBOL INFO RESPONSIF //
if (isMobile) {
 Object.assign(infoButton.style, {
     top: isSmallMobile ? '70px' : '85px',
     right: isSmallMobile ? '23px' : '33px', 
     width: isSmallMobile ? '28px' : '30px',
     height: isSmallMobile ? '28px' : '30px',
     fontSize: isSmallMobile ? '16px' : '17px'
 });
} else {
 Object.assign(infoButton.style, {
     top: '100px',
     right: '40px',
     width: '32px',
     height: '32px',
     fontSize: '18px'
 });
}


// RESPONSIF INFO //
if (isMobile) {
 Object.assign(modalContent.style, {
     maxWidth: isSmallMobile ? '95%' : '90%',
     maxHeight: '85vh',
     padding: isSmallMobile ? '15px' : '20px',
     fontSize: isSmallMobile ? '13px' : '14px',
     margin: isSmallMobile ? '10px' : '20px'
 });
 
 const modalHeadings = modalContent.querySelectorAll('h2, h3');
 modalHeadings.forEach(heading => {
     if (heading.tagName === 'H2') {
         heading.style.fontSize = isSmallMobile ? '18px' : '20px';
     } else if (heading.tagName === 'H3') {
         heading.style.fontSize = isSmallMobile ? '14px' : '16px';
     }
 });
} else {
 Object.assign(modalContent.style, {
     maxWidth: '600px',
     maxHeight: '80vh',
     padding: '25px',
     fontSize: '14px',
     margin: 'auto'
 });
}


// PANEL KHUSUS MOBILE //

if (isSmallMobile) {

  panel.style.display = 'none';
 if (!document.getElementById('togglePanelBtn')) {
     const toggleBtn = document.createElement('button');
     toggleBtn.id = 'togglePanelBtn';
     toggleBtn.innerHTML = '☰'; //hamburger
     Object.assign(toggleBtn.style, {
         position: 'fixed',
         top: '10px',
         left: '5px',
         zIndex: '25',
         width: '30px',
         height: '30px',
         backgroundColor: '#2a2e3e',
         color: 'white',
         border: 'none',
         borderRadius: '4px',
         fontSize: '16px',
         cursor: 'pointer',
         display: 'none' 
     });
     
     let panelVisible = true;
     toggleBtn.addEventListener('click', () => {
         panelVisible = !panelVisible;
         panel.style.display = panelVisible ? 'block' : 'none';
         toggleBtn.innerHTML = panelVisible ? '☰' : '☰';
     });
     
     document.body.appendChild(toggleBtn);
 }
 
const toggleBtn = document.getElementById('togglePanelBtn');
if (toggleBtn) {
    toggleBtn.style.display = 'block';
}
} else {

// Sembunyikan toggle button di layar yang lebih besar
const toggleBtn = document.getElementById('togglePanelBtn');
if (toggleBtn) {
    toggleBtn.style.display = 'none';
    panel.style.display = 'block'; 
}
}

console.log(`UI updated for ${isMobile ? (isSmallMobile ? 'small mobile' : 'mobile') : 'desktop'} screen`);
}


// BUMI DAN LAIN-LAIN //

const loader = new THREE.TextureLoader();
const geometri = new THREE.SphereGeometry(6378.14, 64, 64);

// Grup Bumi
const grupbumi = new THREE.Group();
scene.add(grupbumi);

const material = new THREE.MeshPhongMaterial({
map: loader.load('../teksture/bumisiang.jpg'),
bumpMap: loader.load('../teksture/bump.jpg'),
specularMap: loader.load('../teksture/mask.png'),
});
const bumi = new THREE.Mesh(geometri, material);
grupbumi.add(bumi);

// Lampu Kota
const city = new THREE.MeshBasicMaterial({
map: loader.load('../teksture/bumimalam.jpg'),
blending: THREE.AdditiveBlending,
});
const citylight = new THREE.Mesh(geometri, city);
grupbumi.add(citylight);

// Bintang
const bintang = getStar({ numStars: 1000 });
scene.add(bintang);

// Milky Way Background
new THREE.TextureLoader().load('../teksture/milkyway.jpg', function (texture) {
const rt = new THREE.WebGLCubeRenderTarget(texture.image.height);
rt.fromEquirectangularTexture(renderer, texture);
scene.background = rt.texture;
});

// Awan
const awan = new THREE.MeshStandardMaterial({
map: loader.load('../teksture/berawan.jpg'),
blending: THREE.AdditiveBlending,
transparent: true,
opacity: 0.8
});
const awanku = new THREE.Mesh(geometri, awan);
awanku.scale.setScalar(1.001);
grupbumi.add(awanku);


// FOOTPRINT UNTUK BUMI //

function createFootprintOnlyMaterial() {
console.log("Creating footprint overlay material positioned at satellite...");

const vertexShader = `
    varying vec3 vWorldPosition;
    varying vec3 vNormal;
    
    void main() {
        vec4 worldPosition = modelMatrix * vec4(position, 1.0);
        vWorldPosition = worldPosition.xyz;
        vNormal = normalize(normalMatrix * normal);
        
        gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
    }
`;

const fragmentShader = `
    uniform vec3 footprintCenter;
    uniform float footprintRadius;
    uniform float time;
    
    varying vec3 vWorldPosition;
    varying vec3 vNormal;
    
    void main() {
        // Normalize positions to sphere surface untuk menghindari distorsi
        vec3 surfacePos = normalize(vWorldPosition);
        vec3 footprintCenterNorm = normalize(footprintCenter);
        
        // Calculate angular distance (great circle distance) pada sphere
        float dotProduct = dot(surfacePos, footprintCenterNorm);
        dotProduct = clamp(dotProduct, -1.0, 1.0); // Prevent NaN
        float angularDistance = acos(dotProduct);
        
        // Convert angular distance to linear distance
        float sphereRadius = length(vWorldPosition);
        float linearDistance = angularDistance * sphereRadius;
        
        if (linearDistance <= footprintRadius) {
            // Inside footprint area - pure green overlay
            float pulseIntensity = 0.7 + 0.3 * sin(time * 4.0);
            
            // Create smooth circular boundary
            float edgeFactor = 1.0 - smoothstep(footprintRadius * 0.9, footprintRadius, linearDistance);
            
            // Bright green footprint color
            vec3 footprintColor = vec3(0.0, 1.0, 0.2);
            
            // Alpha based on edge and pulse
            float alpha = edgeFactor * pulseIntensity * 0.7;
            
            gl_FragColor = vec4(footprintColor, alpha);
        } else {
            // Outside footprint: completely transparent
            discard;
        }
    }
`;

return new THREE.ShaderMaterial({
    vertexShader: vertexShader,
    fragmentShader: fragmentShader,
    uniforms: {
        footprintCenter: { value: new THREE.Vector3(0, 0, 0) },
        footprintRadius: { value: 1000.0 },
        time: { value: 0.0 }
    },
    transparent: true,
    blending: THREE.NormalBlending,
    side: THREE.DoubleSide,
    depthWrite: false,
    depthTest: true
});
}

const footprintOverlayMaterial = createFootprintOnlyMaterial();
const footprintOverlay = new THREE.Mesh(geometri, footprintOverlayMaterial);
footprintOverlay.scale.setScalar(1.0035); // Sedikit di atas awan asli (1.003 + 0.0005)
grupbumi.add(footprintOverlay);

//Fresnel
const fresnel = getFresnel();
const bersinar = new THREE.Mesh(geometri, fresnel);
bersinar.scale.setScalar(1.01);
grupbumi.add(bersinar);

function updateDualCloudFootprint(altitude) {
const earthRadius = 6378.14;

let satelliteAltitude;
if (orbitType === "GEO") {
    satelliteAltitude = altitude;
} else if (apogee === perigee) {
    satelliteAltitude = apogee;
} else {
    const worldPos = new THREE.Vector3();
    satellite.getWorldPosition(worldPos);
    satelliteAltitude = worldPos.length() - earthRadius;
}

// Radius footprint yang sama dengan groundtrack
const beamAngleRad = THREE.MathUtils.degToRad(beamwidth / 2);
const footprintRadiusKm = (satelliteAltitude + earthRadius) * Math.tan(beamAngleRad);
const worldPos = new THREE.Vector3();
satellite.getWorldPosition(worldPos);
const footprintOverlayRadius = earthRadius * 1.0035;
const projectedPos = worldPos.clone().normalize().multiplyScalar(footprintOverlayRadius);

// Update shader uniforms dengan posisi satelit yang sebenarnya
footprintOverlayMaterial.uniforms.footprintCenter.value.copy(projectedPos);
footprintOverlayMaterial.uniforms.footprintRadius.value = footprintRadiusKm;
footprintOverlayMaterial.uniforms.time.value = Date.now() * 0.001;

console.log(`Footprint positioned at satellite - World: (${worldPos.x.toFixed(2)}, ${worldPos.y.toFixed(2)}, ${worldPos.z.toFixed(2)}), Projected: (${projectedPos.x.toFixed(2)}, ${projectedPos.y.toFixed(2)}, ${projectedPos.z.toFixed(2)}), Radius: ${footprintRadiusKm.toFixed(2)} km`);
}


// MATAHARI //

function calculateEarthRotationPosition(simulatedTime) {
const utcTime = new Date(simulatedTime.getTime());
const hoursFromMidnight = utcTime.getUTCHours() +
                            utcTime.getUTCMinutes() / 60 + 
                            utcTime.getUTCSeconds() / 3600;

const hourlyRotation = hoursFromMidnight * 15;
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

function calculateRealisticSunPosition(simulatedTime) {
const utcTime = new Date(simulatedTime.getTime()); //Waktu UTC
const hoursFromMidnight = utcTime.getUTCHours() + 
                      utcTime.getUTCMinutes() / 60 + 
                      utcTime.getUTCSeconds() / 3600;

const hourlyLongitude = (12 - hoursFromMidnight) * 15;
const sunLongitude = hourlyLongitude;

let normalizedLongitude = ((sunLongitude % 360) + 360) % 360;
if (normalizedLongitude > 180) {
 normalizedLongitude -= 360;
}

return normalizedLongitude;
}

function calculateRealisticSunDeclination(simulatedTime) {
const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;

// Deklinasi berdasarkan musim
const declination = -23.45 * Math.cos(THREE.MathUtils.degToRad((360 / 365.25) * (dayOfYear + 10)));

return declination;
}


function calculateSunYearlyOrbitPosition(simulatedTime) {
const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;


const orbitalAngle = (dayOfYear / 365.25) * 2 * Math.PI;
const eccentricity = 0.0167; // Eksentrisitas Bumi terhadap matahari
const meanAnomaly = orbitalAngle;
const trueAnomaly = meanAnomaly + 2 * eccentricity * Math.sin(meanAnomaly);

return {
angle: trueAnomaly,
dayOfYear: dayOfYear
};
}

// Axial tilt
function calculateEarthAxisTilt(simulatedTime) {
const startOfYear = new Date(simulatedTime.getFullYear(), 0, 1);
const dayOfYear = Math.floor((simulatedTime - startOfYear) / (1000 * 60 * 60 * 24)) + 1;

// Max tilt pada solstices, 0 pada equinoxes
const tiltAngle = 23.45 * Math.sin(THREE.MathUtils.degToRad((360 / 365.25) * (dayOfYear - 81)));

return tiltAngle;
}

// SINKRONISASI ROTASI BUMI DENGAN PERGERAKAN MATAHARI //

function calculateRequiredEarthRotation(simulatedTime) {
const earthRotationLongitude = calculateEarthRotationPosition(simulatedTime);

const offsetDegrees = 180; 
const adjustedRotation = earthRotationLongitude + offsetDegrees;
const requiredRotationRadians = THREE.MathUtils.degToRad(adjustedRotation);

console.log(`Earth 3D rotation: ${THREE.MathUtils.radToDeg(requiredRotationRadians).toFixed(2)}°`);

return requiredRotationRadians;
}


// SINKRONISASI DIRECTIONALLIGHT //
function synchronizeEarthRotationWithSun() {
const requiredRotation = calculateRequiredEarthRotation(simulatedTime);

bumi.rotation.y = requiredRotation;
citylight.rotation.y = requiredRotation;
bersinar.rotation.y = requiredRotation;
awanku.rotation.y = requiredRotation;

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

// ENHANCED TIME CONTROL EVENT LISTENERS WITH PROPER SYNCHRONIZATION


// SNKRONISASI BUMI DENGAN WAKTU SIMULASI //
function modifySimulatedTimeWithSync(modifier) {
const oldTime = new Date(simulatedTime);
const newTime = new Date(simulatedTime);
modifier(newTime);

simulatedTime = newTime;
console.log(`=== TIME CHANGE EVENT ===`);
console.log(`Time changed from ${oldTime.toISOString()} to ${simulatedTime.toISOString()}`);

synchronizeEarthRotationWithSun();

// Update satellite position for all orbit types when time changes manually
if (orbitType === "GEO") {
updateGEOSatellitePosition();
} else {
const deltaTimeSeconds = (simulatedTime.getTime() - oldTime.getTime()) / 1000;
const angleRate = getTrueAnomalyRate(a * Km, e, trueanomaly, orbitType);
trueanomaly -= angleRate * deltaTimeSeconds;
}

groundTrack.length = 0;
trailPoints.length = 0;
nightOverlayCanvas = null;
frameCounter = 0;
trailNeedsUpdate = true;

// Bersihkan Prediksi Ketika Waktu diubah
if (showingPrediction) {
predictionTrail = [];
showingPrediction = false;
}

console.log(`=== SYNC COMPLETE ===`);
}


// Fungsi Reset Waktu
function resetTimeToCurrentWithSync() {
const oldTime = new Date(simulatedTime);
const now = new Date();
const newTime = new Date(now.getTime()); 

simulatedTime = newTime;

console.log(`=== TIME RESET EVENT ===`);
console.log(`Time reset from ${oldTime.toISOString()} to ${simulatedTime.toISOString()}`);
console.log(`Reset to current time in timezone: ${userTimezone}`);

synchronizeEarthRotationWithSun();

// Reset satelit ke posisi semula
if (orbitType === "GEO") {
updateGEOSatellitePosition();
} else {
// Reset non-GEO satellite ke true anomaly semula
trueanomaly = THREE.MathUtils.degToRad(degtrueanomaly);
}

if (orbitType === "GEO") {
updateGEOSatellitePosition();
}

groundTrack.length = 0;
trailPoints.length = 0;
nightOverlayCanvas = null;
frameCounter = 0;
trailNeedsUpdate = true;

// Bersihkan Prediksi Ketika di Reset
if (showingPrediction) {
predictionTrail = [];
showingPrediction = false;
}

console.log(`=== RESET COMPLETE ===`);
}

// Matahari
const grupOrbitMatahari = new THREE.Group();
scene.add(grupOrbitMatahari);
const matahariRadius = 30000;
const sunGeometry = new THREE.SphereGeometry(matahariRadius, 32, 32);
const sunMaterial = new THREE.MeshBasicMaterial({
map: loader.load('../teksture/sun.jpg'),
});
const matahari = new THREE.Mesh(sunGeometry, sunMaterial);
grupOrbitMatahari.add(matahari);

// Directional Light 
const cahaya = new THREE.DirectionalLight(0xffffff, 3);
scene.add(cahaya); 
const jarakKeMatahari = 300000;


// BUAT SATELIT //
const grupSatelit = new THREE.Group();
grupbumi.add(grupSatelit);

function createAdvancedSatellite() {
const satelliteGroup = new THREE.Group();

// Body utama silinder 
const bodyGeometry = new THREE.CylinderGeometry(60, 60, 200, 16);
const bodyMaterial = new THREE.MeshStandardMaterial({ 
color: 0xdddddd,
metalness: 0.7,
roughness: 0.3,
emissive: 0x222222
});
const satelliteBody = new THREE.Mesh(bodyGeometry, bodyMaterial);
satelliteGroup.add(satelliteBody);

// Ring di Body
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

// Mesin Bawah
const lowerEngineGeometry = new THREE.CylinderGeometry(35, 45, 40, 12);
const lowerEngineMaterial = new THREE.MeshStandardMaterial({ 
color: 0x444444,
metalness: 0.9,
roughness: 0.1
});
const lowerEngine = new THREE.Mesh(lowerEngineGeometry, lowerEngineMaterial);
lowerEngine.position.y = -120;
satelliteGroup.add(lowerEngine);

// Solar Panel
const panelGeometry = new THREE.BoxGeometry(350, 150, 1);
const panelTexture = loader.load('../teksture/panel.jpg');
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

// ANTENNA PARABOLA
// Dasar untuk antena
const mountingBaseGeometry = new THREE.CylinderGeometry(35, 40, 15, 16);
const mountingBaseMaterial = new THREE.MeshStandardMaterial({
color: 0x666666,
metalness: 0.8,
roughness: 0.3
});
const mountingBase = new THREE.Mesh(mountingBaseGeometry, mountingBaseMaterial);
mountingBase.position.set(0, 107, 0);
satelliteGroup.add(mountingBase);

// Antena Parabola dan kecekungannya
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

// Support Arm 2 
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

// Support Arm 3 
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

return satelliteGroup;
}

const satellite = createAdvancedSatellite();
grupSatelit.add(satellite);

// Tambahkan Point Light di dekat satelit
const satelliteLight = new THREE.PointLight(0xffffff, 1, 100);
satelliteLight.position.set(0, 0, 100); // Di dekat satelit
scene.add(satelliteLight);

// Garis Dari Satelit Ke Pusat Bumi
const lineMaterial = new THREE.LineBasicMaterial({ color: 0x00ffff });
const lineGeometry = new THREE.BufferGeometry().setFromPoints([
new THREE.Vector3(0, 0, 0),
new THREE.Vector3(0, 0, 0),
]);
const garisKeBumi = new THREE.Line(lineGeometry, lineMaterial);
scene.add(garisKeBumi);

// Sistem Trail
const maxTrailPoints = 2000;
const trailPositions = new Float32Array(maxTrailPoints * 4);
const trailGeometry = new THREE.BufferGeometry();
trailGeometry.setAttribute('position', new THREE.BufferAttribute(trailPositions, 3));
const trailMaterial = new THREE.LineBasicMaterial({ color: 0xffff00 });
const trail = new THREE.Line(trailGeometry, trailMaterial);
bersinar.add(trail);
const trailPoints = [];
const groundTrack = [];


// DETEKSI CANVAS CROSSING //

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
   
   // Bersihkan Canvas Jika Target Tercapai
   if (canvasCrossings >= targetCrossings) {
      console.log(`Clearing trail after ${canvasCrossings} canvas crossings`);
       groundTrack.length = 0;
       trailNeedsUpdate = true;
       canvasCrossings = 0; 
   }
} else {
   hasCompletedFirstPass = true;
}
}

lastLongitude = currentLon;
lastLatitude = currentLat;
}

let orbitCount = 0;
let previousTrueAnomaly = 0;
let hasCompletedFirstOrbit = false;


// PARAMETER ORBIT //

const Km = 1000;
const earthRadius = 6378.14;
const G = 6.674e-11;
const M = 5.972e24;

const params = window.orbitParams ?? {};

let orbitType = params.type ?? "LEO";
let apogee = parseFloat(params.apogee ?? 200);
let perigee = parseFloat(params.perigee ?? 200);
let deginklination = parseFloat(params.inclination ?? 0);
let inclination = THREE.MathUtils.degToRad(deginklination);
let argPerigeeDeg = parseFloat(params.argPerigee ?? 0);
let argPerigee = THREE.MathUtils.degToRad(argPerigeeDeg);
let RAANDeg = parseFloat(params.raan ?? 30);
let RAAN = THREE.MathUtils.degToRad(RAANDeg);
let degtrueanomaly = parseFloat(params.trueAnomaly ?? 0);
let trueanomaly = THREE.MathUtils.degToRad(degtrueanomaly);
let altitude = parseFloat(35786.019);
let geoLongitude = parseFloat(params.spaceslot_up ?? 0);
let geoLongitudeRad = THREE.MathUtils.degToRad(geoLongitude);
let beamwidth = parseFloat(params.beamwidth_manual_downspacecraft ?? 20);; 


// Fungsi Tampilkan Parameter 
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


// PREDIKSI GROUNDTRACK TRAIL //

// Hitung posisi satelit untuk waktu tertentu
function calculateSatellitePositionAtTime(targetTime, currentTrueAnomaly) {
if (orbitType === "GEO") {
// Untuk GEO posisi fix
return {
  longitude: geoLongitude,
  latitude: 0,
  altitude: altitude
};
}

// Untuk orbit non-GEO, simulasikan gerakan orbit
const deltaTimeSeconds = (targetTime.getTime() - simulatedTime.getTime()) / 1000;
const angleRate = getTrueAnomalyRate(a * Km, e, currentTrueAnomaly, orbitType);
const futureTrueAnomaly = currentTrueAnomaly - angleRate * deltaTimeSeconds;

let r;
if (e === 0) {
r = a;
} else {
r = (a * (1 - e * e)) / (1 + e * Math.cos(futureTrueAnomaly));
}

let x = Math.cos(futureTrueAnomaly) * r;
let z = Math.sin(futureTrueAnomaly) * r;
let pos = new THREE.Vector3(x, 0, z);
const transformMatrix = new THREE.Matrix4()
.multiply(matrixRAAN)
.multiply(matrixInclination)
.multiply(matrixArgPerigee);
pos.applyMatrix4(transformMatrix);

const futureEarthRotation = calculateRequiredEarthRotation(targetTime);

// Konversi ke lat/lon dengan mempertimbangkan rotasi Bumi
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

// Fungsi untuk menghitung posisi matahari untuk kedepan
function calculateFutureSunPosition(futureTime) {
 const futureSunLongitude = calculateRealisticSunPosition(futureTime);
 const futureSunDeclination = calculateRealisticSunDeclination(futureTime);
 
 return {
     longitude: futureSunLongitude,
     declination: futureSunDeclination
 };
}

// Fungsi untuk terminator di masa kedepan
function createFutureTerminatorOverlay(futureTime, width, height, alpha = 0.3) {
 if (!leafletMap) return null;

 const canvas = document.createElement('canvas');
 canvas.width = width;
 canvas.height = height;
 const ctx = canvas.getContext('2d');

 const sunPos = calculateFutureSunPosition(futureTime);
 const step = 8; 

 for (let x = 0; x < width; x += step) {
     for (let y = 0; y < height; y += step) {
         const containerPoint = L.point(x, y);
         const latLng = leafletMap.containerPointToLatLng(containerPoint);
         
         if (!latLng) continue;
         
         let lon = latLng.lng;
         const lat = latLng.lat;
         
         if (lat < -90 || lat > 90) continue;
         
         while (lon > 180) lon -= 360;
         while (lon < -180) lon += 360;
         
         const isDaylight = isPointInDaylight(lon, lat, sunPos.longitude, sunPos.declination);
         
         if (!isDaylight) {
             const latRad = THREE.MathUtils.degToRad(lat);
             const sunDecRad = THREE.MathUtils.degToRad(sunPos.declination);
             const hourAngle = THREE.MathUtils.degToRad(lon - sunPos.longitude);
             const sinElevation = Math.sin(latRad) * Math.sin(sunDecRad) +
                                Math.cos(latRad) * Math.cos(sunDecRad) * Math.cos(hourAngle);
             const elevationDegrees = THREE.MathUtils.radToDeg(Math.asin(sinElevation));
             
             const darkness = Math.min(1.0, Math.abs(elevationDegrees) / 60 + 0.5);
             const finalAlpha = alpha + (darkness * 0.2);
             const red = Math.floor(60 + (darkness * 20)); // Warna merah untuk terminator prediksi
             ctx.fillStyle = `rgba(${red}, 10, 10, ${finalAlpha})`;

             ctx.fillRect(x, y, step, step);
         }
     }
 }

 return canvas;
}

// Prediksi Trail dengan Prediksi terminator
function generatePredictionTrailWithTerminator(durationHours) {
predictionTrail = [];
showingTerminatorPrediction = true;

let orbitalPeriodHours;
if (orbitType === "GEO") {
  orbitalPeriodHours = 24;
} else {
  const earthRadius = 6378.14;
  const r_apogee = earthRadius + apogee;
  const r_perigee = earthRadius + perigee;
  const a_km = (r_apogee + r_perigee) / 2;
  const a_m = a_km * 1000;
  const G = 6.674e-11;
  const M = 5.972e24;
  
  const orbitalPeriodSeconds = 2 * Math.PI * Math.sqrt(Math.pow(a_m, 3) / (G * M));
  orbitalPeriodHours = orbitalPeriodSeconds / 3600;
}

console.log(`Generating prediction with terminator for ${durationHours} hours (${orbitalPeriodHours.toFixed(2)}h orbital period)`);

// Untuk durasi 30 - 360 hari hanya 3 periode terakhir
let startTime, endTime;
if (durationHours >= 720) {
  const threePeriods = orbitalPeriodHours * 3;
  startTime = new Date(simulatedTime.getTime() + (durationHours - threePeriods) * 60 * 60 * 1000);
  endTime = new Date(simulatedTime.getTime() + durationHours * 60 * 60 * 1000);
} else {
  startTime = new Date(simulatedTime);
  endTime = new Date(startTime.getTime() + durationHours * 60 * 60 * 1000);
}

let timeStepMinutes;
if (durationHours <= 1) {
  timeStepMinutes = 1;
} else if (durationHours <= 8) {
  timeStepMinutes = 2;
} else if (durationHours <= 24) {
  timeStepMinutes = 3;
} else {
  timeStepMinutes = 3;
}

const currentTrueAnomalySnapshot = trueanomaly;
let pointCount = 0;

for (let time = new Date(startTime); time <= endTime; time.setMinutes(time.getMinutes() + timeStepMinutes)) {
  const position = calculateSatellitePositionAtTime(time, currentTrueAnomalySnapshot);
  predictionTrail.push({
      coords: [position.longitude, position.latitude],
      time: new Date(time),
      altitude: position.altitude
  });
  pointCount++;
  
  if (pointCount > 10000) {
      console.warn(`Prediction trail limited to ${pointCount} points for performance`);
      break;
  }
}

console.log(`Generated prediction trail with terminator: ${predictionTrail.length} points`);
}

// Inisialisasi kanvas prediksi
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

// Perbarui Canvas Dengan Prediksi Terminator
function updatePredictionCanvasWithTerminator() {
 if (!showingPrediction || predictionTrail.length < 2 || !leafletMap) return;

 initPredictionCanvas();
 predictionCtx.clearRect(0, 0, widthGT, heightGT);

 // Buat terminator masa depan jika menampilkan prediksi terminator
 if (showingTerminatorPrediction && predictionTrail.length > 0) {
     const endTime = predictionTrail[predictionTrail.length - 1].time;
     const futureTerminatorOverlay = createFutureTerminatorOverlay(endTime, widthGT, heightGT, 0.25);
     
     if (futureTerminatorOverlay) {
         predictionCtx.save();
         predictionCtx.filter = 'blur(6px)';
         predictionCtx.drawImage(futureTerminatorOverlay, 0, 0);
         predictionCtx.restore();
         
        
     }
 }

 predictionCtx.save();
 predictionCtx.beginPath();
 predictionCtx.rect(0, 0, widthGT, heightGT);
 predictionCtx.clip();

 // Trail Satelit Untuk Prediksi
 predictionCtx.strokeStyle = '#FF6B6B';
 predictionCtx.lineWidth = 3;
 predictionCtx.lineCap = 'round';
 predictionCtx.lineJoin = 'round';

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

 // Posisi Akhir
 if (predictionTrail.length > 0) {
     const endPosition = predictionTrail[predictionTrail.length - 1];
     const endPixel = convertCoordsToPixel(endPosition.coords);
     
     if (endPixel) {
         predictionCtx.save();
         
         // End marker
         predictionCtx.strokeStyle = '#FFFFFF';
         predictionCtx.fillStyle = '#FF6B6B';
         predictionCtx.lineWidth = 3;
         predictionCtx.beginPath();
         predictionCtx.arc(endPixel[0], endPixel[1], 8, 0, Math.PI * 2);
         predictionCtx.fill();
         predictionCtx.stroke();
         
         predictionCtx.strokeStyle = '#FFFFFF';
         predictionCtx.lineWidth = 2;
         predictionCtx.lineCap = 'round';
         
         predictionCtx.beginPath();
         predictionCtx.moveTo(endPixel[0] - 4, endPixel[1] - 4);
         predictionCtx.lineTo(endPixel[0] + 4, endPixel[1] + 4);
         predictionCtx.stroke();
         
         predictionCtx.beginPath();
         predictionCtx.moveTo(endPixel[0] + 4, endPixel[1] - 4);
         predictionCtx.lineTo(endPixel[0] - 4, endPixel[1] + 4);
         predictionCtx.stroke();
         
         predictionCtx.restore();
         
         // Label Waktu
         predictionCtx.save();
         predictionCtx.fillStyle = '#FFFFFF';
         predictionCtx.strokeStyle = '#000000';
         predictionCtx.lineWidth = 1;
         predictionCtx.font = '12px monospace';
         predictionCtx.textAlign = 'center';
         predictionCtx.textBaseline = 'top';
         
         const endTime = endPosition.time.toLocaleString('id-ID', {
             timeZone: userTimezone,
             month: '2-digit',
             year: '2-digit',
             day: '2-digit',
             hour: '2-digit',
             minute: '2-digit',
             hour12: false
         });
         
         const labelText = `END: ${endTime}`;
         const textY = endPixel[1] + 15;
         const textMetrics = predictionCtx.measureText(labelText);
         const textWidth = textMetrics.width;
         const textHeight = 16;
         
         predictionCtx.fillStyle = 'rgba(0, 0, 0, 0.7)';
         predictionCtx.fillRect(
             endPixel[0] - textWidth/2 - 4, 
             textY - 2, 
             textWidth + 8, 
             textHeight + 4
         );
         
         predictionCtx.fillStyle = '#FFFFFF';
         predictionCtx.fillText(labelText, endPixel[0], textY);
         predictionCtx.restore();
     }
 }

 predictionCtx.restore();
}

// Helper function to format duration text
function formatDurationText(hours) {
if (hours < 24) {
return `${hours}h`;
} else if (hours < 168) {
return `${Math.floor(hours/24)}d`;
} else if (hours < 720) {
return `${Math.floor(hours/168)}w`;
} else if (hours < 8760) {
return `${Math.floor(hours/720)}m`;
} else {
return `${Math.floor(hours/8760)}y`;
}
}

showPredictionBtn.addEventListener('click', () => {
const selectedDuration = parseInt(trailDurationSelect.value);
generatePredictionTrailWithTerminator(selectedDuration);
showingPrediction = true;
hideOriginalTerminator = true; //Sembunyikan terminator asli
updateOrbitInfo();

const durationText = formatDurationText(selectedDuration);
showPredictionBtn.textContent = `Showing ${durationText} + Terminator`;
showPredictionBtn.style.background = '#FF6B6B';
});

clearPredictionBtn.addEventListener('click', () => {
predictionTrail = [];
showingPrediction = false;
showingTerminatorPrediction = false;
hideOriginalTerminator = false; // Tampilkan kembali terminator asli
updateOrbitInfo();

showPredictionBtn.textContent = 'Show Prediction';
showPredictionBtn.style.background = '#4CAF50';
});

// Membuat Orbit Dengan Inklinasi
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


// SATELIT GEO POSITION CALCULATION //
let lastEarthRotation = 0;

// Fungsi untuk memperbarui posisi satelit GEO berdasarkan rotasi Bumi 
function updateGEOSatellitePosition() {
if (orbitType !== "GEO") return;

const radius = earthRadius + altitude;
const currentEarthRotation = bumi.rotation.y;
const geoLongitudeRad = THREE.MathUtils.degToRad(geoLongitude);
const totalRotation = geoLongitudeRad + currentEarthRotation;

// Posisikan satelit pada garis bujur tertentu 
const x = radius * Math.cos(totalRotation);
const z = -radius * Math.sin(totalRotation);
const y = 0; // Equatorial orbit (Khatulistiwa)

// Mengatur posisi satelit (sekarang berputar bersama Bumi)
satellite.position.set(x, y, z);

// Update rotasi terakhir tracker
lastEarthRotation = currentEarthRotation;
console.log(`GEO satellite positioned at Earth-relative longitude ${geoLongitude}° (rotation: ${THREE.MathUtils.radToDeg(currentEarthRotation).toFixed(2)}°)`);
}


function shouldUpdateGEOPosition() {
if (orbitType !== "GEO") return false;
const currentEarthRotation = bumi.rotation.y;
const rotationDiff = Math.abs(currentEarthRotation - lastEarthRotation);

//Hanya perbarui jika Bumi telah berotasi secara signifikan (lebih dari 0,001 radian ≈ 0,057 derajat)
return rotationDiff > 0.001;
}

// KALKULASI UNTUK TERMINATOR //

function isPointInDaylight(longitude, latitude, sunLongitude, sunDeclination) {
const latRad = THREE.MathUtils.degToRad(latitude);
const sunDecRad = THREE.MathUtils.degToRad(sunDeclination);
let hourAngle = longitude - sunLongitude;

while (hourAngle > 180) hourAngle -= 360;
while (hourAngle < -180) hourAngle += 360;

const hourAngleRad = THREE.MathUtils.degToRad(hourAngle);
const sinElevation = Math.sin(latRad) * Math.sin(sunDecRad) +
Math.cos(latRad) * Math.cos(sunDecRad) * Math.cos(hourAngleRad);

return sinElevation > 0;
}

// Enhanced night overlay with smooth gradients and twilight zones 
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

const step = 8; //Kehalusan Teminator

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
       const alpha = 0.4 + (darkness * 0.4);
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

// Update lebih jarang untuk performa
const shouldUpdate = !nightOverlayCanvas ||!lastSunLon ||
Math.abs(lastSunLon - sunLongitude) > 0.5 ||
Math.abs(lastSunDec - sunDeclination) > 0.2 ||
frameCounter % 120 === 0; // Update setiap 2 detik 

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


// FOOTPRINT UNTUK GROUNDTRACK //
function drawFootprintOnGroundTrack(ctx, satelliteLon, satelliteLat, altitude) {
if (!leafletMap) return;

const earthRadius = 6378.14;

let satelliteAltitude;
if (orbitType === "GEO") {

satelliteAltitude = altitude;
} else if (apogee === perigee) {
satelliteAltitude = apogee; 
console.log(`Circular orbit detected - Using static altitude: ${satelliteAltitude} km (ignoring dynamic parameter: ${altitude.toFixed(2)} km)`);
} else {
satelliteAltitude = altitude;
console.log(`Elliptical orbit - Using dynamic altitude: ${satelliteAltitude.toFixed(2)} km`);
}

const beamAngleRad = THREE.MathUtils.degToRad(beamwidth / 2);
const footprintRadiusKm = (satelliteAltitude + earthRadius) * Math.tan(beamAngleRad);

// Convert ke leaflet koordinat
const centerPixel = convertCoordsToPixel([satelliteLon, satelliteLat]);
if (!centerPixel) return;

// Hitung radius dalam piksel 
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

// OPTIMIZED SMOOTH TRAIL RENDERING //
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

// Gambar segments menggunakan koordinat Leaflet
segments.forEach(segment => {
if (segment.length < 2) return;

trailCtx.beginPath();
let pathStarted = false;

for (let i = 0; i < segment.length; i += Math.max(1, step)) {
  const point = segment[i];
  const pixel = convertCoordsToPixel(point.coords); 
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


// DETEKSI PENYELESAIAN ORBIT //
function detectOrbitCompletion(currentTrueAnomaly) {
const normalizedCurrent = ((currentTrueAnomaly % (2 * Math.PI)) + (2 * Math.PI)) % (2 * Math.PI);
const normalizedPrevious = ((previousTrueAnomaly % (2 * Math.PI)) + (2 * Math.PI)) % (2 * Math.PI);

if (hasCompletedFirstOrbit && normalizedPrevious > 5.5 && normalizedCurrent < 0.8) {
orbitCount++;
updateOrbitInfo();
}
if (!hasCompletedFirstOrbit && Math.abs(normalizedCurrent - normalizedPrevious) > 0.1
) {
hasCompletedFirstOrbit = true;
}

previousTrueAnomaly = currentTrueAnomaly;
}

// ENHANCED TIME SIMULATION //


function getSeasonInfo(date) {
const year = date.getFullYear()

// solstices dan equinoxes
const springEquinox = new Date(year, 2, 20); // Maret 20
const summerSolstice = new Date(year, 5, 21); // Juni 21
const autumnEquinox = new Date(year, 8, 23); // September 23
const winterSolstice = new Date(year, 11, 21); // Desember 21

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


// FUNGSI ANIMATE //

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

if (speedFactor > 0) {
let deltaMillis = deltaTime * 1000 * speedFactor;
simulatedTime = new Date(simulatedTime.getTime() + deltaMillis);
synchronizeEarthRotationWithSun();
}

awanku.rotation.y += 0.00005 * speedFactor * deltaTime;
bintang.rotation.y -= 2 * 10e-6;


// KALKULASI TERMINATOR //

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

// Hitung posisi ground track dengan rotasi Bumi 
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
displayLat = 0; 
} else {
displayLon = lonNormalized;
displayLat = lat;

detectCanvasCrossing(lonNormalized, lat);
}

// Update footprint pada Bumi 3D dengan altitude 
let currentAltitude;
if (orbitType === "GEO") {
currentAltitude = altitude;
} else {
const worldPos = new THREE.Vector3();
satellite.getWorldPosition(worldPos);
currentAltitude = worldPos.length() - earthRadius;
}
updateDualCloudFootprint(displayLon, displayLat, currentAltitude);

if (orbitType !== "GEO" || frameCounter % 60 === 0) {
groundTrack.push({
  coords: [displayLon, displayLat],
  time: new Date(simulatedTime.getTime())
});
}

// SISTEM TRAIL //
let maxGroundTrackPoints;

// Titik Trail untuk di groundtrack
if (orbitType === "GEO") { 
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

if (mapContainer.style.display === 'block') {
ctxGT.clearRect(0, 0, widthGT, heightGT);
if (!hideOriginalTerminator) {
  drawEnhancedNightOverlay(ctxGT, currentSunLongitude, currentSunDeclination, widthGT, heightGT);
}

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


if (trailCanvas) {
  ctxGT.drawImage(trailCanvas, 0, 0);
}

// Gambar jejak prediksi Saat ditampilkan
if (showingPrediction) {
  updatePredictionCanvasWithTerminator(); 
  if (predictionCanvas) {
      ctxGT.drawImage(predictionCanvas, 0, 0);
  }
}

// Gambar footprint di ground track
drawFootprintOnGroundTrack(ctxGT, displayLon, displayLat, currentAltitude);

// Gambar posisi satelit 
const currentSatellitePixel = convertCoordsToPixel([displayLon, displayLat]);
if (currentSatellitePixel) {
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

// Display musim
const satelliteInDaylight = isPointInDaylight(displayLon, displayLat, currentSunLongitude, currentSunDeclination);
const season = getSeasonInfo(simulatedTime);
const timeStatus = satelliteInDaylight ? " ☀️ DAY" : " 🌙 NIGHT";

if (window.updateDateDisplayMobile && window.innerWidth <= 480) {
window.updateDateDisplayMobile();
} else {
const formattedSimTime = simulatedTime.toLocaleString('id-ID', {
    timeZone: userTimezone,
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false
});

//Display Info Musim
dateDisplay.innerHTML = `
  <div style="font-weight: bold; margin-bottom: 8px; color: #ffff00; font-size: 16px;"> Waktu Simulasi: ${formattedSimTime}</div>
  <div style="color: #88ff88; font-size: 12px;">Musim: ${season}</div>
`;
}

// Display Posisi satelit
satelliteDisplay.innerHTML = `
<div style="font-weight: bold; margin-bottom: 3px; color:rgb(255, 255, 255);">
<div>Posisi Satelit: ${displayLon.toFixed(4)}°, ${displayLat.toFixed(4)}°${timeStatus}</div>
`;

if (window.updateCurrentTimeDisplayMobile && window.innerWidth <= 1024) {
window.updateCurrentTimeDisplayMobile();
}

controls.update();
renderer.render(scene, camera);
}

// Kontrol Bulan
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

// Kontrol Hari
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

// Kontrol Jam
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

resetTimeBtn.addEventListener("click", resetTimeToCurrentWithSync);

synchronizeEarthRotationWithSun();

if (orbitType === "GEO") {
updateGEOSatellitePosition();
}


// RESIZE UNTUK UI YANG RESPONSIF //

function handleWindowResizeEnhanced() {
camera.aspect = window.innerWidth / window.innerHeight;
camera.updateProjectionMatrix();
renderer.setSize(window.innerWidth, window.innerHeight);

updateResponsiveUI();
preventAutoFocus();

clearTimeout(window.resizeTimeout);
window.resizeTimeout = setTimeout(() => {
 updateCanvasSize();
 preventAutoFocus();
}, 150);
}


updateResponsiveUI();

window.addEventListener('resize', handleWindowResizeEnhanced, false);


// PENANGAN PERUBAHAN ORIENTASI UNTUK MOBILE //
window.addEventListener('orientationchange', () => {
setTimeout(() => {
 updateResponsiveUI();
 updateCanvasSize();
}, 500); // Delay untuk memastikan orientasi sudah berubah
}, false);

// strict viewport meta untuk mencegah auto-zoom
function StrictViewportMeta() {
let viewportMeta = document.querySelector('meta[name="viewport"]');

if (!viewportMeta) {
viewportMeta = document.createElement('meta');
viewportMeta.name = 'viewport';
document.head.appendChild(viewportMeta);
}
viewportMeta.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover';
}

StrictViewportMeta();
animate();

});