<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #b3e0ff; /* Soft baby blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: #005b8f; /* Darker blue color for heading */
            font-size: 32px; /* Larger font size for the heading */
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px; /* Slightly wider form */
            text-align: center;
        }

        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            font-size: 18px; /* Larger font size for inputs */
            border: 2px solid #b3e0ff; /* Light baby blue border */
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #b3e0ff;
            color: #ffffff;
            padding: 15px;
            font-size: 18px; /* Larger font size for button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #80c7ff; /* Slightly darker baby blue on hover */
        }

        p {
            color: #005b8f;
            font-size: 18px; /* Larger font size for the paragraph */
        }

        a {
            color: #005b8f;
            text-decoration: none;
            font-size: 18px; /* Larger font size for link */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <h2>Register</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <p><?php echo $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
        <form method="POST" action="<?php echo site_url('auth/register'); ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Register</button>
        </form>
        <p><a href="<?php echo site_url('auth/login'); ?>">Login</a></p>
    </div>
</body>
</html>
