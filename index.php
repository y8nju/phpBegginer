<?php require("layout/header.php")?>
<?php 
  require('database/connect.php');

  $sql = "SELECT * FROM topic";
  $result = mysqli_query($mysqli, $sql);
  $list = '';
  while ($row = mysqli_fetch_array($result)) {
    $escaped_title = htmlspecialchars($row['title']);
    $list = $list."<li><a href=\"?id={$row['id']}\">{$escaped_title}</a></li>";
  } 

  $article = array(
    'title' => '',
    'description' => '',
    'name' => ''
  );
  $update_link = '';
  $delete_link = '';
  $author = '';

  if( isset($_GET['id']) ) {
    $filtered_id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = htmlspecialchars($row['title']);
    $article['description'] = htmlspecialchars($row['description']);
    $article['name'] = htmlspecialchars($row['name']);
    $update_link = '<a href="update.php?id='.$_GET['id'].'" role="button" class="outline contrast">update</a>';
    $delete_link = '
    <form action="process/processDelete.php" method="POST"
      onsubmit="return deleteConfirm()"
      style="display: inline-block; padding: 0;">
      <input type="hidden" name="id" value="'.$_GET['id'].'">
      <button type="submit" role="button" class="outline secondary">delete</button>
    </form>';
    $author = "<p style=\"text-align: right;\">by {$article['name']}</p>";
  }
?>
<section>
  <hgroup>
    <h1>
      <a href="/">WEB</a>
    </h1>
    <h3><a href="author.php">author</a></h3>
  </hgroup>
</section>
<div class="grid">
  <div>
    <ol><?= $list ?></ol>
    <section>
      <a href="create.php" role="button" class="outline">create</a>
      <?= $update_link ?>
      <?= $delete_link ?>
    </section>
  </div>
  <div>
    <section>
      <h2><?= $article['title'] ?></h2>
      <p style="text-align: justify;"><?= $article['description'] ?></p>
      <?= $author ?>
    </section>
  </div>
</div>
<script>
  function deleteConfirm() {
    if (confirm('정말 삭제하시겠습니까?')) {
      return true;
    } else {
      event.preventDefault();
      return false;
  }
}
</script>
<?php require("layout/footer.php")?>