<?php
session_start();
session_unset();
session_destroy();
?>
<script>
alert('User Logged out successfully');
window.location.href='../login.php';
</script>