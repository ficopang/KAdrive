<div id="add-folder-modal-container" class="modal-container">
    <div id="add-folder-modal" class="modals">
        <h3 class="modals-title">Add New Folder</h3>
        <form action="./controller/fileFolderController.php" method="POST">
            <!-- YOU CAN CHANGE THIS CODE BELOW USING PHP: -->
            <!-- !!CODE START HERE -->

            <input type="hidden" name="id" value="<?= $_SESSION['id']; ?>">
            <input type="hidden" name="username" value="<?= $_SESSION['username']; ?>">
            <input type="hidden" name="dir" value="<?= $_GET['dir'] ?>">

            <!-- !!CODE END HERE -->

            <input type="text" name="folderName" class="folder-name f-name" placeholder="Folder Name">

            <div class="modal-buttons">
                <input type="button" value="Cancel" class="cancel-btn m-btn" onclick="closeModal()">
                <input type="submit" value="Create Folder" class="submit-btn m-btn" name="add-folder">
            </div>
        </form>
    </div>
</div>

<div id="rename-modal-container" class="modal-container">
    <div class="modals">
        <h3 class="modals-title">Rename</h3>

        <form action="./controller/fileFolderController.php" method="POST">
            <!-- YOU CAN CHANGE THIS CODE BELOW USING PHP: -->
            <!-- !!CODE START HERE -->

            <input type="hidden" name="id" value="<?= $_SESSION['id']; ?>">
            <input type="hidden" name="username" value="<?= $_SESSION['username']; ?>">
            <input type="hidden" name="dir" value="<?= $_GET['dir'] ?>">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
            <input type="hidden" name="oldName" id="old-name">

            <!-- !!CODE END HERE -->

            <input type="text" name="fName" id="new-name" class="f-name">
            <div class="modal-buttons">
                <input type="button" value="Cancel" class="cancel-btn m-btn" onclick="closeModal()">
                <input type="submit" value="Rename" class="submit-btn m-btn" name="rename-f">
            </div>
        </form>
    </div>
</div>

<div id="delete-modal-container" class="modal-container">
    <div class="modals">
        <h3 class="modals-title">Are you sure you want to delete?</h3>

        <form action="./controller/fileFolderController.php" method="POST">
            <!-- YOU CAN CHANGE THIS CODE BELOW USING PHP: -->
            <!-- !!CODE START HERE -->

            <input type="hidden" name="id" value="<?= $_SESSION['id']; ?>">
            <input type="hidden" name="username" value="<?= $_SESSION['username']; ?>">
            <input type="hidden" name="dir" value="<?= $_GET['dir'] ?>">
            <input type="hidden" name="fName" id="f-name" class="f-name">
            <input type="hidden" name="page" value="<?= $_GET['page'] ?>">

            <!-- !!CODE END HERE -->

            <div class="modal-buttons">
                <input type="button" value="Cancel" class="cancel-btn m-btn" onclick="closeModal()">
                <input type="submit" value="Confirm" class="submit-btn m-btn" name="delete-f">
            </div>
        </form>
    </div>
</div>