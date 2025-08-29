<?php
// Latest news (dummy data)
$latestNews = [
  ["id" => 1, "title" => "Global Summit Highlights", "desc" => "World leaders gather to discuss climate change.", "img" => "https://via.placeholder.com/600x350"],
  ["id" => 2, "title" => "Peace Talks in Middle East", "desc" => "Progress in regional negotiations.", "img" => "https://via.placeholder.com/600x350"],
  ["id" => 3, "title" => "Champions League Final", "desc" => "Football fans await thrilling finale.", "img" => "https://via.placeholder.com/600x350"],
  ["id" => 4, "title" => "AI Breakthrough Announced", "desc" => "Next-gen AI transforming industries.", "img" => "https://via.placeholder.com/600x350"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CNN - Breaking News</title>
  <style>
    body {font-family: Arial, sans-serif;margin:0;padding:0;background:#f4f4f9;}
    header {background:#cc0000;color:#fff;padding:15px;text-align:center;font-size:28px;font-weight:bold;}
    nav {background:#222;padding:10px;text-align:center;}
    nav a {color:#fff;margin:0 15px;text-decoration:none;font-weight:bold;}
    nav a:hover {color:#ffcccb;}
    .container {width:90%;margin:20px auto;}
    h2 {color:#cc0000;margin-bottom:15px;}
    .news-grid {display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;}
    .news-card {background:#fff;padding:15px;border-radius:10px;box-shadow:0 4px 10px rgba(0,0,0,0.1);}
    .news-card img {width:100%;border-radius:10px;}
    .news-card h3 {margin:10px 0;color:#222;}
    .news-card p {color:#555;}
    .news-card button {background:#cc0000;color:#fff;padding:10px 15px;border:none;border-radius:8px;cursor:pointer;}
    .news-card button:hover {background:#a30000;}
  </style>
  <script>
    function goToArticle(id){
      window.location.href="article.php?id="+id;
    }
    function goCategory(cat){
      window.location.href="categories.php?cat="+cat;
    }
  </script>
</head>
<body>
  <header>CNN</header>
  <nav>
    <a href="index.php">Home</a>
    <a href="javascript:goCategory('World')">World</a>
    <a href="javascript:goCategory('Sports')">Sports</a>
    <a href="javascript:goCategory('Technology')">Technology</a>
    <a href="javascript:goCategory('Entertainment')">Entertainment</a>
  </nav>
  <div class="container">
    <h2>Breaking News</h2>
    <div class="news-grid">
      <?php foreach($latestNews as $news): ?>
        <div class="news-card">
          <img src="<?php echo $news['img']; ?>" alt="">
          <h3><?php echo $news['title']; ?></h3>
          <p><?php echo $news['desc']; ?></p>
          <button onclick="goToArticle(<?php echo $news['id']; ?>)">Read More</button>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
