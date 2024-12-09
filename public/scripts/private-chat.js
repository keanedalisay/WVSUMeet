const ws = new WebSocket("ws://localhost:8080");

ws.onopen = (e) => {
  console.log("Private chat connection open!");
};

ws.onerror = (e) => {
  console.error("WebSocket error:", e);
};

const chatbox = document.querySelector("[data-js=chatbox]");
const chatbar = document.querySelector("[data-js=chatbar]");

chatbox.scrollTo(0, chatbox.scrollHeight);

const messages = [];
let senderUser = document.querySelector("input[name=receiver_id]").getAttribute("value");
let receiverUser = document.querySelector("input[name=user_wvsuid]").getAttribute("value");

chatbar.addEventListener("submit", async (e) => {
  e.preventDefault();

  const message = new FormData(e.target);
  console.log({
    chat_type: message.get('chat_type'),
    sender_id: message.get("user_wvsuid"),
    receiver_id: message.get("receiver_id"),
    msg: message.get("user_msg")
  })
  const jsonMessage = JSON.parse(`{ 
    "chat_type": "${message.get('chat_type')}",
    "sender_name": "${message.get('user_name')}",
    "sender_id": "${message.get("user_wvsuid")}",
    "receiver_id": "${message.get("receiver_id")}",
    "msg": "${message.get("user_msg")}"
  }`);
  receiverUser = message.get("user_wvsuid");

  const image = message.get("user_files");
  
  if (image.name.length > 0 && image.constructor === File) {
    const image = message.get("user_files");
    console.log("test");
    const imageUrl = URL.createObjectURL(image);

    async function getBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
      });
    }

    jsonMessage.img = await getBase64(image);
    jsonMessage.imgName = image.name;

    chatbox.insertAdjacentHTML(
      'beforeend',
      `<li class='msg msg--user'>
        <cite class='msg-athr'>${ 
          messages.length < 1 || messages[messages.length - 1].sender_id !== message.get("user_wvsuid") ? "You" : ""
            }</cite>
        <blockquote class='msg-ctnt'>
        <a href='${imageUrl}'><img src='${imageUrl}' alt='${image.name}'></a>
        </blockquote>
    </li>`
    );
  } else {
    chatbox.insertAdjacentHTML(
      "beforeend",
      `<li class='msg msg--user'>
        <cite class='msg-athr'>${messages.length < 1 || messages[messages.length - 1].sender_id !== message.get("user_wvsuid") ? "You" : ""}</cite>
        <blockquote class='msg-ctnt'>${message.get("user_msg")}</blockquote>
      </li>`
    );
  }

  messages.push(jsonMessage);

  chatbox.scrollTo(0, chatbox.scrollHeight);
  chatbar.reset();

  ws.send(JSON.stringify(jsonMessage));
});

const wrapMessages = document.querySelector("[data-js=wrap-msgs]");
const divUploadedFiles = document.querySelector("[data-js=div-uploaded-files]");
const inputUserFiles = document.querySelector("[data-js=input-user-files]");

let uploadedFiles = [];

inputUserFiles.addEventListener("input", (e) => {
  const userFiles = e.target.files;

  divUploadedFiles.insertAdjacentHTML("beforeend", `
    <figure class="uploaded-file" data-uploaded-file="${uploadedFiles.length}">
      <button class="uploaded-file__rmv-btn" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/></svg></button>
      <img class="uploaded-file__img" src="${URL.createObjectURL(userFiles[0])}">
    </figure>
  `);

  uploadedFiles.push(userFiles[0]);
  
  divUploadedFiles.classList.remove("chatbar__uploaded-files--hide");
  wrapMessages.style.height = "65%";
  chatbar.style.height = "25%"; 
});

divUploadedFiles.addEventListener("click", (e) => {
  console.log(e.target);
  if (e.target.classList.contains("uploaded-file__rmv-btn")) {
    const index = e.target.parentElement.dataset.uploadedFile;
    uploadedFiles = uploadedFiles.splice(index + 1, 1);
    e.target.parentElement.remove();

    divUploadedFiles.classList.add("chatbar__uploaded-files--hide");
    wrapMessages.style.height = "75%";
    chatbar.style.height = "15%"; 
  }
});

ws.onmessage = async (e) => {
  async function dataUrlToFile(dataUrl, fileName) {
    const res = await fetch(dataUrl);
    const blob = await res.blob();
    return new File([blob], fileName, { type: dataUrl.match(/^data:(.+);base64/)?.[1] });
  }

  const jsonMessage = JSON.parse(e.data);
  console.log('Received private message:', jsonMessage);

  if (jsonMessage.receiver_id === receiverUser && jsonMessage.sender_id == senderUser) {
    if (jsonMessage.img) {
      const img = await dataUrlToFile(jsonMessage.img, jsonMessage.imgName);
      chatbox.insertAdjacentHTML(
        'beforeend',
        `<li class='msg msg--others'>
              <cite class='msg-athr'>${
                messages.length < 1 || messages[messages.length - 1].sender_id !== jsonMessage.sender_id ? jsonMessage.sender_name : ""
              }</cite>
              <blockquote class='msg-ctnt'>
              <a href='${URL.createObjectURL(img)}'><img src='${URL.createObjectURL(img)}' alt='${jsonMessage.imgName}'></a>
              </blockquote>
          </li>`
      );
    } else {
      chatbox.insertAdjacentHTML(
        "beforeend",
        `<li class='msg msg--others'>
          <cite class='msg-athr'>${messages.length < 1 || messages[messages.length - 1].sender_id !== jsonMessage.sender_id ? jsonMessage.sender_name : ""}</cite>
          <blockquote class='msg-ctnt'>${jsonMessage.msg}</blockquote>
        </li>`
      );
    }
    

    messages.push(jsonMessage);
    chatbox.scrollTo(0, chatbox.scrollHeight);
  }
};
