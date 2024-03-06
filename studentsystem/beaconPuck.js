NRF.nfcURL('http://192.168.1.154/studentsystem/puck_data.php');
// Set Puck.js as a beacon emitting data periodically
setInterval(function() {
    var currentTime = new Date();
    var day = currentTime.getDate();
    var month = currentTime.getMonth() + 1; // Month is zero-based, so we add 1
    var year = currentTime.getFullYear();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    // Pad single digit values with leading zero if needed
    var formattedDate = padNumber(day) + '/' + padNumber(month) + '/' + year;
    var formattedTime = padNumber(hours) + ':' + padNumber(minutes);
    var dataToSend = formattedDate + " " + formattedTime;

    NRF.setAdvertising({}, { interval: 1000, name: dataToSend });
}, 2000); // Change the interval as needed (milliseconds)

function padNumber(number) {
    return (number < 10 ? '0' : '') + number;
}




