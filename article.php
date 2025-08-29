<?php require_once __DIR__.'/config.php';
$slug = get_str('slug','');
if($slug===''){ http_response_code(404); die('Article not found'); }
 
$stmt = $mysqli->prepare("SELECT a.*, c.name AS catname, c.slug AS catslug
                          FROM articles a JOIN categories c ON c.id=a.category_id
                          WHERE a.slug=? LIMIT 1");
$stmt->bind_param('s',$slug);
$stmt->execute();
$article = $stmt->get_result()->fetch_assoc();
if(!$article){ http_response_code(404); die('Article not found'); }
 
// Related (same category)
$rstmt = $mysqli->prepare("SELECT title,slug,image_url,created_at FROM articles WHERE category_id=? AND slug<>? ORDER BY created_at DESC LIMIT 4");
$rstmt->bind_param('is', $article['category_id'], $slug);
$rstmt->execute();
$related = $rstmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo esc($article['title']); ?> — NewsNow</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  :root{--accent:#e50914;--text:#e8eef5;--muted:#9aa5b5;--hr:#252c3e}
  *{box-sizing:border-box} body{margin:0;background:linear-gradient(180deg,#0a0b10,#0f1117);color:var(--text);font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif}
  a{color:inherit;text-decoration:none} img{max-width:100%;display:block;border-radius:16px}
  .wrap{max-width:880px;margin:0 auto;padding:16px}
  .top{position:sticky;top:0;background:rgba(10,11,16,.75);backdrop-filter:blur(10px);border-bottom:1px solid #1e2230;z-index:20}
  .row{display:flex;gap:12px;align-items:center;justify-content:space-between;padding:10px 16px}
  .brand{display:flex;gap:10px;align-items:center;font-weight:800}
  .logo{width:30px;height:30px;background:var(--accent);display:grid;place-items:center;border-radius:8px}
  .crumbs{color:#b6c0d4;font-size:13px;margin:16px 0}
  .title{font-size:34px;line-height:1.15;margin:6px 0 10px 0}
  .meta{color:var(--muted);font-size:13px;margin-bottom:12px}
  .content{background:#11141c;border:1px solid #1b2132;border-radius:18px;padding:16px}
  .content p{line-height:1.7;color:#d7deea}
  .rel{margin:18px 0}
  .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
  .card{background:#121622;border:1px solid #1b2132;border-radius:16px;padding:10px}
  hr{border:0;border-top:1px solid var(--hr);margin:16px 0}
  @media (max-width:900px){ .grid{grid-template-columns:repeat(2,1fr)} .title{font-size:28px} }
  @media (max-width:520px){ .grid{grid-template-columns:1fr} }
  .btn{padding:8px 12px;border-radius:10px;border:1px solid #232a3d;background:#141a26;cursor:pointer}
</style>
</head>
<body>
  <div class="top">
    <div class="row">
      <div class="brand" role="button" onclick="go('index.php')"><div class="logo">NN</div><div>NewsNow</div></div>
      <div>
        <button class="btn" onclick="go('category.php?slug=<?php echo esc($article['catslug']); ?>')">More in <?php echo esc($article['catname']); ?></button>
      </div>
    </div>
  </div>
 
  <div class="wrap">
    <div class="crumbs">
      <a href="javascript:void(0)" onclick="go('index.php')">Home</a> ›
      <a href="javascript:void(0)" onclick="go('category.php?slug=<?php echo esc($article['catslug']); ?>')"><?php echo esc($article['catname']); ?></a>
    </div>
 
    <h1 class="title"><?php echo esc($article['title']); ?></h1>
    <div class="meta"><?php echo date('M j, Y', strtotime($article['created_at'])); ?> • Category: <?php echo esc($article['catname']); ?></div>
 
    <?php if(!empty($article['image_url'])): ?>
      <img src="<?php echo esc($article['image_url']); ?>" alt="" style="margin:8px 0 12px 0">
    <?php endif; ?>
 
    <div class="content">
      <p style="font-weight:600;color:#cfd8ea"><?php echo esc($article['summary']); ?></p>
      <hr>
      <p><?php echo nl2br(esc($article['content'])); ?></p>
    </div>
 
    <div class="rel">
      <h3 style="margin:14px 0">Related</h3>
      <div class="grid">
        <?php while($r = $related->fetch_assoc()): ?>
          <div class="card">
            <img src="<?php echo esc($r['image_url']); ?>" alt="">
            <h4 style="margin:8px 0;font-size:16px" role="button"
                onclick="go('article.php?slug=<?php echo esc($r['slug']); ?>')"><?php echo esc($r['title']); ?></h4>
            <div style="color:#9fb0c9;font-size:12px"><?php echo date('M j, Y', strtotime($r['created_at'])); ?></div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
 
    <div style="display:flex;gap:10px;margin:16px 0">
      <button class="btn" onclick="history.back()">◀ Back</button>
      <button class="btn" onclick="go('index.php')">Home</button>
    </div>
  </div>
 
<script>
  function go(u){ window.location.href = u; }
</script>
</body>
</html>
 
