<?php

$USER='id20120100_abd';
$PASS = '6rtf@XfR[6D+jrK';

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=id20120100_base_air_plane;charest=utf8',$USER ,$PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "";
    }
    catch (PDOException $e)
    {
       echo $e;
    }

?>
