<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Violation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/admin_table_style.css">
</head>
<body>
    <div class="modal fade" id="addViolationModal" tabindex="-1" aria-labelledby="addViolationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addViolationModalLabel">Add Violation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="Admin_FinalOutput\includes\formhandler_addingToViolationList.php"?>">
                        <strong>ViolationID #
                            <?php $lastViolation = end($violations); ?>
                            <?php $nextViolationID = $lastViolation['ViolationID'] + 1; ?>
                            <label><?php echo $nextViolationID; ?>:</label>
                            <input type="text" id="new_violation" name="new_violation" class="textboxAdd" value="<?php echo $newViolation; ?>">
                        </strong>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-custom">Add</button>
                    <button type="submit" name="cancel" class="btn btn-custom">Cancel</button>
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