<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
