<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep Makanan</title>
    <!-- Fonts and Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            color: #333;
        }

        /* Header */
        header {
            background-color: transparent;
            padding: 20px 50px;
            transition: background-color 0.3s;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: black;
            font-weight: 500;
            font-size: 18px;
            transition: color 0.7s;
        }

        nav ul li a:hover {
            color: #eeff00;
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
            border-radius: 20px;
            overflow: hidden;
            height: 500px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            transition: transform 0.3s;
        }

        .item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }

        .text {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            max-width: 80%;
        }

        /* Fade-in Animation */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1.5s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content {
                padding: 30px 10px;
            }

            .item {
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <button onclick="history.back()" class="btn btn-outline-secondary m-3" aria-label="Go Back">
        <i class="fas fa-arrow-left"></i> Go Back
    </button>

    <!-- Main Content -->
    <main>
        <section class="content">
            <!-- Item 1: Push Up -->
            <div class="item">
                <img src="https://img-global.cpcdn.com/recipes/ddb63f08f0ebc7c9/1280x1280sq70/photo.webp" alt="Lompat Tali">
                <div class="text">
                    <h3 class="fade-in">Mie Shirataki</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal1">
                        Details
                    </button>
                </div>
            </div>

            <!-- Modal 1 -->
            <div class="modal fade" id="detailModal1" tabindex="-1" aria-labelledby="detailModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel1">Detail Resep</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://img-global.cpcdn.com/recipes/ddb63f08f0ebc7c9/1280x1280sq70/photo.webp" class="img-fluid mb-3" alt="Detail Push Up">
                            <p>1 buah mie shirataki (25gram) direbus matang potong Kol sesuai selera, 1 buah wortel, potong memanjang</p>
                            <P>1 buah telor Garam, kecap manis 1 siung bawang putih, 1 siung bawang merah</p>
                            <p><strong>Cara Memasak:</strong>Tumis bawang merah, putih, mskan wortel, kol klo sudah matang mskan telor, diamkan sampai telor agak sedikit matang. Aduk rata, mskan mie tambah bumbu n kecap</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 2: Kwetiau -->
            <div class="item">
                <img src="https://o-cdn-cas.oramiland.com/parenting/images/Kwetiau.width-800.format-webp.webp" alt="Kwetiau">
                <div class="text">
                    <h3 class="fade-in">Kwetiau</h3>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal2">
                        Details
                    </button>
                </div>
            </div>

            <!-- Modal 2 -->
            <div class="modal fade" id="detailModal2" tabindex="-1" aria-labelledby="detailModalLabel2" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel2">Detail Resep</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://o-cdn-cas.oramiland.com/parenting/images/Kwetiau.width-800.format-webp.webp" class="img-fluid mb-3" alt="Detail Kwetiau">
                            <p>1 bungkus kwetiau 1/2 batang wortel 100 gr tauge 2 batang sosin</p>
                            <p>3 sdm minyak Penyedap rasa jamur secukupnya Kecap asin secukupnya</p>
                            <p>Masukan minyak ke dalam wajan. Masukan wortel sosin oseng-oseng hingga layu. Lalu masukan kwetiau.</p>
                            <p><strong>Cara Memasak:</strong>Masukan penyedap rasa dan kecap asin.Beri air secukupnya oseng-oseng hingga matang.Kwetiau oseng siap disajikan.</p>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
