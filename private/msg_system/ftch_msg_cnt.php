<?php
$conn = mysqli_connect('meet_wvsu_db', 'root', '123', 'meet.wvsu');
$gbl_msgs_cnt_sql = mysqli_query($conn, 'SELECT COUNT(WVSU_ID) FROM gbl_msgs');
$gbl_msgs_cnt = mysqli_fetch_row($gbl_msgs_cnt_sql)[0];

mysqli_free_result($gbl_msgs_cnt_sql);
mysqli_close($conn);

echo $gbl_msgs_cnt;
?>