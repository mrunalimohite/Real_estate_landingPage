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
    <title>Manage Properties</title>
    <link rel="stylesheet" href="dashbord-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <div class="manage-details">
        <a href="dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <h1 class="main-h1"><span>Manage </span>Properties Details</h1>
        <div class="left">
            <a href="add_properties.php" class="menage-left">Add Property</a>
        </div>
        <div class="manage">
        <?php
        $result = mysqli_query($conn , "SELECT * FROM  properties ORDER BY id DESC");
        if(mysqli_num_rows($result) > 0){
            echo "<table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image </th> 
                        <th>Property Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>City</th>
                        <th>Type</th>
                        <th>Rooms</th>
                        <th>Bathrooms</th>
                        <th>Area</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <tbody>";
            while($row = mysqli_fetch_assoc($result)){
                echo "
                <tr>
                        <td>{$row['id']}</td>
                        <td>
                            <img src='../uploads/{$row['image']}' width='80' height='60'>
                        </td>
                        <td class='name'>{$row['name']}</td>
                        <td class='description'>{$row['description']}</td>
                        <td>{$row['location']}</td>
                        <td class='city'>{$row['city']}</td>
                        <td class='type'>{$row['type']}</td>
                        <td>{$row['rooms']}</td>
                        <td>{$row['bathrooms']}</td>
                        <td>{$row['area']}</td>
                        <td class='price'>{$row['price']}</td>
                        <td>
                        <div class='action-icon'>
                        <a href='update_property.php?id={$row['id']}'><i class='fa-solid fa-pen-to-square'></i>
                        <a href='delete_property.php?id={$row['id']}'><i class='fa-regular fa-trash-can'></i>
                        </div>
                        </td>
                    </tr>
                ";
            } echo "</tbody>
            </table> ";
        } else {
            echo "<p> No Property Found";
        }
        ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>