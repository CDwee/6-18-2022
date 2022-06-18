<!-- Started at 11:36 6-18-2022 -->

$(document).ready(function() {
	
	$("#hideLogin").click(function() {
		$("#loginForm").hide();
		$("#registerForm").show();
	});

	$("#hideRegister").click(function() {
		$("#loginForm").show();
		$("#registerForm").hide();
	});
});

html, 
body {
    padding: 0;
    margin: 0;
    height: 100%;
}

#background {
    background-color: #000;
    background-image: url(../images/bg.jpg);
    background-position: center;
    background-size: cover;
    display: table;
    height: 100%;
    width: 100%;
}

#loginContainer * {
    color: #fff;
    font-family: "Helvetica Neue", "Helvetica", "Arial", sans-serif;
    font-weight: normal;
    line-height: 1em;
    box-sizing: border-box;
}

#loginContainer {
    width: 80%;
    margin: 0 auto;
    position: relative;
    max-width: 1024px;
}

::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    color:    #fff;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
   color:    #fff;
   opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
   color:    #fff;
   opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
   color:    #fff;
}
::-ms-input-placeholder { /* Microsoft Edge */
   color:    #fff;
}

#inputContainer {
    width: 400px;
    padding: 45px;
    float: left;
    border-right: 1px solid #999;
}

#inputContainer h2 {
    text-align: center;
}

#inputContainer input[type="text"],
#inputContainer input[type="email"],
#inputContainer input[type="password"] {
    display: block;
    background-color: transparent;
    border: 0;
    border-bottom: 1px solid #fff;
    height: 27px;
    line-height: 27px;
    width: 100%;
}

#inputContainer label {
    color: #a0a0a0;
    font-size: 13px;
    display: block;
    margin-top: 15px;
}

#inputContainer button {
    background-color: transparent;
    border: 2px solid #fff;
    border-radius: 250px;
    color: #fff;
    display: block;
    font-size: 14px;
    letter-spacing: 1px;
    margin: 20px auto;
    height: 41px;
    width: 100%;
}

#inputContainer button:hover {
    cursor: pointer;
}

.hasAccountText span {
    cursor: pointer;
    font-weight: bold;
    font-size: 12px;
}

.hasAccountText {
    text-align: center;
}

#registerForm,
#loginForm {
    display: none;
}

#loginText {
    padding: 45px;
    display: table-cell;
}

#loginText h1 {
    color: #07d159;
    font-size: 60px;
    font-weight: bold;
}

#loginText h2 {
    margin: 35px 0;
}

#loginText ul {
    padding: 0;
}

#loginText li {
    font-size: 20px;
    list-style-type: none;
    padding: 5px 30px;
    background: url(../images/icons/checkmark.png) no-repeat 0 0;
}

#inputContainer .errorMessage {
    color: #07d159;
    font-size: 12px;
    display: block;
}

<?php
	include("includes/config.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constants.php");

	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
?>

<html>
<head>
	<title>Welcome to Slotify!</title>

	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
	<?php
	if(isset($_POST['registerButton'])) {
	echo '<script>
			$(document).ready(function() {
				$("#loginForm").hide();
				$("#registerForm").show();
			});
			</script>';
	}
	else {
		echo '<script>
			$(document).ready(function() {
				$("#loginForm").show();
				$("#registerForm").hide();
			});
			</script>';
	}

	?>

	<div id="background">

		<div id="loginContainer">

			<div id="inputContainer">
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>
					<p>
						<?php echo $account->getError(Constants::$loginFailed); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('loginUsername') ?>" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Sign up here.</span>
					</div>
					
				</form>



				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->getError(Constants::$usernameCharacters); ?>
						<?php echo $account->getError(Constants::$usernameTaken); ?>
						<label for="username">Username</label>
						<input id="username" name="username" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('username') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$firstNameCharacters); ?>
						<label for="firstName">First name</label>
						<input id="firstName" name="firstName" type="text" placeholder="e.g. Bart" value="<?php getInputValue('firstName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$lastNameCharacters); ?>
						<label for="lastName">Last name</label>
						<input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" value="<?php getInputValue('lastName') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
						<?php echo $account->getError(Constants::$emailInvalid); ?>
						<?php echo $account->getError(Constants::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>
					</p>

					<p>
						<label for="email2">Confirm email</label>
						<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email2') ?>" required>
					</p>

					<p>
						<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
						<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
						<?php echo $account->getError(Constants::$passwordCharacters); ?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" placeholder="Your password" required>
					</p>

					<p>
						<label for="password2">Confirm password</label>
						<input id="password2" name="password2" type="password" placeholder="Your password" required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>
					
				</form>


			</div>

			<div id="loginText">
				<h1>Get some music that makes you feel great!</h1>
				<h2>Listen to great songs for free!</h2>
				<ul>
					<li>Find music you love</li>
					<li>Create your own playlists</li>
					<li>Follow your favorite artist</li>
				</ul>
			</div>

		</div>
	</div>

</body>
</html>

<?php
include("includes/config.php");

// session_destroy();

if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
}
else {
    header("Location: register.php");
}

