<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="Omnifood is a premium food delivery service with the mission to bring affordable and healty meals to as many people as possible">

		<link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
		<link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
		<link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
		<link rel="stylesheet" type="text/css" href="vendors/css/animate.css">
		<link rel="stylesheet" type="text/css" href="resource/css/style.css">
		<link rel="stylesheet" type="text/css" href="resource/css/signup.css">
		<link rel="stylesheet" type="text/css" href="resource/css/queries.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,300italic" rel="stylesheet" type="text/css">
		<title>Omnifood</title>

		<link rel="apple-touch-icon" sizes="57x57" href="/resource/favicons/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/resource/favicons/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/resource/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/resource/favicons/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/resource/favicons/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/resource/favicons/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/resource/favicons/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/resource/favicons/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/resource/favicons/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="/resource/favicons/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="/resource/favicons/favicon-194x194.png" sizes="194x194">
		<link rel="icon" type="image/png" href="/resource/favicons/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/resource/favicons/android-chrome-192x192.png" sizes="192x192">
		<link rel="icon" type="image/png" href="/resource/favicons/favicon-16x16.png" sizes="16x16">
		<link rel="manifest" href="/resource/favicons/manifest.json">
		<link rel="mask-icon" href="/resource/favicons/safari-pinned-tab.svg" content="#5bbad5">
		<link rel="shortcut icon" href="/resource/favicons/favicon.ico">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="msapplication-TileImage" content="/resource/favicons/mstile-144x144.png">
		<meta name="msapplication-config" content="/resource/favicons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">


	</head>
	<body>
		<header class="header-page">
			<nav>
				<div class="row">
					<img src="resource/img/logo-white.png" alt="Omnifood logo" class="logo logo-page">
					<img src="resource/img/logo.png" alt="Omnifood logo" class="logo-black logo-black-page">
					<ul class="main-nav nav-page js--main-nav">
						<li><a href="#features">Food delivery</a></li>
						<li><a href="#works">How it works</a></li>
						<li><a href="#cities">Our cities</a></li>
						<li><a href="/signup.php">Sign up</a></li>
					</ul>
					<a class="mobile-nav-icon js--nav-icon"><i class="ion-navicon-round"></i></a>
				</div>
			</nav>
		</header>

		<section class="section-signup">
			<div class="row">
				<h2>회원가입</h2>
			</div>
            
            <div class="image-upload">
                <form method="post" enctype="multipart/form-data">
                <input type="file" name="image">
                <input type="submit" name="submit" value="프로필업로드">    
                
                </form>
            </div>
            <?php
                if(isset($_POST['submit']))
                {
                    if(getimagesize($_FILES['image']['tmp_name']) == FALSE){
						echo "Please select an image";
					}
					else{
						$image = addslashes($_FILES['image']['tmp_name']);
						$name = addslashes($_FILES['image']['name']);
						$image= file_get_contents($image);
						$image = base64_encode($image);
						saveimage($image);
					}
                }
				displayimage();
            	function saveimage($image){
					$conn = mysqli_connect("127.0.0.1:3000", "root", "asdf1234");
					mysqli_select_db($conn, "madebuydb");

					$query = "UPDATE user_tb SET user_im ='$image' WHERE userKey = 2";
					$result = mysqli_query($conn, $query);
					if($result){
						echo "Image uploaded";
					}
					else{
						echo "Image not uploaded";
					}
				}
				function displayimage(){
					$conn = mysqli_connect("127.0.0.1:3000", "root", "asdf1234");
					mysqli_select_db($conn, "madebuydb");

					$query = "select user_im from user_tb where userKey = 2";
					$result = mysqli_query($conn, $query);
					while($row = mysqli_fetch_assoc($result)){
						echo '<img height="300" width= "300" src="data:image;base64,'.$row['user_im'].' ">';
					}
					mysqli_close($conn);
				}
            ?>
            
			<div class="row">
				<form method="post" action="process/signup_process.php" class="signup-form" name="signupForm">
					<div class="row">
						<div class="id-row">
							<div class="col span-1-of-3">
								<label for="email">이메일주소</label>
							</div>
							<div class="col span-2-of-3">
								<input type="email" name="email" id="email" placeholder="이메일 주소" required>
							</div>
						</div>
						<div>
							<input type="button" value="아이디 중복확인" class="id-btn" onClick="id_check(signupForm)">
							<script>
								function id_check(signupForm){
									var writtenEmail = signupForm.email.value;
									signupForm.method = "post";
									signupForm.action = "process/checkEmail.php";
									signupForm.submit();
								}
							</script>
						</div>
					</div>
					<div class="row">
						<div class="col span-1-of-3">
							<label for="password">비밀번호</label>
						</div>
						<div class="col span-2-of-3">
							<input type="password" name="password" id="password" placeholder="비밀번호" required>
						</div>
					</div>
					<div class="row">
						<div class="col span-1-of-3">
							<label for="pwd-confirm">비밀번호 확인</label>
						</div>
						<div class="col span-2-of-3">
							<input type="password" name="pwd-confirm" id="pwd-confirm" placeholder="비밀번호 확인" required>
						</div>
					</div>
					<div class="row">
						<div class="col span-1-of-3">
							<label for="name">이름</label>
						</div>
						<div class="col span-2-of-3">
							<input type="text" name="name" id="name" placeholder="이름" required>
						</div>
					</div>
					<div class="row">
						<div class="col span-1-of-3">
							<label for="phone">휴대전화</label>
						</div>
						<div class="col span-2-of-3">
							<input type="text" name="phone" id="phone" placeholder="-를 제외하고 입력" required>
						</div>
					</div>
					<div class="row">
						<div class="col span-1-of-3">
							<label for="user-type">가입유형</label>
						</div>
						<div class="col span-2-of-3">
							<input type="radio" name="user-type" id="client-type" value="client" />
							<label for="client-type">클라이언트</label>
							<input type="radio" name="user-type" id="freelancer-type" value="freelancer" />
							<label for="freelancer-type">프리랜서</label>
						</div>
					</div>

					<div class="row">
						<div class="col span-1-of-3">
							<label>&nbsp;</label>
						</div>
						<div class="col span-2-of-3">
							<input type="checkbox" name="terms" id="terms" checked>이용약관에 동의합니다
						</div>
					</div>
					<div class="row">
						<div class="col span-1-of-3">
							<label>&nbsp;</label>
						</div>
						<div class="col span-2-of-3">
							<input type="checkbox" name="information" id="information" checked>개인정보취급방침에 동의합니다
						</div>
					</div>

					<div class="row">
						<div class="col span-1-of-3">
							<label>&nbsp;</label>
						</div>
						<div class="col span-2-of-3">
							<input type="submit" value="회원가입">
						</div>
					</div>
				</form>
			</div>
		</section>

		<footer>
			<div class="row">
				<div class="col span-1-of-2">
					<ul class="footer-nav">
						<li><a href="#">About us</a></li>
						<li><a href="#">Blog</a></li>
						<li><a href="#">Press</a></li>
						<li><a href="#">iOS App</a></li>
						<li><a href="#">Android App</a></li>
					</ul>
				</div>
				<div class="col span-1-of-2">
					<ul class="social-links">
						<li><a href="#"><i class="ion-social-facebook"></i></a></li>
						<li><a href="#"><i class="ion-social-twitter"></i></a></li>
						<li><a href="#"><i class="ion-social-googleplus"></i></a></li>
						<li><a href="#"><i class="ion-social-instagram"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<p>
					Copyright &copy; 2016 by Ensemble Lab. All right reserved.
				</p>
			</div>

		</footer>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
		<script src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://cdn.jsdelivr.net/selectivizr/1.0.3b/selectivizr.min.js"></script>
		<script src="vendors/js/jquery.waypoints.min.js"></script>
		<script src="resource/js/script.js"></script>


	</body>

</html>