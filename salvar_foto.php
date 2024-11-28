<?php
session_start();
include 'conectar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = $_SESSION['user_email'];
    
    // Verifica se o arquivo foi enviado
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
        $file = $_FILES['foto_perfil'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        // Verifica a extensão do arquivo
        if (in_array($ext, $allowed)) {
            $newFileName = uniqid() . '.' . $ext;
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . $newFileName;

            // Move o arquivo para o diretório de uploads
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // Atualiza o caminho da foto no banco de dados
                $sql = "UPDATE user SET foto_perfil = ? WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $uploadFile, $userEmail);

                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "file_path" => $uploadFile]);
                } else {
                    echo json_encode(["success" => false, "message" => "Erro ao salvar no banco de dados."]);
                }
                $stmt->close();
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao mover o arquivo."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Tipo de arquivo não permitido."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Nenhum arquivo enviado."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método não permitido."]);
}
$conn->close();
?>
