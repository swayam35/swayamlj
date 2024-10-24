<?php
session_start();
include "connect.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
include "Includes/functions/functions.php";
?>

<section class="contact-section" id="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info">
                    <h2>Get in touch with us &<br>send us a message today!</h2>
                    <p>Getting dressed up and traveling with good friends makes for a shared, unforgettable experience.</p>
                    <h3>198 West 21th Street, Suite 721 <br>New York, NY 10010</h3>
                    <ul>
                        <li><span style="font-weight: bold">Email:</span> contact@varnicarrental.com</li>
                        <li><span style="font-weight: bold">Phone:</span> +88 (0) 101 0000 000</li>
                        <li><span style="font-weight: bold">Fax:</span> +88 (0) 202 0000 001</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 sm-padding">
                <div class="contact-form">
                    <form method="POST" action="#contact-us">
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="message" cols="30" rows="5" class="form-control message" placeholder="Message" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" name="submit_contact" class="contact_send_btn">Send Message</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['submit_contact']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Test input to prevent XSS
                        $name = test_input($_POST['name']);
                        $email = test_input($_POST['email']);
                        $subject = test_input($_POST['subject']);
                        $message = test_input($_POST['message']);

                        // Prepare MySQLi query
                        $stmt = $con->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");

                        if ($stmt) {
                            // Bind the parameters
                            $stmt->bind_param("ssss", $name, $email, $subject, $message);

                            // Execute the query
                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success'>Message sent successfully</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
                            }

                            // Close the statement
                            $stmt->close();
                        } else {
                            echo "<div class='alert alert-danger'>Error: " . $con->error . "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
