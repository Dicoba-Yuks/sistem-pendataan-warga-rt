// Dapatkan elemen-elemen yang dibutuhkan
const keyword = document.querySelector('#keyword'); 
const container = document.querySelector('#container-data'); 

// Event ketika tombol pada keyboard ditekan di input 'keyword'
keyword.addEventListener('keyup', function () {
  fetch('ajax_cari.php?keyword=' + keyword.value)
  .then((response) => response.text())
  .then((response) => (container.innerHTML = response));
});

document.addEventListener('DOMContentLoaded', function() {
  fetch('ajax_cari.php?keyword=')
  .then((response) => response.text())
  .then((response) => (container.innerHTML = response));
});