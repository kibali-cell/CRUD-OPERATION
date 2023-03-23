<?php 
include ('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "select * from users where id='$id'";
    $run = mysqli_query($conn, $query);
    $data = $run -> fetch_assoc();

} else if (isset($_GET['submit'])){
    $id = $_GET['id2'];
    $oldusername=$_GET['oldusername'];
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
        $error = "Please fill al fields!";
    } else if (mysqli_num_rows($run) != 0) {
        if ($username != $oldusername){
             $error = "user exits";
        } else {
            $query = "UPDATE users 
                SET 
                username= '$username', 
                full_name='$full_name', 
                gender='$gender',
                 dateofbirth='$dateofbirth', 
                 phone_number='$phone_number',
                 nationality='$nationality', 
                 password= '$password'     
                 WHERE
                 id='$id';";
        
            if(mysqli_query($conn, $query)) {
                    $message = "DATA WAS SUCCESSFUL UPDATED!";
                    header('location: view_users.php?message='.$message.'');
            } else {
                    $error = "THERE WAS AN ERROR";
                }
        }
       
    } else {
        $query = "UPDATE users 
        SET 
        username= '$username', 
        full_name='$full_name', 
        gender='$gender',
         dateofbirth='$dateofbirth', 
         phone_number='$phone_number',
         nationality='$nationality', 
         password= '$password'     
         WHERE
         id='$id';";
        if(mysqli_query($conn, $query)) {
            $message = "DATA WAS SUCCESSFUL UPDATED!";
            header('location: view_users.php?message='.$message.'');
        } else {
            $error = "THERE WAS AN ERROR";
        }
    }
}else{
    header('location: view_users.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8">
        <title>
            UPDATE DATA
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


            <h1>Update Data.</h1>
            <a href="view_users.php"><button>View Users</button></a>
        <form action="site.php" method="get" class="form">
            <label>Username</label>
            <input type="text" name="username" value="<?php
                echo $data['username'];
            ?>"><br>
            <label>Full name</label>
            <input type="text" name="full_name" value="<?php
                echo $data['full_name'];
            ?>"><br>><br>
            <label>Gender</label><br>
            Male: <input type="radio" name="gender" value="M" checked>
            Female: <input type="radio" name="gender" value="F"><br><br>
            <label>Date of Birth</label>
            <input type="date" name="dateofbirth" value="<?php
                echo $data['dateofbirth'];
            ?>"><br>><br>
            <label>Phone Number</label>
            <input type="text" name="phone_number" value="<?php
                echo $data['phone_number'];
            ?>"><br>><br>
            <label>Nationality</label>
            <select name="nationality">
                <option><?php echo $data['nationality']; ?>"><br> </option>
                <option>Kenya<option>
                <option>Tanzania<option>
                <option>Uganda<option>
            </select><br>
            <label>Password</label>
            <input type="password" name="password"><br>
            <input type="hidden" name="oldusername" value="<?php echo $data['username'];?>">
            <input type="hidden" name="id2" value="<?php echo $data['id'];?>">
           <button name="submit">UPDATE</button>
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