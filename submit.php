
<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit();
}

function clean($value) {
    return htmlspecialchars(trim($value ?? ""), ENT_QUOTES, "UTF-8");
}

$fullname = clean($_POST["fullname"] ?? "");
$email = clean($_POST["email"] ?? "");
$phone = clean($_POST["phone"] ?? "");
$dob = trim($_POST["dob"] ?? "");
$gender = clean($_POST["gender"] ?? "");
$course = clean($_POST["course"] ?? "");
$year = clean($_POST["year"] ?? "");
$address = clean($_POST["address"] ?? "");

$dobDate = DateTime::createFromFormat("!Y-m-d", $dob);
$validDob = $dobDate && $dobDate->format("Y-m-d") === $dob;

if (
    $fullname === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    !preg_match("/^[0-9]{10}$/", $phone) ||
    !$validDob ||
    $dob > date("Y-m-d") ||
    $gender === "" ||
    $course === "" ||
    $year === "" ||
    $address === ""
) {
    die("
    <!DOCTYPE html>
    <html>
    <head>
        <title>Registration Error</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <main class='container'>
            <section class='result-card'>
                <p class='success'>REGISTRATION ERROR</p>
                <h1>Invalid Details.</h1>
                <p class='subtitle'>Please check your information and try again.</p>
                <a class='back-link' href='index.html'>Go Back</a>
            </section>
        </main>
    </body>
    </html>
    ");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="topbar">
        <h2>STUDENT PORTAL <span>2026</span></h2>
    </header>

    <main class="container">

        <section class="result-card">

            <p class="success">✓ REGISTRATION SUCCESSFUL</p>

            <h1>Application Received<span style="color:#50dfd0">.</span></h1>

            <p class="subtitle">
                Your registration details have been submitted successfully.
            </p>

            <h3>01 / Personal Information</h3>

            <div class="result-grid">

                <div class="result-item">
                    <small>Full Name</small>
                    <p><?= $fullname ?></p>
                </div>

                <div class="result-item">
                    <small>Email Address</small>
                    <p><?= $email ?></p>
                </div>

                <div class="result-item">
                    <small>Phone Number</small>
                    <p><?= $phone ?></p>
                </div>

                <div class="result-item">
                    <small>Date of Birth</small>
                    <p><?= htmlspecialchars($dob) ?></p>
                </div>

                <div class="result-item">
                    <small>Gender</small>
                    <p><?= $gender ?></p>
                </div>

            </div>

            <h3>02 / Academic Information</h3>

            <div class="result-grid">

                <div class="result-item">
                    <small>Course</small>
                    <p><?= $course ?></p>
                </div>

                <div class="result-item">
                    <small>Year of Study</small>
                    <p><?= $year ?></p>
                </div>

                <div class="result-item full">
                    <small>Address</small>
                    <p><?= nl2br($address) ?></p>
                </div>

            </div>

            <a href="index.html" class="back-link">← Back to Registration</a>

        </section>

    </main>

    <footer>STUDENT PORTAL © 2026</footer>

</body>
</html>
