const profileButton = document.querySelector("[data-js=profile-button]");
const profileDropdown = document.querySelector("[data-js=profile-dropdown]");

profileButton.addEventListener("click", (e) => {
  profileButton.classList.toggle("profile--open");
  profileDropdown.classList.toggle("dropdown--open");
})