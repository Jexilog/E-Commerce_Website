<?php
    require_once __DIR__ . "../../../database.php"; //PDO Database Connection

    //Database Connection Validation
    if($pdo == null){
        die("Database connection failed.");
    }

    $maxRows = isset($_GET['maxRows']) ? intval($_GET['maxRows']) : 5;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

    //Count total number of users
    $countUser = "SELECT COUNT(*) AS total FROM user_accounts";
    $totalUserCount = $pdo->query($countUser);
    $TotalUserResult = $totalUserCount ? $totalUserCount->fetch(PDO::FETCH_ASSOC)['total'] : 0;
    $totalPages = $maxRows > 0 ? ceil($TotalUserResult / $maxRows) : 1;
    $offset = ($page - 1) * $maxRows;

    //Fetching records from the database
    $show = "SELECT * FROM user_accounts LIMIT $maxRows OFFSET $offset";
    $stmt = $pdo->query($show);
    $result = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
  
    $addUserMessage = ''; //Error Message Variable

   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
        //$image =$_FILES['avatar'] ?? null;
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
        // $uname = $_POST['UserName']; 
        $email = $_POST['Email_Add'];
        $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        $status = $_POST['Status'];
        $createdAt = date('Y-m-d H:i:s');
        $updatedAt = $createdAt;

        // If status is Inactive, generate verification code
        $verification_code = null;
        if (strtolower($status) === 'inactive') {
            $verification_code = bin2hex(random_bytes(16));
        }

        $pdo = new PDO("mysql:host=localhost;dbname=db_websystem", "root", "");
        if (!$pdo) {
            die("Connection failed: " . $pdo->errorInfo()[2]);
        }
   
        // ...existing code...
        // Check if email already exists
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM user_accounts WHERE Email_Add = ?");
        $checkStmt->execute([$email]);
        if ($checkStmt->fetchColumn() > 0) {
            $addUserMessage = "Email already exists. Please use a different email.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO user_accounts (FirstName, LastName, Email_Add, Password, Created_AT, Updated_AT, Status, Verification_Code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $email, $password, $createdAt, $updatedAt, $status, $verification_code]);
        }

  // (Optional) Send verification email if status is inactive
//   if ($verification_code) {
//       $verify_link = "http://localhost/System/SoundStage/src/pages/auth/verify.php?code=$verification_code";
//       $subject = "Verify your SoundStage account";
//       $message = "Click this link to verify: $verify_link";

//       $mail = new PHPMailer(true);
//       try {
//           //Server settings
//           $mail->isSMTP();
//           $mail->Host       = 'smtp.gmail.com';
//           $mail->SMTPAuth   = true;
//           $mail->Username   = 'customerservicesoundstage@gmail.com'; // Your Gmail address
//           $mail->Password   = 'uotdoblzaisbokky';    // Gmail App Password, hindi regular password!
//           $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//           $mail->Port       = 587;

//           //Recipients  
//           $mail->setFrom('customerservicesoundstage@gmail.com', 'SoundStage');
//           $mail->addAddress($email, $firstName . ' ' . $lastName);

//           //Content
//           $mail->isHTML(false);
//           $mail->Subject = $subject;
//           $mail->Body    = $message;

//           $mail->send();
//           $addUserMessage = "Verification email sent to $email.";
//       } catch (Exception $e) {
//           $addUserMessage = "Failed to send verification email. Mailer Error: {$mail->ErrorInfo}";
//       }
//   }

