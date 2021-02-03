<?php

require 'db.php';

$getDate = $_GET['date'];

$statistics = R::getAll("SELECT id, room, DATE(`start`) as DateStart, TIME(`start`) as TimeStart, DATE(`end`) as DateEnd, TIME(`end`) as TimeEnd, work, bed, towels, score FROM `statistics` WHERE DATE(start) = ? AND NOT `work` IN ('0')", [$getDate]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Список всех работ</title>
</head>
<body>

<div class="container">
	<table class="table table-bordered mt-2 mb-2">
	  <thead>
	    <tr class="table-dark">
	      <th scope="col">Номер</th>
	      <th scope="col">Категория номера</th>
	      <th scope="col">Тип уборки</th>
	      <th scope="col">Начало уборки</th>
	      <th scope="col">Конец уборки</th>
	      <th scope="col">Сумма за уборку</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($statistics as $statistic): ?>
	    <tr id="tableDay">
	      <th scope="row"><?=$statistic['id']?></th>
	      <td><?=$statistic['room']?></td>
	      <td>
			<?php 
				if($statistic['bed'] == 1 && $statistic['towels'] == 0) {
					$bed = 'смена белья';
					echo $bed;
				}
				else if($statistic['towels'] == 1 && $statistic['bed'] == 0) {
					$towels = 'полотенец';
					echo $towels;
				}
				else if($statistic['bed'] == 1 && $statistic['towels'] == 1) {
					$bed = 'смена белья';
					$towels = 'полотенец';
					echo $bed .', '.$towels;
				}
				else {
					$nowork = 'уборки не было';
					echo $nowork;
				}
			?>      	
	      </td>
	      <td><?=$statistic['TimeStart']?></td>
	      <td><?=$statistic['TimeEnd']?></td>
	      <td id="scoreDay">
	      	<?php
	      		$bed = 30;
				$towels = 10;
	      		if($statistic['bed'] == 1 && $statistic['towels'] == 1) {
					$sum = $statistic['score'] + $bed + $towels;
				}
				else {
					$sum = $statistic['score'];
				}
				echo $sum;	
	      	?>	      	
	      </td>
	    </tr>
		<?php endforeach; ?>
	    <tr>
	      <td id="summOfDay" class="table-dark" colspan="6"></td>
	    </tr>
	  </tbody>
	</table>	
</div>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>	