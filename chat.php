<?php 
	
	$chat_id = $_GET['chatroom_id'];
	$cookie_name = 'user_id';
	$person_id = -1;
	if(isset($_COOKIE[$cookie_name]))
		$person_id = $_COOKIE[$cookie_name];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat page</title>
	<link rel="stylesheet" href="dest/normalize.css">
	<link href="https://fonts.googleapis.com/css?family=Cormorant+SC:400,700&amp;subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="dest/normalize.css">
	<link rel="stylesheet" href="dest/jquery.modal.min.css">
	<link rel="stylesheet" href="dest/style.min.css">
</head>
<body class="page">
	
	<div class="page__wrapper">
	
		<header class="header page__header header--style">
			
			<div class="header__wrapper">
				
				<div class="logo header__logo">
					<a href="index.php" class="link"><img src="img/logo.png" alt="Tanysaiyq" class="logo__img logo__img--style"></a>
				</div>
				
				<div class="header__slogan header__slogan--new">
					<p class="par">Кыздар, жигиттер танысайык</p>
				</div>

				<div class="header__search">
					<form action="" method="POST" class="search__form">
						<div class="search__input-wrapper">
							<input type="text" placeholder="Поиск" required class="search__input">
						</div>
					</form>
				</div>

				<div class="header__exit">
					<a href="/php/exit.php" class="link header__exit-link">Выход</a>
				</div>

			</div>

		</header>

		<main class="main-content page__main-content">

			<div class="main-content__chat-wrapper">
				
				<div class="chat__info">
					
					<div class="chat__link-wrapper">
						<a href="profile.php" class="link chat__link">Назад</a>
					</div>
					
					<div>
						<h2 class="chat__header"></h2>
						<a href="" class="link chat__participants">Участники</a>
					</div>
					
					<a href="" class="link chat__add">+</a>

				</div>

				<div class="chat__body">

					<a href="#down" class="test"></a>
					
					<div class="chat__inner">
						
						<div id="down"></div>
					</div>
					<div class="chat-write">
						<form action="php/setmessages.php" method="POST" class="chat-write__form">
							<div class="chat-write__input-wrapper">
								<textarea name="body" rows="6" placeholder="Напишите сообщение..." class="chat-write__input"></textarea>
							</div>
							<input type="hidden" name="chatroom_id" value="<?php echo $chat_id; ?>">
							<input type="hidden" name="person_id" value="<?php echo $person_id; ?>">
							<div class="chat-write__button-wrapper">
								<input type="submit" value="Отправить" class="chat-write__button">
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
	
	<div class="chat-add">
		
		<ul class="list chat-add__list">
			
		</ul>

	</div>

	<div class="chat-part">
		<h3>Участники</h3>
		<ul class="list chat-part__list">
			
		</ul>

	</div>

	<script src="dest/libs.min.js"></script>
	<script src="dest/jquery.modal.min.js"></script>
	<script src="dest/main.min.js"></script>
	<script>
		$(document).ready(function(){
			loadMessages();
			setInterval(loadMessages, 1000);
		});
	</script>
</body>
</html>