//   header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
//   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>User | Admin Panel</title>
    <style>
        /* .table-responsive{
            overflow-x: auto;
            position:static !important;
            z-index: auto;
        } */

        .dropdown-menu {
            z-index: 1050 !important;
        }
        /* .table-responsive::-webkit-scrollbar {
            height: 8px;
            display: none;
        } */

        .alert{
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .alert i.bi-x {
            cursor: pointer;
            color: #dc3545;
            font-size: 1.6rem;
            font-weight: 1000;
            transition: color 0.3s ease;
            margin-left:500px;
        }
    </style>
</head>
<body style="padding:10px;">
    <?php include "../adminpage/sidebar/sidebar.php"?>

     <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-2 mb-4">
             <a class="navbar-brand fw-300" href="dashboard.php">CyberHack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="btn btn-primary d-flex align-items-center gap-2 ms-auto" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus"></i>
                Add User
            </button>
        </header>
                <main class="px-4 py-1">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div>
                    <h4 class="mb-1">User Management</h4>
                </div>
            </div>
            <!-- Search Filter -->
            <div class="mb-2">
                <div class="input-group" style="max-width:320px;">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" id="userSearchInput" placeholder="Search users by name or email...">
                </div>
            </div>
            <!-- Rows per page filter -->
            <form method="get" class="mb-2">
                <label for="maxRows" class="form-label me-2">Rows per page:</label>
                <select name="maxRows" id="maxRows" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                    <option value="5" <?= $maxRows == 5 ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= $maxRows == 10 ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= $maxRows == 25 ? 'selected' : '' ?>>25</option>
                    <option value="50" <?= $maxRows == 50 ? 'selected' : '' ?>>50</option>
                </select>
            </form>
            <button class="btn btn-danger btn-sm mb-2" id="deleteSelectedUsersBtn"><i class="bi bi-trash"></i> Delete Selected</button>
            <!-- Add User Message -->
            <?php if (!empty($addUserMessage)): ?>
                <div class="alert alert-info"><?= $addUserMessage ?>
                <i class="bi bi-x"></i>
            </div>
            <?php endif; ?>
            <div class="table-responsive rounded shadow-sm bg-white p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;"><input type="checkbox" id="selectAllUsers"></th>
                            <th style="width: 70px;">User ID</th>
                            <th style="width: 120px;">First Name</th>
                            <th style="width: 120px;">Last Name</th>
                            <th style="width: 220px;">UserName</th>
                            <th style="width: 220px;">Email</th>
                            <th style="width: 150px;" class="text-nowrap">Date Created</th>
                            <th style="width: 200px;">Time Created</th>
                            <th style="width: 150px;" class="text-nowrap">Date Updated</th>
                            <th style="width: 150px;">Time Updated</th>
                            <th style="width: 90px;">Status</th>
                            <th style="width: 110px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id ="userTableBody">
                        <?php if ($result && count($result) > 0): ?>
                            <!--?php $displayNo = ($page - 1) * $maxRows + 1; ?-->
                            <?php foreach($result as $row): ?>
                            <tr>
                                <td><input type="checkbox" class="user-checkbox" value="<?= $row['User_ID'] ?>"></td>
                                <td><?= $row['User_ID'] ?></td>
                                <td><?= htmlspecialchars($row['FirstName']) ?></td>
                                <td><?= htmlspecialchars($row['LastName']) ?></td>
                                <td></td>
                                <td><?= htmlspecialchars($row['Email_Add']) ?></td>
                                <td class="text-nowrap"><?= htmlspecialchars(date('Y-m-d', strtotime($row['Created_AT']))) ?></td>
                                <td class="text-nowrap"><?= htmlspecialchars(date('H:i:s', strtotime($row['Created_AT']))) ?></td>
                                <td class="text-nowrap"><?= htmlspecialchars(date('Y-m-d', strtotime($row['Updated_AT']))) ?></td>
                                <td class="text-nowrap"><?= htmlspecialchars(date('H:i:s', strtotime($row['Updated_AT']))) ?></td>
                                <td>
                                    <span class="badge bg-<?= strtolower($row['Status']) === 'active' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($row['Status']) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <div class="dropdown">
                                            <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item edit-user-btn d-flex align-items-center gap-2" href="#"
                                                        data-userid="<?= $row['User_ID'] ?>"
                                                        data-fname="<?= htmlspecialchars($row['FirstName']) ?>"
                                                        data-lname="<?= htmlspecialchars($row['LastName']) ?>"
                                                        data-email="<?= htmlspecialchars($row['Email_Add']) ?>"
                                                        data-status="<?= htmlspecialchars($row['Status']) ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                        <span>Edit User Info</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item reset-pass-btn d-flex align-items-center gap-2" href="#"
                                                        data-email="<?= htmlspecialchars($row['Email_Add']) ?>">
                                                        <i class="bi bi-arrow-repeat"></i>
                                                        <span>Reset Password</span>
                                                    </a>
                                                </li>
                                                <li class="d-flex align-items-center gap-2 px-3">
                                                    <i class="bi bi-slash-circle"></i>
                                                    <?php if (strtolower($row['Status']) === 'active'): ?>
                                                        <a class="ban-unban-btn text-danger fw-bold" href="#"
                                                            data-userid="<?= $row['User_ID'] ?>"
                                                            data-name="<?= htmlspecialchars($row['FirstName'].' '.$row['LastName']) ?>"
                                                            data-status="<?= htmlspecialchars($row['Status']) ?>">
                                                            Ban
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="ban-unban-btn text-success fw-bold" href="#"
                                                            data-userid="<?= $row['User_ID'] ?>"
                                                            data-name="<?= htmlspecialchars($row['FirstName'].' '.$row['LastName']) ?>"
                                                            data-status="<?= htmlspecialchars($row['Status']) ?>">
                                                            Unban
                                                        </a>
                                                    <?php endif; ?>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger delete-user-btn d-flex align-items-center gap-2" href="#"
                                                        data-userid="<?= $row['User_ID'] ?>"
                                                        data-name="<?= htmlspecialchars($row['FirstName'].' '.$row['LastName']) ?>">
                                                        <i class="bi bi-trash"></i>
                                                        <span>Delete Account</span>
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-2" href="order-history.php?email=<?= urlencode($row['Email_Add']) ?>&name=<?= urlencode($row['FirstName'].' '.$row['LastName']) ?>">
                                                        <i class="bi bi-clock-history"></i>
                                                        <span>View Order History</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination (dynamic) -->
            <nav aria-label="User table pagination" class="mt-3">
                <ul class="pagination justify-content-end mb-0" id="pagination">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>&maxRows=<?= $maxRows ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&maxRows=<?= $maxRows ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>&maxRows=<?= $maxRows ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
     <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form id="addUserForm" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="add_user" value="1">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title" id="addUserModalLabel">
                            <i class="bi bi-person-plus me-2"></i>Add User
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="row">
                            <!-- Avatar Upload -->
                            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center mb-3 mb-md-0">
                                <img id="avatarPreview" src="https://ui-avatars.com/api/?name=User" class="rounded-circle mb-2" width="90" height="90" alt="Avatar Preview">
                                <label for="userAvatar" class="form-label mb-1 small">Avatar</label>
                                <input class="form-control form-control-sm" type="file" id="userAvatar" name="avatar" accept="image/*" style="max-width: 180px;">
                            </div>
                            <!-- User Info -->
                            <div class="col-md-8">
                                <div class="row g-2">
                                    <div class="col-md-6 mb-2">
                                        <label for="userFirstName" class="form-label mb-1">First Name</label>
                                        <input type="text" class="form-control form-control-sm" id="userFirstName" name="FirstName" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="userLastName" class="form-label mb-1">Last Name</label>
                                        <input type="text" class="form-control form-control-sm" id="userLastName" name="LastName" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="userEmail" class="form-label mb-1">Email address</label>
                                        <input type="email" class="form-control form-control-sm" id="userEmail" name="Email_Add" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="userPassword" class="form-label mb-1">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="userPassword" name="Password" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="userStatus" class="form-label mb-1">Status</label>
                                        <select class="form-select form-select-sm" id="userStatus" name="Status">
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Banned">Banned</option>
                                            <option value="Unbanned">Unbanned</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit User Info Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form id="editUserForm" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title" id="editUserModalLabel"><i class="bi bi-pencil-square me-2"></i>Edit User Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="row g-2">
                            <div class="col-md-6 mb-2">
                                <label for="editFirstName" class="form-label mb-1">First Name</label>
                                <input type="text" class="form-control form-control-sm" id="editFirstName" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="editLastName" class="form-label mb-1">Last Name</label>
                                <input type="text" class="form-control form-control-sm" id="editLastName" name="last_name" required>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="editEmail" class="form-label mb-1">Email address</label>
                                <input type="email" class="form-control form-control-sm" id="editEmail" name="email" required>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="editStatus" class="form-label mb-1">Status</label>
                                <select class="form-select form-select-sm" id="editStatus" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Banned">Banned</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="resetPasswordForm" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title" id="resetPasswordModalLabel"><i class="bi bi-key me-2"></i>Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label for="resetPassword" class="form-label">New Password for <strong id="resetUserEmail" class="fw-bold"></strong></label>
                            <input type="password" class="form-control" id="resetPassword" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning btn-sm">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

       <!-- Ban/Unban Modal -->
    <div class="modal fade" id="banUnbanModal" tabindex="-1" aria-labelledby="banUnbanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="banUnbanForm">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title" id="banUnbanModalLabel"><i class="bi bi-person-x me-2"></i><span id="banUnbanTitle"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <p id="banUnbanMessage"></p>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm" id="banUnbanActionBtn"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteAccountForm">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title" id="deleteAccountModalLabel"><i class="bi bi-trash me-2"></i>Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <p>Are you sure you want to <span class="text-danger fw-bold">delete</span> the account of <span id="deleteUserName" class="fw-bold"></span>? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function (){
            const userSearchInput = document.getElementById('userSearchInput');
            const userTableBody = document.getElementById('userTableBody');
            const editUserForm = document.getElementById('editUserForm');
            const editUserModal = document.getElementById('editUserModal');
            const avatarInput = document.getElementById('userAvatar');

            if(userSearchInput){
                userSearchInput.addEventListener('input',debounce(searchUsers, 300));
            }

            if (userTableBody) {
                userTableBody.addEventListener('click', function(e) {
                    // Edit User
                    if (e.target.closest('.edit-user-btn')) {
                        handleEditUser(e);
                    }
                    // Reset Password
                    else if (e.target.closest('.reset-pass-btn')) {
                        handleResetPassword(e);
                    }
                    // Ban/Unban User
                    else if (e.target.closest('.ban-unban-btn')) {
                        handleBanUnban(e);
                    }
                    // Delete User
                    else if (e.target.closest('.delete-user-btn')) {
                        handleDeleteUser(e);
                    }
                });
            }

            const selectAllCheckbox = document.getElementById('selectAllUsers');

            if (selectAllCheckbox && userTableBody) {
                // When "Select All" is toggled
                selectAllCheckbox.addEventListener('change', function () {
                    const userCheckboxes = userTableBody.querySelectorAll('.user-checkbox');
                    userCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
                });

                // When any individual checkbox is toggled
                userTableBody.addEventListener('change', function (e) {
                    if (e.target.classList.contains('user-checkbox')) {
                        const userCheckboxes = userTableBody.querySelectorAll('.user-checkbox');
                        const allChecked = Array.from(userCheckboxes).every(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                    }
                });
            }

             if (editUserForm) {
                editUserForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    submitEditUserForm();
                });
            }

             if (avatarInput) {
                avatarInput.addEventListener('change', function(e) {
                    const [file] = this.files;
                    if (file && file.type.startsWith('image/')) {
                        document.getElementById('avatarPreview').src = URL.createObjectURL(file);
                    }
                });
            }

            const deleteSelectedBtn = document.getElementById('deleteSelectedUsersBtn');
                if (deleteSelectedBtn && userTableBody) {
                    deleteSelectedBtn.addEventListener('click', async function () {
                        // Get all checked user checkboxes
                        const checked = userTableBody.querySelectorAll('.user-checkbox:checked');
                        if (checked.length === 0) {
                            alert('Please select at least one user to delete.');
                            return;
                        }

                        if (!confirm(`Are you sure you want to delete ${checked.length} selected user(s)? This action cannot be undone.`)) {
                            return;
                        }

                        // Collect user IDs
                        const userIds = Array.from(checked).map(cb => cb.value);

                        // Send AJAX request
                        try {
                            const formData = new FormData();
                            userIds.forEach(id => formData.append('user_ids[]', id));

                            const response = await fetch('functions/delete_multiple_users.php', {
                                method: 'POST',
                                body: formData
                            });

                            const data = await response.json();
                            if (data.success) {
                                window.location.reload();
                            } else {
                                alert('Failed to delete users: ' + (data.message || 'Unknown error'));
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('An error occurred while deleting users.');
                        }
                    });
                }

             function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this, args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            function searchUsers() {
                const searchTerm = userSearchInput.value.toLowerCase();
                const rows = userTableBody.querySelectorAll('tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            }

            async function handleEditUser(e) {
                try {
                    e.preventDefault();
                    const btn = e.target.closest('.edit-user-btn');
                    
                    // Populate modal fields
                    document.getElementById('editFirstName').value = btn.dataset.fname;
                    document.getElementById('editLastName').value = btn.dataset.lname;
                    document.getElementById('editEmail').value = btn.dataset.email;
                    document.getElementById('editStatus').value = btn.dataset.status;
                    
                    // Store user ID
                    editUserModal.dataset.userid = btn.dataset.userid;
                    
                    // Show modal
                    const modal = new bootstrap.Modal(editUserModal);
                    modal.show();
                } catch (error) {
                    console.error('Edit user error:', error);
                    alert('An error occurred while preparing to edit user.');
                }
            }
            async function submitEditUserForm() {
                try {
                    const formData = new FormData(editUserForm);
                    formData.append('user_id', editUserModal.dataset.userid);
                    
                    const response = await fetch('functions/edit_user.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    if (result.success) {
                        alert('User updated successfully.');
                        location.reload(); // Reload to see changes
                    } else {
                        alert('Error updating user: ' + result.message);
                    }
                } catch (error) {
                    console.error('Edit user submission error:', error);
                    alert('An error occurred while updating user.');
                }
            }

            let currentResetUserID = null;
            async function handleResetPassword(e) {
                try {
                    const btn = e.target.closest('.reset-pass-btn');
                    currentResetUserID = btn.dataset.userid; // Store email for reset
                    const email = btn.dataset.email;

                     // Clear password field when modal is shown
                    document.getElementById('resetUserEmail').textContent = btn.dataset.email;
                    document.getElementById('resetPassword').value = '';
                    
                    const modal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
                    modal.show();
                    
                   
                } catch (error) {
                    console.error('Reset password error:', error);
                    alert('An error occurred while preparing to reset password.');
                }
            }

            document.getElementById('submitResetPassword').addEventListener('click', async () => {
            const newPassword = document.getElementById('resetPassword').value.trim();

            if (newPassword.length < 8) {
                alert('Password must be at least 8 characters.');
                return;
            }

            try {
                const response = await fetch('functions/reset_password.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        user_id: currentResetUserId,
                        new_password: newPassword
                    })
                });

                const data = await response.json();

                if (data.success) {
                    alert('Password reset successfully.');
                    bootstrap.Modal.getInstance(document.getElementById('resetPasswordModal')).hide();
                } else {
                    alert('Failed to reset password: ' + data.message);
                }
            } catch (error) {
                console.error('AJAX error:', error);
                alert('An error occurred while resetting the password.');
            }
        });

         async function handleBanUnban(e) {
            try {
                const btn = e.target.closest('.ban-unban-btn');
                const userId = btn.dataset.userid;
                const userName = btn.dataset.name;
                const currentStatus = btn.dataset.status;
                const isBanned = currentStatus.toLowerCase() !== 'active';
                const newStatus = isBanned ? 'Active' : 'Banned';
                
                // Update modal content
                document.getElementById('banUnbanTitle').textContent = isBanned ? 'Unban User' : 'Ban User';
                document.getElementById('banUnbanMessage').textContent = `Are you sure you want to ${isBanned ? 'unban' : 'ban'} ${userName}?`;
                document.getElementById('banUnbanActionBtn').textContent = isBanned ? 'Unban' : 'Ban';
                
                const modal = new bootstrap.Modal(document.getElementById('banUnbanModal'));
                modal.show();
                
                // Set up action button
                document.getElementById('banUnbanActionBtn').onclick = async function() {
                    try {
                        // Optimistic UI update
                        btn.dataset.status = newStatus;
                        const badge = btn.closest('tr').querySelector('.badge');
                        badge.textContent = newStatus;
                        badge.className = `badge bg-${newStatus === 'Active' ? 'success' : 'danger'}`;

                        btn.textContent = newStatus === 'Active' ? 'Ban' : 'Unban';
                        btn.classList.toggle('text-success', newStatus !== 'Active');
                        btn.classList.toggle('text-danger', newStatus === 'Active');
                        btn.classList.add('fw-bold');
                        
                        const response = await fetch('functions/update_user_status.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `user_id=${userId}&status=${newStatus}`
                        });
                        
                        const data = await response.json();
                        
                        if (!data.success) {
                            throw new Error(data.message || 'Failed to update status');
                        }
                    } catch (error) {
                        console.error('Ban/Unban error:', error);
                        // Revert UI on failure
                        btn.dataset.status = currentStatus;
                        const badge = btn.closest('tr').querySelector('.badge');
                        badge.textContent = currentStatus;
                        badge.className = `badge bg-${currentStatus.toLowerCase() === 'active' ? 'success' : 'danger'}`;
                        alert(error.message);
                    } finally {
                        modal.hide();
                    }
                };
            } catch (error) {
                console.error('Ban/Unban setup error:', error);
                alert('An error occurred while preparing ban/unban action.');
            }
        }

       async function handleDeleteUser(e) {
        try {
            const btn = e.target.closest('.delete-user-btn');
            const userId = btn.dataset.userid;
            const userName = btn.dataset.name;

            // Set user name in modal
            document.getElementById('deleteUserName').textContent = userName;

            // Store user ID in modal for later use
            const modalEl = document.getElementById('deleteAccountModal');
            modalEl.dataset.userid = userId;

            // Show modal
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        } catch (error) {
            console.error('Delete user setup error:', error);
            alert('An error occurred while preparing to delete user.');
        }

         const deleteAccountForm = document.getElementById('deleteAccountForm');
            if (deleteAccountForm) {
                deleteAccountForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const userId = document.getElementById('deleteAccountModal').dataset.userid;
                    const formData = new FormData();
                    formData.append('user_id', userId);

                    fetch('functions/delete_user.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Failed to delete user: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting user.');
                    });
                });
            }
        }
    });         
</script>
</body>
</html>