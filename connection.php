<?php
//error_reporting(0);

@$connection = mysqli_connect('localhost', 'root', '', 'trip');

if($connection){
	echo "<h2> Up and online </h2> <div class='circle__Status-sucess blink_me'></div> ";
}
else{
	echo "<h2> Start your XAMPP server</h2> <div class='circle__Status-error blink_me'></div>";
}

?>

<style>
	.blink_me {
		animation: blinker 2s linear infinite;
	}

	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}

	.circle__status-sucess {
		height: 50px;
		width: 50px;
		border-radius: 55px;
		background-color: green;
		display: inline-block;
	}

	.circle__status-error {
		height: 50px;
		width: 50px;
		border-radius: 55px;
		background-color: red;
		display: inline-block;
	}

	h2 {
		display: inline-block;
	}
</style>