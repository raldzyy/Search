<?php 
require_once 'dbconfig.php';
require_once  'models.php';



if (isset($_GET['searchBtn'])) {
	$searchforappli = searchforappli($pdo, $_GET['searchInput']);
	foreach ($searchforappli as $row) {
		echo "<tr> 
				<td>{$row['job_id']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['position']}</td>
				<td>{$row['email']}</td>
				<td>{$row['gender']}</td>
				<td>{$row['home_address']}</td>
				<td>{$row['nationality']}</td>
			  </tr>";
	}
}

if (isset($_POST['insertnewbtn'])){
    $insertppli = insertnewappli($pdo,$_POST['first_name'], $_POST['last_name'],$_POST['position'],$_POST['email'],$_POST['gender'],$_POST['home_address']
                                    ,$_POST['nationality']);
                                
        if ($insertppli){
            $_SESSION['message'] = 'Insert successfull';
            header('Location: ../index.php');
        }                                
                                
}



if (isset($_POST['editbtn'])){
    $editapplication = editappli($pdo,$_POST['first_name'], $_POST['last_name'],$_POST['position'],$_POST['email'],$_POST['gender'],$_POST['home_address']
                                    ,$_POST['nationality'] ,$_GET['job_id']);
                                
        if ($editapplication){
            $_SESSION['message'] = 'Edit successfull';
            header('Location: ../index.php');
        }                                
                                
}
if (isset($_POST['deletebtn'])){
    $deleteapplication = deleteappli($pdo, $_GET['job_id']);

    if ($deleteapplication){
        $_SESSION['message'] = 'delete successfull';
        header('Location: ../index.php');
    }
}


?>