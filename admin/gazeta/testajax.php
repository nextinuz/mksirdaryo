<?

$host = 'localhost';
$username = 'nextin_mk';
$pass = 'ELlR%it0';
$db = 'nextin_mk';

$db = mysqli_connect($host,$username,$pass,$db);





if (isset($_POST['nashr_turi'])) {

	$query = "SELECT * FROM ".$_POST['nashr_turi'];
	$result = $db->query($query);

		file_put_contents('nashr_turi.txt', $_POST['nashr_turi']);
	$nashr_turi = file_get_contents('nashr_turi.txt');

	if ($nashr_turi == "gazeta" OR $nashr_turi == "jurnal") {
			echo '<option  selected disabled> -- tanlang -- </option>';
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.str_replace(' ' , '_', $row['nomi']).'>'.$row['nomi'].'</option>';
		 }

	}else{

		echo '<option>No State Found!</option>';
	}

} 