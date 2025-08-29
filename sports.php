<?php
// sports.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CNN Clone - Sports News</title>
  <style>
    body{font-family:Arial, sans-serif;margin:0;padding:0;background:#f4f4f4;color:#333;}
    header{background:#cc0000;color:white;padding:15px;text-align:center;font-size:28px;font-weight:bold;}
    nav{display:flex;justify-content:center;background:#222;}
    nav a{color:white;text-decoration:none;padding:14px 20px;display:block;transition:0.3s;}
    nav a:hover{background:#cc0000;}
    .container{width:90%;margin:20px auto;}
    h2{color:#cc0000;margin-bottom:15px;}
    .news-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;}
    .news-card{background:white;border-radius:10px;overflow:hidden;box-shadow:0 3px 8px rgba(0,0,0,0.2);transition:transform 0.2s;cursor:pointer;}
    .news-card:hover{transform:scale(1.03);}
    .news-card img{width:100%;height:180px;object-fit:cover;}
    .news-content{padding:15px;}
    .news-content h3{margin:0;color:#222;}
    .news-content p{color:#555;margin:10px 0 0;font-size:15px;}
    footer{background:#222;color:white;text-align:center;padding:15px;margin-top:30px;}
  </style>
  <script>
    function redirectTo(page){window.location.href=page;}
  </script>
</head>
<body>
<header>CNN Clone</header>
<nav>
  <a href="index.php">Home</a>
  <a href="world.php">World</a>
  <a href="sports.php">Sports</a>
  <a href="technology.php">Technology</a>
  <a href="entertainment.php">Entertainment</a>
</nav>
 
<div class="container">
  <h2>🏅 Sports News</h2>
  <div class="news-grid">
 
    <div class="news-card" onclick="redirectTo('article.php?id=4')">
      <img src="https://cdn.cnn.com/cnnnext/dam/assets/230201123456-sport1.jpg" alt="Sports">
      <div class="news-content">
        <h3>Team Wins Historic Championship</h3>
        <p>Fans celebrate as their team secures a record-breaking victory...</p>
      </div>
    </div>
 
    <div class="news-card" onclick="redirectTo('article.php?id=5')">
      <img src="https://cdn.cnn.com/cnnnext/dam/assets/230201987654-sport2.jpg" alt="Sports">
      <div class="news-content">
        <h3>Legendary Player Announces Retirement</h3>
        <p>Sports world reacts as a superstar ends an unforgettable career...</p>
      </div>
    </div>
 
    <div class="news-card" onclick="redirectTo('article.php?id=6')">
      <img src="https://cdn.cnn.com/cnnnext/dam/assets/230202111111-sport3.jpg" alt="Sports">
      <div class="news-content">
        <h3>Major Tournament Kicks Off</h3>
        <p>Excitement builds as international teams compete for the trophy...</p>
      </div>
    </div>
 
  </div>
</div>
 
<footer>&copy; 2025 CNN Clone - All Rights Reserved</footer>
</body>
</html>
 
