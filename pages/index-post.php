<?php
require_once __DIR__ . "/../model/posts.php";
require_once __DIR__ . "/../model/users.php";
require_once __DIR__ . "/../model/tags.php";
require_once __DIR__ . "/../model/model.php";

if (!isset($_SESSION['full_name'])) {
  echo "<script>
  window.location.href = 'login.php';
  </script>";
  exit;
}

$Users = new Users();
$Posts = new Posts();
$Tags = new Tags();
$show_tag = $Tags->show_tag();
$groupedTags = [];
foreach ($show_tag as $tag) {
  $groupedTags[$tag['post_id_pivot']][] = $tag['name_tag'];
}

$limit = 3;
$pageActive = (isset($_GET['page'])) ? ($_GET['page']) : 1;
$startData = $limit * $pageActive - $limit;
$length = count($Posts->all());
$countPage = ceil($length / $limit);
$num = ($pageActive - 1) * $limit + 1;
$Posts_detail = $Posts->all2($startData, $limit);

$prev = ($pageActive > 1) ? $pageActive - 1 : 1;
$next = ($pageActive < $countPage) ? $pageActive + 1 : $countPage;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Posts Page</title>

  <link rel="stylesheet" href="../dist/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../dist/assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../dist/assets/css/style.css">
  <link rel="stylesheet" href="../dist/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?= include "../components/layout/navbar.php" ?>
      <?= include "../components/layout/sidebar.php" ?>

      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Halaman Posts</h1>
          </div>

          <div class="section-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Tags</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($Posts_detail as $post): ?>
                  <tr>
                    <td><?= $num++ ?></td>
                    <td><?= $post['title'] ?></td>
                    <td><?= $post['full_name'] ?></td>
                    <td>
                      <?php if (isset($groupedTags[$post['id_post']])): ?>
                        <?= implode(', ', $groupedTags[$post['id_post']]) ?>
                      <?php else: ?>
                        No Tags
                      <?php endif; ?>
                    </td>
                    <td>
                      <button onclick='modalDetails("<?= $post["content"] ?>")' class="btn btn-primary btn-sm">
                        <i class="fas fa-info-circle"></i> Detail
                      </button>
                      <a href="edit-post.php?id_post=<?= $post['id_post'] ?>" class="btn btn-success btn-sm">
                        <i class="far fa-edit"></i> Edit
                      </a>
                      <a href="../services/delete-post.php?id_post=<?= $post['id_post'] ?>" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Delete
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="d-flex justify-content-center mt-4">
              <nav aria-label="Page navigation">
                <ul class="pagination">
                  <?php if ($pageActive > 1): ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= $prev ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php for ($i = 1; $i <= $countPage; $i++): ?>
                    <li class="page-item<?= ($i == $pageActive) ? ' active' : '' ?>">
                      <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php endfor; ?>
                  <?php if ($pageActive < $countPage): ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= $next ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>

          </div>

        </section>
      </div>

      <?= include "../components/layout/footer.php" ?>
    </div>
  </div>



  <script>
    function modalDetails(desc) {
      let safeDesc = $('<div>').text(desc).html();
      let content = `<ul><li><strong>Content: </strong><br>${safeDesc}</li></ul>`;
      $('#detailModal .modal-body').html(content);
      $('#detailModal').modal('show');
    }
  </script>

  <!-- Tambahkan Modal di Bawah -->
  <!-- Modal untuk Detail -->
  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Post Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Konten modal akan diisi melalui JavaScript -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Pemuatan JavaScript di akhir body -->
  <script src="../dist/assets/modules/jquery.min.js"></script>
  <script src="../dist/assets/modules/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fungsi untuk menampilkan detail dalam modal
    function modalDetails(desc) {
      let safeDesc = $('<div>').text(desc).html();
      let content = `<ul><li><strong>Content: </strong><br>${safeDesc}</li></ul>`;
      $('#detailModal .modal-body').html(content);
      $('#detailModal').modal('show');
    }
  </script>

</body>

</html>