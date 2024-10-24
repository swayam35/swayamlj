<?php
session_start();

// Page Title
$pageTitle = 'Submit Problem';

// Includes
include "connect.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
include "Includes/functions/functions.php";
?>

<section class="contact-section" id="submit-problem">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 sm-padding">
                <div class="contact-info">
                    <h2>Submit a Problem</h2>
                    <p>If you're facing an issue, please use the form below to report the problem. We value your feedback.</p>
                </div>
            </div>

            <div class="col-lg-6 sm-padding">
                <div class="contact-form">
                    <form action="#submit-problem" method="POST">
                        <div class="form-group colum-row row">
                            <div class="col-sm-6">
                                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" name="problem_type" class="form-control" placeholder="Problem Type" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="message" cols="30" rows="5" class="form-control message" placeholder="Please describe the issue you're facing" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" name="submit_problem" class="contact_send_btn">Submit Problem</button>
                            </div>
                        </div>
                    </form>

                    <?php
                    // Handle form submission
                    if (isset($_POST['submit_problem']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Sanitize and retrieve form data
                        $name = htmlspecialchars(trim($_POST['name']));
                        $email = htmlspecialchars(trim($_POST['email']));
                        $problem_type = htmlspecialchars(trim($_POST['problem_type']));
                        $message = htmlspecialchars(trim($_POST['message']));

                        // Prepare MySQLi query
                        $stmt = $con->prepare("INSERT INTO problems (name, email, problem_type, message) VALUES (?, ?, ?, ?)");
                        
                        if ($stmt) {
                            // Bind the parameters
                            $stmt->bind_param("ssss", $name, $email, $problem_type, $message);
                            
                            // Execute the query
                            if ($stmt->execute()) {
                                // Display success message
                                echo "<div class='alert alert-success'>Problem submitted successfully!</div>";
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

<?php
// Include Footer
include 'Includes/templates/footerr.php';
?>
