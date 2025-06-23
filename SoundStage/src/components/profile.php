<?php
session_start();
require_once __DIR__ . '../../db.php';

$user = null;
if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM user_accounts WHERE User_ID = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if ($user && !empty($user['avatar'])) {
        $avatar = $user['avatar'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Setting | SoundStage</title>
    <link rel="icon" href="../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            background: #ffffff; 
            font-family: 'Segoe UI', sans-serif; 
        }
        .container.py-5.min-vh-100 {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .row.justify-content-center {
            width: 100%;
            display: flex;
            align-items: stretch;
        }
        .settings-sidebar {
            min-width: 240px;
            background: #003366;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 1rem 1.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .settings-sidebar .nav-link {
            color: #222;
            font-weight: 500;
            font-size: 1.07rem;
            border-radius: .5rem;
            display: flex;
            align-items: center;
            gap: .7rem;
            transition: background 0.2s, color 0.2s;
        }
        .settings-sidebar .nav-link.active, .settings-sidebar .nav-link:hover {
            background: #2563eb;
            color: #fff !important;
        }
        .settings-sidebar .nav-link.text-danger {
            color: #e53935 !important;
        }
        .settings-sidebar .nav-link.text-danger.active, .settings-sidebar .nav-link.text-danger:hover {
            background: #e53935;
            color: #fff !important;
        }
        .profile-edit-card {
            border-radius: 1.25rem;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            height: 100%;
            min-height: 600px; /* adjust as needed for your minimum card height */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .profile-picture-preview {
            width: 100px; height: 100px; object-fit: cover;
            border-radius: 50%; border: 2px solid #2563eb;
        }
        .form-label { font-weight: 500; }
        .tab-pane { display: none; }
        .tab-pane.active { display: block; }
    </style>
</head>
<body>

    <?php include '../components/header/header.php'; ?>

    <div class="container py-5 min-vh-100">
        <div class="row justify-content-center align-items-stretch" style="height: 100%;">
            <!-- Sidebar -->
            <div class="col-md-4 col-lg-3 mb-4 d-flex" style="height: 100%;">
                <div class="settings-sidebar w-100">
                    <h4 class="fw-bold mb-4 text-light">Settings</h4>
                    <ul class="nav flex-column gap-2" id="sidebar-nav">
                        <li class="nav-item">
                            <a class="nav-link active text-primary" href="#" onclick="showTab('account');return false;" id="tab-account">
                                <i class="bi bi-person-circle"></i> Account Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="#" onclick="showTab('security');return false;" id="tab-security">
                                <i class="bi bi-shield-lock"></i> Security Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="#" onclick="showTab('privacy');return false;" id="tab-privacy">
                                <i class="bi bi-shield-check"></i> Privacy Controls
                            </a>
                        </li>
                        <div class="divider text-light"><hr></div>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="delete-account.php" id="tab-delete">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-md-8 col-lg-7 d-flex" style="height: 100%;">
                <div class="profile-edit-card p-4 w-100">
                    <!-- Account Settings Tab -->
                    <div id="content-account" class="tab-pane active">
                        <h3 class="fw-bold mb-4">Edit Profile</h3>
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-4 d-flex align-items-center gap-4">
                                <img src="<?= isset($avatar) ? htmlspecialchars($avatar) : '../assets/images/default-pfp.jpg' ?>" alt="Profile Picture" class="profile-picture-preview">
                                <div>
                                    <button class="btn btn-primary mb-2" type="button"><i class="bi bi-image"></i> Change picture</button><br>
                                    <button class="btn btn-outline-secondary" type="button"><i class="bi bi-trash"></i> Delete picture</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">First name</label>
                                    <input type="text" class="form-control" name="first_name" value="<?= $user ? htmlspecialchars($user['FirstName']) : '' ?>" placeholder="Enter first name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last name</label>
                                    <input type="text" class="form-control" name="last_name" value="<?= $user ? htmlspecialchars($user['LastName']) : '' ?>" placeholder="Enter last name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" value="<?= $user ? htmlspecialchars($user['Email_Add']) : '' ?>" placeholder="Enter email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone" value="<?= $user['Phone_Number'] ?? '' ?>" placeholder="Enter your phone number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address" rows="2" placeholder="Enter your address here"><?= $user['Address'] ?? '' ?></textarea>
                            </div>
                            <button class="btn btn-success px-4">Save Changes</button>
                        </form>
                    </div>

                    <!-- Security Settings Tab -->
                    <div id="content-security" class="tab-pane">
                        <h3 class="fw-bold mb-4">Security Settings</h3>
                        <form>
                            <div class="mb-4">
                                <label for="currentPassword" class="form-label">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" placeholder="Enter current password">
                            </div>
                            <div class="mb-4">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                            </div>
                            <div class="mb-4">
                                <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Two-Factor Authentication</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="twoFactorSwitch">
                                    <label class="form-check-label" for="twoFactorSwitch">Enable Two-Factor Authentication</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Update Password</button>
                        </form>
                    </div>
                    <!-- Privacy Controls Tab -->
                    <div id="content-privacy" class="tab-pane">
                        <h3 class="fw-bold mb-4">Privacy Controls</h3>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Profile Visibility</label>
                                <select class="form-select" name="profile_visibility">
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                    <option value="friends">Friends Only</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Search Visibility</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="searchable" id="searchable" checked>
                                    <label class="form-check-label" for="searchable">
                                        Allow my profile to appear in search results
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data Download</label>
                                <p class="small text-secondary mb-2">You can request a copy of your personal data.</p>
                                <button type="button" class="btn btn-outline-primary">Request Data Download</button>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Delete Account</label>
                                <p class="small text-danger mb-2">Permanently delete your account and all associated data.</p>
                                <a href="delete-account.php" class="btn btn-outline-danger">Delete Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../components/header/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showTab(tab) {
            // Hide all tab panes
            document.querySelectorAll('.tab-pane').forEach(function(el) {
                el.classList.remove('active');
            });
            // Remove active from all nav links
            document.querySelectorAll('.settings-sidebar .nav-link').forEach(function(el) {
                el.classList.remove('active');
            });
            // Show selected tab pane
            document.getElementById('content-' + tab).classList.add('active');
            // Highlight selected nav link
            document.getElementById('tab-' + tab).classList.add('active');
        }
    </script>

</body>
</html>