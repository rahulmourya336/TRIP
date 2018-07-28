<?php
//error_reporting(0);

@$connection = mysqli_connect('localhost', 'root', '', 'trip');

if($connection){
    echo "<script>console.log('%c Connected! ', 'background: white; color: Green');</script>";
	//echo "<div class='circle__status-sucess blink_me'></div> ";
}
else{
	//echo "<h2> Offline </h2> <div class='circle__status-error blink_me'></div>";
    echo "<script>console.log('%c Connection Error! ', 'background: red; color: white');</script>";
}

?>

<!---->
<!--<style>-->
<!--	.blink_me {-->
<!--		animation: blinker 2s linear infinite;-->
<!--	}-->
<!---->
<!--	@keyframes blinker {-->
<!--		50% {-->
<!--			opacity: 0;-->
<!--		}-->
<!--	}-->
<!---->
<!--	.circle__status-sucess {-->
<!--		height: 30px;-->
<!--		width: 30px;-->
<!--		border-radius: 55px;-->
<!--		background-color: green;-->
<!--		display: inline-block;-->
<!--	}-->
<!---->
<!--	.circle__status-error {-->
<!--		height: 30px;-->
<!--		width: 30px;-->
<!--		border-radius: 55px;-->
<!--		background-color: red;-->
<!--		display: inline-block;-->
<!--	}-->
<!---->
<!--	h3 {-->
<!--		display: inline-block;-->
<!--	}-->
<!--</style>-->