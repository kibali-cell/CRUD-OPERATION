<?php
    include "connection.php";
    $query = "select * from users";
    $run = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
         body {
                width: 900px;
                margin: auto;
            }
         h1 {
                color: #717171;
                
            }
            table {
                border-collapse: collapse;
                width: 800px;
                border-radius: 20px;
            }

            table td, table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            table tr:nth-child(even){
                background-color: #f2f2f2;
            }

            table tr :hover {
                background-color: #04aa6d;
            }

            table th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: black;
                color: white;
            }

            button {
                padding: 10px;
                width: 80px;
                font-weight: bold;
                font-size: 16px;
                opacity: 0.7;
                border: 2px solid;
                cursor: pointer;
                border-radius: 20px;
                margin: 5px;
            }

            button:hover {
                color: white;
                background: black;
            }

            h2 {
                padding: 20px;
                width: 200px;
                height: 30px;
                font-weight: bold;
                font-size: 22px;
                background: black;
                border: 2px solid;
                color: white;
                cursor: pointer;
                border-radius: 10px;   
            }

    </style>
</head>
<body>
    <h1>VIEW AND MANAGE USERS</h1>
    <table border="1" cellpadding="10px" cellspacing="0">
        <tr>
            <th>Username</th>
            <th>Full name</th>
            <th>D.O.B</th>
            <th>Gender</th>
            <th>Operation</th>
        </tr>
    
    <?php
        while($data = $run->fetch_assoc()) {
            echo "<tr>
                    <td>" . $data['username']. "</td>
                    <td>" . $data['full_name']. "</td>
                    <td>" . $data['dateofbirth']. "</td>
                    <td>" . $data['gender']. "</td>
                    <td>".
                    "<a href='edit_user.php?id=".$data['id']."' ><button>Edit</button></a>
                    <a href='delete_user.php?id=".$data['id']."' ><button>Delete</button></a>
                    </td>";
        }
    ?>
    </table>

    <?php
            if (isset($_GET['error'])) {
                echo '
                 <div class="error">
                    <h2>
                       There was an error
                    </h2>
                 </div>';
            } if (isset($_GET['message'])) {
                echo '
                <div class="message">
                    <h2>
                        ' . $_GET['message'] .'
                    </h2>
                 </div>';
            }
        ?>
</body>
</html>