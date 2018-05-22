
<?php 
	
	$cookie_name = 'user_id';
	$cookie_role = 'role';
	if(isset($_COOKIE[$cookie_name])){
		if ($_COOKIE[$cookie_role] == 'user')
			header('Location: profile.php');
		else header('Location: admin.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добро пожаловать</title>
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

			<div class="main-content__wrapper">
				
				<div class="main-content__block">
					
					<h2 class="main-content__header">Tanysaiyq</h2>
					<p class="main-content__description">
						Социальная сеть для совместного <span>движа</span> в КZ.<br>
						<span>Самая вышка!</span>
					</p>

					<div class="main-content__img-wrapper">
						<img src="img/kaz.png" alt="Image goes here" class="main-content__img">
					</div>

				</div>
				
				<div class="main-content__block">
					
					<div class="form-wrapper">
						
						<form action="register/auth.php" method="POST" class="main-content__form">
							<h2 class="main-content__form-header">Вход</h2>
							<div class="main-content__input-wrapper">
								<input type="email" name="email" required placeholder="Email" class="main-content__input">
							</div>
							<div class="main-content__input-wrapper">
								<input type="password" required name="password" placeholder="Пароль" class="main-content__input">
							</div>
							<div class="main-content__input-wrapper">
								<input type="submit" value="Войти" class="button main-content__button">
							</div>
						</form>

					</div>

					<div class="form-wrapper">
						
						<form action="register/register.php" method="POST" class="main-content__form main-content__form--new">
							<h2 class="main-content__form-header">Регистрация</h2>
							<div class="main-content__input-wrapper">
								<input type="email" name="email" placeholder="Email" class="main-content__input">
							</div>
							<div class="main-content__input-wrapper">
								<input type="password" name="password" placeholder="Пароль" class="main-content__input">
							</div>
							<input type="hidden" name="main-page" value="value">
							<div class="main-content__input-wrapper">
								<input type="submit" value="Зарегистрироваться" class="button main-content__button">
							</div>
						</form>

					</div>

				</div>

			</div>

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