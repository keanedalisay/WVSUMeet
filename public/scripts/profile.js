const inputUserProfile = document.querySelector("[data-js=input-user-profile]");
const formUserProfile = document.querySelector("[data-js=form-user-profile]");
const buttonSaveUserProfile = document.querySelector("[data-js=button-user-profile-save]");
const buttonCancelUserProfile = document.querySelector("[data-js=button-user-profile-cancel]");

const profileImg = document.querySelector("[data-js=user-profile]");
let userProfile = profileImg.getAttribute("src") || "";

inputUserProfile.addEventListener("input", () => {
  buttonSaveUserProfile.parentElement.classList.remove("form__controls--hide");

  const form = new FormData(formUserProfile);
  const file = form.get("user_profile_img");

  const profileNoImg = document.querySelector("[data-js=user-default-profile]");

  profileImg.setAttribute("src", URL.createObjectURL(file));
  profileImg.setAttribute("alt", file.name);

  profileNoImg.classList.add("user-profile--hide");
  profileImg.classList.remove("user-profile--hide");
});

buttonCancelUserProfile.addEventListener("click", (e) => {
  buttonSaveUserProfile.parentElement.classList.add("form__controls--hide");
  const profileNoImg = document.querySelector("[data-js=user-default-profile]");
  
  if (!profileImg.classList.contains("user-profile--hide")) {
    profileNoImg.classList.remove("user-profile--hide");
    profileImg.classList.add("user-profile--hide");
  }
  else profileImg.setAttribute("src", userProfile);

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