<?php 

function getUserById($id_user, $db) {
    // Validasi ID
    if (!is_numeric($id_user) || $id_user <= 0) {
        return 0; // ID tidak valid
    }

    // Query untuk mendapatkan user berdasarkan ID
    $sql = "SELECT * FROM users WHERE id_user = ?";
    
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute([$id_user]);

        // Periksa apakah user ditemukan
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(); // Ambil data user
            return $user;
        } else {
            return 0; // User tidak ditemukan
        }
    } catch (PDOException $e) {
        // Tangani error (opsional: log error untuk debugging)
        error_log("Database error: " . $e->getMessage());
        return 0;
    }
}
?>
