<?php
include ('connection.php');
if (isset($_GET['submit'])){
    $username = $_GET['username'];
    $full_name = $_GET['full_name'];
    $gender = $_GET['gender'];
    $dateofbirth = $_GET['dateofbirth'];
    $nationality = $_GET['nationality'];
    $password = $_GET['password'];
    $error = "";

    $query = "select * from users where username='$username'";
    $run = mysqli_query($conn, $query);

    if (empty($username) || empty($full_name) || empty($gender) || 
        empty($dateofbirth) || empty($nationality) || empty($password))
        {
        $error = "Please fill all fields!";
    } else if (mysqli_num_rows($run) != 0) {
        $error = "user exits";
    } else {
        $query = "INSERT INTO users (username, full_name, gender,
         dateofbirth, nationality, password) VALUES (
         '$username',
         '$full_name',
         '$gender',
         '$dateofbirth',
         '$nationality',
            '$password'
         );";

        if(mysqli_query($conn, $query)) {
            $message = "DATA WAS SUCCESSFUL INSERTED";
        } else {
            $error = "THERE WAS AN ERROR";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>
            Insert data to database
        </title>

        <style type="text/css">
            body {
                width: 900px;
                margin: auto;
            }
            .form {
                clear: both;
                background-color: #e5e5e5;
                width: 900px;
                height: 500px;
                padding: 20px;
                border-radius: 10px;
            }
            .form input[type="text"], .form select, .form input[type="password"], 
            .form input[type="date"] {
                width: 850px;
                padding: 10px;
                margin-bottom: 10px;
            }

            button {
                padding: 10px;
                width: 150px;
                font-weight: bold;
                font-size: 16px;
                background: black;
                border: 2px solid;
                color: white;
                cursor: pointer;
                border-radius: 20px;
            }

            button:hover {
               opacity: 0.7;
            }

            .error {
                width: 100%;
                background: red;
                color: white;
                padding: 15px;
            }

            .message {
                width: 100%;
                background: green;
                color: white;
                padding: 15px;
            }

            label {
                color: #717171;
                font-size: 17px;
            }

            a{
                float: right;
                text-decoration: none;
                font-size: 20px;
                color: black;
                margin-top: 30px;
            }

            a:hover {
                text-decoration: underline;
            }

            h1 {
                float: left;
                color: #717171;
            }

            input {
               border: 0;
                border-radius: 5px;
            }

        </style>
    </head>
    <body>


            <h1>Register.</h1>
            <a href="view_users.php"><button>View Users</button></a>
        <form action="site.php" method="get" class="form">
            <label>Username</label>
            <input type="text" name="username"><br>
            <label>Full name</label>
            <input type="text" name="full_name"><br>
            <label>Gender</label><br>
            Male: <input type="radio" name="gender" value="M" checked>
            Female: <input type="radio" name="gender" value="F"><br><br>
            <label>Date of Birth</label>
            <input type="date" name="dateofbirth"><br>
            <label>Phone Number</label>
            <input type="text" name="phone_number"><br>
            <label>Nationality</label>
            <select name="nationality">
                <option value="">--Select Nationality--</option>
                <option>Kenya<option>
                <option>Tanzania<option>
                <option>Uganda<option>
            </select><br>
            <label>Password</label>
            <input type="password" name="password"><br>
           <button name="submit">REGISTER</button>
        </form>
        <?php
            if (!empty($error)) {
                echo '
                 <div class="error">
                    <h2>
                        ' . $error .'
                    </h2>
                 </div>';
            } if (!empty($message)) {
                echo '
                <div class="message">
                    <h2>
                        ' . $message .'
                    </h2>
                 </div>';
            }
        ?>

           

    </body>
</html>