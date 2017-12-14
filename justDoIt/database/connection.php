<?php
  try
  {
    $conn = new PDO("sqlite:../database/clean_database.db");
  }
  catch(PDOexception $e)
  {
    die( "Connection failed: " . $e->getMessage());
  }
?>
