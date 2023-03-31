<?php
require 'connec.php';
$pdo = new \PDO(DSN, USER, PASS);
if(isset($_POST['insert'])){
$firstName = trim($_POST['firstname']);
$lastName = trim($_POST['lastname']);

$query = 'INSERT INTO friends (first_Name, last_Name) VALUES(:firstName, :lastName)';
$statement = $pdo->prepare($query);

$statement->bindValue(':firstName', $firstName, \pdo :: PARAM_STR);
$statement->bindValue(':lastName', $lastName, \pdo :: PARAM_STR);

$statement->execute();

header("location: index.php");


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index.php</title>
</head>
<body>
    <div>
<?php $query =" SELECT * FROM friends";
$statement = $pdo->query($query);
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($friends as $friend){
    echo $friend['first_Name'] . ' ' . $friend['last_Name'];?><br><br><?php
} ?>
</div>
<form action="index.php" method="post">
<div>
    <label for="firstname">Prenom :</label><br>
    <input type="text" id="firstname" name="firstname"><br><br>
</div>

<div>
    <label for="lastname">Nom :</label><br>
    <input type="text" id="lastname" name="lastname"><br><br>
</div>
<input type="submit" value="Envoyer" name='insert'>

</form> 
   
</body>
</html>