?>

<html>
<head>
    <title>Welcome to Slotify!</title>

    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>
    

    <div id="nowPlayingBarContainer">

        <div id="nowPlayingBar">

            <div id="nowPlayingLeft">
                <div class="content">
                    <span class="albumLink">
                        <img src="https://i.discogs.com/8ILgRvJEJB1WJJ4Ze2JMcJkXn3z25kKSjCXu5MYZx90/rs:fit/g:sm/q:90/h:600/w:599/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTIxMTgw/NC0xMzM3MTE0NTk4/LTg2NjUuanBlZw.jpeg" class="albumArtWork">
                    </span>

                    <div class="trackInfo">
                        
                        <span class="trackName">
                            <span>A view to a kill</span>
                        </span>

                         <span class="artistName">
                            <span>Duran Duran</span>
                        </span>

                    </div>



                </div>
            </div>

            <div id="nowPlayingCenter">

                <div class="content playerControls">

                    <div class="buttons">

                        <button class="controlButton shuffle" title="Shuffle button">
                            <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                        </button>

                        <button class="controlButton previous" title="Previous button">
                            <img src="assets/images/icons/previous.png" alt="Previous">
                        </button>

                        <button class="controlButton play" title="Play button">
                            <img src="assets/images/icons/play.png" alt="Play">
                        </button>

                        <button class="controlButton pause" title="Pause button" style="display: none;">
                            <img src="assets/images/icons/pause.png" alt="Pause">
                        </button>

                        <button class="controlButton next" title="Next button">
                            <img src="assets/images/icons/next.png" alt="Next">
                        </button>

                        <button class="controlButton repeat" title="Repeat button">
                            <img src="assets/images/icons/repeat.png" alt="Repeat">
                        </button>
                        
                    </div>


                    <div class="playbackBar">
                        
                        <span class="progressTime current">0.00</span>

                        <div class="progressBar">
                            <div class="progressBarBG">
                                <div class="progress"></div>
                            </div>
                        </div>

                        <span class="progressTime remaining">0.00</span>


                    </div>

                    
                </div>


                
            </div>

            <div id="nowPlayingRight">
                <div class="volumeBar">
                    
                    <button class="controlButton volume" title="Volume button">
                        <img src="assets/images/icons/volume.png" alt="Volume">
                    </button>

                    <div class="progressBar">
                            <div class="progressBarBG">
                                <div class="progress"></div>
                            </div>
                    </div>
                </div>
            </div>



            
        </div>
    </div>


</body>

</html>

html, body {
    padding:  0;
    margin: 0;
    height: 100%;
}

* {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    color: #fff;
}

#nowPlayingBarContainer {
    width: 100%;
    background-color: #282828;
    bottom: 0;
    position: fixed;
    min-width: 620px;
}

#nowPlayingBar {
    display: flex;
    height: 90px;
    padding: 16px;
    box-sizing: border-box;
}

#nowPlayingLeft,
#nowPlayingRight {
    width: 30%;
    min-width: 180px;
}

#nowPlayingRight {
    position: relative;
    margin-top: 16px;
}

#nowPlayingCenter {
    width: 40%;
    max-width: 700px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#nowPlayingBar .content {
    width: 100%;
    height:  57px;
}

.playerControls .buttons {
    margin: 0 auto;
    display: table;
}

.controlButton {
    background-color: transparent;
    border: none;
    vertical-align: middle;
}

.controlButton img {
    width: 20px;
    height: 20px;
}

.controlButton.play img,
.controlButton.pause img {
    width: 32px;
    height: 32px;
}

.controlButton:hover {
    cursor: pointer;
}

.progressTime {
    color: #a0a0a0;
    font-size: 11px;
    min-width: 40px;
    text-align: center;
}

.playbackBar {
    display: flex;
}

.progressbar {
    width: 100%;
    height: 12px;
    display: inline-flex;
    cursor: pointer;
}

.progressBarBG {
    background-color: #404040;
    height: 4px;
    width: 100%;
    border-radius: 2px;
}

.progress {
    background-color: #a0a0a0;
    height: 4px;
    width: 0;
    border-radius: 2px;
}

.playbackBar .progressBar {
    margin-top: 3px;
}

#nowPlayingLeft .albumArtWork{
    height: 100%;
    max-width: 57px;
    margin-right: 15px;
    float: left;
    background-size: cover;
}

.trackInfo {
    display: table;
}

#nowPlayingLeft .trackInfo .trackName {
    margin: 6px 0;
    display: inline-block;
    width: 100%;
}

#nowPlayingLeft .trackInfo .artistName span {
    font-size: 12px;
    color: #a0a0a0;
}

.volumeBar {
    width: 180px;
    position: absolute;
    right: 0;
}

.volumeBar .progressBar {
    width: 125px;
}

<!-- Ended at 5:38 6-18-2022 -->
