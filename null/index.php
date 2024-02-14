<?php 
require_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <section>
        <nav>
            <div class="logo">
                <img src="image/logo.png" style="width: 60px; height: auto;" >
            </div>
            <ul>
                <li><a href="#Home">Home</a></li>
                <li><a href="#Book_reg">Book Registration</a></li>
                <li><a href="#Book_cat">Book Category</a></li>
                <li><a href="#Member">Member</a></li>
                <li><a href="#Book_borrow_deta">Book Borrow Details</a></li>
                <li><a href="#Fine">Fine</a></li>
            </ul>
            <div class="social_icon">
                <i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-solid fa-heart"></i>
                <i class="fa-solid fa-envelope"></i>
            </div>
        </nav>
        <div class="main">
            <div class="main_tag">
                <h1>WELCOME TO<br><span>LIBRARY MANAGEMENT <br></span>SYSTEM</h1>
                <p>
                    The University of Kelaniya Library Management System efficiently organizes resources, 
                    facilitates user access, and streamlines circulation processes, enhancing academic research and 
                    learning experiences. Additionally, 
                    <br>
                    <br>
                    Its Fine Management System simplifies fine payments, 
                    ensures secure transactions through advanced encryption, maintains transparent records for tracking, 
                    and implements fair policies for equitable treatment. These integrated systems optimize library operations, 
                    promoting a conducive environment for scholarly pursuits and intellectual growth.
                </p>
                <a href="#" class="main_btn">Learn More</a>
            </div>
            <div class="main_img">
                <img src="image/table.png" style="width: 600px; height: auto;">
            </div>
        </div>
    </section>

    <!--Services-->
    
    <div class="services">
        <div class="services_box">
            <div class="services_card">
                <a href="finetable.php"><i class="fa-solid fa-money-bill-wave"></i></a>
                <h3>Fine Payment</h3>
                <p>
                    Simplify fine payments with our intuitive system, ensuring convenience for borrowers.
                </p>
            </div>
        </div>
    </div>

    <br>
    <br>
    <div>
            <br>
            <br>
                  
    <!--Footer-->
    <footer>
        <div class="footer_main">
            <div class="tag">
                <img src="image/logo.png" style="width: 40px; height: auto;">
                <p>
                    Effortless browsing, secure transactions, and simplified fine management 
                    await in our user-friendly University of Kelaniya Library Management System.
                </p>
            </div>
            <div class="tag">
                <h1>Quick Link</h1>
                <a href="#">Home</a>
                <a href="#">Books Registration</a>
                <a href="#">Book Category</a>
                <a href="#">Member</a>
                <a href="#">Book Borrow Details</Details></a>
                <a href="#">Fine</a>
            </div>
            <div class="tag">
                <h1>Contact Info</h1>
                <a href="#"><i class="fa-solid fa-phone"></i>+94 77 123 456 78</a>
                <a href="#"><i class="fa-solid fa-phone"></i>+94 77 987 654 32</a>
                <a href="#"><i class="fa-solid fa-envelope"></i>library_kelaniya@gmail.com</a>
            </div>
            <div class="tag">
                <h1>Follow Us</h1>
                <div class="social_link">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-linkedin-in"></i>
                </div>
            </div>
            <div class="tag">
                <h1>Newsletter</h1>
                <div class="search_bar">
                    <input type="text" placeholder="You email id here">
                    <button type="submit">Subscribe</button>
                </div>                
            </div>            
        </div>
        <p class="end">Design By<span><i class="fa-solid fa-face-grin"></i> TEAM AVENGERS</span></p>
    </footer>
</body>
</html>
