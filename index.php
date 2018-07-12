<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>.: TRIP | Welcome login, signup :.</title>
	<link rel="stylesheet" href="css/index_style.css">
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
	<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

</head>

<body>
	<div class="signup__container">
		<div class="container__child signup__thumbnail">
			<div class="thumbnail__content text-center">
				<h1 class="heading--primary">Welcome to TRIP</h1>
				<h2 class="heading--secondary">Travel Expense Manager</h2>
			</div>
			<div class="signup__overlay"></div>
		</div>
		<div class="container__child signup__form">
			<form action="#">
				<div class="form-group">
					<label for="username">Full Name</label>
					<input class="form-control" type="text" name="name" id="name" placeholder="james.bond" required />
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input class="form-control" type="text" name="email" id="email" placeholder="james.bond@spectre.com" required />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" type="password" name="password" id="password" placeholder="********" required />
				</div>
				<div class="form-group">
					<label for="passwordRepeat">Repeat Password</label>
					<input class="form-control" type="password" name="passwordRepeat" id="passwordRepeat" placeholder="********" required />
				</div>

				<!--				Sample code for +91 contact info-->
				<div class="col-auto">
					<label class="sr-only" for="inlineFormInputGroup">Username</label>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">@</div>
						</div>
						<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
					</div>
				</div>
<!--				end of sample code-->


				<div class="form-group">
					<label for="passwordRepeat">Contact Number</label>
					<input class="form-control" type="number" name="mobile" id="mobile" placeholder="+91 XXXXXXXXXX" required />
				</div>
				<div class="m-t-lg">
					<ul class="list-inline">
						<li>
							<input class="btn btn--form" type="submit" value="Register" />
						</li>
						<li>
							<a class="signup__link" href="#">I am already a member</a>
						</li>
					</ul>
				</div>
			</form>
		</div>
	</div>

</body>



</html>