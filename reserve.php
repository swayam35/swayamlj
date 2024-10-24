<?php
session_start();
include "connect.php"; // Ensure your database connection is properly set
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
include "Includes/functions/functions.php";

// Initialize pickup_date and return_date
$pickup_date = isset($_SESSION['pickup_date']) ? $_SESSION['pickup_date'] : null;
$return_date = isset($_SESSION['return_date']) ? $_SESSION['return_date'] : null;

// Check if form for reserving a car is submitted
if (isset($_POST['reserve_car']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['pickup_location'] = test_input($_POST['pickup_location']);
    $_SESSION['return_location'] = test_input($_POST['return_location']);
    $_SESSION['pickup_date'] = test_input($_POST['pickup_date']);
    $_SESSION['return_date'] = test_input($_POST['return_date']);
}
?>

<!-- BANNER SECTION -->
<div class="reserve-banner-section">
    <h2>Reserve your car</h2>
</div>

<!-- CAR RESERVATION SECTION -->
<section class="car_reservation_section">
    <div class="container">
        <?php
        // Handle reservation submission
        if (isset($_POST['submit_reservation']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $selected_car = $_POST['selected_car'];
            $full_name = test_input($_POST['full_name']);
            $client_email = test_input($_POST['client_email']);
            $client_phonenumber = test_input($_POST['client_phonenumber']);
            $pickup_location = $_SESSION['pickup_location'];
            $return_location = $_SESSION['return_location'];
            $pickup_date = $_SESSION['pickup_date'];
            $return_date = $_SESSION['return_date'];

            // Begin MySQLi transaction
            $con->begin_transaction();
            try {
                // Inserting Client Details
                $stmtClient = $con->prepare("INSERT INTO clients (full_name, client_email, client_phone) VALUES (?, ?, ?)");
                $stmtClient->bind_param("sss", $full_name, $client_email, $client_phonenumber);
                $stmtClient->execute();

                // Getting the last inserted client ID
                $client_id = $con->insert_id;

                // Inserting Reservation Details
                $stmtReservation = $con->prepare("INSERT INTO reservations (client_id, car_id, pickup_date, return_date, pickup_location, return_location) VALUES (?, ?, ?, ?, ?, ?)");
                $stmtReservation->bind_param("iissss", $client_id, $selected_car, $pickup_date, $return_date, $pickup_location, $return_location);
                $stmtReservation->execute();

                // Commit the transaction
                $con->commit();

                echo "<div class='alert alert-success'>Great! Your reservation has been created successfully.</div>";
            } catch (Exception $e) {
                // Rollback the transaction in case of error
                $con->rollback();
                echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
            }
        } elseif ($pickup_date && $return_date) { // Ensure both dates are set
            $pickup_location = $_SESSION['pickup_location'];
            $return_location = $_SESSION['return_location'];

            // SQL query to fetch available cars
            $stmt = $con->prepare("SELECT cars.*, car_brands.brand_name, cars.price_per_day
                                   FROM cars
                                   JOIN car_brands ON cars.brand_id = car_brands.brand_id
                                   WHERE cars.id NOT IN (SELECT car_id
                                                         FROM reservations
                                                         WHERE (? BETWEEN pickup_date AND return_date
                                                                OR ? BETWEEN pickup_date AND return_date)
                                                         AND canceled = 0)");
            $stmt->bind_param("ss", $pickup_date, $return_date);
            $stmt->execute();
            $result = $stmt->get_result();
            $available_cars = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <!-- HTML for displaying available cars -->
        <form action="reserve.php" method="POST" id="reservation_second_form" v-on:submit="checkForm" v-cloak>
        <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-3 reservation_cards">
                    <p>
                        <i class="fas fa-calendar-alt"></i>
                        <span>Pickup Date: </span><?php echo $_SESSION['pickup_date']; ?>
                    </p>
                </div>
                <div class="col-md-3 reservation_cards">
                    <p>
                        <i class="fas fa-calendar-alt"></i>
                        <span>Return Date: </span><?php echo $_SESSION['return_date']; ?>
                    </p>
                </div>
                <div class="col-md-3 reservation_cards">
                    <p>
                        <i class="fas fa-map-marked-alt"></i>
                        <span>Pickup Location: </span><?php echo $_SESSION['pickup_location']; ?>
                    </p>
                </div>
                <div class="col-md-3 reservation_cards">
                    <p>
                        <i class="fas fa-map-marked-alt"></i>
                        <span>Return Location: </span><?php echo $_SESSION['return_location']; ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <div class="invalid-feedback" style="display:block; margin: 10px 0; font-size: 15px;" v-if="selected_car === null">
                            Select your car
                        </div>
                        <div class="items_tab">
                            <?php foreach ($available_cars as $car): ?>
                                <?php
                                // Fetching the car image path
                                $car_image_path = "admin/Uploads/images/" . $car['car_image'];
                                ?>
                                <div class='itemListElement'>
                                    <div class='item_details'>
                                        <!-- Display car image with 10% width -->
                                        <img src='<?php echo $car_image_path; ?>' alt='<?php echo htmlspecialchars($car['car_name']); ?>' style='width: 20%; height: auto; margin-bottom: 10px;' />
                                        <div class='car_name'><?php echo htmlspecialchars($car['car_name']); ?></div>
                                        <div class='item_select_part'>
                                            <div class="select_item_bttn">
                                                <label class="item_label btn btn-secondary active">
                                                    <input type="radio" class="radio_car_select" name="selected_car" v-model="selected_car" value="<?php echo $car['id']; ?>">Select
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="client_details">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" placeholder="John Doe" name="full_name" v-model="full_name" required>
                            <div class="invalid-feedback" style="display:block" v-if="full_name === null">
                                Full name is required
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client_email">E-mail</label>
                            <input type="email" class="form-control" name="client_email" placeholder="abc@mail.xyz" v-model="client_email" required>
                            <div class="invalid-feedback" style="display:block" v-if="client_email === null">
                                E-mail is required
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client_phonenumber">Phone number</label>
                            <input type="text" name="client_phonenumber" placeholder="0123456789" class="form-control" v-model="client_phonenumber" required>
                            <div class="invalid-feedback" style="display:block" v-if="client_phonenumber === null">
                                Phone number is required
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Total Price</label>
                            <p v-if="total_price !== null">{{ total_price }} ₹</p>
                            <p v-else>Price will be calculated</p>
                        </div>
                        <button type="submit" class="btn sbmt-bttn" name="submit_reservation">Book Instantly</button>
                    </div>
                </div>
            </div>
        
        </form>
        <?php
        } else {
        ?>
            <div style="max-width:500px; margin:auto;">
                <div class="alert alert-warning">
                    Please, select first pickup and return date.
                </div>
                <button class="btn btn-info" style="display:block; margin:auto">
                    <a href="./#reserve" style="color:white">Homepage</a>
                </button>
            </div>
        <?php } ?>
    </div>
</section>

<!-- FOOTER BOTTOM -->
<?php include "Includes/templates/footerr.php"; ?>

<script>
new Vue({
    el: "#reservation_second_form",
    data: {
        selected_car: '',
        full_name: '',
        client_email: '',
        client_phonenumber: '',
        total_price: null,
        available_cars: <?php echo json_encode($available_cars); ?>,
        pickup_date: '<?php echo $pickup_date; ?>',
        return_date: '<?php echo $return_date; ?>'
    },
    methods: {
        checkForm: function(event) {
            if(this.full_name && this.client_email && this.client_phonenumber && this.selected_car) {
                return true;
            }
            
            if(!this.full_name) {
                this.full_name = null;
            }

            if(!this.client_email) {
                this.client_email = null;
            }

            if(!this.client_phonenumber) {
                this.client_phonenumber = null;
            }

            if(!this.selected_car) {
                this.selected_car = null;
            }
            
            event.preventDefault();
        },
        calculatePrice: function() {
            if(this.selected_car) {
                const car = this.available_cars.find(car => car.id == this.selected_car);
                const days = (new Date(this.return_date) - new Date(this.pickup_date)) / (1000 * 60 * 60 * 24);
                this.total_price = days * car.price_per_day;
            } else {
                this.total_price = null;
            }
        }
    },
    watch: {
        selected_car: function() {
            this.calculatePrice();
        }
    }
});
</script>
