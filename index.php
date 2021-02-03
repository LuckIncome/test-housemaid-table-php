<?php

require 'db.php';

$statistics = R::getAll("SELECT DATE(`start`) as DateStart, TIME(`start`) as TimeStart, TIME(`end`) as TimeEnd, (SELECT SUM(work) FROM `statistics` WHERE DATE(start) = DateStart) AS sumWork, (SELECT SUM(status) FROM `statistics` WHERE DATE(start) = DateStart) AS sumStatus, (SELECT COUNT(room) FROM `statistics` WHERE DATE(start) = DateStart) AS countRoom, (SELECT DISTINCT ROUND(SUM(`score` + 40), 2) AS summ FROM `statistics` WHERE `bed` = 1 AND `towels` = 1 AND DATE(`start`) = DateStart) AS sumScore FROM `statistics` WHERE `work` IN ('0')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Отчёт по всем работам</title>
</head>
<body>

<div class="container">
	<table class="table table-bordered mt-2 mb-2">
	  <thead>
	    <tr class="table-dark">
	      <th scope="col">Дата</th>
	      <th scope="col">Начало рабочего дня</th>
	      <th scope="col">Конец рабочего дня</th>
	      <th scope="col">Кол-во генеральных уборок</th>
	      <th scope="col">Кол-во текущих уборок</th>
	      <th scope="col">Кол-во заездов</th>
	      <th scope="col">Сумма оплаты за день</th>
	    </tr>
	  </thead>
	  <tbody>

		<?php foreach ($statistics as $statistic): ?> 	  					  			
			<tr id="tableMonth">
				<th scope="row">
					<a href="/page.php?date=<?=$statistic['DateStart']?>"><?=$statistic['DateStart']?></a>
	   			</th>
				<td><?=$statistic['TimeStart']?></td>
				<td><?=$statistic['TimeEnd']?></td>
				<td><?=$statistic['sumWork']?></td>
			  	<td><?=$statistic['sumStatus']?></td>
			  	<td><?=$statistic['countRoom']?></td>
			  	<td id="scoreMonth" ><?=$statistic['sumScore']?></td>
			</tr>		  						  	
		<?php endforeach; ?> 

	  	<tr>
      		<td id="summOfMonth" class="table-dark" colspan="7"></td>
	    </tr>	    
	  </tbody>
	</table>
	
</div>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>	
