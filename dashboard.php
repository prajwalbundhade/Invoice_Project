<?php
include 'dbconn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Custom Css -->
    <style>
    a {
        text-decoration: none !important;
    }
    </style>
    <link rel="stylesheet" href="assets/css/dash_style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</head>

<body>

    <section id="sidebar">
        <a href="dashboard.php" class="brand">
            <i class="fa fa-solid fa-hand-holding-dollar"></i>
            <span class="text">My Jwellery</span>
        </a>
        <ul class="side-menu top Dashboard">
            <li class="active">
                <a href="dashboard.php">
                    <i class="fa fa-solid fa-house"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="new_bill.php">
                    <i class="fa-solid fa fa-plus"></i>
                    <span class="text">New Bill</span>

                </a>

            </li>
            <li>
                <a href="">
                    <i class="fa-solid fa fa-money-bill-1"></i>
                    <span class="text">Show Bill</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa fa-indian-rupee-sign"></i>
                    <span class="text">Sales</span>
                </a>
            </li>

        </ul>


    </section>

    <!-- Left Sidebar End -->

    <!--  -->
    <section id="content">
        <!-- navbar end -->
        <nav>
            <a href="#" class="nav-link"></a>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class="fa fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>



            <!-- profile -->
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>

            </a>
            <ul class="dropdown-menu dropdown-menu-end">


                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                    </a>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="logout.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- navbar end  -->
        <main>

            <div class="item-container">
                <ul class="box-info">
                    <li>
                        <i class="fa-solid fa fa-indian-rupee-sign"></i>
                        <span class="text">
                            <?php

                       $select_query = "SELECT SUM(total_amount_after_taxes) AS total_sales FROM final_bill";
                       $result = mysqli_query($conn, $select_query);

                       if ($result && mysqli_num_rows($result) > 0) {
                           $row = mysqli_fetch_assoc($result);
                           $totalSales = $row["total_sales"];
                           
                           // Format the total sales amount to two decimal places
                           $formattedTotalSales = number_format($totalSales, 2);
                           
                       }


						?>
                            <h3><?php echo $formattedTotalSales ?></h3>
                            <p>Total Sales</p>
                        </span>
                    </li>
                    <li>
                        <i class="fa-solid fa fa-money-bill-1"></i>
                        <span class="text">
                            <!-- <h3>28</h3> -->
                            <p>Show Bill</p>
                        </span>
                    </li>
                    <li>
                        <a href="new_bill.php"><i class="fa-solid fa fa-plus"></i></a>
                        <span class="text">
                            <!-- <h3>43</h3> -->
                            <p>New Bill</p>
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-solid fa-address-book"></i>
                        <span class="text">
                            <!-- <h3>12</h3> -->
                            <p>Mortgage</p>
                        </span>
                    </li>

                </ul>



            </div>

        </main>

        <section class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Bill Number</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Date</th>
                <th scope="col">Description</th>
                <th scope="col">Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming you have already established a database connection

            // Modify the SQL query to fetch data from your tables using JOIN
            $sql = "SELECT
                ncd.`customer_id`,
                ncd.`name`,
                ncd.`address`,
                ncd.`date`,
                GROUP_CONCAT(pd.`description` SEPARATOR ', ') AS `description`,
                fb.`total_amount_after_taxes`
            FROM
                `new_customer_details` ncd
            LEFT JOIN
                `final_bill` fb ON ncd.`customer_id` = fb.`customer_id`
            LEFT JOIN
                `product_details` pd ON ncd.`customer_id` = pd.`customer_id`
            GROUP BY
                ncd.`customer_id`";  // Modify table and column names as needed

            $result = mysqli_query($conn, $sql);

            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><b><?php echo $row['customer_id']; ?></b></td> <!-- Customer ID as Bill Number -->
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['total_amount_after_taxes']; ?></td>
                    <td><a href="view.php?customer_id=<?php echo $row['customer_id']; ?>"
                            class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <!-- edit bill  -->
                            <a href="update_bill.php?customer_id=<?php echo $row['customer_id']; ?>"
                            class="btn btn-danger"><i class="fa fa-edit"></i></a>
                    </td>
                            
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</section>







        <!-- Javascript -->
        <script src="script.js"></script>

        <script src="https://kit.fontawesome.com/f2786c0b81.js" crossorigin="anonymous"></script>
</body>

</html>