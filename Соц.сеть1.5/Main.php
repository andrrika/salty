<?php
session_start(); // Начинаем сессию

// Проверка, если сессия с именем пользователя существует
if (!isset($_SESSION['username'])) {
    // Если пользователь не авторизован, редирект на страницу регистрации
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username']; // Получаем имя пользователя из сессии
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIVE 1.1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212; /* Темный фон страницы */
            color: #e0e0e0; /* Светлый текст */
            display: flex;
            justify-content: center;
        }
        /* Header Styles */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #1e1e1e; /* Темный фон шапки */
            border-bottom: 1px solid #333; /* Темная граница */
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-sizing: border-box;
            justify-content: center;
        }
        .header .logo {
            display: flex;
            align-items: center;
        }
        .header .logo img {
            height: 30px;
            margin-right: 10px;
        }
        .header .logo span {
            font-size: 18px;
            color: #e0e0e0; /* Светлый цвет текста логотипа */
        }
        .header .sections {
            display: flex;
            align-items: center;
            margin: 0 410px;
        }
        .header .sections .section {
            margin: 0 10px;
        }
        .header .sections .section a {
            color: #e0e0e0; /* Светлый цвет текста разделов */
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 3px;
            transition: background-color 0.3s, color 0.3s;
        }
        .header .sections .section a:hover {
            background-color: #333; /* Темная подложка при наведении */
            color: #e0e0e0; /* Цвет текста при наведении */
        }
        .header .icons img {
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .container {
            display: flex;
            max-width: 1200px;
            width: 100%;
            margin-top: 80px; /* Отступ для контента под фиксированной шапкой */
        }
        .sidebar {
            width: 250px;
            padding: 20px;
            background-color: #1e1e1e; /* Темный фон для боковой панели */
            display: flex;
            flex-direction: column;
            height: 100vh;
            box-sizing: border-box;
            
        }
        .sidebar a {
            color: #e0e0e0;
            text-decoration: none;
            margin-bottom: 20px;
            font-size: 18px;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 10px;
        }
        .sidebar a:hover {
            background-color: #333;
        }
        .sidebar .icon {
            font-size: 24px;
            margin-right: 10px;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .post {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .post .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .post .post-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .post .post-header .user-name {
            font-weight: bold;
        }
        .post .post-content {
            margin-bottom: 10px;
        }
        .post img {
            width: 100%;
            border-radius: 10px;
        }
        .right-sidebar {
            width: 250px;
            padding: 20px;
        }
        .like-button {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            font-size: 24px;
            color: #e0e0e0;
            transition: color 0.3s;
            margin-top: 10px;
        }
        .like-button .fas {
            color: #e63946;
        }
         /* Modal Styles */
         .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1001;
        }
        .modal-content {
            background-color: #2a2a2a;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            max-width: 80%;
        }
        .modal-content textarea {
            width: 100%;
            color: #e0e0e0;
            background-color: #333;
            border: none;
            padding: 10px;
            border-radius: 5px;
            resize: none;
            margin-bottom: 10px;
            height: 100px;
            box-sizing: border-box;
        }
        .modal-content button {
            background-color: #555;
            color: #e0e0e0;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .modal-content button:hover {
            background-color: #777;
        }
        .far fa-heart {
            margin-left:100px;
        }
    </style>
   
    
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo">
            <a href="#"><img src="logotip-removebg-preview.png" alt="Logo"></a>
            <span>LIVE</span>
        </div>
        <div class="sections">
            <div class="section">
                <a href="#recommendations">Рекомендации</a>
            </div>
            <div class="section">
                <a href="#for-you">Для вас</a>
            </div>
        </div>
        <div class="icons">
            <a href="Register.html">
                <img class="ProfilLogo" src="3d-render-of-avatar-character_23-2150611746.jpg" alt="Profile Image">
                <h1><?php echo htmlspecialchars($username); ?></h1>
            </a>
        </div>
    </header>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="Main.php"><span class="icon">🏠</span> Home</a>
            <a href="#"><span class="icon">🔍</span> Explore</a>
            <a href="Messages.html"><span class="icon">✉️</span> Messages</a>
            <a href="#"><span class="icon">🔖</span> Bookmarks</a>
            <a href="Profile.html"><span class="icon">👤</span> Profile</a>
            <a href="Settings.html"><span class="icon">⚙️</span> Settings</a>
            <a href="Moer.html"><span class="icon">🔽</span> More</a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Post 1 -->
            <div class="post">
                <div class="post-header">
                    <img src="3d-render-of-avatar-character_23-2150611746.jpg" alt="Profile Image">
                    <?php echo htmlspecialchars($username); ?>
                    <div>
                        <div class="user-name">Андрей Пирожков</div>
                        <div>@pirozkov_a67502</div>
                    </div>
                </div>
                <div class="post-content">
                    2 МЕСТО на гонке!!
                </div>
                <img src="photo_5341695330942575101_y.jpg" alt="Post Image">
                <div class="like-button">
                    <i class="far fa-heart" onclick="toggleLike(this)"></i>
                    <i>⠀</i>
                    <i class="far fa-comment comment-button" onclick="openCommentModal()"></i>
                </div>
            </div>

            <!-- Post 2 -->
            <div class="post">
                <div class="post-header">
                    <img src="3d-render-of-avatar-character_23-2150611746.jpg" alt="Profile Image">
                    <div>
                        <div class="user-name">Андрей Пирожков</div>
                        <div>@pirozkov_a67502</div>
                    </div>
                </div>
                <div class="post-content">
                    Старт пролога на огненом велосипеде)
                </div>
                <img src="photo_5321560318100495823_y.jpg" alt="Second Post Image">
                <div class="like-button">
                    <i class="far fa-heart" onclick="toggleLike(this)"></i>
                    <i>⠀</i>
                    <i class="far fa-comment comment-button" onclick="openCommentModal()"></i>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (Optional for future use) -->
        <div class="right-sidebar">
            <!-- You can add trends or additional information here, like Twitter does -->
        </div>
    </div>

    <!-- Comment Modal -->
    <div class="modal" id="commentModal">
        <div class="modal-content">
            <textarea placeholder="Оставьте комментарий..."></textarea>
            <button onclick="closeCommentModal()">Отправить</button>
        </div>
    </div>

    <script>
        function toggleLike(element) {
            element.classList.toggle('far');
            element.classList.toggle('fas');
            element.classList.add('animate__animated', 'animate__heartBeat');
            setTimeout(() => {
                element.classList.remove('animate__animated', 'animate__heartBeat');
            }, 1000);
        }

        function openCommentModal() {
            document.getElementById("commentModal").style.display = "flex";
        }

        function closeCommentModal() {
            document.getElementById("commentModal").style.display = "none";
        }

        // Close modal if clicked outside
        window.onclick = function(event) {
            let modal = document.getElementById("commentModal");
            if (event.target === modal) {
                closeCommentModal();
            }
        }
    </script>
    </script>
</body>
</html>