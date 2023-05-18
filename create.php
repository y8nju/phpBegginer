<?php require("layout/header.php")?>
<?php
    require('database/connect.php');
    $sql = "SELECT * FROM author";
    $result = mysqli_query($mysqli, $sql);
    $select_form = '<select name="author_id">';
    while($row = mysqli_fetch_array($result)) {
        $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
    $select_form .= '</select>';
?>
<h1>CREATE</h1>
<form action="process/processCreate.php" method="POST">
    <input type="text" name="title" placeholder="title">
    <textarea name="description" placeholder="description" rows="5"></textarea>
    <?= $select_form ?>
    <input type="submit" value="Create">
</form>
<?php require("layout/footer.php")?>