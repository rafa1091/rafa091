<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Fisik</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #111;
        }

        /* Header */
        header {
            background-color: transparent;
            padding: 20px 50px;
            width: 100%;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: background-color 0.3s;
        }

        /* Back Button */
        .btn-back {
            margin: 20px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 16px;
            border: 2px solid #ccc;
            padding: 8px 12px;
            text-decoration: none;
            color: #111;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-back:hover {
            background-color: #da8787;
            color: #fff;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(135deg, #da8787, #111);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #f0f0f0;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .hero-button {
            display: inline-block;
            background-color: #fff;
            color: #111;
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .hero-button:hover {
            background-color: #da8787;
            color: #fff;
            transform: scale(1.05);
        }

        /* Content Section */
        .content {
            background-color: #000;
            padding: 60px 20px;
            display: grid;
            gap: 20px;
        }

        .item {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            height: 400px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            background: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 10px;
            max-width: 80%;
            transition: background-color 0.3s;
        }

        .text h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .text a {
            color: #da8787;
            text-decoration: none;
            font-weight: 600;
        }

        .text a:hover {
            text-decoration: underline;
        }

        /* Fade-in Animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1.5s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .item {
                height: 200px;
            }

            .text {
                bottom: 10px;
                left: 10px;
                padding: 10px;
            }

            .text h3 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <a href="javascript:history.back()" class="btn-back" aria-label="Go Back">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>

    
    <!-- Content Section -->
    <section class="content" id="content">
        <div class="item">
            <img src="https://orinews.id/wp-content/uploads/2023/09/olahraga-kardio.jpg" alt="Latihan Kardio">
            <div class="text">
                <h3 class="fade-in">Kardio</h3>
                <a href="kardio.php" class="fade-in">Jelajahi <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="item">
            <img src="https://cove-blog-id.sgp1.cdn.digitaloceanspaces.com/cove-blog-id/2023/08/angkat-beban.webp" alt="Latihan Beban">
            <div class="text">
                <h3 class="fade-in">Latihan Beban</h3>
                <a href="latihanbeban.php" class="fade-in">Jelajahi <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="item">
            <img src="https://www.ekhartyoga.com/media/image/articles/Laia_Bove_Mermaid-pose.jpg" alt="Latihan Yoga">
            <div class="text">
                <h3 class="fade-in">Yoga</h3>
                <a href="yoga.php" class="fade-in">Jelajahi <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
</body>
</html>
