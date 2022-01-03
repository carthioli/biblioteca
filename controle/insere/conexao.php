<?php
    
    try {
      //$link = pg_connect("host=localhost port=2408 dbname=biblioteca user=postgres password=24082015");
      //$link = pg_connect("host=127.0.0.1 port=5432 dbname=biblioteca user=postgres password=@1234bf");
	    $link = pg_connect("host=127.0.0.1 port=5432 dbname=biblioteca user=carlos password=12345");
      return $link;
    } 
    catch (Exception $e) 
    {
      echo $e->getMessage();
    }
    catch (Erro $e)
    {
      echo $e->getMessage();
    }
