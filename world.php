<?php
// world.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CNN Clone - World News</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f4;
      color: #333;
    }
    header {
      background: #cc0000;
      color: white;
      padding: 15px;
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      letter-spacing: 1px;
    }
    nav {
      display: flex;
      justify-content: center;
      background: #222;
    }
    nav a {
      color: white;
      text-decoration: none;
      padding: 14px 20px;
      display: block;
      transition: 0.3s;
    }
    nav a:hover {
      background: #cc0000;
    }
    .container {
      width: 90%;
      margin: 20px auto;
    }
    h2 {
      color: #cc0000;
      margin-bottom: 15px;
    }
    .news-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }
    .news-card {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 8px rgba(0,0,0,0.2);
      transition: transform 0.2s ease-in-out;
      cursor: pointer;
    }
    .news-card:hover {
      transform: scale(1.03);
    }
    .news-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .news-content {
      padding: 15px;
    }
    .news-content h3 {
      margin: 0;
      color: #222;
    }
    .news-content p {
      color: #555;
      margin: 10px 0 0;
      font-size: 15px;
    }
    footer {
      background: #222;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 30px;
    }
  </style>
  <script>
    function redirectTo(page){
      window.location.href = page;
    }
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
    <h2>🌍 World News</h2>
    <div class="news-grid">
 
      <div class="news-card" onclick="redirectTo('article.php?id=1')">
        <img src="https://cdn.cnn.com/cnnnext/dam/assets/230101123456-world1.jpg" alt="News">
        <div class="news-content">
          <h3>Global Leaders Meet for Climate Summit</h3>
          <p>World leaders gathered today to discuss urgent climate change action in New York...</p>
        </div>
      </div>
 
      <div class="news-card" onclick="redirectTo('article.php?id=2')">
        <img src="https://cdn.cnn.com/cnnnext/dam/assets/230101987654-world2.jpg" alt="News">
        <div class="news-content">
          <h3>Peace Talks Resume in Conflict Region</h3>
          <p>Efforts for peace continue as international mediators work towards stability...</p>
        </div>
      </div>
 
      <div class="news-card" onclick="redirectTo('article.php?id=3')">
        <img src="https://cdn.cnn.com/cnnnext/dam/assets/230102111111-world3.jpg" alt="News">
        <div class="news-content">
          <h3>Global Economy Faces New Challenges</h3>
          <p>Experts warn of inflation and supply chain issues affecting multiple regions...</p>
        </div>
      </div>
 
    </div>
  </div>
 
  <footer>
    &copy; 2025 CNN Clone - All Rights Reserved
  </footer>
 
</body>
</html>
