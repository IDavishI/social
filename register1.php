<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>О Компании</title>
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

			<h2 class="register__header">Регистрация</h2>

			<form action="register/register.php" method="POST" class="register__form">
				<div class="register__input-wrapper">
					<input type="text" placeholder="Имя" name="name" required class="register__input">
				</div>
				<div class="register__input-wrapper">
					<input type="text" placeholder="Фамилия" name="surname" required class="register__input">
				</div>
				<div class="register__input-wrapper">
					<?php $pass = ''; if(isset($_SESSION['password'])) $pass = $_SESSION['password']; ?>
					<input type="password" placeholder="Пароль" name="password" value="<?php echo $pass; ?>" required class="register__input">
				</div>
				<div class="register__input-wrapper">
					<?php $email = ''; if (isset($_SESSION['email'])) $email = $_SESSION['email']; ?>
					<input type="email" value="<?php echo $email; ?>" placeholder="email" name="email" required class="register__input">
				</div>
				<input type="hidden" name="page" value="page1">
				<div class="register__button-wrapper">
					<input type="submit" value="Далее" class="register__button">
				</div>
			</form>

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
						<a href="" class="link footer__link">Вакансии</a>
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