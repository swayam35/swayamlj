<?php
// Include database connection
include "connect.php";
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";

// Check if form is submitted
if (isset($_POST['reserve_car'])) {
    // Sanitize user inputs
    $pickup_location = filter_var(trim($_POST['pickup_location']), FILTER_SANITIZE_STRING);
    $return_location = filter_var(trim($_POST['return_location']), FILTER_SANITIZE_STRING);
    $pickup_date = $_POST['pickup_date']; // Assume date is properly validated
    $return_date = $_POST['return_date']; // Assume date is properly validated

    // Perform validation
    if (empty($pickup_location) || empty($return_location) || empty($pickup_date) || empty($return_date)) {
        echo "<div class='alert alert-danger'>All fields are required.</div>";
    } else {
        // Prepare SQL statement using MySQLi
        $stmt = $con->prepare("INSERT INTO reservations (pickup_location, return_location, pickup_date, return_date) VALUES (?, ?, ?, ?)");

        // Bind parameters to the statement
        $stmt->bind_param("ssss", $pickup_location, $return_location, $pickup_date, $return_date);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: reserve.php?message=Reservation+successful");
            exit();
        } else {
            header("Location: reserve.php?error=Reservation+failed");
            exit();
        }
        

        // Close the statement
        $stmt->close();
    }
}
?>


<section class="reservation_section" style="padding:50px 0px" id="reserve">
	<div class="container">
		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-7">
            <form method="POST" action="reserve.php" class="car-reservation-form" id="reservation_form" v-on:submit="checkForm">

					<div class="text_header">
						<span>Find your car</span>
					</div>
					<div>
						<div class="form-group">
							<label for="pickup_location">Pickup Location</label>
							<input type="text" class="form-control" name="pickup_location" placeholder="34 Mainfield Road" v-model="pickup_location" required>
							<div class="invalid-feedback" style="display:block" v-if="pickup_location === null">
								<!-- Pickup location is required -->
							</div>
						</div>
						<div class="form-group">
							<label for="return_location">Return Location</label>
							<input type="text" class="form-control" name="return_location" placeholder="34 Mainfield Road" v-model="return_location" required>
							<div class="invalid-feedback" style="display:block" v-if="return_location === null">
								<!-- Return location is required -->
							</div>
						</div>
						<div class="form-group">
							<label for="pickup_date">Pickup Date</label>
							<input type="date" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>" name="pickup_date" class="form-control" v-model="pickup_date" required>
							<div class="invalid-feedback" style="display:block" v-if="pickup_date === null">
								<!-- Pickup date is required -->
							</div>
						</div>
						<div class="form-group">
							<label for="return_date">Return Date</label>
							<input type="date" min="<?php echo date('Y-m-d', strtotime('+2 day')) ?>" name="return_date" class="form-control" v-model="return_date" required>
							<div class="invalid-feedback" style="display:block" v-if="return_date === null">
								<!-- Return date is required -->
							</div>
						</div>
						<!-- Submit Button -->
						<button type="submit" action="reserve.php" class="btn sbmt-bttn" name="reserve_car">Book Instantly</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
new Vue({
    el: "#reservation_form",
    data: {
        pickup_location: '',
        return_location: '',
        pickup_date: '',
		return_date: ''
    },
    methods:{
        checkForm: function(event){
            let isValid = true;

            if (!this.pickup_location) {
                this.pickup_location = null;
                isValid = false;
            }

            if (!this.return_location) {
                this.return_location = null;
                isValid = false;
            }

            if (!this.pickup_date) {
                this.pickup_date = null;
                isValid = false;
            }

			if (!this.return_date) {
                this.return_date = null;
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        }
    }
});
</script>
<script>
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    fetch('contact.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
      .then(data => {
        if (data.success) {
            form.reset();
            document.getElementById('responseMessage').innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
        } else {
            document.getElementById('responseMessage').innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    }).catch(error => {
        document.getElementById('responseMessage').innerHTML = '<div class="alert alert-danger">Error: ' + error.message + '</div>';
    });
});
</script>

