<?php
require_once dirname(__DIR__, 1)."/vendor/autoload.php";
require_once __DIR__.'/router.php';

session_name("WVSUMeet");

get("/", "pages/index.php");
get("/sign-up", "pages/sign-up.php");
get("/log-in", "pages/log-in.php");
get("/chat", "pages/chat.php");

post("/sign-up", "pages/sign-up.php");
post("/log-in", "pages/log-in.php");