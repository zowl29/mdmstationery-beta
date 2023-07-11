<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>MDMStationery</title>
        <link rel="stylesheet" href="css/reset.css"> 
        <link rel="stylesheet" href="css/signup-login.css">
    </head>
    
    <body class="bg-neutral-100">
        <form class="bg-neutral-100" action="includes/signup.inc.php" method="post">
            <img src="img/MDMStationery-Logo-Black.png" alt="MDMStationery">
            <h1 class="fs-secondary-heading fw-bold">Create Your Account</h1>
            <div class="input-container">
                <input type="text" name="name" placeholder="Name">
            </div>
            <div class="input-container">
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="input-container">
                <input type="email" name="email" placeholder="Email">
            </div>
            <div class="input-container">
                <select class="department-dropdown" name="department">
                    <option value="" disabled selected hidden>Bahagian</option>
                    <option value="Khidmat Pengurusan">Khidmat Pengurusan</option>
                    <option value="Kejuruteraan">Kejuruteraan</option>
                    <option value="Kesihatan Awam">Kesihatan Awam</option>
                </select>
            </div>
            <div class="password input-container">
                <input type="password" name="password" placeholder="Password">
                <div class="password-instructions">
                <p class="text-neutral-600">Your password must contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.</p>
                </div>
            </div>
            <div class="password input-container">
                <input type="password" name="confirmpassword" placeholder="Confirm Password">
            </div>
            
            <button class="filled-button" type="submit" name="submit">Sign Up</button>
            <a class="alr-have-acc" href="login.php">I already have an account</a>
        </form>
    </body>
</html>