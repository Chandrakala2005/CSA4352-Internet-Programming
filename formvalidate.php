<?php
include 'db.php';

if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $website=$_POST['website'];
    $comment=$_POST['comment'];
    $gender=$_POST['gender'];

    $sql="INSERT INTO users(name,email,website,comment,gender)
    VALUES('$name','$email','$website','$comment','$gender')";

    mysqli_query($conn,$sql);
}
?>

<!DOCTYPE html>
<html>
<head>
<title>PHP Form Validation Form</title>

<style>
body{
    font-family:Arial;
    background:#f4f7fc;
    padding:30px;
}

.container{
    width:700px;
    background:white;
    padding:30px;
    margin:auto;
    border-radius:10px;
    box-shadow:0px 0px 10px gray;
}

input,textarea{
    width:100%;
    padding:8px;
    margin-bottom:15px;
}

button{
    padding:10px 20px;
    background:blue;
    color:white;
    border:none;
    border-radius:5px;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid black;
}

th,td{
    padding:10px;
}
</style>

</head>

<body>

<div class="container">

<h2>PHP Form Validation Form</h2>

<form method="POST">

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Website</label>
<input type="text" name="website">

<label>Comment</label>
<textarea name="comment"></textarea>

<label>Gender</label><br>

<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<input type="radio" name="gender" value="Other"> Other

<br><br>

<button type="submit" name="submit">Submit</button>

</form>

<h2>Stored Records</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Website</th>
<th>Comment</th>
<th>Gender</th>
</tr>

<?php

$result=mysqli_query($conn,"SELECT * FROM users");

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['website']; ?></td>
<td><?php echo $row['comment']; ?></td>
<td><?php echo $row['gender']; ?></td>
</tr>

<?php
}
?>

</table>

</div>

</body>
</html>