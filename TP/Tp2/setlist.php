<?php
// setlist.php : affiche la liste des morceaux avec tri et recherche
require __DIR__ . '/header.php';
// if (!function_exists('dd')) {
//  function dd()
//   {
//       echo '<pre>';
//       array_map(function($x) {var_dump($x);}, func_get_args());
//       die;
//    }
//  }
// Colonnes pour le tri
$allowedCols = ['title','artist','style'];
$col = isset($_GET['sort']) && in_array($_GET['sort'], $allowedCols, true) ? $_GET['sort'] : 'title';
$dir = (isset($_GET['dir']) && strtolower($_GET['dir']) === 'desc') ? 'DESC' : 'ASC';
$nextDir = $dir === 'ASC' ? 'desc' : 'asc';

$stmt = $pdo->query("SELECT title, artist, style FROM setlist ORDER BY $col $dir");
$rows = $stmt->fetchAll();

?>
<div class="container2">
    <h2>Setlist</h2>
    <div style="margin:12px 0">
      <input id="q" type="search" placeholder="Recherche">
    </div>
    <table id="tab">
      <thead>
        <tr>
          <th><a href="?sort=title&dir=<?php echo $nextDir; ?>">Titre <?php if($col==='title') echo $dir==='ASC'?'↑':'↓'; ?></a></th>
          <th><a href="?sort=artist&dir=<?php echo $nextDir; ?>">Artiste <?php if($col==='artist') echo $dir==='ASC'?'↑':'↓'; ?></a></th>
          <th><a href="?sort=style&dir=<?php echo $nextDir; ?>">Style <?php if($col==='style') echo $dir==='ASC'?'↑':'↓'; ?></a></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($rows as $r): ?>
          <tr>
            <td><?php echo ($r['title']); ?></td>
            <td><?php echo ($r['artist']); ?></td>
            <td><?php echo ($r['style']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <script>
      const q = document.getElementById('q');
      const rows = Array.from(document.querySelectorAll('#tab tbody tr'));
      q.addEventListener('input', () => {
        const needle = q.value.toLowerCase();
        rows.forEach(tr => {
          const txt = tr.innerText.toLowerCase();
          tr.style.display = txt.includes(needle) ? '' : 'none';
        });
      });
    </script>
<?php require __DIR__ . '/footer.php'; ?>