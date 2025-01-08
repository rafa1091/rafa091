<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Beban</title>
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
                <img src="https://ai-care.id/photos/Lifestyle/64e30cbff1b36.jpg" alt="Lompat Tali">
                <div class="text">
                    <h3 class="fade-in">Push Up</h3>
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
                            <h5 class="modal-title" id="detailModalLabel1">Detail Latihan - Push Up</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://www.tintahijau.com/wp-content/uploads/2024/05/Ilustrasi-PushUp.jpg" class="img-fluid mb-3" alt="Detail Push Up">
                            <p>Push-up termasuk latihan beban tubuh. Latihan ini merupakan gerakan klasik yang efektif untuk melatih beberapa kelompok otot sekaligus, termasuk otot dada, bahu, dan trisep.</p>
                            <P></p>
                            <p><strong>Latihan:</strong> 5 - 10 x 2 reps</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 2: Squat -->
            <div class="item">
                <img src="https://www.goldsgym.co.id/assets/img/uploads/img-3658.jpg" alt="Squat">
                <div class="text">
                    <h3 class="fade-in">Squat</h3>
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
                            <h5 class="modal-title" id="detailModalLabel2">Detail Latihan - Squat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://shopee.co.id/inspirasi-shopee/wp-content/uploads/2021/12/manfaat-squat-jump.webp" class="img-fluid mb-3" alt="Detail Squat">
                            <p>Latihan squat adalah latihan ketahanan yang dilakukan dengan menurunkan dan mengangkat kembali tubuh dari posisi jongkok. Squat merupakan salah satu latihan yang baik untuk meningkatkan kekuatan dan ukuran otot tubuh bagian bawah, serta memperkuat otot inti.</p>
                            <p><strong>Latihan:</strong>5 - 10 X 2 reps</p>
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
