<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../../composer/vendor/autoload.php';

// Pagination and DB logic BEFORE HTML
$maxRows = isset($_GET['maxRows']) ? intval($_GET['maxRows']) : 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Connect to DB
$conn = new mysqli("localhost", "root", "", "db_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count total users
$totalUsersResult = $conn->query("SELECT COUNT(*) as total FROM user_accounts");
$totalUsers = $totalUsersResult ? $totalUsersResult->fetch_assoc()['total'] : 0;
$totalPages = $maxRows > 0 ? ceil($totalUsers / $maxRows) : 1;
$offset = ($page - 1) * $maxRows;

// Fetch paginated users
$sql = "SELECT * FROM user_accounts LIMIT $maxRows OFFSET $offset";
$result = $conn->query($sql);

// Handle Add User form submission
$addUserMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
  $firstName = $_POST['FirstName'];
  $lastName = $_POST['LastName'];
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

  $conn = new mysqli("localhost", "root", "", "testing");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("INSERT INTO user_accounts (FirstName, LastName, Email_Add, Password, Created_AT, Updated_AT, Status, Verification_Code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssssss", $firstName, $lastName, $email, $password, $createdAt, $updatedAt, $status, $verification_code);
  $stmt->execute();
  $stmt->close();
  $conn->close();

  // (Optional) Send verification email if status is inactive
  if ($verification_code) {
      $verify_link = "http://localhost/System/SoundStage/src/pages/auth/verify.php?code=$verification_code";
      $subject = "Verify your SoundStage account";
      $message = "Click this link to verify: $verify_link";

      $mail = new PHPMailer(true);
      try {
          //Server settings
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'customerservicesoundstage@gmail.com'; // Your Gmail address
          $mail->Password   = 'uotdoblzaisbokky';    // Gmail App Password, hindi regular password!
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port       = 587;

          //Recipients  
          $mail->setFrom('customerservicesoundstage@gmail.com', 'SoundStage');
          $mail->addAddress($email, $firstName . ' ' . $lastName);

          //Content
          $mail->isHTML(false);
          $mail->Subject = $subject;
          $mail->Body    = $message;

          $mail->send();
          $addUserMessage = "Verification email sent to $email.";
      } catch (Exception $e) {
          $addUserMessage = "Failed to send verification email. Mailer Error: {$mail->ErrorInfo}";
      }
  }

  header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userlist | SoundStage</title>
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/styles/users.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <?php include '../../components/admin/sidebar/sidebar.php'; ?>
    <div class="main-content flex-grow-1" style="margin-left:250px; min-height:100vh; background:#fafbfc;">
        <!-- Header -->
        <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-2 mb-4">
            <a class="navbar-brand fw-300" href="dashboard.php">SoundStage</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button class="btn btn-primary d-flex align-items-center gap-2 ms-auto" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-person-plus"></i>
                Add User
            </button>
        </header>

        <!-- Main Content -->
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
            <!-- Add User Message -->
            <?php if (!empty($addUserMessage)): ?>
                <div class="alert alert-info"><?= $addUserMessage ?></div>
            <?php endif; ?>
            <div class="table-responsive rounded shadow-sm bg-white p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 40px;"><input type="checkbox" id="selectAllUsers"></th>
                            <th style="width: 70px;">User ID</th>
                            <th style="width: 120px;">First Name</th>
                            <th style="width: 120px;">Last Name</th>
                            <th style="width: 220px;">Email</th>
                            <th style="width: 150px;" class="text-nowrap">Created At</th>
                            <th style="width: 150px;" class="text-nowrap">Updated At</th>
                            <th style="width: 90px;">Status</th>
                            <th style="width: 110px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><input type="checkbox" class="user-checkbox" value="<?= $row['User_ID'] ?>"></td>
                                <td><?= $row['User_ID'] ?></td>
                                <td><?= htmlspecialchars($row['FirstName']) ?></td>
                                <td><?= htmlspecialchars($row['LastName']) ?></td>
                                <td><?= htmlspecialchars($row['Email_Add']) ?></td>
                                <td class="text-nowrap"><?= htmlspecialchars($row['Created_AT']) ?></td>
                                <td class="text-nowrap"><?= htmlspecialchars($row['Updated_AT']) ?></td>
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
                            <?php endwhile; ?>
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
                            <label for="resetPassword" class="form-label">New Password for <span id="resetUserEmail" class="fw-bold"></span></label>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const userSearchInput = document.getElementById('userSearchInput');
    const userTableBody = document.getElementById('userTableBody');
    const editUserForm = document.getElementById('editUserForm');
    const editUserModal = document.getElementById('editUserModal');
    const avatarInput = document.getElementById('userAvatar');

    // Search functionality
    if (userSearchInput) {
        userSearchInput.addEventListener('input', debounce(function() {
            const filter = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#userTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        }, 300));
    }

    // Event delegation for user actions
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

    // Form submission for editing user
    if (editUserForm) {
        editUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            submitEditUserForm();
        });
    }

    // Avatar preview
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const [file] = this.files;
            if (file && file.type.startsWith('image/')) {
                document.getElementById('avatarPreview').src = URL.createObjectURL(file);
            }
        });
    }

    // Helper functions
    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
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
        const editUserForm = document.getElementById('editUserForm');
        editUserForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(editUserForm); // Automatically gets data from the form
        //If you are not getting the user_id from the form, you can append it like this:
        const userId = document.getElementById('editUserModal').dataset.userid;
        formData.append('user_id', userId);

        fetch('update_user_info.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Failed to update user info: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating user info.');
        });
    });
}

    async function handleResetPassword(e) {
        try {
            const btn = e.target.closest('.reset-pass-btn');
            document.getElementById('resetUserEmail').textContent = btn.dataset.email;
            
            const modal = new bootstrap.Modal(document.getElementById('resetPasswordModal'));
            modal.show();
            
            // Clear password field when modal is shown
            document.getElementById('resetPassword').value = '';
        } catch (error) {
            console.error('Reset password error:', error);
            alert('An error occurred while preparing to reset password.');
        }
    }

    async function handleBanUnban(e) {
        try {
            const btn = e.target.closest('.ban-unban-btn');
            const userId = btn.dataset.userid;
            const userName = btn.dataset.name;
            const currentStatus = btn.dataset.status;
            const isBanned = currentStatus.toLowerCase() !== 'active';
            const newStatus = isBanned ? 'Active' : 'Inactive';
            
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
                    
                    const response = await fetch('update_user_status.php', {
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
        document.getElementById('deleteAccountModal').dataset.userid = userId;

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
        modal.show();
    } catch (error) {
        console.error('Delete user setup error:', error);
        alert('An error occurred while preparing to delete user.');
    }
}

// Handle delete account form submission
const deleteAccountForm = document.getElementById('deleteAccountForm');
if (deleteAccountForm) {
    deleteAccountForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const userId = document.getElementById('deleteAccountModal').dataset.userid;
        const formData = new FormData();
        formData.append('user_id', userId);

        fetch('delete_user.php', {
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
  });
</script>
</body>
</html>