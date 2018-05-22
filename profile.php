<?php
	
	$cookie_name = 'user_id';
	$user_id = -1;
	if(isset($_COOKIE[$cookie_name])){
		$user_id = $_COOKIE[$cookie_name];
		$cookie_id = $_COOKIE[$cookie_name];
	} else {
		header("Location:index.php");
	}

	if (isset($_GET['id']))
		$user_id = $_GET['id'];

	include './register/db_info.php';

	$person = array();
	$news = array();
	$events = array();
	$chats = array();

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "Select * FROM Person WHERE Person.id = {$user_id};"; 
	    foreach ($conn->query($sql) as $row) {
	        $person['name'] = $row['name'];
	        $person['surname'] = $row['surname'];
	        $person['age'] = $row['age'];
	        $person['rating'] = $row['rating'];
	        $person['media'] = $row['media'];
	        $person['phone'] = $row['phone']; 
	        $person['city'] = $row['city'];
	        $person['interests'] = $row['interests']; 
	        $person['email'] = $row['email']; 
	        $person['birth_date'] = $row['birth_date']; 
	        $person['gender'] = $row['gender']; 
	        $person['about'] = $row['about'];
    	}

    	$sql = "SELECT News.id as id, body, news_date FROM News, Person WHERE Person.id = {$user_id} AND Person.id = News.person_id ORDER BY news_date DESC;";

    	foreach ($conn->query($sql) as $row) {
	        $news[] = $row;
    	}

    	$sql = "SELECT Event.id, Event.name, Event.status, Event.date FROM Person, Event, Person_Event WHERE Person.id = {$user_id} AND Event.id = Person_Event.event_id AND Person.id = Person_Event.person_id;";

    	foreach ($conn->query($sql) as $row) {
	        $events[] = $row;
    	}

    	$sql = "SELECT Chatroom.id, Chatroom.name FROM Chatroom, Person_Chatroom, Person WHERE Person_Chatroom.person_id = Person.id AND Person.id = {$user_id} AND Chatroom.id = Person_Chatroom.chatroom_id;";

    	foreach ($conn->query($sql) as $r) {
	        $chats[] = $r;
    	}

    	$sql = "SELECT Person.id, name, surname, rating FROM Person, Friends WHERE Person.id = Friends.friend_id AND Friends.person_id = '{$user_id}'";

	    foreach ($conn->query($sql) as $row) {
	        $friends[] = $row;
    	}


	}
	catch(PDOException $e) {
	    echo "Error: " . $e->getMessage();
	}
	$conn = null;

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $person['name'] . " " . $person['surname']; ?></title>
	<link rel="stylesheet" href="dest/normalize.css">
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
				
				<div class="header__slogan header__slogan--new">
					<p class="par">Кыздар, жигиттер танысайык</p>
				</div>

				<div class="header__search">
					<form action="search.php" method="POST" class="search__form">
						<div class="search__input-wrapper">
							<input type="text" placeholder="Поиск" name="email" required class="search__input">
						</div>
						<input type="submit" style="display: none;">
					</form>
				</div>

				<div class="header__exit">
					<a href="/php/exit.php" class="link header__exit-link">Выход</a>
				</div>

			</div>

		</header>

		<main class="main-content page__main-content">

			<div class="main-content__inner">

				<div class="profile__wrapper">
				
					<div class="profile__block">
						
						<div class="profile__img-wrapper">
							<?php $avatar = $person['media']; if ($avatar == NULL) $avatar = 'avatar-def.png';?>
							<img src="<?php echo 'img/' . $avatar; ?>" alt="" class="profile__img">
						</div>

						<h3 class="profile__name"><?php echo $person['name'] . " " . $person['surname']; ?></h3>
						<p class="par profile__age"><?php echo $person['age']; ?> лет</p>
						<div class="profile__rating">Рейтинг: <?php echo $person['rating']; ?></div>

					</div>

					<div class="profile__block">

						<div class="profile__inner">
							
							<?php 
								$counter = 0;
							foreach($events as $event) {

								echo '<a href="event.php?event='. $event['id'] .'" class="link profile__event">' . $event['name'] . '<br>' . $event['date'] . "<br>" . $event['status'] . '</a>';
									if ($counter == 6) break;
								$counter++;
							}?>

							
						</div>

					</div>

				</div>

				<div class="profile__master">
						<div class="tab tab--new">
						    <a href="#news" class="tablinks active">Новости</a>
						    <a href="#profile" class="tablinks">Профиль</a>
						    <a href="#friends" class="tablinks">Друзья</a>
						    <a href="#chatroom" class="tablinks">Чаты</a>
						</div>

						<div id="news" class="tabcontent">
							<h3 class="review__header">Новости</h3>
							<?php if ($user_id == $cookie_id) {
								echo '<button class="vacancy__button vacancy__button--new news__button">Добавить</button>';
							}?>
							
							<form action="php/regnews.php" method="POST" class="news__form">
								<label for="text">Текст сообщения:</label><br>
								<div class="news__input-wrapper">
									<textarea id="text" name="text" required cols="30" placeholder="Текст сообщения" rows="6" class="news__text"></textarea>
								</div>
								<div class="news__button-wrapper">
									<input type="submit" value="Добавить" class="vacancy__button">
								</div>
							</form>
							<div class="news__block">
								<br>
							<?php 

								foreach ($news as $n) {
	        						echo "<p class='par'>" . "<span class='news__date'>" .$n['news_date'] . "</span><a href='php/deletenews.php?news_id=" .$n['id'] ."' class='link news__delete' title='Delete'>x</a><br>" . $n['body'] ."</p><br>";
    							}

							 ?>
							 </div>

						</div>

						<div id="profile" class="tabcontent">
							<div class="profile__content">
								<form action="update-user.php" method="POST" class="profile__form">
									<input type="hidden" name="city" value="<?php echo $person['city']; ?>">
									<input type="hidden" name="interests" value="<?php echo $person['interests']; ?>">
									<input type="hidden" name="about" value="<?php echo $person['about']; ?>">
									<input type="hidden" name="email" value="<?php echo $person['email']; ?>">
									<input type="hidden" name="phone" value="<?php echo $person['phone']; ?>">
									<input type="submit" class="profile__update" value="Изменить" title="Изменить">
								</form>
								<h3 class="review__header">Профайл</h3>
							</div>
							<p class="vacancy__text news__profile">
								<span>Пол: </span> <?php echo $person['gender']; ?><br><br>
								<span>Город: </span> <?php echo $person['city']; ?><br><br>
								<span>Год рождения: </span> <?php echo $person['birth_date']; ?><br><br>
								<span>Email: </span> <?php echo $person['email']; ?><br><br>
								<span>Телефон: </span> <?php echo $person['phone']; ?><br><br>
								<span>Интересы: </span> <?php echo $person['interests']; ?><br><br>
								<span>О Себе: </span> <?php echo $person['about']; ?><br>
							</p>
						</div>

						<div id="friends" class="tabcontent">
							<h3 class="review__header">Друзья</h3>
							
							<div class="link friends__wrapper">
								
								<?php

								foreach ($friends as $friend) {
									$n = substr($friend['name'],0,1);
									$l = substr($friend['surname'],0,1);
	        						echo '<a href="profile.php?id='.$friend['id'].'" class="link friends__block">' . 
	        							'<div class="friends__logo">' . $n . $l .
	        							'</div><div class="friends__name">' .
	        							$friend['name'] . ' ' . $friend['surname'] .
	        							'</div></a>';
    							}

								?> 

							</div>

						</div>

						<div id="chatroom" class="tabcontent">
							<h3 class="review__header">Чаты</h3>
							<?php if ($user_id == $cookie_id) {
								echo '<button class="vacancy__button vacancy__button--new chat__button">Добавить Чат</button>';
							}?>
							
							<form action="php/regchatroom.php" method="POST" class="chat__form">
								<label for="text">Имя Чата:</label><br>
								<div class="news__input-wrapper">
									<input id="text" name="new_group_name" required placeholder="Введите имя чата" class="chat__input">
								</div>
								<div class="news__button-wrapper">
									<input type="submit" value="Добавить Чат" class="vacancy__button">
								</div>
							</form>
							<div class="chat__block">
							<?php 

								foreach ($chats as $chat) {
									if ($user_id == $cookie_id)
	        						echo "<a href='chat.php?chatroom_id={$chat['id']}&name={$chat['name']}'><p class='par'>" .$chat['name'] . "</p><br></a>";
	        						else echo "<p class='par'>" .$chat['name'] . "</p><br>";
    							}

							 ?>
							 </div>

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