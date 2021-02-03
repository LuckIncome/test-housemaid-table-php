<?php

require 'lib/rb-mysql.php';

R::setup( 'mysql:host=localhost;dbname=staff','root', 'root', false);
if(!R::testConnection()) die('No DB connection!');


?>