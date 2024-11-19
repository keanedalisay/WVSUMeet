const SignUp = () => {
  const form_signup = document.querySelector("[data-slctr=signup-form]");
  const input_signup_pswrd = document.querySelector(
    "[data-slctr=input-signup-pswrd]"
  );
  const input_cnfrm_pswrd = document.querySelector(
    "[data-slctr=input-cnfrm-pswrd]"
  );

  const isValidPswrd = () =>
    input_signup_pswrd.value === input_cnfrm_pswrd.value;

  const process = (e) => {
    e.preventDefault();

    if (isValidPswrd()) {
      form_signup.submit();
      return;
    }

    const err_lbl_pswrd = document.querySelector("[data-slctr=err-lbl-pswrd]");
    err_lbl_pswrd.textContent = "Passwords do not match. Retype them.";
    err_lbl_pswrd.classList.remove("form-err_lbl--hidden");

    input_signup_pswrd.setAttribute("aria-invalid", "true");
    input_cnfrm_pswrd.setAttribute("aria-invalid", "true");
  };

  const init = () => {
    form_signup.addEventListener("submit", process);
  };

  return { init };
};

const sign_up = SignUp();
sign_up.init();
