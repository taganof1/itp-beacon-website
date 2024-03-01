NRF.nfcURL('http://192.168.1.154/studentsystem/details.php');

NRF.on('NFCon', function() {
  var currentTime = new Date();
  var day = currentTime.getDate();
  var month = currentTime.getMonth() + 1;
  var year = currentTime.getFullYear();
  var hours = currentTime.getHours();
  var minutes = currentTime.getMinutes();
  var formattedDate = padNumber(day) + '/' + padNumber(month) + '/' + year;
  var formattedTime = padNumber(hours) + ':' + padNumber(minutes);
  var loginTime = "Student checked-in at: " + formattedDate + " " + formattedTime;

  // Send the loginTime data to the details page
  NRF.request('http://192.168.1.154/studentsystem/details.php?loginTime=' + encodeURIComponent(loginTime));
});

function padNumber(number) {
  return (number < 10 ? '0' : '') + number;
}
