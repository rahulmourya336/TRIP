<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>.: TRIP | Welcome login, signup :.</title>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
    <link rel="stylesheet" href="css/index_style.css">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css'>

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <style>
        .heropanel--video {
            font-family: 'Open Sans', sans-serif;
            min-height: 639px;
        }
        @keyframes gm-slidein {
            from {
                -webkit-transform:translate3d(0,-100%,0);
                opacity:0;
                transform:translate3d(0,-100%,0);
            }

            to {
                -webkit-transform:none;
                opacity:1;
                transform:none;
            }
        }

        .heropanel__content {
            -moz-animation:gm-slidein 3s 1;
            -ms-animation:gm-slidein 3s 1;
            -o-animation:gm-slidein 3s 1;
            -webkit-animation:gm-slidein 3s 1;
            animation:gm-slidein 3s 1;
            border-bottom:1px solid #FFF;
            margin:0 auto;
            max-width:50%;
            padding:4em 0 2em;
            text-align:center;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .heropanel__content h1 {
            margin:0 0 .5em;
            margin-top: 40px;
            text-transform:uppercase;
        }

        .heropanel__content h1 a {
            color:#FFF;
            text-decoration:none;
        }

        .heropanel__content p {
            color:#fff;
            margin:0;
            text-transform:uppercase;
        }

    </style>
    <script>
        function loggedUser(){
          window.location.href = "dashboard.php";
        }

      function invalidCredentials () {
        $().alert()
        setTimeout(function () {$('.alert').alert('close')}, 4000)
      }

      window.onload = function () {

        one = window.location.href
        status = one.search('invalid')
        if (status == -1) {
          $('.alert').hide()
        }
        else {
          invalidCredentials()
        }
        two = window.location.href
        status_2 = one.search('loginfirst')
        if (status_2 != -1) {
          $('.alert').show()
          document.getElementById('error_info').innerHTML = 'You must first login to continue...'
        }
      }


    </script>
    <?php
    if(isset($_SESSION["username"])){
        echo "<script>loggedUser();</script>";
    }
    ?>
    <script src="https://www.gordonmac.com/wp-content/themes/2016/vendor/vide/jquery.vide.min.js"></script>
</head>

<body>
<!-- Background Video-->
<header class="heropanel--video" data-vide-bg="mp4: ./images/Travel_Video.mp4,  data-vide-options="posterType: png, loop: true, muted: true, position: 90% 20% style="z-index: 0!important;">
</header>
<div class="signin__container">

    <div class="container__child signin__thumbnail">
        <div class="thumbnail__content text-center">
            <h1 class="heading--primary">Welcome to TRIP<span class="text-warning">P.</span></h1>
            <h2 class="heading--secondary">Travel Expense Manager</h2>
        </div>
        <div class="signin__overlay"></div>
    </div>
    <div class="container__child signin__form">
        <div class="text-center">
            <h5>Welcome back!</h5>
            <h6 class="blockquote-footer">We're so excited to see you again!</h6>
        </div>
        <!--        Alert box -->
        <div class="alert alert-danger alert-dismissible fade in" role="alert" id="error_info_alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
            </button>
            <h6 id="error_info">Invalid username or password</h6>
        </div>
        <!--        End of Alert box-->
        <form action="script.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="james.bond@spectre.com"
                       required autofocus/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="********"
                       required minlength="6"/>
            </div>
            <div class="m-t-lg">
                <ul class="list-inline">
                    <li>
                        <input class="btn btn--form" type="submit" value="Submit"/>
                    </li>
                    <li>
                        <a class="signin__link" href="index.php">I am a new member</a>
                    </li>
                </ul>
            </div>
        </form>

    </div>
</div>

</body>

</html>