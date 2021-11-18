<?php
    try{

    $link = pg_connect('host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf');
    }Catch (Exception $e) {
      Echo $e->getMessage();
  }