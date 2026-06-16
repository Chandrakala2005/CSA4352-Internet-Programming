<?php
$conn = mysqli_connect("localhost","root","","hospital_system");

if(!$conn)
{
    die("Database Connection Failed");
}

// Registration
if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($conn,"INSERT INTO users(name,email,password)
    VALUES('$name','$email','$password')");
    echo "<h3>Registration Successful!</h3>";
}

// Login
if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email' AND password='$password'");

    if(mysqli_num_rows($result)>0)
        echo "<h3>Login Successful!</h3>";
    else
        echo "<h3>Invalid Login!</h3>";
}

// Hospital Search
if(isset($_POST['search']))
{
    $location = $_POST['location'];

    $result = mysqli_query($conn,
    "SELECT * FROM hospitals WHERE location LIKE '%$location%'");

    echo "<h2>Hospital List</h2>";

    while($row = mysqli_fetch_assoc($result))
    {
        echo "Hospital Name: ".$row['hospital_name']."<br>";
        echo "Speciality: ".$row['speciality']."<br>";
        echo "Location: ".$row['location']."<br>";
        echo "<a href='".$row['google_map']."'>Google Map</a><br><hr>";
    }
}

// Appointment Booking
if(isset($_POST['book']))
{
    $user_id = $_POST['user_id'];
    $doctor_id = $_POST['doctor_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    mysqli_query($conn,
    "INSERT INTO appointments(user_id,doctor_id,appointment_date,appointment_time,status)
    VALUES('$user_id','$doctor_id','$date','$time','Booked')");

    echo "<h3>Appointment Booked Successfully!</h3>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Hospital Appointment System</title>
<style>
body{
    font-family:Arial;
    background:#f2f2f2;
    padding:20px;
}
.box{
    background:white;
    padding:20px;
    margin:20px;
    border-radius:10px;
}
input{
    width:250px;
    padding:8px;
    margin:5px;
}
button{
    padding:8px 15px;
}
</style>
</head>
<body>

<h1 align="center">MedCare Hospital Appointment Booking System</h1>

<div class="box">
<h2>User Registration</h2>

<form method="post">
<input type="text" name="name" placeholder="Enter Name" required><br>
<input type="email" name="email" placeholder="Enter Email" required><br>
<input type="password" name="password" placeholder="Enter Password" required><br>
<button type="submit" name="register">Register</button>
</form>
</div>

<div class="box">
<h2>User Login</h2>

<form method="post">
<input type="email" name="email" placeholder="Enter Email" required><br>
<input type="password" name="password" placeholder="Enter Password" required><br>
<button type="submit" name="login">Login</button>
</form>
</div>

<div class="box">
<h2>Search Hospital</h2>

<form method="post">
<input type="text" name="location"
placeholder="Enter Location" required><br>
<button type="submit" name="search">Search</button>
</form>
</div>

<div class="box">
<h2>Book Appointment</h2>

<form method="post">
<input type="number" name="user_id"
placeholder="User ID" required><br>

<input type="number" name="doctor_id"
placeholder="Doctor ID" required><br>

<input type="date" name="date" required><br>

<input type="time" name="time" required><br>

<button type="submit" name="book">
Book Appointment
</button>
</form>
</div>

</body>
</html>