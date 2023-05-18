<?php
    require('../database/connect.php');

    settype($_POST['id'], "int");

    $filtered = array(
        'title' => mysqli_real_escape_string($mysqli, $_POST['title']),
        "description" => mysqli_real_escape_string($mysqli, $_POST['description']),
        "id" => mysqli_real_escape_string($mysqli, $_POST['id']),
        'author_id' => mysqli_real_escape_string($mysqli, $_POST['author_id'])
    );

    $sql = "
        UPDATE topic
            SET
                title = '{$filtered['title']}',
                description = '{$filtered['description']}',
                author_id = '{$filtered['author_id']}'
            WHERE
                id = '{$filtered['id']}'
    ";
    // die($sql);
    $result = mysqli_query($mysqli, $sql);

    ini_set('display_errors', 'On');
    if( !$result ) {
        echo '수정하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
        error_log(mysqli_error($mysqli));
    } else {
        header('Location: /?id='.$_POST['id']);
    }
    // echo $sql;
?>