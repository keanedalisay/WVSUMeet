(() => {
  const msgbox = document.querySelector("[data-slctr=msgbox]");
  msgbox.scrollTop += msgbox.scrollHeight;
  // use long polling to fetch data from database
  // while loop
  // use fetch and async await
  // result of then will be used to continue while loop

  // change get to post
  // const newGblMsg = () => {
  //   fetch("http://localhost/meet.wvsu/scripts/php/ftch_new_gbl.php", {
  //     method: "GET",
  //     mode: "cors",
  //     headers: {
  //       "Content-Type": "text/html",
  //     },
  //   })
  //     .then((resp) => resp.text())
  //     .then((gbl_msg) => {
  //       console.log(gbl_msg);
  //       newGblMsg();
  //     })
  //     .catch((err) => {
  //       newGblMsg();
  //     });
  // };
  // newGblMsg();
})();
