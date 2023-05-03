(() => {
  const msgbox = document.querySelector("[data-slctr=msgbox]");
  msgbox.scrollTop += msgbox.scrollHeight;

  const newGblMsg = () => {
    fetch("http://localhost/meet.wvsu/private/msg_system/ftch_new_gbl.php", {
      method: "GET",
      mode: "cors",
      headers: {
        "Content-Type": "text/html",
      },
    })
      .then((resp) => resp.text())
      .then((gbl_msg_html) => {
        if (gbl_msg_html) msgbox.insertAdjacentHTML("beforeend", gbl_msg_html);
        msgbox.scrollTop += msgbox.scrollHeight;
        newGblMsg();
      })
      .catch((err) => {
        newGblMsg();
      });
  };
  newGblMsg();
})();
