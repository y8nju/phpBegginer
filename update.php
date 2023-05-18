<?php require("layout/header.php")?>
<?php
    require('database/connect.php');
    // $sql = "SELECT * FROM topic WHERE id = {$_GET['id']}";
    $filtered_id = mysqli_real_escape_string($mysqli, $_GET['id']);
    $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($result);
    $article = array(
        'title' => htmlspecialchars($row['title']),
        'description' => htmlspecialchars($row['description']),
        'author_id' => htmlspecialchars($row['author_id']),
        'name' => htmlspecialchars($row['name'])
    );

    $sql = "SELECT * FROM author";
    $result = mysqli_query($mysqli, $sql);
    $select_form = '<select name="author_id">';
    while($row = mysqli_fetch_array($result)) {
        if($row['id'] == $article['author_id']) {
            $select_form .= '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
        } else {
            $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }
    $select_form .= '</select>';
?>
<h1>UPDATE</h1>
<form action="process/processUpdate.php" method="POST">
    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
    <input type="text" name="title" placeholder="title"
        value="<?= $article['title'] ?>">
    <textarea name="description" placeholder="description" rows="5"><?= $article['description'] ?></textarea>
    <?= $select_form ?>
    <input type="submit" value="Update">
</form>
<?php require("layout/footer.php")?>