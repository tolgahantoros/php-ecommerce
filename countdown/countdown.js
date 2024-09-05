function updateTimer() {
  gelecek = document.getElementById("countdown_sure_sonu").innerHTML;   
  future = Date.parse(gelecek); 
  now = new Date();
  diff = future - now;

  days = Math.floor(diff / (1000 * 60 * 60 * 24));
  hours = Math.floor(diff / (1000 * 60 * 60));
  mins = Math.floor(diff / (1000 * 60));
  secs = Math.floor(diff / 1000);

  d = days;
  h = hours - days * 24;
  m = mins - hours * 60;
  s = secs - mins * 60;

  document.getElementById("timer").innerHTML =
  "<div>" +
  d +
  "<span>GÜN</span></div>" +
  "<div>" +
  h +
  "<span>SAAT</span></div>" +
  "<div>" +
  m +
  "<span>DAKİKA</span></div>" +
  "<div>" +
  s +
  "<span>SANİYE</span></div>";
}
setInterval("updateTimer()", 1000);
