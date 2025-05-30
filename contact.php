
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Database connection
            include 'db.php';
            $sql = "CREATE TABLE IF NOT EXISTS query (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(50) NOT NULL,
                message TEXT NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                resolution ENUM('unresolved', 'resolved') DEFAULT 'unresolved'
            )";
            if ($conn->query($sql) === TRUE) {
               
            } else {
                echo "Error creating table: " . $conn->error;
            }

            $stmt = $conn->prepare("INSERT INTO query (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);

            if ($stmt->execute()) {
                // echo "<script>alert('Message submitted successfully!');</script>";
            } else {
                echo "<script>alert('Failed to submit message.');</script>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<script>alert('Invalid email address.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NutriTrack - Contact</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #f2f6f9;
      color: #333;
    }

    header {
      background: rgb(0,51,102);
background: linear-gradient(159deg, rgba(0,51,102,1) 0%, rgba(15,82,186,1) 100%);
      color: white;
      padding: 20px 40px;
      text-align: center;
    }

    h1 {
      margin: 0;
      font-size: 2rem;
    }

    .feature-section {
      padding: 40px;
      background: white;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      margin: 20px;
      border-radius: 10px;
    }

    .feature-section h2 {
      color:rgb(5, 78, 152);

      margin-bottom: 10px;
    }

    .contact-form {
      margin: 20px;
      padding: 40px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .contact-form h2 {
      margin-bottom: 20px;
      color:rgb(5, 78, 152);
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input, textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

     button {
      background:rgb(27, 105, 182);

      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background:rgb(5, 78, 152);

    }

    footer {
      text-align: center;
      padding: 20px;
      color: #777;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <header>
    <h1>NutriTrack</h1>
    <p>Your Fitness & Nutrition Companion</p>
  </header>

  <div class="feature-section">
    <h2>Fitness Challenge Tracker</h2>
    <p>
      Join and create custom fitness challenges! NutriTrack allows you to track progress,
      set fitness goals, and earn rewards for achieving milestones. Compete with friends or
      challenge yourself to stay on top of your health journey.
    </p>
  </div>

  <div class="contact-form">
    <h2>Contact Us</h2>
    <form action="" method="POST" id="contact-form">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />
      </div>

      <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" required></textarea>
      </div>

      <button type="submit" name="submit">Send Message</button>
    </form>
  </div>



</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $to      = "suk051271@gmail.com";
            $subject = "User Query from NutriTrack";
            $headers = "From: $name <$email>\r\nReply-To: $email\r\n";
            $body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

            if (mail($to, $subject, $body, $headers)) {
                echo "<script>alert('Message sent successfully!');</script>";
            } else {
                echo "<script>alert('Failed to send message. Please try again later.');</script>";
            }
        } else {
            echo "<script>alert('Invalid email address.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>
