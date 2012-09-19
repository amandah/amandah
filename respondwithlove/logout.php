<?php
	setcookie ("userId", "", time() - 3600);
	setcookie ("token", "", time() - 3600);
	header("Location: .");
?>