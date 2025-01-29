<!--Register.php-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 120vh;
            margin: 0;
        }
        
        #registerForm {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        input[type="text"], input[type="email"], input[type="date"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        #general_error_message {
            text-align: center;
            font-weight: bold;
            color: red;
            margin-top: 10px;
        }

        input.error {
            border-color: red;
        }
    </style>
</head>
<body>

<div id="Register-data"></div>

<form id="registerForm">
    <h2>Register</h2>
    <input type="text" id="first_name" name="first_name" placeholder="Enter First Name"><br>
    <span id="first_name_error" class="error"></span><br>

    <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name"><br>
    <span id="last_name_error" class="error"></span><br>

    <input type="date" id="dob" name="dob"><br>
    <span id="dob_error" class="error"></span><br>

    <input type="text" id="address" name="address" placeholder="Enter Address"><br>
    <span id="address_error" class="error"></span><br>

    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number"><br>
    <span id="phone_error" class="error"></span><br>

    <input type="email" id="email" name="email" placeholder="Enter Email"><br>
    <span id="email_error" class="error"></span><br>

    <input type="password" id="password" name="password" placeholder="Enter Password"><br>
    <span id="password_error" class="error"></span><br>

    <button type="submit">Register</button>
    <div id="general_error_message" class="error"></div>
</form>

