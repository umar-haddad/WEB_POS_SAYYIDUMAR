document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const toggleBtn = document.getElementById("sidebarToggle");

  toggleBtn.addEventListener("click", function () {
    sidebar.classList.toggle("active");
  });
});
