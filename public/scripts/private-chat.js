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

chatbar.addEventListener("submit", (e) => {
  e.preventDefault();

  const message = new FormData(e.target);
  console.log({
    chat_type: message.get('chat_type'),
    sender_id: message.get("user_wvsuid"),
    receiver_id: message.get("receiver_id"),
    msg: message.get("user_msg")
  })
  const jsonMessage = `{ 
    "chat_type": "${message.get('chat_type')}",
    "sender_id": "${message.get("user_wvsuid")}",
    "receiver_id": "${message.get("receiver_id")}",
    "msg": "${message.get("user_msg")}"
  }`;
  console.log(jsonMessage)

  chatbox.insertAdjacentHTML(
    "beforeend",
    `<li class='msg msg--user'>
      <cite class='msg-athr'>${messages.length < 1 || messages[messages.length - 1].sender_id !== message.get("user_wvsuid") ? "You" : ""}</cite>
      <blockquote class='msg-ctnt'>${message.get("user_msg")}</blockquote>
    </li>`
  );

  messages.push(JSON.parse(jsonMessage));

  chatbox.scrollTo(0, chatbox.scrollHeight);
  chatbar.reset();


  ws.send(jsonMessage);
});

ws.onmessage = (e) => {
  const jsonMessage = JSON.parse(e.data);
  console.log('Received private message:', jsonMessage);

  if (
    jsonMessage.sender_id === document.querySelector("[name='user_wvsuid']").value ||
    jsonMessage.receiver_id === document.querySelector("[name='receiver_id']").value
  ) {
    chatbox.insertAdjacentHTML(
      "beforeend",
      `<li class='msg msg--others'>
        <cite class='msg-athr'>${messages.length < 1 || messages[messages.length - 1].sender_id !== jsonMessage.sender_id ? jsonMessage.sender_name : ""}</cite>
        <blockquote class='msg-ctnt'>${jsonMessage.msg}</blockquote>
      </li>`
    );

    messages.push(jsonMessage);
    chatbox.scrollTo(0, chatbox.scrollHeight);
  }
};
