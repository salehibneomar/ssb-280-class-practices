<?php
    date_default_timezone_set('Asia/Dhaka');
    
    include 'conn.php';

    $GLOBALS['succMsgTitle'] = 'Success&ensp;<i class="check green icon"></i>';
    $GLOBALS['errMsgTitle']  = 'Error&ensp;<i class="times red icon"></i>';

    function operationMessage($msgTitle, $msgDetails){
        $msg = '<div class="header">'.$msgTitle.'</div><div class="content">
            <p>'.$msgDetails.'</p>
        </div>
        <div class="actions">
            <div class="ui cancel blue button cancel-btn">Okay</div>
        </div>';

        return $msg;
    }

    
?>