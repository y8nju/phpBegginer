<?php
    require('../database/connect.php');

    settype($_POST['id'], 'int');

    $filtered = array(
        'id' => mysqli_real_escape_string($mysqli, $_POST['id']),
        'name' => mysqli_real_escape_string($mysqli, $_POST['name']),
        "profile" => mysqli_real_escape_string($mysqli, $_POST['profile']),
    );

    $sql = "
        Update author 
            SET
                name = '{$filtered['name']}',
                profile = '{$filtered['profile']}'
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
        header('Location: /author.php?id='.$filtered['id']);
    }
    // echo $sql;
?>