<script>
    $(document).ready(function () {
        function validateName(name) {
            const namePattern = /^[A-Za-z_]{3,}$/;
            return namePattern.test(name);
        }

        function validateEmail(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        function validatePhone(phone) {
            const phonePattern = /^\d{10}$/;
            return phonePattern.test(phone);
        }

        function validatePassword(password) {
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
            return passwordPattern.test(password);
        }

        function validateAddress(address) {
            return address.length >= 5; 
        }

        $('#first_name').on('keyup blur', function () {
            const firstName = $(this).val().trim();
            $('#first_name_error').text(firstName === '' ? 'Enter a name for First Name.' :
                !validateName(firstName) ? 'Expect only letters or underscore, at least 3 characters.' : '');
        });

        $('#last_name').on('keyup blur', function () {
            const lastName = $(this).val().trim();
            $('#last_name_error').text(lastName === '' ? 'Enter a name for Last Name.' :
                !validateName(lastName) ? 'Expect only letters or underscore, at least 3 characters.' : '');
        });

        $('#dob').on('blur', function () {
            const dob = $(this).val().trim();
            const birthDate = new Date(dob);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            $('#dob_error').text(dob === '' ? 'Enter your Date of Birth.' :
                age < 18 ? 'You must be 18 years or older.' : '');
        });
		
		$('#address').on('keyup blur', function () {
            const address = $(this).val().trim();
            $('#address_error').text(address === '' ? 'Enter an address.' :
                !validateAddress(address) ? 'Address should be at least 5 characters.' : '');
        });

        $('#phone').on('keyup blur', function () {
            const phone = $(this).val().trim();
            $('#phone_error').text(phone === '' ? 'Enter a phone number.' :
                !validatePhone(phone) ? 'Phone Number must be exactly 10 digits.' : '');
        });

        $('#email').on('keyup blur', function () {
            const email = $(this).val().trim();
            $('#email_error').text(email === '' ? 'Enter an email address.' :
                !validateEmail(email) ? 'Invalid Email format.' : '');
        });

        $('#password').on('keyup blur', function () {
            const password = $(this).val().trim();
            $('#password_error').text(password === '' ? 'Enter a password.' :
                !validatePassword(password) ? 'Password must be at least 6 characters, including at least one letter and one number.' : '');
        });

        

        $('#registerForm').on('submit', function (e) {
            e.preventDefault();

            let isValid = true;
            const firstName = $('#first_name').val().trim();
            const lastName = $('#last_name').val().trim();
            const email = $('#email').val().trim();
            const phone = $('#phone').val().trim();
            const dob = $('#dob').val().trim();
            const address = $('#address').val().trim();
            const password = $('#password').val().trim();

            if (!firstName || !validateName(firstName)) isValid = false;
            if (!lastName || !validateName(lastName)) isValid = false;
			if (!dob || (new Date().getFullYear() - new Date(dob).getFullYear()) < 18) isValid = false;
			 if (!address || !validateAddress(address)) isValid = false;
			  if (!phone || !validatePhone(phone)) isValid = false;
            if (!email || !validateEmail(email)) isValid = false;
            if (!password || !validatePassword(password)) isValid = false;

            if (isValid) {
                $('#general_error_message').text('');
                const formdata = $("#registerForm").serialize();
                $.ajax({
                    url: "insert.php",  // Change to the correct path for your backend handler
                    method: "POST",
                    data: formdata,
                    success: function (response) {
                        if (response.includes("success")) {
                            alert("Account Created successfully!");
                            $('#registerForm')[0].reset(); // Reset the form fields
                           // setTimeout(function () {
                                window.location.href = 'user-loginform.php'; // Redirect after 2 seconds
                           // }, 2000);
                        } else {
                            $('#general_error_message').text(response);
                        }
                    },
                });
            } else {
                $('#general_error_message').text('Please fill in all fields correctly.');
            }
        });
    });
</script>

</body>
</html>
<!--Register-backend-->
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "user_resister";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$first_name = $last_name = $email = $phone = $dob = $password = $address = "";

if (isset($_POST['first_name'], $_POST['last_name'], $_POST['dob'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['password'])) {

    // Capture and sanitize form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob =  $_POST['dob'];
    $address = $_POST['address'];
    $phone =  $_POST['phone'];
    $email = $_POST['email'];
    $password =  md5($_POST['password']);

    // Validate required fields
    if (!empty($first_name) && !empty($last_name) && !empty($dob) && !empty($address) && !empty($phone) && !empty($email) && !empty($password)) {

        // Check if email already exists
        $check_email = "SELECT * FROM users1 WHERE email='$email'";
        $result = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($result) > 0) {
            echo "Email already registered. Please use a different email.";
        } else {
            // Hash the password for security
            //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // SQL query to insert data
            $insert = "INSERT INTO users1 (first_name, last_name, dob, address, phone, email, password) 
                       VALUES ('$first_name', '$last_name', '$dob', '$address', '$phone', '$email', '$password')";

            // Execute the query
            if (mysqli_query($conn, $insert)) {
                echo "User registered successfully.";
            } else {
                echo "Failed to register user. Please try again.";
            }
        }
    } else {
        echo "Please fill out all fields.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
<!--Login.php-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #7f8c8d, #2c3e50);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        #loginForm {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 2em;
            margin-bottom: 20px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        #general_login_error_message {
            text-align: center;
            font-weight: bold;
            color: red;
            margin-top: 15px;
        }

        label {
            font-weight: bold;
            color: #34495e;
            font-size: 1.1em;
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <form id="loginForm">
        <h2>Login</h2>
        <label for="login_email">Email</label>
        <input type="email" id="login_email" name="email" placeholder="Enter your email" required>
        <span id="login_email_error" class="error"></span>

        <label for="login_password">Password</label>
        <input type="password" id="login_password" name="password" placeholder="Enter your password" required>
        <span id="login_password_error" class="error"></span>

        <button type="submit">Login</button>
        <div id="general_login_error_message" class="error"></div>
    </form>

    <script>
        $(document).ready(function () {
            function validateEmail(email) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }

            $('#login_email').on('keyup blur', function () {
                const email = $(this).val().trim();
                if (email === '') {
                    $('#login_email_error').text('Enter an email address.');
                } else if (!validateEmail(email)) {
                    $('#login_email_error').text('Invalid Email format.');
                } else {
                    $('#login_email_error').text('');
                }
            });

            $('#login_password').on('keyup blur', function () {
                const password = $(this).val().trim();
                if (password === '') {
                    $('#login_password_error').text('Enter your password.');
                } else {
                    $('#login_password_error').text('');
                }
            });

            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                const email = $('#login_email').val().trim();
                const password = $('#login_password').val().trim();

                if (email === '' || !validateEmail(email) || password === '') {
                    $('#general_login_error_message').text('Please fill in all fields correctly.');
                    return;
                }

                $('#general_login_error_message').text('');
                const formData = $("#loginForm").serialize();
                console.log(formData);

                $.ajax({
                    type: "POST",
                    url: "loginbeckend.php",
                    data: formData,
                    success: function (response) {
                        if (response === 'success') {
                            alert("Login successfully redirect to dashboard page..!");
                            window.setTimeout(function() {
                                window.location.href = 'user-desboard.php';
                            }, 1000);
                        } else {
                            $('#general_login_error_message').text('Invalid email or password.');
                        }
                    },
                });
            });
        });
    </script>
