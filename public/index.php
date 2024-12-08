<?php
require_once dirname(__DIR__, 1)."/vendor/autoload.php";
require_once __DIR__.'/router.php';

session_name("WVSUMeet");
if(session_status() !== PHP_SESSION_ACTIVE) session_start();

get("/", "pages/index.php");
get("/sign-up", "pages/sign-up.php");
get("/log-in", "pages/log-in.php");
get("/log-out", "pages/log-in.php");
get("/chat", "pages/chat.php");
get("/chat/profile", "pages/profile.php");

post("/sign-up", "pages/sign-up.php");
post("/log-in", "pages/log-in.php");

post("/api/chats/global", "pages/chat.php");
post("/api/chats/private", "pages/chat.php");
post("/api/user/profile/img", "pages/profile.php");
post("/api/user/profile/details", "pages/profile.php");