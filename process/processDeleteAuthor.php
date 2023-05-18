<?php
    require('../database/connect.php');
    settype($_POST['id'], 'int');

    $id = mysqli_real_escape_string($mysqli, $_POST['id']);

    // 사용자가 작성한 글 삭제
    $sql = "
        DELETE
            FROM topic
            WHERE author_id = {$id}
    ";
    mysqli_query($mysqli, $sql);

    // 사용자 삭제
    $sql = "
        DELETE 
            FROM author 
            WHERE id = {$id}
    ";
    $result = mysqli_query($mysqli, $sql);
    
    ini_set('display_errors', 'On');
    if( !$result ) {
        echo '삭제하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
        error_log(mysqli_error($mysqli));
    } else {
        header('Location: /author.php');
    }
?>