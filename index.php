<?php		
require_once ("src/DataManipulation.php");
$list = []; // для вывода справочника
$dm = new DataManipulation(new JSONRepository);
$list = $dm->read(); // получаем содержимое справочника
?>

<!DOCTYPE html>
<html>
<head>
	<title>Телефонный справочник</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<base href="<?php __DIR__ ?>">
	<link rel="stylesheet" href="styles/style.css" />
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
	
</head>

<body>
	<h1>Телефонный справочник</h1>
	<div class="container">
		<div class="list" id="list"> 
		
			<?php 
			//  вывод справочника
			foreach ($list as $key => $row) {
					$keyStr = strval($key); // номер записи
					echo "<div class='row'>
					<div class='row-item'>".$row['name']."</div>
					<div class='row-item'>".$row['tel']."</div>
					<div class='row-item'><button class='del' id='".$keyStr."' >Удалить</button>
					
					</div>
					</div>";
				}
			?>
		</div>
		<div class="form">
	  
			<form action="" method="post" id="form1" >
				<label for="name">Имя</label>
				<input type="text" name="name" id="name" pattern="[A-Za-zА-Яа-яЁё]*[^;]" />
				<br>
				<label for="tel">Телефон</label>
				<input type="tel" id="tel" name="tel" pattern="[0-9\s\-]*" />
				<br>
				<button type="submit" id="submit">Добавить</button>
			</form>
		</div>
	</div>
	
	<script src="js/script.js"></script>
</body>
</html>

<?php		
// для обработки формы
if (!empty($_POST)){
var_dump($_POST);
	$currName = htmlspecialchars($_POST['name']);
	$currName = trim($currName);
	$currTel = htmlspecialchars($_POST['tel']);
	$currTel = trim($currTel);
	
	$dm = new DataManipulation(new JSONRepository);
	$dm->setRecord($currName, $currTel);
	$dm->write();
}

// для обработки кнопок
if (!empty($_GET)){
	$currIndex = $_GET['del'];
	$currIndex = (int)$currIndex;
	
	$dm = new DataManipulation(new JSONRepository);
	$dm->setIndex($currIndex);
	$dm->del();

}