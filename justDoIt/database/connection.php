<?php

  try
  {
    $conn = new PDO("sqlite:../database/database.db");
  }   
    catch(PDOexception $e)
    {
      die( "Connection failed: " . $e->getMessage());
    }

?>