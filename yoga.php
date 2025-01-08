<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yoga</title>
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
            <!-- Item 1: Navasana -->
            <div class="item">
                <img src="https://youaligned.com/wp-content/uploads/2020/08/halfboat.jpg" alt="Lompat Tali">
                <div class="text">
                    <h3 class="fade-in">Navasana (Boat Pose)</h3>
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
                            <h5 class="modal-title" id="detailModalLabel1">Detail Latihan - Navasana (Boat Pose)</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://www.yogaclassplan.com/wp-content/uploads/2021/06/22-boat-pose.jpg" class="img-fluid mb-3" alt="Detail Push Up">
                            <p>Sesuai namanya, boat pose akan membuat tubuh Anda terlihat mengambang seperti perahu. Pose ini melatih keseimbangan tubuh, sekaligus kekuatan otot punggung, panggul, dan perut.</p>
                            <P>Duduk pada matras dan rapatkan kedua kaki lurus ke depan. Kemudian, tekuk kedua lutut dan dekatkan ke arah dada Anda.</p>
                            <p>Perlahan angkat kedua kaki ke udara hingga lutut kembali lurus. Kencangkan otot perut dan tegakkan dada.</p>
                            <p><strong>Latihan:</strong> 10 - 30 detik</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Item 2: Four-limbed staff pose -->
            <div class="item">
                <img src="https://cdn.shopify.com/s/files/1/0259/3665/8531/files/04_5e54777c-af9a-482e-9c34-89222f7fc34c.jpg?v=1633082299" alt="Four-limbed staff pose">
                <div class="text">
                    <h3 class="fade-in">Four-limbed staff pose</h3>
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
                            <h5 class="modal-title" id="detailModalLabel2">Detail Latihan - Four-limbed staff pose</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="https://cdn.prod.website-files.com/5b44edefca321a1e2d0c2aa6/5ef3ed67fb8d6acc8b3a8dd0_Dimensions-Humans-Yoga-Poses-Four-Limbed-Staff-Pose-Women.svg" class="img-fluid mb-3" alt="Detail Four-limbed staff pose">
                            <p>Four-limbed staff pose mungkin lebih Anda kenali sebagai gerakan plank. Salah satu manfaat plank adalah mengencangkan otot perut yang bisa membantu menurunkan berat badan Anda.</p>
                            <p>Pastikan kondisi kaki Anda lurus ke belakang. Sementara lengan menekuk dengan sudut 90 derajat di sisi tubuh dengan telapak tangan menahan tubuh bagian atas.</p>
                            <P>Pertahankan plank pose dengan pandangan mata menghadap matras dan tubuh tetap lurus sambil mengencangkan otot perut.</p>
                            <p><strong>Durasi:</strong>30 - 60 detik</p>
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
