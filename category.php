<?php require_once __DIR__.'/config.php';
$slug = get_str('slug','all');
$q = get_str('q','');
$page = max(1, get_int('page',1));
$per = 8;
$offset = ($page-1)*$per;
 
// Resolve category (or 'all')
$cat = null;
if($slug !== 'all'){
  $stmt = $mysqli->prepare("SELECT id,name,slug FROM categories WHERE slug=? LIMIT 1");
  $stmt->bind_param('s',$slug);
  $stmt->execute();
  $cat = $stmt->get_result()->fetch_assoc();
  if(!$cat){ $slug = 'all'; }
}
$title = $slug==='all' ? 'All News' : $cat['name'];
 
// Build query
$where = "1=1";
$params = [];
$types = '';
if($slug!=='all'){
  $where .= " AND a.category_id=?";
  $types .= 'i';
  $params[] = intval($cat['id']);
}
if($q!==''){
  $where .= " AND a.title LIKE ?";
  $types .= 's';
  $params[] = "%$q%";
}
$count_sql = "SELECT COUNT(*) AS cnt FROM articles a WHERE $where";
$list_sql  = "SELECT a.*, c.name AS catname, c.slug AS catslug
              FROM articles a JOIN categories c ON c.id=a.category_id
              WHERE $where
              ORDER BY a.created_at DESC
              LIMIT $per OFFSET $offset";
 
function bindAndExec($mysqli,$sql,$types,$params){
  $stmt = $mysqli->prepare($sql);
  if($types!==''){ $stmt->bind_param($types, ...$params); }
  $stmt->execute();
  return $stmt->get_result();
}
$total = bindAndExec($mysqli,$count_sql,$types,$params)->fetch_assoc()['cnt'];
$rows  = bindAndExec($mysqli,$list_sql,$types,$params);
$pages = max(1, ceil($total/$per));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo esc($title); ?> — NewsNow</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  :root{--accent:#e50914;--text:#e8eef5;--muted:#98a2b3;--card:#10131a;--soft:#141821}
  *{box-sizing:border-box} body{margin:0;background:linear-gradient(180deg,#0a0b10,#0f1117);color:var(--text);font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif}
  a{color:inherit;text-decoration:none} img{max-width:100%;display:block;border-radius:14px}
  .top{position:sticky;top:0;background:rgba(10,11,16,.75);backdrop-filter:blur(10px);border-bottom:1px solid #1e2230;z-index:20}
  .wrap{max-width:1100px;margin:0 auto;padding:14px}
  .row{display:flex;gap:12px;align-items:center;justify-content:space-between}
  .brand{display:flex;gap:10px;align-items:center;font-weight:800}
  .logo{width:30px;height:30px;background:var(--accent);display:grid;place-items:center;border-radius:8px}
  .search{display:flex;gap:8px;background:#0e1118;border:1px solid #21273a;padding:8px 10px;border-radius:12px}
  .search input{background:transparent;border:0;outline:0;color:var(--text);width:240px}
  .chips{display:flex;gap:6px;flex-wrap:wrap;margin-top:10px}
  .chip{background:#1a1f2c;border:1px solid #222a3c;padding:7px 10px;border-radius:999px;cursor:pointer}
  .title{margin:16px 0 8px 0;font-size:26px}
  .grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
  .card{background:var(--card);border:1px solid #1b2132;border-radius:16px;padding:10px}
  .meta{color:var(--muted);font-size:12px}
  .pagi{display:flex;gap:8px;justify-content:center;margin:18px 0}
  .btn{padding:8px 12px;border-radius:10px;border:1px solid #232a3d;background:#141a26;cursor:pointer}
  @media (max-width:980px){ .grid{grid-template-columns:repeat(2,1fr)} }
  @media (max-width:560px){ .grid{grid-template-columns:1fr} .search input{width:100%} }
</style>
</head>
<body>
  <div class="top">
    <div class="wrap">
      <div class="row">
        <div class="brand" role="button" onclick="go('index.php')"><div class="logo">NN</div><div>NewsNow</div></div>
        <div class="search">
          <input id="q" type="search" placeholder="Search headlines" value="<?php echo esc($q); ?>">
          <button class="chip" onclick="doSearch()">Search</button>
        </div>
      </div>
      <div class="chips">
        <?php
          $cats = $mysqli->query("SELECT id,name,slug FROM categories ORDER BY name");
          echo '<div class="chip" onclick="go(\'category.php?slug=all\')">All</div>';
          while($c = $cats->fetch_assoc()){
            $active = $slug===$c['slug'] ? 'style="background:#1f2535;border-color:#2b3550"' : '';
            echo '<div class="chip" '.$active.' onclick="go(\'category.php?slug='.esc($c['slug']).'\')">'.esc($c['name']).'</div>';
          }
        ?>
      </div>
    </div>
  </div>
 
  <div class="wrap">
    <h2 class="title"><?php echo esc($title); ?> <?php if($q!=='') echo ' — search: '.esc($q); ?></h2>
    <div class="grid">
      <?php while($a = $rows->fetch_assoc()): ?>
        <div class="card">
          <img src="<?php echo esc($a['image_url']); ?>" alt="">
          <h3 style="margin:10px 0 6px 0;line-height:1.2;font-size:18px" role="button"
              onclick="go('article.php?slug=<?php echo esc($a['slug']); ?>')"><?php echo esc($a['title']); ?></h3>
          <p style="margin:0 0 8px 0;color:#aab4c6;font-size:14px"><?php echo esc($a['summary']); ?></p>
          <div class="meta"><?php echo date('M j, Y', strtotime($a['created_at'])); ?> •
            <a href="javascript:void(0)" onclick="go('category.php?slug=<?php echo esc($a['catslug']); ?>')"><?php echo esc($a['catname']); ?></a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
 
    <div class="pagi">
      <?php
        $base = 'category.php?slug='.urlencode($slug).($q!=='' ? '&q='.urlencode($q) : '');
        if($page>1) echo '<button class="btn" onclick="go(\''.$base.'&page='.($page-1).'\')">Prev</button>';
        echo '<div class="btn">Page '.$page.' / '.$pages.'</div>';
        if($page<$pages) echo '<button class="btn" onclick="go(\''.$base.'&page='.($page+1).'\')">Next</button>';
      ?>
    </div>
  </div>
 
<script>
  function go(u){ window.location.href = u; }
  function doSearch(){
    const v = document.getElementById('q').value.trim();
    const base = new URL(window.location.href);
    base.searchParams.set('q', v);
    base.searchParams.set('page', '1');
    window.location.href = base.toString();
  }
</script>
</body>
</html>
