const ws = new WebSocket("ws://localhost:8080");

ws.onopen = (e) => {
  console.log("Connection open!");
}

ws.onerror = (e) => {
  console.log("error!");
}

const chatbox = document.querySelector("[data-js=chatbox]");
const chatbar = document.querySelector("[data-js=chatbar]");

chatbox.scrollTo(0, chatbox.scrollHeight);

const messages = [];

chatbar.addEventListener('submit', async (e) => {
  e.preventDefault();

  const message = new FormData(e.target);

  const lastMsg = document.querySelector(".msg:last-of-type");

  const jsonMessage = JSON.parse(`{ 
    "name": "${message.get('user_name')}",
    "wvsuid":  "${message.get('user_wvsuid')}",
    "chat_type": "${message.get('chat_type')}",
    "msg": "${message.get('user_msg')}"
  }`);

  const image = message.get("user_files");

  if (Object.keys(image).length === 0 && image.constructor === File) {
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
          messages.length < 1 && !lastMsg ? "You"
          : messages.length < 1 && lastMsg.classList.contains('msg--others') ? "You" 
          : messages.length < 1 && lastMsg.classList.contains('msg--user') ? "" 
          : messages[messages.length - 1].name === message.get("user_name") ? "" 
          : "You"
            }</cite>
        <blockquote class='msg-ctnt'>
        <a href='${imageUrl}'><img src='${imageUrl}' alt='${image.name}'></a>
        </blockquote>
    </li>`
    );
  } else {
    chatbox.insertAdjacentHTML(
      'beforeend',
      `<li class='msg msg--user'>
        <cite class='msg-athr'>${ 
          messages.length < 1 && !lastMsg ? "You"
          : messages.length < 1 && lastMsg.classList.contains('msg--others') ? "You" 
          : messages.length < 1 && lastMsg.classList.contains('msg--user') ? "" 
          : messages[messages.length - 1].name === message.get("user_name") ? "" 
          : "You"
            }</cite>
        <blockquote class='msg-ctnt'>
        ${message.get('user_msg')}
        </blockquote>
    </li>`
    );
  }

  messages.push(jsonMessage);

  chatbox.scrollTo(0, chatbox.scrollHeight);
  chatbar.reset();
  
  ws.send(JSON.stringify(jsonMessage));
});

ws.onmessage = async (e) => {

  async function dataUrlToFile(dataUrl, fileName) {
    const res = await fetch(dataUrl);
    const blob = await res.blob();
    return new File([blob], fileName, { type: dataUrl.match(/^data:(.+);base64/)?.[1] });
  }

  const jsonMessage = JSON.parse(e.data);

  const lastMsg = document.querySelector('.msg:last-of-type');

  if (jsonMessage.img) {
    const img = await dataUrlToFile(jsonMessage.img, jsonMessage.imgName);
    chatbox.insertAdjacentHTML(
      'beforeend',
      `<li class='msg msg--others'>
            <cite class='msg-athr'>${
              messages.length < 1 && !lastMsg ? jsonMessage.name
              : messages.length < 1 && lastMsg.classList.contains('msg--user') ? jsonMessage.name
              : messages.length < 1 && lastMsg.classList.contains('msg--others') ? ""
              : messages[messages.length - 1].name === jsonMessage.name ? "" 
              : jsonMessage.name
            }</cite>
            <blockquote class='msg-ctnt'>
            <a href='${URL.createObjectURL(img)}'><img src='${URL.createObjectURL(img)}' alt='${jsonMessage.imgName}'></a>
            </blockquote>
        </li>`
    );
  } else {
    chatbox.insertAdjacentHTML(
      'beforeend',
      `<li class='msg msg--others'>
            <cite class='msg-athr'>${
              messages.length < 1 && !lastMsg ? jsonMessage.name
              : messages.length < 1 && lastMsg.classList.contains('msg--user') ? jsonMessage.name
              : messages.length < 1 && lastMsg.classList.contains('msg--others') ? ""
              : messages[messages.length - 1].name === jsonMessage.name ? "" 
              : jsonMessage.name
            }</cite>
            <blockquote class='msg-ctnt'>
            ${jsonMessage.msg}
            </blockquote>
        </li>`
    );
  }

  messages.push(jsonMessage);

  chatbox.scrollTo(0, chatbox.scrollHeight);
};
