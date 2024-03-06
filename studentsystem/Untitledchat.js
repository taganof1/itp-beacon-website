NRF.nfcURL('http://192.168.1.154/studentsystem/details.php');

// Function to format time data
function formatTime() {
  var currentTime = new Date();
  var hours = currentTime.getHours();
  var minutes = currentTime.getMinutes();
  var seconds = currentTime.getSeconds();
  return padNumber(hours) + ':' + padNumber(minutes) + ':' + padNumber(seconds);
}

// Function to pad numbers with leading zeros
function padNumber(number) {
  return (number < 10 ? '0' : '') + number;
}

// Update BLE advertisement with time data
function updateAdvertisement() {
  NRF.setAdvertising({
    0x1803: [formatTime()], // Service UUID for Current Time Service
  });
}

// Initial advertisement setup
updateAdvertisement();

// Handle NRF event
NRF.on('NFCon', function() {
  updateAdvertisement(); // Update advertisement when NRF event is triggered
});

// Regularly update advertisement every second
setInterval(updateAdvertisement, 1000);


