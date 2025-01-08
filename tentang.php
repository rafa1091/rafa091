<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        header {
            background-color: #f9f9f9;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            color: black;
        }

        .navbar-brand i {
            margin-right: 8px;
            color: #333;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 18px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #da8787;
        }

        .header-icons a {
            color: #333;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .header-icons a:hover {
            color: #da8787;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(to right, #eaeaea, #f4f9b6);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .hero-content {
            max-width: 800px;
            padding: 20px;
            animation: fadeIn 1.5s ease-in-out forwards;
        }

        .hero h1 {
            color: black;
            font-size: 48px;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .hero p {
            color: black;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .hero ul {
            color: black;
            text-align: left;
            margin: 20px auto;
            max-width: 600px;
            list-style: disc;
            padding-left: 20px;
        }

        .hero ul li {
            color: black;
            margin-bottom: 10px;
        }
        /* Footer */
.footer {
    background: #333;
    color: white;
    text-align: center;
    padding: 1px 0;
}
.footer .social-links {
    list-style: none;
    display: flex;
    justify-content: center;
    margin: 15px 0;
}
.footer .social-links li {
    margin: 0 10px;
}
.footer .social-links a {
    color: white;
    text-decoration: white;
    font-size: 1.2rem;
}
.footer .social-links a:hover {
    color: #ff6347;
}
        .fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeIn 0.5s ease-in-out forwards;
}

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 10px 20px;
            }

            nav ul {
                gap: 10px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero p, .hero ul {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a class="navbar-brand" href="#">
            <i class="fas fa-dumbbell" aria-hidden="true"></i> Diet For Beginner
        </a>
        <nav>
            <ul>
                <li><a href="landingpage.php">Halaman</a></li>
                <li><a href="tentang.php">Tentang</a></li>
            </ul>
        </nav>
        <div class="header-icons">
            <a href="login.php" aria-label="Login">
                <i class="fa-solid fa-user"></i>
            </a>
        </div>
    </header>

    <!-- Main Section -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Selamat Datang!</h1>
                <p>
                    Kami memahami bahwa memulai diet dan gaya hidup sehat bisa jadi tantangan besar, terutama bagi pemula. 
                    <strong>Diet For Beginners</strong> hadir untuk membantumu mengatur pola latihan dan makan, memilih makanan sehat, 
                    dan memantau perkembangan dietmu dengan cara yang praktis dan menyenangkan.
                </p>
                <ul>
                    <li>Panduan latihan fisik yang mudah dipahami</li>
                    <li>Program makan sehat dan terstruktur</li>
                </ul>
                <p>
                    Dengan pendekatan yang ramah pengguna dan tips praktis, kami percaya setiap orang bisa mencapai tubuh sehat dan idealnya.
                </p>
                <p><em><strong>Bersama Diet For Beginners, mulailah langkah kecil untuk perubahan besar dalam hidupmu!</strong></em></p>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer class="footer">
            <div class="container">
                <p>&copy; 2024 All right reserved.</p>
                <ul class="social-links">

                <li><a href="#">Instagram</a></li>
                </ul>
            </div>
        </footer>
</body>
</html>
