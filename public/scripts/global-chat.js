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

chatbar.addEventListener('submit', (e) => {
  e.preventDefault();

  const message = new FormData(e.target);

  const lastMsg = document.querySelector(".msg:last-of-type");

  const jsonMessage = `{ 
    "name": "${message.get('user_name')}",
    "wvsuid":  "${message.get('user_wvsuid')}",
    "chat_type": "${message.get('chat_type')}",
    "msg": "${message.get('user_msg')}"
  }`;

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

  messages.push(JSON.parse(jsonMessage));

  chatbox.scrollTo(0, chatbox.scrollHeight);
  chatbar.reset();
  
  ws.send(jsonMessage);
});

ws.onmessage = (e) => {
  const jsonMessage = JSON.parse(e.data);

  const lastMsg = document.querySelector('.msg:last-of-type');

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

  messages.push(jsonMessage);

  chatbox.scrollTo(0, chatbox.scrollHeight);
};
