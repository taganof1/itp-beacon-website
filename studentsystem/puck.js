NRF.nfcURL('http://10.167.113.4/studentsystem/puck_data.php');
NRF.on('NFCon', function(data) {
    var currentTime = new Date();
    var day = currentTime.getDate();
    var month = currentTime.getMonth() + 1;
    var year = currentTime.getFullYear();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var formattedDate = padNumber(day) + '/' + padNumber(month) + '/' + year;
    var formattedTime = padNumber(hours) + ':' + padNumber(minutes);
    var dataToSend = formattedDate + " " + formattedTime; // Combine date and time
    var encodedData = encodeURIComponent(dataToSend); // Encode the data

    // Construct the URL with the encoded data
    var urlToSend = 'http://10.167.113.4/studentsystem/puck_data.php?data=' + encodedData;

    // Send the NFC URL with the data
    NRF.nfcURL(urlToSend);

    console.log("Sent data to server:", dataToSend);
    console.log("Student checked-in at: " + formattedDate + " " + formattedTime);
});

function padNumber(number) {
    return (number < 10 ? '0' : '') + number;
}
