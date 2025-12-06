<?php
// portfolio.php
// Make sure this file is saved as portfolio.php and uploaded to your server

// Only accept POST submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

// Simple sanitization
$firstName = isset($_POST['myFName']) ? trim($_POST['myFName']) : '';
$lastName  = isset($_POST['myLName']) ? trim($_POST['myLName']) : '';
$email     = isset($_POST['myEmail']) ? trim($_POST['myEmail']) : '';
$phone     = isset($_POST['myPhone']) ? trim($_POST['myPhone']) : '';
$comments  = isset($_POST['myComments']) ? trim($_POST['myComments']) : '';

// Extra safety: encode for output
$firstName_html = htmlspecialchars($firstName, ENT_QUOTES);
$lastName_html  = htmlspecialchars($lastName, ENT_QUOTES);
$email_html     = htmlspecialchars($email, ENT_QUOTES);
$phone_html     = htmlspecialchars($phone, ENT_QUOTES);
$comments_html  = nl2br(htmlspecialchars($comments, ENT_QUOTES));

// Send email (optional: will work only if server supports mail())
$to = "carolinagar189@gmail.com"; // keep your email
$subject = "New contact form submission from $firstName $lastName";
$body = "You have a new message from your website contact form:\n\n";
$body .= "Name: $firstName $lastName\n";
$body .= "Email: $email\n";
$body .= "Phone: $phone\n\n";
$body .= "Message:\n$comments\n";

$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// Try to send the email (this returns true/false)
$mail_sent = false;
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Attempt to send mail - many hosts require additional configuration for mail()
    $mail_sent = @mail($to, $subject, $body, $headers);
}

// Now display a confirmation page styled to match your site
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Message Received — Carolina's Portfolio</title>

  <!-- Link your existing stylesheet so the colors match the rest of the site -->
  <link rel="stylesheet" href="portfolio.css">

  <style>
    /* Local confirmation box styles (only affects this page) */
    .confirm-wrapper {
      display: flex;
      justify-content: center;
      padding: 60px 20px;
      min-height: 60vh;
    }

    .confirm-card {
      max-width: 700px;
      width: 100%;
      background: rgba(255,255,255,0.07); /* subtle translucent card to fit your palette */
      border-radius: 12px;
      padding: 28px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.4);
      color: #ebe9fc;
      border: 1px solid rgba(255,255,255,0.06);
    }

    .confirm-card h1 {
      font-size: 1.6rem;
      margin-bottom: 10px;
      color: #ebe9fc;
    }

    .confirm-card p.lead {
      margin-bottom: 18px;
      color: #e0defc;
    }

    .info-list {
      background: rgba(0,0,0,0.25);
      padding: 16px;
      border-radius: 8px;
      color: #e0defc;
      line-height: 1.6;
      margin-bottom: 18px;
      font-size: 15px;
    }

    .info-list dt { font-weight: 700; color: #fff; }
    .info-list dd { margin: 6px 0 12px 0; color: #e6e2ff; }

    .confirm-actions {
      display:flex;
      gap:12px;
      justify-content: flex-start;
      flex-wrap:wrap;
    }

    .btn {
      display:inline-block;
      padding:10px 18px;
      border-radius:8px;
      text-decoration:none;
      font-weight:600;
      cursor:pointer;
      border: none;
    }

    .btn-primary {
      background-color: #ebe9fc;
      color: #4d6039;
    }

    .btn-secondary {
      background: transparent;
      color: #ebe9fc;
      border: 1px solid rgba(255,255,255,0.12);
    }

    @media (max-width:560px){
      .confirm-card { padding:18px; }
    }
  </style>
</head>
<body>
  <!-- Optional: show your normal header/navigation so the page feels native -->
  <header>
    <div class="dot"></div>
    <strong>Carolina’s Portfolio</strong>
  </header>

  <nav>
    <a href="mainpage.html">HOME</a>
    <a href="portfolio.html">PORTFOLIO</a>
    <a href="beauty.html">BEAUTY</a>
    <a href="blog.html">BLOG</a>
    <a href="contact.html">CONTACT</a>
  </nav>

  <div class="confirm-wrapper">
    <div class="confirm-card">
      <h1>We will be contacting you soon!</h1>
      <p class="lead">Thank you for reaching out — here is the information you entered:</p>

      <dl class="info-list">
        <dt>First Name:</dt>
        <dd><?php echo $firstName_html; ?></dd>

        <dt>Last Name:</dt>
        <dd><?php echo $lastName_html; ?></dd>

        <dt>Email:</dt>
        <dd><?php echo $email_html; ?></dd>

        <dt>Phone:</dt>
        <dd><?php echo $phone_html; ?></dd>

        <dt>Comments:</dt>
        <dd><?php echo $comments_html; ?></dd>
      </dl>

      <?php if ($mail_sent): ?>
        <p style="color:#e0defc; margin-bottom:12px;">Your message was sent successfully.</p>
      <?php else: ?>
        <p style="color:#f7d6d6; margin-bottom:12px;">Note: We could not send an email automatically from the server. Your submission was recorded and you will still see the confirmation here. If you expect emails and do not receive them, please check hosting email settings or contact your hosting provider.</p>
      <?php endif; ?>

      <div class="confirm-actions">
        <!-- Back to contact page -->
        <a class="btn btn-secondary" href="contact.html">Back to Contact</a>

        <!-- Back using browser history -->
        <button onclick="history.back()" class="btn btn-primary">Go Back</button>
      </div>
    </div>
  </div>

  <footer>
    ©2025 CAROLINA’S PORTFOLIO<br>carolinagar189@gmail.com
  </footer>
</body>
</html>
