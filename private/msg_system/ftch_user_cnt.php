<?php
$conn = mysqli_connect('localhost', 'root', '', 'meet.wvsu');
$user_cnt_sql = mysqli_query($conn, 'SELECT COUNT(WVSU_ID) FROM users');
$user_cnt = mysqli_fetch_row($user_cnt_sql)[0];

mysqli_free_result($user_cnt_sql);
mysqli_close($conn);

echo $user_cnt;
?>