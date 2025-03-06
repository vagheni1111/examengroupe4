 <?php
session_start();

// Générer un nombre aléatoire et le stocker en session
if (!isset($_SESSION['number_to_guess'])) {
    $_SESSION['number_to_guess'] = rand(1, 100);
    $_SESSION['attempts'] = 0;
}

// Réinitialiser la session si l'utilisateur veut recommencer
if (isset($_POST['reset'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['guess'])) {
    $guess = intval($_POST['guess']);
    $_SESSION['attempts']++;

    if ($guess < $_SESSION['number_to_guess']) {
        $message = "C'est plus grand !";
    } elseif ($guess > $_SESSION['number_to_guess']) {
        $message = "C'est plus petit !";
    } else {
        $message = "Félicitations ! Vous avez deviné le nombre en " . $_SESSION['attempts'] . " essais.";
        session_destroy();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jeu de Devinette de Nombre</title>
</head>
<link rel="stylesheet" href="style.css">
<body>
    <div class="container">
        <div class="bg-container">
            <h1>Jeu de Devinette de Nombre</h1>
            <p>Je pense à un nombre entre 1 et 100. Pouvez-vous le deviner ?</p>

            <form method="post">
                <input type="number" name="guess" required>
                <button type="submit">Deviner</button>
            </form>

            <?php if (isset($message)): ?>
                <p><?= $message ?></p>
            <?php endif; ?>

            <form method="post">
                <button type="submit" name="reset">Recommencer</button>
            </form>
        </div>
    </div> 
    <script src="script.js"></script>
</body>
</html>
