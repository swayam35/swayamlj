<?php 
    #PHP INCLUDES
    include "connect.php";
    include "Includes/templates/header.php";
    include "Includes/templates/navbar.php";
?>

<!-- Home Section -->
<section class="home_section">
    <div class="section-header">
        <div class="section-title" style="font-size:50px; color:white">
            Find Best Car & Limousine
        </div>
    </div>
</section>

<!-- Our Services Section -->
<section class="our-services" id="services">
    <div class="container">
        <div class="section-header">
            <div class="section-title">
                What Services we offer to our clients
            </div>
            <hr class="separator">
            <div class="section-tagline">
                Who are in extremely love with eco-friendly system.
            </div>
        </div>
        <div class="row">
        <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <h4>
                        <span>
                            <i class="far fa-user"></i>
                        </span>
                        Expert Technicians
                    </h4>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <h4>
                        <span>
                            <i class="fas fa-certificate"></i>
                        </span>
                        Professional Service
                    </h4>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <h4>
                        <span>
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        Great Support
                    </h4>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <h4>
                        <span>
                            <i class="fas fa-rocket"></i>
                        </span>
                        Technical Skills
                    </h4>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <h4>
                        <span>
                            <i class="fas fa-gem"></i>
                        </span>
                        Highly Recomended
                    </h4>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-feature">
                    <h4>
                        <span>
                            <i class="far fa-comments"></i>
                        </span>
                        Positive Reviews
                    </h4>
                    <p>
                        Usage of the Internet is becoming more common due to rapid advancement of technology and power.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Area Section -->
<section class="about-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 left-area" style="padding:0px">
                <img src="Design/images/911.png" alt="Car Rental Image">
            </div>
            <div class="col-md-6 right-area" style="padding:50px">
                <h1>
                    Globally Connected <br> by Large Network
                </h1>
                <p>
                    <span>We are here to listen from you deliver excellence</span>
                </p>
                <p>
                    Discover France and Europe aboard a Hertz car. Rent a Hertz car and go on an adventure! Let's go!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Brands Section -->
<section class="our-brands" id="brands">
    <div class="container">
        <div class="section-header">
            <div class="section-title">
                First Class Car Rental & Limousine Services
            </div>
            <hr class="separator">
            <div class="section-tagline">
                We offer professional car rental & limousine services in our range of high-end vehicles
            </div>
        </div>
        <div class="car-brands">
            <div class="row">
                <?php
                // MySQLi query
                $stmt = $con->prepare("SELECT * FROM car_brands");
                $stmt->execute();
                $result = $stmt->get_result(); // get result set

                while ($car_brand = $result->fetch_assoc()) {
                    $car_brand_img = "admin/Uploads/images/" . $car_brand['brand_image'];
                ?>
                    <div class="col-md-4">
                        <div class="car-brand" style="background-image: url(<?php echo $car_brand_img; ?>);">
                            <div class="brand_name">
                                <h3><?php echo $car_brand['brand_name']; ?></h3>
                            </div>
                        </div>
                    </div>
                <?php
                }

                // Free result and close statement
                $stmt->close();
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<section class="widget_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="footer_widget">
                    <a class="navbar-brand" href="">
                        <span style="color:white">varni CarRental</span>
                    </a>
                    <p>
                        Getting dressed up and traveling with good friends makes for a shared, unforgettable experience.
                    </p>
                    <ul class="widget_social">
                        <!-- Social links -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="footer_widget">
                    <h3>Contact Info</h3>
                    <ul class="contact_info">
                        <li><i class="fas fa-map-marker-alt"></i>savy strata sanand chokdi</li>
                        <li><i class="far fa-envelope"></i>varni@car-rental.com</li>
                        <li><i class="fas fa-mobile-alt"></i>+9537005612</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="footer_widget">
                    <h3>Newsletter</h3>
                    <p style="margin-bottom:0px">Don't miss a thing! Sign up to receive daily deals</p>
                    <div class="subscribe_form">
                        <form action="" method="POST" novalidate="true">
                            <input type="email" name="email" id="subs-email" class="form_input" placeholder="Email Address..." required>
                            <button type="submit" name="subscribe" class="submit">SUBSCRIBE</button>
                            
                        </form>

                        <?php
                        if (isset($_POST['subscribe']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                            // Sanitize email input
                            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

                            // Validate email address
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                echo "<div class='alert alert-danger'>Invalid email format</div>";
                            } else {
                                // Check if the email already exists
                                $checkStmt = $con->prepare("SELECT * FROM subscribers WHERE email = ?");
                                $checkStmt->bind_param("s", $email);
                                $checkStmt->execute();
                                $checkStmt->store_result();

                                if ($checkStmt->num_rows > 0) {
                                    echo "<div class='alert alert-warning'>This email is already subscribed.</div>";
                                } else {
                                    // Prepare and execute insert query
                                    $stmt = $con->prepare("INSERT INTO subscribers (email) VALUES (?)");
                                    $stmt->bind_param("s", $email);
                                    if ($stmt->execute()) {
                                        echo "<div class='alert alert-success'>Successfully subscribed to the newsletter</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
                                    }
                                    $stmt->close();
                                }

                                $checkStmt->close();
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BOTTOM FOOTER -->
<?php include "Includes/templates/footer.php"; ?>
