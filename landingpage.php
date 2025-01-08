<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #ffffff;
    color: #f0f0f0;
}

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

.hero {
    height: 100vh;
    background: linear-gradient(to right, #eaeaea, #f4f9b6);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 0 20px;
    color: #f0f0f0;
}

.hero h1 {
    color: black;
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 20px;
}

.hero p {
    color: black;
    font-size: 20px;
    margin-bottom: 30px;
    
}

.hero-button {
    display: inline-block;
    background-color: #f0f0f0;
    color: #111;
    padding: 12px 24px;
    font-size: 18px;
    font-weight: 600;
    border-radius: 50px;
    text-decoration: none;
    transition: background-color 0.3s, transform 0.3s;
}

.hero-button:hover {
    background-color: #da8787;
    color: #f0f0f0;
    transform: scale(1.05);
}
.content {
    background-color: #000000;
    padding: 60px 0;
    display: grid;
    gap: 20px;

}

.item {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 500px; 
}

.item img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Pastikan gambar memenuhi elemen tanpa distorsi */
    object-position: center; /* Letakkan fokus gambar di tengah */
    border-radius: 20px; /* Tetap mempertahankan radius sudut */
    transition: transform 0.3s, filter 0.3s;
}

.item:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
}

.item:hover img {
    transform: scale(1.05);
    filter: brightness(0.8);
}

.text {
    position: absolute;
    bottom: 20px;
    left: 20px;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.6);
    padding: 15px;
    border-radius: 10px;
    max-width: 80%;
    transition: background-color 0.3s;
}

.text h3 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 10px;
}

.text a {
    color: #da8787;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 18px;
}

.text a:hover {
    text-decoration: underline;
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

@media (max-width: 768px) {
    .content {
        padding: 30px 20px;
        gap: 20px;
    }

    .item {
        height: 200px; 
    }

    .item img {
        border-radius: 15px;
    }

    .text {
        bottom: 15px;
        left: 15px;
        padding: 10px;
    }

    .text h3 {
        font-size: 20px;
    }

    .text a {
        font-size: 16px;
    }
}
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeIn 0.5s ease-in-out forwards;
}

@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
    <title>Diet For Beginner</title>
</head>
<body>
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

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="fade-in">Selamat Datang </h1>
                <p>Jadilah versi terbaik dari dirimu dengan diet yang tepat.</p>
                <a href="login.php" class="hero-button fade-in">Get Started <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </section>

        <section class="content">
            <div class="item">
                <div class="item-inner">
                    <img src="https://laminarehab.com/wp-content/uploads/2023/09/contoh-latihan-daya-tahan.jpeg" alt="Artworks Exhibition">
                    <div class="text">
                        <h3 class="fade-in">Latihan Fisik</h3>
                        <a href="landinglfisik.php" class="fade-in">Jelajahi <span><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="item-inner">
                    <img src="https://cdn.antaranews.com/cache/1200x800/2023/05/05/photo_2023-05-05_18-01-59.jpg.webp" alt="Historical Museum Tour">
                    <div class="text">
                        <h3 class="fade-in">Resep Makan</h3>
                        <a href="jenismakan.php" class="fade-in">Jelajahi <span><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            
                </div>
            </div>
        </section>
    </main>
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