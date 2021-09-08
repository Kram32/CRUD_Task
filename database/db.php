<?php 

                                                                //username  pass 
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=courses_crud", "root", "");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);