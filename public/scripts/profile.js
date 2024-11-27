const inputUserProfile = document.querySelector("[data-js=input-user-profile]");
const formUserProfile = document.querySelector("[data-js=form-user-profile]");
const buttonSaveUserProfile = document.querySelector("[data-js=button-user-profile-save]");
const buttonCancelUserProfile = document.querySelector("[data-js=button-user-profile-cancel]");

inputUserProfile.addEventListener("input", (e) => {
  buttonSaveUserProfile.parentElement.classList.remove("form__controls--hide");
});

buttonCancelUserProfile.addEventListener("click", (e) => {
  buttonSaveUserProfile.parentElement.classList.add("form__controls--hide");
});

const inputUserName = document.querySelector("[data-js=input-user-name]");
const buttonSaveUserDetails = document.querySelector("[data-js=button-user-details-save]");
const buttonCancelUserDetails = document.querySelector("[data-js=button-user-details-cancel]");

inputUserName.addEventListener("input", (e) => {
  buttonSaveUserDetails.parentElement.classList.remove("form__controls--hide");
});

buttonCancelUserDetails.addEventListener("click", (e) => {
  buttonSaveUserDetails.parentElement.classList.add("form__controls--hide");
});

formUserProfile.addEventListener("submit", (e) => {
  e.preventDefault();
  buttonSaveUserProfile.parentElement.classList.add("form__controls--hide");
  const form = new FormData(e.target);
  const file = form.get("user_profile_img");

  const profileImg = document.querySelector("[data-js=user-profile]");
  const profileNoImg = document.querySelector("[data-js=user-default-profile]");

  profileImg.setAttribute("src", URL.createObjectURL(file));
  profileImg.setAttribute("alt", file.name);

  profileNoImg.classList.add("user-profile--hide");
  profileImg.classList.remove("user-profile--hide");
  e.target.submit();
});