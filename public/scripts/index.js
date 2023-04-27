(() => {
  const ptrts = [
    "imgs/index/ptrt_4.jpg",
    "imgs/index/ptrt_5.jpg",
    "imgs/index/ptrt_6.jpg",
    "imgs/index/ptrt_9.jpg",
    "imgs/index/ptrt_12.jpg",
    "imgs/index/ptrt_16.jpg",
  ];

  const ptrt_dim = [
    {
      w: "clamp(10rem, 30vw, 18rem)",
      h: "clamp(8rem, 30vw, 16rem)",
    },
    {
      w: "clamp(11rem, 30vw, 18rem)",
      h: "clamp(13rem, 30vw, 20rem)",
    },
    {
      w: "clamp(13rem, 30vw, 23rem)",
      h: "clamp(15rem, 30vw, 25rem)",
    },
  ];

  const ptrt_sctn = document.querySelector("[data-slctr=ptrts]");
  const body = document.body.getBoundingClientRect();

  const showPtrts = () => {
    ptrt_sctn.innerHTML = "";

    for (let i = 0; i < ptrts.length; i += 1) {
      const ptrt = new Image();
      ptrt.src = ptrts[i];
      ptrt.loading = "lazy";
      ptrt.classList.add("ptrts-ptrt");

      const dim_i = Math.round(Math.random() * (ptrt_dim.length - 1));

      ptrt.style.cssText = ` width: ${ptrt_dim[dim_i].w}; 
      height: ${ptrt_dim[dim_i].h}; 
      top: ${Math.random() * (body.height / 1.5)}px; 
      left: ${Math.random() * (body.width / 1.5)}px;`;

      ptrt_sctn.appendChild(ptrt);
    }
  };

  showPtrts();
  setInterval(showPtrts, 15000);
})();
