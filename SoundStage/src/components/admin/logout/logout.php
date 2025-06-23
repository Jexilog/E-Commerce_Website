<?php
session_start();

// Destroy session
session_unset();
session_destroy();

// Redirect to login or homepage
header("Location: /System/SoundStage/src/pages/auth/sign-in.php");
exit;