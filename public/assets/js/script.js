// Script untuk mengganti tema
document.querySelector(".theme-toggle").addEventListener("click", () => {
  toggleLocalStorage();
  toggleRootClass();
  // Mencari vektor S untuk merubah gambar
  if (document.getElementById("vektorS")) {
    toggleImageSource();
  }
});

function toggleRootClass() {
  const current = document.documentElement.getAttribute("data-bs-theme");
  const inverted = current == "dark" ? "light" : "dark";
  document.documentElement.setAttribute("data-bs-theme", inverted);
}

function toggleLocalStorage() {
  if (isLight()) {
    localStorage.removeItem("light");
  } else {
    localStorage.setItem("light", "set");
  }
}

function isLight() {
  return localStorage.getItem("light");
}

if (isLight()) {
  toggleRootClass();
}

// Script untuk memunculkan dan menyembunyikan sidebar
const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("collapsed");
});

// Script untuk mencetak layar dengan tombol yang berisi printContent
function printContent(el) {
  var restorepage = document.body.innerHTML;
  var printcontent = document.getElementById(el).innerHTML;
  document.body.innerHTML = printcontent;
  window.print();
  document.body.innerHTML = restorepage;
}

// Script untuk menampilkan tanggal
document.addEventListener("DOMContentLoaded", (event) => {
  const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
  const dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

  const date = new Date();
  const day = dayNames[date.getDay()];
  const dateNumber = date.getDate();
  const month = monthNames[date.getMonth()];
  const year = date.getFullYear();

  const formattedDate = `${day}, ${dateNumber}-${month}-${year}`;

  document.getElementById("tanggal").innerText = `Jakarta, ${formattedDate}`;
});
