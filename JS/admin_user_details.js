const hamburger = document.querySelector("#toggle-btn");
const sidebar = document.querySelector("#sidebar");
const profile = document.querySelector('nav .profile');
const imgProfile = profile.querySelector('img');
const dropdownProfile = profile.querySelector('.profile-link');

hamburger.addEventListener("click", function(){
    sidebar.classList.toggle("expand");
});

imgProfile.addEventListener('click', function () {
    dropdownProfile.classList.toggle('show');
});

window.addEventListener('click', function (e) {
    if(e.target !== imgProfile && !profile.contains(e.target)) {
        dropdownProfile.classList.remove('show');
    }
});

const sidebarLinks = document.querySelectorAll('#sidebar .sidebar-link');

sidebarLinks.forEach(link => {
    link.addEventListener('click', function() {
        sidebar.classList.add("locked");
    });
});

hamburger.addEventListener("click", function(){
    if (sidebar.classList.contains("locked")) {
        sidebar.classList.remove("locked");
    }
});
