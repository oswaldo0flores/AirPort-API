<?php
// HW8 - Airport API   Oswaldo Flores
require('views/header.php'); ?>
<main>
    <p>Open a .dat file (DAT file)</p>
    <br />
<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="<?= DATA_FILE_ACTION; ?>" />
    <input type="file" name="data_files"/>
    <input type="submit" name="submit" value="Upload" />
</form>
    <br />
    <?php if(isset($doesDatabaseContainData) and $doesDatabaseContainData): ?>
    <a href="documentation.php">Documentation</a>
    <?php endif; ?>
</main>
<?php require('views/footer.php'); ?>