</body>
</html>
<!--Login-backend.php-->

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "user_resister";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = md5($_POST['password']);
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "SELECT * FROM users1 WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['email'] = $email; 
    echo 'success'; 
} else {
    echo 'error'; 
}
?>
<!--User-dashboard.php-->
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: user-loginform.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "user_resister";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #34495e;
            margin: 30px 0;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 1em;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6f7ff;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }

        #logout-btn {
            background-color: #e74c3c;
        }

        #logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>User Dashboard</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th colspan="2">Actions</th>
        </tr>

        <?php
        $user_email = $_SESSION['email'];
        $sql = "SELECT * FROM users1 WHERE email = '$user_email'";
        $select = mysqli_query($conn, $sql);
        while ($d = mysqli_fetch_assoc($select)) {
        ?>
            <tr class="main<?php echo $d['id']; ?>">
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['first_name']; ?></td>
                <td><?php echo $d['last_name']; ?></td>
                <td><?php echo $d['dob']; ?></td>
                <td><?php echo $d['address']; ?></td>
                <td><?php echo $d['phone']; ?></td>
                <td><?php echo $d['email']; ?></td>
                <td><button class="edit" data-id="<?php echo $d['id']; ?>">Edit</button></td>
                <td><a href="logout123.php"><button id="logout-btn">Logout</button></a></td>
            </tr>
        <?php
        }
        ?>
    </table>

    <div id="message" class="error"></div>

    <script>
        $(document).ready(function () {
            // Edit functionality
            $('.edit').click(function (ev) {
                ev.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: "update123.php",
                    data: { id: id },
                    success: function (response) {
                        // Replace current content with update form
                        $('body').html(response);
                    },
                    error: function (xhr, status, error) {
                        alert("Error loading update form. Please try again.");
                    }
                });
            });
        });
    </script>
