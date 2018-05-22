<?php 
	
	$user_id = $_COOKIE['user_id']; 
	$city = $_POST['city']; 
	$interests = $_POST['interests']; 
	$about = $_POST['about']; 
	$email = $_POST['email']; 
	$phone = $_POST['phone'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update the user</title>
	<link href="https://fonts.googleapis.com/css?family=Cormorant+SC:400,700&amp;subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="dest/style.min.css">
</head>
<body class="page">

	<div class="page__wrapper">
	
		<header class="header page__header header--style">
			
			<div class="header__wrapper">
				
				<div class="logo header__logo">
					<a href="index.php" class="link"><img src="img/logo.png" alt="Tanysaiyq" class="logo__img logo__img--style"></a>
				</div>
				
				<div class="header__slogan">
					<p class="par">Кыздар, жигиттер танысайык</p>
				</div>

			</div>

		</header>

		<main class="main-content page__main-content">

			

		</main>

		<footer class="footer page__footer">
			
			<div class="footer__wrapper">
				
				<ul class="list footer__list">
					<li class="footer__item">
						<a href="about.html" class="link footer__link">О Компании</a>
					</li>
					<li class="footer__item">
						<a href="contacts.html" class="link footer__link">Контакты</a>
					</li>
					<li class="footer__item">
						<a href="vacancy.html" class="link footer__link">Вакансии</a>
					</li>
					<li class="footer__item">
						<a href="" class="link footer__link">Реклама</a>
					</li>
				</ul>

			</div>

		</footer>
	</div>
	<script src="dest/libs.min.js"></script>
	<script src="dest/main.min.js"></script>
</body>
</html>