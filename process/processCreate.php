<?php
    require('../database/connect.php');

    $filtered = array(
        'title' => mysqli_real_escape_string($mysqli, $_POST['title']),
        "description" => mysqli_real_escape_string($mysqli, $_POST['description']),
        "author_id" => mysqli_real_escape_string($mysqli, $_POST['author_id']),
    );

    $sql = "
        INSERT INTO topic (
            title,
            description,
            author_id,
            created
        ) VALUES (
            '{$filtered['title']}',
            '{$filtered['description']}',
            '{$filtered['author_id']}',
            NOW()
        )";
    // die($sql);
    $result = mysqli_query($mysqli, $sql);

    ini_set('display_errors', 'On');
    if( !$result ) {
        echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
        error_log(mysqli_error($mysqli));
    } else {
        // echo '성공했습니다. <a href="/">메인으로</a>';
        header('Location: /');
    }
    // echo $sql;
?>