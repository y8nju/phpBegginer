<?php require("layout/header.php")?>
<?php require('database/connect.php'); ?>
<section>
    <hgroup>
    <h1>AUTHOR</h1>
    <h3><a href="/">WEB</a></h3>
    </hgroup>
</section>
<div class="grid">
  <div>
    <table role="grid">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>profile</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM author";
                $result = mysqli_query($mysqli, $sql);
                $list = '';
                while ($row = mysqli_fetch_array($result)) {
                    $filtered = array(
                        'id' => htmlspecialchars($row['id']),
                        'name' => htmlspecialchars($row['name']),
                        'profile' => htmlspecialchars($row['profile']),
                    );
            ?>
            <tr onClick="location.href='/author.php?id=<?= $filtered['id'] ?>'"
                style="cursor: pointer;">
                <td><?= $filtered['id'] ?></td>
                <td><?= $filtered['name'] ?></td>
                <td><?= $filtered['profile'] ?></td>
            </tr>
            <?php 
                } 
            ?>
        </tbody>
    </table>
  </div>
  <div>
    <?php
        $authorInfo = array(
            'name' => '',
            'profile' => ''
        );
        $lable_submit = 'Create';
        $form_action = 'process/processCreateAuthor.php';
        $form_id = '';
        $delete_link = '';
        $create_link = '';

        if(isset($_GET['id'])) {
            $filtered_id = mysqli_real_escape_string($mysqli, $_GET['id']);
            settype($filtered_id, 'int');
            $sql = "SELECT * FROM author where id = {$filtered_id}";
            $result = mysqli_query($mysqli, $sql);
            $row = mysqli_fetch_array($result);
            $authorInfo['name'] = htmlspecialchars($row['name']);
            $authorInfo['profile'] = htmlspecialchars($row['profile']);
            $lable_submit = 'Update';
            $form_action = 'process/processUpdateAuthor.php';
            $form_id = '<input type="hidden" name="id" value="'.$filtered_id.'">';

            // delete Button
            $delete_link = '
            <form action="process/processDeleteAuthor.php" method="POST"
                onsubmit="return deleteConfirm()"
                style="padding: 0;">
                <input type="hidden" name="id" value="'.$filtered_id.'">
                <button type="submit" class="outline secondary">delete</button>
            </form>';

            $create_link = '<button onClick="location.href=\'/author.php\'" class="secondary" role="button">Create</button>';
        }
    ?>
    <form action="<?= $form_action ?>" method="POST" style="margin-bottom: 0;">
        <?= $form_id ?>
        <input type="text" name="name" placeholder="name" value="<?= $authorInfo['name'] ?>">
        <textarea name="profile" rows="2" placeholder="profile"><?= $authorInfo['profile'] ?></textarea>
        <input type="submit" class="outline" value="<?= $lable_submit ?> Author">
    </form>
    <?= $delete_link ?>
    <?= $create_link  ?>
    
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