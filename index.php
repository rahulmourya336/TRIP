<?php
// session_start()
if(isset($_SESSION)){
    header("Location: ./dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
      function checkPassword () {
        Password = document.getElementById('password').value
        RepeatPassword = document.getElementById('passwordRepeat').value
        errorBox = document.getElementById('passwordValidationMessage')
        phoneNumber = document.getElementById('mobile').value

        if (phoneNumber > 0) {
          if (phoneNumber.length < 10 || phoneNumber.length > 11) {
            pwdErrorMessage = document.getElementById('mobileValidationMessage')
            pwdErrorMessage.classList.add('text-danger')
            pwdErrorMessage.innerHTML = 'Not a Valid phone number'
            return false
          }
        }
        if (Password !== RepeatPassword) {
          errorBox.classList.remove('text-success')
          errorBox.classList.add('text-danger')
          errorBox.innerHTML = 'Password is not matching.'
          return false
        }
        else if (Password === RepeatPassword) {
          errorBox.classList.remove('text-danger')
          errorBox.classList.add('text-success')
          errorBox.innerHTML = 'Password Matched.'
          return true
        }
        else {
          errorBox.classList.add('text-info')
          errorBox.innerHTML = 'Enter alpha-numeric password.'
          return false
        }
      }

      function invalidCredentials () {
        $().alert()
      }

      window.onload = function () {
        one = window.location.href
        status = one.search('invalid')
        if (status == -1) {
          $('.alert').hide()
        }
        else {
          console.log('Error header found')
          invalidCredentials()
        }
      }

    </script>
    <script src="https://www.gordonmac.com/wp-content/themes/2016/vendor/vide/jquery.vide.min.js"></script>
</head>

<body>
<!-- Background Video-->
<header class="heropanel--video" data-vide-bg="mp4: ./images/Travel_Video.mp4,  data-vide-options="posterType: png, loop: true, muted: true, position: 90% 20% style="z-index: 0!important;">

</header>
<div class="signup__container">
    <div class="container__child signup__thumbnail">
        <div class="thumbnail__content text-center">
            <h1 class="heading--primary">Welcome to TRIP</h1>
            <h2 class="heading--secondary">Travel Expense Manager</h2>
        </div>
        <div class="signup__overlay"></div>
    </div>
    <div class="container__child signup__form">
        <div class="text-center">
            <h5>Create an account</h5>
        </div>
        <!--        Alert box -->
        <div class="alert alert-danger alert-dismissible fade in" role="alert" id="error_info_alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
            </button>
            <h6>Email already exist <a href="signin.php">Click here to signin</a></h6>
        </div>
        <!--        End of Alert box-->
        <form action="dummy_signup.php" onsubmit="" method="post"
              id="signup">
            <div class="form-group">
                <label for="username">Full Name</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="james.bond" required maxlength="45" autofocus/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="james.bond@spectre.com"
                       required maxlength="45"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="********"
                       required minlength="6" maxlength="45" title="Enter password length more than 6 digit"/>
            </div>
            <div class="form-group">
                <label for="passwordRepeat">Repeat Password <span id="passwordValidationMessage" class="small text-right"></span></label>
                <input class="form-control" type="password" name="passwordRepeat" id="passwordRepeat"
                       placeholder="********" required minlength="6" maxlength="45" title="Enter password length more than 6 digit" oninput="checkPassword()"/>

            </div>

            <!--				TODO - Add [+91] Style block bootstrap-->


            <div class="form-group">
                <label for="mobile">Contact Number <span class="small" id="mobileValidationMessage"></span></label>
                <input class="form-control" type="number" name="mobile" id="mobile" placeholder="+91 XXXXXXXXXX"
                       pattern="/(7|8|9)\d{9}/" title="Not a valid phone number" required minlength="10" maxlength="11"/>
            </div>
            <div class="m-t-lg">
                <ul class="list-inline">
                    <li>
                        <input class="btn btn--form" type="submit" value="Register" name="reg_user" onclick="return checkPassword()"/>
                    </li>
                    <li>
                        <a class="signup__link" href="signin.php">I am already a member</a>
                    </li>
                </ul>
            </div>
        </form>
    </div>
</div>

</body>
</html>