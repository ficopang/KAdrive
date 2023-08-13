<header>
    <div class="left-container">
        <a href="./index.php?id=<?= $_SESSION['id'] ?>&username=<?= $_SESSION['username'] ?>">
            <img id="logo" src="./assets/logo.png" alt="">
        </a>
    </div>

    <div class="right-container">
        <p>Hi, <?= $_SESSION['username']; ?>!</p>
        <a href="./controller/logoutController.php" id="logout-btn">Logout</a>
    </div>
</header>