</body>
</html>
<!--update.php-->
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: user-loginform.php");
    exit();
}

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'user_resister');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data
$user_email = $_SESSION['email'];
$sql = "SELECT * FROM users1 WHERE email = '$user_email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        #editForm {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        input[type="text"], input[type="email"], input[type="date"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        #general_error_message {
            text-align: center;
            font-weight: bold;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <form id="editForm">
        <h2>Edit Profile</h2>
        
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" value="<?php echo $user['first_name']; ?>"><br>
        <span id="first_name_error" class="error"></span><br>

        <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" value="<?php echo $user['last_name']; ?>"><br>
        <span id="last_name_error" class="error"></span><br>
        
        <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>"><br>
        <span id="dob_error" class="error"></span><br>
        
        <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>"><br>
        <span id="address_error" class="error"></span><br>
        
        <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $user['phone']; ?>"><br>
        <span id="phone_error" class="error"></span><br>

        <input type="email" id="email" name="email" placeholder="Enter Email" value="<?php echo $user['email']; ?>"><br>
        <span id="email_error" class="error"></span><br>

        <button type="submit">Update</button>
        <div id="general_error_message" class="error"></div>
    </form>

    <script>
        $(document).ready(function () {
            // Validation functions
            function validateName(name) {
                const namePattern = /^[A-Za-z_]{3,}$/;
                return namePattern.test(name);
            }

            function validateEmail(email) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }

            function validatePhone(phone) {
                const phonePattern = /^\d{10}$/;
                return phonePattern.test(phone);
            }

            function validateAddress(address) {
                return address.length >= 5;
            }

            // Real-time validation for each field
            $('#first_name').on('keyup blur', function () {
                const firstName = $(this).val().trim();
                $('#first_name_error').text(firstName === '' ? 'Enter a name for First Name.' : 
                    !validateName(firstName) ? 'Expect only letters or underscore, at least 3 characters.' : '');
            });

            $('#last_name').on('keyup blur', function () {
                const lastName = $(this).val().trim();
                $('#last_name_error').text(lastName === '' ? 'Enter a name for Last Name.' : 
                    !validateName(lastName) ? 'Expect only letters or underscore, at least 3 characters.' : '');
            });

            $('#email').on('keyup blur', function () {
                const email = $(this).val().trim();
                $('#email_error').text(email === '' ? 'Enter an email address.' : 
                    !validateEmail(email) ? 'Invalid Email format.' : '');
            });

            $('#phone').on('keyup blur', function () {
                const phone = $(this).val().trim();
                $('#phone_error').text(phone === '' ? 'Enter a phone number.' : 
                    !validatePhone(phone) ? 'Phone Number must be exactly 10 digits.' : '');
            });

            $('#dob').on('blur', function () {
                const dob = $(this).val().trim();
                const birthDate = new Date(dob);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                $('#dob_error').text(dob === '' ? 'Enter your Date of Birth.' : 
                    age < 18 ? 'You must be 18 years or older.' : '');
            });

            $('#address').on('keyup blur', function () {
                const address = $(this).val().trim();
                $('#address_error').text(address === '' ? 'Enter an address.' :
                    !validateAddress(address) ? 'Address should be at least 5 characters.' : '');
            });

            // Submit form validation and AJAX request
            $('#editForm').on('submit', function (e) {
                e.preventDefault();

                let isValid = true;
                const firstName = $('#first_name').val().trim();
                const lastName = $('#last_name').val().trim();
                const email = $('#email').val().trim();
                const phone = $('#phone').val().trim();
                const dob = $('#dob').val().trim();
                const address = $('#address').val().trim();

                if (!firstName || !validateName(firstName)) isValid = false;
                if (!lastName || !validateName(lastName)) isValid = false;
                if (!dob || (new Date().getFullYear() - new Date(dob).getFullYear()) < 18) isValid = false;
                if (!address || !validateAddress(address)) isValid = false;
                if (!phone || !validatePhone(phone)) isValid = false;
                if (!email || !validateEmail(email)) isValid = false;

                if (isValid) {
                    $('#general_error_message').text('');
                    const formData = $("#editForm").serialize();
                    $.ajax({
                        url: "update-backend.php",
                        method: "POST",
                        data: formData,
                        success: function (response) {
                            if (response.includes("success")) {
                                alert("Profile updated successfully!");
                                setTimeout(function () {
                                    window.location.href = 'user-desboard.php';
                                }, 2000);
                            } else {
                                $('#general_error_message').text(response);
                            }
                        },
                    });
                } else {
                    $('#general_error_message').text('Please fill in all fields correctly.');
                }
            });
        });
    </script>

</body>
</html>
<!--Update.backend.php-->
<?php

session_start();
if(!isset($_SESSION['email'])){
	header('location:user-loginform.php');
	exit();
}
//print_r($_POST);
//die('hlo');
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_resister";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];




// Update user info with SQL injection prevention (prepared statement)
$sql = "UPDATE  users1 SET first_name='$first_name', last_name='$last_name',dob='$dob',address='$address', phone='$phone' ,email='$email' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    // Update session email after successfully updating the user's email
    $_SESSION['email'] = $email;  // Update session with the new email

    echo "success";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
<!--Logout.php-->

<?php
session_start();
$_SESSION = [];

session_destroy();
header("Location:user-loginform.php");
exit();
?>
<!--connection-->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database="user_resister";

$conn = mysqli_connect($servername, $username, $password,$database);

$sql = "CREATE TABLE  users1(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
	dob VARCHAR(100) NOT NULL,
	address VARCHAR(200) NOT NULL,
    phone VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
    
)";
$result= mysqli_query($conn,$sql);
if($result){
	echo "table create";
}

?>
