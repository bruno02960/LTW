<?php

    function checkAuthHash($AuthToken,$TokenName)
    {
        if($AuthToken==null||$TokenName==null)
        {
            return -1;
        }else
        {
            $Token = hash_hmac('sha256', $TokenName , $_SESSION['UserAuthToken']);
            if(hash_equals($Token,$AuthToken))
            {
                return 1;
            }else
            {
                return 0;
            }
        }
    }

?>