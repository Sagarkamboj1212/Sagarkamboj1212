<!---USER REGISTER-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

        .gender, .languages {
            margin-right: 10px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        .error {
            font-size: 0.9em;
            color: red;
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

<div id="Register-data"></div>

<form id="registerForm">
    <h2>Register</h2>
    <input type="text" id="first_name" name="first_name" placeholder="Enter First Name"><br>
    <span id="first_name_error" class="error"></span><br>

    <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name"><br>
    <span id="last_name_error" class="error"></span><br>

    <input type="email" id="email" name="email" placeholder="Enter Email"><br>
    <span id="email_error" class="error"></span><br>

    <input type="text" id="phone" name="phone" placeholder="Enter Phone Number"><br>
    <span id="phone_error" class="error"></span><br>

    <input type="date" id="dob" name="dob"><br>
    <span id="dob_error" class="error"></span><br>

    <input type="password" id="password" name="password" placeholder="Enter Password"><br>
    <span id="password_error" class="error"></span><br>

    <label>Gender:</label>
    <input type="radio" id="male" name="gender" value="male" class="gender">
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female" class="gender">
    <label for="female">Female</label>
    <span id="gender_error" class="error"></span><br>

    <label>Select Languages:</label><br>
    <input type="checkbox" class="languages" name="languages[]" value="Hindi"> Hindi
    <input type="checkbox" class="languages" name="languages[]" value="English"> English
    <input type="checkbox" class="languages" name="languages[]" value="Punjabi"> Punjabi<br>
    <span id="languages_error" class="error"></span><br>

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

        $('#password').on('keyup blur', function () {
            const password = $(this).val().trim();
            $('#password_error').text(password === '' ? 'Enter a password.' :
                !validatePassword(password) ? 'Password must be at least 6 characters, including at least one letter and one number.' : '');
        });

        $('#gender').on('change', function () {
            const gender = $('input[name="gender"]:checked').val();
            $('#gender_error').text(gender === undefined ? 'Please select your gender.' : '');
        });

        $('input.languages').on('change', function () {
            const languages = $('input.languages:checkbox:checked').length;
            $('#languages_error').text(languages < 2 ? 'Please select at least two languages.' : '');
        });

        $('#registerForm').on('submit', function (e) {
            e.preventDefault();

            let isValid = true;
            const firstName = $('#first_name').val().trim();
            const lastName = $('#last_name').val().trim();
            const email = $('#email').val().trim();
            const phone = $('#phone').val().trim();
            const dob = $('#dob').val().trim();

            const gender = $('input[name="gender"]:checked').val();
            const password = $('#password').val().trim();
            const languages = $('input.languages:checkbox:checked').length;

            if (!firstName || !validateName(firstName)) isValid = false;
            if (!lastName || !validateName(lastName)) isValid = false;
            if (!email || !validateEmail(email)) isValid = false;
            if (!phone || !validatePhone(phone)) isValid = false;
            if (!dob || (new Date().getFullYear() - new Date(dob).getFullYear()) < 18) isValid = false;
            if (!gender) isValid = false;
            if (!password || !validatePassword(password)) isValid = false;
            if (languages < 2) isValid = false;

            if (isValid) {
                $('#general_error_message').text('');
                const formdata = $("#registerForm").serialize();
                $.ajax({
                    url: "save.php",
                    method: "POST",
                    data: formdata,
                    success: function (response) {
                        if (response.includes("success")) {
                            alert("Account Created successful!");
                            setTimeout(function() {
                                window.location.href = 'login-user.php';
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
<!---LOGIN USER-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        
        #loginForm {
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

        .gender, .languages {
            margin-right: 10px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        .error {
            font-size: 0.9em;
            color: red;
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
    <form id="loginForm">
        <h2>Login</h2>
        <input type="email" id="login_email" name="email" placeholder="Enter email" required><br>
        <span id="login_email_error" class="error"></span><br>

        <input type="password" id="login_password" name="password" placeholder="Enter password" required><br>
        <span id="login_password_error" class="error"></span><br>

        <button type="submit">Login</button>
        <div id="general_login_error_message" class="error"></div>
    </form>

    <script>
        $(document).ready(function () {
            // Validate Email
            function validateEmail(email) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }

            // Real-time validation on keyup and blur events
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

            // Final form validation on submit
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                const email = $('#login_email').val().trim();
                const password = $('#login_password').val().trim();

                if (email === '' || !validateEmail(email) || password === '') {
                    $('#general_login_error_message').text('Please fill in all fields correctly.');
                    return;
                }

                $('#general_login_error_message').text('');
				 const formdata = $("#loginForm").serialize();
				 console.log(formdata); 
            $.ajax({
    type: "POST",
    url: "process.php",
    data: formdata,
    success: function (response) {
		 console.log(response); 
        if (response === 'success') {
            window.location.href = 'user-dashboard.php';
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

<!--PROCESS-->
<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'example_database');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

// Basic SQL query (note: this is vulnerable to SQL injection)
$sql = "SELECT * FROM user_register WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['email'] = $email; 
    echo 'success'; // Indicating success
} else {
    echo 'error'; // Indicating failure
}
?>

<!--SAVE-->

<?php

$first_name = $last_name = $email = $phone = $dob = $password=$gender = $languages = "";
$connection = mysqli_connect('localhost', 'root', '', 'Example_database');

if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone'], $_POST['dob'], $_POST['gender'], $_POST['languages'],$_POST['password'])) {
 
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
	$password=$_POST['password'];
    $gender = $_POST['gender'];
    $languages = implode(',', $_POST['languages']);

    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone) && !empty($dob)&& !empty($password) && !empty($gender) && !empty($languages)) {

        // Check if email already exists
        $check_email = "SELECT * FROM user_register WHERE email='$email'";
        $result = mysqli_query($connection, $check_email);

        if (mysqli_num_rows($result) > 0) {
            echo "Email already registered. Please use a different email.";
        } else {
            $insert = "INSERT INTO user_register (first_name, last_name, email,phone,dob,password,gender,languages) VALUES ('$first_name', '$last_name', '$email', '$phone', '$dob','$password','$gender','$languages')";
            if (mysqli_query($connection, $insert)) {
                echo "User registered successfully.";
            } else {
                echo "Failed to register user.";
            }
        }
    } else {
        echo "Please fill out all fields.";
    }
}
?>
<!--USER-DASHBOARD-->
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login-user.php");
    exit();
}

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'Example_database');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid black;
        }
        h1 {
            text-align: center;
        }
        .error { color: red; }
    </style>
</head>
<body>
<body>
    <h1>Display Data</h1>

    <!-- Add the logout link/button -->
   

    <table style="background-color: lightgrey;">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Dob</th>
            <th>Gender</th>
            <th>Languages</th>
            <th colspan="2">Action</th>
        </tr>

        <?php
        $user_email = $_SESSION['email'];
        $sql = "SELECT * FROM user_register WHERE email = '$user_email'";
        $select = mysqli_query($conn, $sql);
        while ($d = mysqli_fetch_assoc($select)) {
        ?>
            <tr class="main<?php echo $d['id']; ?>">
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['first_name']; ?></td>
                <td><?php echo $d['last_name']; ?></td>
                <td><?php echo $d['email']; ?></td>
                <td><?php echo $d['phone']; ?></td>
                <td><?php echo $d['dob']; ?></td>
                <td><?php echo $d['gender']; ?></td>
                <td><?php echo $d['languages']; ?></td>
                <td><button class="edit" data-id="<?php echo $d['id']; ?>">Edit</button></td>
				<td>
                <a href="logout.php"><button>Logout</button></a>
    </td>
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
                    url: "user-update.php",
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

<!--USER UPDATE FORM-->
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login-user.php");
    exit();
}

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'Example_database');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data
$user_email = $_SESSION['email'];
$sql = "SELECT * FROM user_register WHERE email = '$user_email'";
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
            height: 120vh;
            margin: 0;
        }
        
        #editForm{
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

        .gender, .languages {
            margin-right: 10px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        .error {
            font-size: 0.9em;
            color: red;
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

        <input type="email" id="email" name="email" placeholder="Enter Email" value="<?php echo $user['email']; ?>"><br>
        <span id="email_error" class="error"></span><br>

        <input type="text" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $user['phone']; ?>"><br>
        <span id="phone_error" class="error"></span><br>

        <input type="date" id="dob" name="dob" value="<?php echo $user['dob']; ?>"><br>
        <span id="dob_error" class="error"></span><br>

 
<label>Gender:</label>
<input type="radio" id="male" name="gender" class="gender" value="male" <?php echo (isset($user['gender']) && $user['gender'] == 'male') ? 'checked' : ''; ?>>
<label for="male">Male</label>

<input type="radio" id="female" name="gender" class="gender" value="female" <?php echo (isset($user['gender']) && $user['gender'] == 'female') ? 'checked' : ''; ?>>
<label for="female">Female</label>

<span id="gender_error" class="error"></span><br>


        <label>Select Languages:</label><br>
        <input type="checkbox" class="languages" name="languages[]" value="Hindi" <?php echo (strpos($user['languages'], 'Hindi') !== false) ? 'checked' : ''; ?>> Hindi
        <input type="checkbox" class="languages" name="languages[]" value="English" <?php echo (strpos($user['languages'], 'English') !== false) ? 'checked' : ''; ?>> English
        <input type="checkbox" class="languages" name="languages[]" value="Punjabi" <?php echo (strpos($user['languages'], 'Punjabi') !== false) ? 'checked' : ''; ?>> Punjabi<br>
        <span id="languages_error" class="error"></span><br>

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

    function validatePassword(password) {
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
        return passwordPattern.test(password);
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

    // $('#password').on('keyup blur', function () {
        // const password = $(this).val().trim();
        // $('#password_error').text(password === '' ? 'Enter a password.' : 
            // !validatePassword(password) ? 'Password must be at least 6 characters, including at least one letter and one number.' : '');
    // });

    $('#gender').on('change', function () {
        const gender = $('input[name="gender"]:checked').val();
        $('#gender_error').text(gender === undefined ? 'Please select your gender.' : '');
    });

    $('input.languages').on('change', function () {
        const languages = $('input.languages:checkbox:checked').length;
        $('#languages_error').text(languages < 2 ? 'Please select at least two languages.' : '');
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
        const gender = $('input[name="gender"]:checked').val();
        // const password = $('#password').val().trim();
        const languages = $('input.languages:checkbox:checked').length;

        // Validation checks
        if (!firstName || !validateName(firstName)) isValid = false;
        if (!lastName || !validateName(lastName)) isValid = false;
        if (!email || !validateEmail(email)) isValid = false;
        if (!phone || !validatePhone(phone)) isValid = false;
        if (!dob || (new Date().getFullYear() - new Date(dob).getFullYear()) < 18) isValid = false;
        if (!gender) isValid = false;  // Gender validation check
        // if (password && !validatePassword(password)) isValid = false;
        if (languages < 2) isValid = false;

        if (isValid) {
            $('#general_error_message').text('');
            const formdata = $("#editForm").serialize();
            $.ajax({
                url: "update-user.php",
                method: "POST",
                data: formdata,
                success: function (response) {
                    if (response.includes("success")) {
                        alert("Profile updated successfully!");
                        setTimeout(function () {
                            window.location.href = 'user-dashboard.php';
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

<!--USER-UPDATE->
<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login-user.php");
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'example_database');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];

$languages = implode(',', $_POST['languages'] ?? []);

// Update user info with SQL injection prevention (prepared statement)
$sql = "UPDATE user_register SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', dob='$dob', gender='$gender', languages='$languages' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    // Update session email after successfully updating the user's email
    $_SESSION['email'] = $email;  // Update session with the new email

    echo "success";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>


<!--USER LOGOUT-->
<?php
session_start();

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: login-user.php");
exit();
?>
<!--Db Connection table-->
<?php
// Database connection details
$servername = "localhost"; // Your server name (usually localhost)
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "Example_database";// Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the table
$sql = "CREATE TABLE IF NOT EXISTS `user_register` (
    `id` INT(100) NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(100) NOT NULL,
    `dob` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `gender` VARCHAR(100) NOT NULL,
    `languages` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Table 'user_register' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>