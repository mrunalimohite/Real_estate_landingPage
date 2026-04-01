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
    <title>Add Properties</title>
    <link rel="stylesheet" href="dashbord-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="properties">
        <a href="dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="left">
            <a href="manage_property.php" class="menage-left">Manage Property</a>
        </div>
        <h1 class="main-h1"><span>Add </span>Properties</h1>
        <form action="../api/add-property.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Property name">
            <textarea name="description" placeholder="Description"></textarea>
            <input type="text" name="location" placeholder="Location">
            <input type="text" name="city" placeholder="City">
            <select name="type">
                <option value="">Select Type</option>
                <option value="buy">For Buy</option>
                <option value="rent">For Rent</option>
            </select>
            <input type="number" name="rooms" placeholder="Rooms" required>
            <input type="number" name="bathrooms" placeholder="Bathrooms" required>
            <input type="number" name="area" placeholder="Area (sq ft)">
            <input type="number" name="price" placeholder="Price" required>
           <div class="feature">
                <label>Featured</label> <input type="checkbox" name="featured" value="1">
            </div>
            <input type="file" name="image" required>
            <button type="submit" name="submit" class="form-btn">Add Property</button>
        </form>
        
    </div>
    <script src="script.js"></script>
</body>
</html>