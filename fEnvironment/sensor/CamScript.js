const cameraSelect = document.getElementById('cameraSelect');
const cameraContainer = document.getElementById('cameraContainer'); // 獲取新的容器

// 初始，加載鏡頭1畫面
loadCameraStream('http://cowmis.ddns.net:8000/stream.mjpg'); //ip位置

cameraSelect.addEventListener('change', function() {
    const selectedCamera = cameraSelect.value;
    if (selectedCamera === 'camera1') {
        loadCameraStream('http://cowmis.ddns.net:8000/stream.mjpg'); //ip位置
    } else if (selectedCamera === 'camera2') {
        loadCameraStream('http://cowmis.ddns.net:8001/stream.mjpg'); //ip位置
    }
});

function loadCameraStream(src) {
    // 創建新的img元素
    const cameraImage = document.createElement('img');
    cameraImage.src = src;
    cameraImage.style.width = '100%';
    cameraImage.style.height = '100%';
    cameraImage.style.objectFit = 'contain';

    // 移除舊內容，更換新內容
    while (cameraContainer.firstChild) {
        cameraContainer.removeChild(cameraContainer.firstChild);
    }
    cameraContainer.appendChild(cameraImage);
}