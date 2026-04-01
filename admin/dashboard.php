<?php include "../db.php"; 
$result = mysqli_query($conn, "SELECT * FROM properties ORDER BY id DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="dashbord-style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-house-chimney"></i>
            <span> MyProperties</span>
        </div>
        <ul class="menu">
            <li><a href="dashboard.php"><i class="fa-solid fa-grip"></i> Dashboard</a></li>
            <li><a href="add_properties.php"><i class="fa-solid fa-house-chimney-user"></i> Add Properties</a></li>
            <li><a href="manage_property.php"><i class="fa-solid fa-desktop"></i> Manage Property</a></li>
            <li><a href="latest_msg.php"><i class="fa-solid fa-message"></i> message</a></li>
        </ul>
        <a href="#" class="login"><i class="fa-solid fa-right-from-bracket"></i> Log out</a>
    </div>
    <div class="main">
        <button class="menu-toggle" id="menuToggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="header">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass" ></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="header-right">
                <div class="profile">
                    <i class="fa-solid fa-circle-user"></i>
                    <span>Welcome, Admin</span>
                </div>
            </div>
        </div>
            <section class="stats">
            <div class="stat-box">
                <i class="fa-solid fa-house"></i>
                <h2>
                    <?php $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM properties"));
                    echo $r['total']; ?>
                </h2>
                <p>Total Properties</p>
            </div>
            <div class="stat-box">
                <i class="fa-solid fa-tags"></i>
                <h2>
                    <?php $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) As Buy FROM properties WHERE type='rent'"));
                    echo $r['Buy']; ?>
                </h2>
                <p>To Buy</p>
            </div>
            <div class="stat-box">
                <i class="fa-solid fa-key"></i>
                <h2>
                    <?php $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) As Rent FROM properties WHERE type='rent'"));
                    echo $r['Rent']; ?>
                </h2>
                <p>For Rent</p>
            </div>
            <div class="stat-box">
                <i class="fa-solid fa-envelope"></i>
                <h2><?php $r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) As message FROM messages"));
                    echo $r['message']; ?></h2>
                <p>Messages</p>
            </div>
        </section>
        <section class="listings">
            <div class="listing-container">
                <div class="heading">
                    <h1>Top Listings</h1>
                    <a href="listings.php">See More</a>
                </div>
                <div class="listing-cards">
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <div class="cards">
                        <div class="img-box">
                            <img src="../uploads/<?= $row['image']; ?>" alt="house image">
                        </div>
                        <h2><?= $row['name']; ?></h2>
                        <span><i class="fa-solid fa-location-dot"></i> <?= $row['location']; ?></span>
                        <p class="price"><i class="fa-solid fa-indian-rupee-sign"></i><?= number_format($row['price']); ?></p>
                        <div class="sell-rent">
                            <p><?= ucfirst($row['type']); ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section class="message">
            <div class="msg-container">
                <div class="heading">
                    <h1>Latest Message</h1>
                    <a href="latest_msg.php">See More</a>
                </div>
                <div class="table-container">
                    <?php 
                    $result = mysqli_query($conn ,"SELECT * FROM messages ORDER BY id DESC LIMIT 5");
                    if(mysqli_num_rows($result) > 0){ 
                        echo "
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead><tbody>
                        ";
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
                        } echo "</tbody> </table>";
                    } else{
                        echo "<p>Records are not found</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', (e) => {
            sidebar.classList.toggle('active');
            
            // Icon Animation logic
            const icon = menuToggle.querySelector('i');
            if (sidebar.classList.contains('active')) {
                icon.classList.replace('fa-bars', 'fa-times');
            } else {
                icon.classList.replace('fa-times', 'fa-bars');
            }
            e.stopPropagation();
        });

        // Close when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 992) {
                if (!sidebar.contains(e.target) && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    menuToggle.querySelector('i').classList.replace('fa-times', 'fa-bars');
                }
            }
        });
    </script>
</body>
</html>
