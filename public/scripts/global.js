const profileButton = document.querySelector("[data-js=profile-button]");
const profileDropdown = document.querySelector("[data-js=profile-dropdown]");

profileButton.addEventListener("click", (e) => {
  profileButton.classList.toggle("profile--open");
  profileDropdown.classList.toggle("dropdown--open");
})

const emojiBtn = document.querySelector("[data-js=emoji-button]");
const emojiModal = document.querySelector("[data-js=emoji-modal]");
const inputUserMsg = document.querySelector("[data-js=input-user-msg]");

emojiBtn.addEventListener("click", (e) => {
  emojiModal.classList.toggle("modal--open");
});

emojiModal.addEventListener("click", (e) => {
  if (e.target.type === "button") {
    inputUserMsg.value += e.target.textContent;
  }
});