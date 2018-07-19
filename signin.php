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
    <script>
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

</head>

<body>

<div class="signin__container">
    <div class="container__child signin__thumbnail">
        <div class="thumbnail__content text-center">
            <h1 class="heading--primary">Welcome to TRIP</h1>
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
                       required/>
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