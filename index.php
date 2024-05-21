<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/admin_loginDone.css">
</head>
<body>
    <div class="d-flex flex-column align-items-center">
        <div class="left-content">
            <img src="IMG/logo.png" alt="Image" class="img-fluid">
        </div>
        <div class="text-overlay">
            <p class="text-white fw-bold">LYCEUM OF<br>SUBIC BAY INC.</p>
            <h2 class="text-white fw-bold">Student Violation Management System<br><br></h2>
            <h6 class="text-white">Managed by Office of Student Affairs and Services</h6>
        </div>
        <div class="container">
            <form action="includes/admin_login_handler.php" method="post">
                <h3 class="text-center fw-semibold">Admin Access Module</h3>
                <div class="mb-3 bg p-5 rounded">
                    <label for="username" class="form-label fw-medium">User ID</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                    <label for="password" class="form-label mt-3 fw-medium">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i id="eyeIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    <input type="submit" class="btn btn-color btn-fluid text-center mt-5 w-100 mx-auto" value="Login">
                </div>
            </form>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/3b2e9f2e5b.js" crossorigin="anonymous"></script>
    <script src="JS/error_handling.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("togglePassword").addEventListener("click", function() {
            var passwordInput = document.getElementById("passwordInput");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
    </script>
</body>
</html>
