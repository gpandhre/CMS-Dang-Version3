const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");
const main = document.getElementById("main");
const loginSignup = document.getElementById("login-signup");
const loginBtn = document.getElementById("login");
const signupBtn = document.getElementById("signup");
const userAdmin = document.getElementById("user-admin");

signupBtn.addEventListener("mouseover", () => {
  loginBtn.classList.toggle("log-disabled");
  signupBtn.classList.toggle("sign-enabled");
});

loginBtn.addEventListener("mouseover", () => {
  loginBtn.classList.remove("log-disabled");
  signupBtn.classList.remove("sign-enabled");
});

loginBtn.addEventListener("click",()=>{
  userAdmin.classList.toggle("login-clicked");
})


function toggleSidebar() {
  sidebar.classList.toggle("close");
  toggleButton.classList.toggle("rotate");
  main.classList.toggle("full");
  loginSignup.classList.toggle("ls-full");
  closeAllSubMenus();
}

function toggleSubMenu(button) {
  if (!button.nextElementSibling.classList.contains("show")) {
    closeAllSubMenus();
  }

  button.nextElementSibling.classList.toggle("show");
  button.classList.toggle("rotate");

  if (sidebar.classList.contains("close")) {
    sidebar.classList.toggle("close");
    toggleButton.classList.toggle("rotate");
  }
}

function closeAllSubMenus() {
  Array.from(sidebar.getElementsByClassName("show")).forEach((ul) => {
    ul.classList.remove("show");
    ul.previousElementSibling.classList.remove("rotate");
  });
}
