(() => {
  const user_cnt_val = document.querySelector("[data-slctr=user_cnt_val]");
  const msg_cnt_val = document.querySelector("[data-slctr=msg_cnt_val]");

  const getUserCnt = () => {
    fetch("http://localhost/meet.wvsu/private/msg_system/ftch_user_cnt.php", {
      method: "GET",
      mode: "cors",
      headers: {
        "Content-Type": "text/html",
      },
    })
      .then((resp) => resp.text())
      .then((user_cnt) => {
        if (user_cnt) {
          user_cnt_val.textContent = user_cnt;
        }
        getUserCnt();
      })
      .catch((err) => {
        getUserCnt();
      });
  };

  const getGblMsgCnt = () => {
    fetch("http://localhost/meet.wvsu/private/msg_system/ftch_msg_cnt.php", {
      method: "GET",
      mode: "cors",
      headers: {
        "Content-Type": "text/html",
      },
    })
      .then((resp) => resp.text())
      .then((gbl_msg_cnt) => {
        if (gbl_msg_cnt) {
          msg_cnt_val.textContent = gbl_msg_cnt;
        }
        getGblMsgCnt();
      })
      .catch((err) => {
        getGblMsgCnt();
      });
  };

  getUserCnt();
  getGblMsgCnt();
})();

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
        if (gbl_msg_html) {
          msgbox.insertAdjacentHTML("beforeend", gbl_msg_html);
          msgbox.scrollTop += msgbox.scrollHeight;
        }
        newGblMsg();
      })
      .catch((err) => {
        newGblMsg();
      });
  };
  newGblMsg();
})();
