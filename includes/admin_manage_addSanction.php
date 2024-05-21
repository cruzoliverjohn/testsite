<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Sanction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_table_style.css">
</head>
<body>
    <?php
        include_once("includes/db_connection.php");
    ?>
    <div class="modal fade" id="addSanctionModal" tabindex="-1" aria-labelledby="addSanctionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSanctionModalLabel">Add Sanction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <strong>SanctionID #</strong>
                        <?php $lastSanction = end($sanctions); ?>
                        <?php $nextSanctionID = $lastSanction['sanctionID'] + 1; ?>
                        <label><?php echo $nextSanctionID; ?>:</label>
                        <input type="text" id="new_sanction" name="new_sanction" class="textboxAdd" value="<?php echo $newSanction; ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-custom">Add</button>
                    <button type="button" class="btn btn-custom" data-bs-dismiss="modal">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="JS/admin_manage_Adding.js"></script>
    <script src="JS/admin_violation_validation.js"></script>
</body>
</html>