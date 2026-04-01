<?php include "../db.php";
session_start();

if(isset($_SESSION['success'])){
    echo "<div class='toast success'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])){
    echo "<div class='toast error'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Massage</title>
    <link rel="stylesheet" href="dashbord-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="msg-container">
        <a href="dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="main-h1"><span>Latest </span>Messages</h1>
        <div class="manage">
        <?php
        $result = mysqli_query($conn , "SELECT * FROM  messages ORDER BY id DESC");
        if(mysqli_num_rows($result) > 0){
            echo "<table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name </th> 
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date-Time</th>
                    </tr>
                </thead>
            <tbody>";
            while($row = mysqli_fetch_assoc($result)){
                echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['number']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['message']}</td>
                    <td>{$row['created_at']}</td> 
                </tr>
                ";
            } echo "</tbody>
            </table> ";
        } else {
            echo "<p> No message Found";
        }
        ?>
        </div>
        
        
    </div>
</body>
</html>