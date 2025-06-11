<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings | SoundStage</title>
    <link rel="icon" href="../../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: #ecf0f1;
        }
        .settings-sidebar {
            min-width: 220px;
            border-right: 1px solid #e0e0e0;
            background: #f8fafc;
            height: 100%;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #e0e0e0;
        }
        .settings-link {
            color: #333;
            text-decoration: none;
            display: block;
            margin-bottom: 1rem;
            cursor: pointer;
        }
        .settings-link.active, .settings-link:hover {
            font-weight: bold;
            color: #0d6efd;
        }
        .delete-link {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }
        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container" style="min-height: 100vh; display: flex; align-items: center;">
        <div class="row justify-content-center w-100">
            <div class="col-lg-10 bg-light rounded shadow-sm p-4" style="min-height: 80vh;">
                <div class="row h-100">
                    <!-- Sidebar -->
                    <div class="col-md-4 settings-sidebar py-3 d-flex flex-column h-100">
                        <div>
                            <h5 class="mb-4">Settings</h5>
                            <a class="settings-link active" data-section="account">Account Settings</a>
                            <a class="settings-link" data-section="security">Security Settings</a>
                            <a class="settings-link" data-section="privacy">Privacy Controls</a>
                            <a href="#" class="delete-link mt-4">Delete</a>
                        </div>
                        <div class="mt-auto">
                            <a href="../admin/dashboard.php" class="btn btn-outline-primary w-200">
                                <i class="bi bi-arrow-left"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                    <!-- Main Content -->
                    <div class="col-md-8 py-3" id="settings-content">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Content for each section
    const content = {
        account: `
            <h4 class="mb-4">Edit Profile</h4>
            <div class="d-flex align-items-center mb-4">
                <img src="../images/admin-rep.jpg" alt="Profile Picture" class="profile-img me-4">
                <div>
                    <button class="btn btn-primary mb-2" type="button"><i class="bi bi-image"></i> Change picture</button><br>
                    <button class="btn btn-outline-secondary" type="button"><i class="bi bi-trash"></i> Delete picture</button>
                </div>
            </div>
            <form>
                <div class="row mb-3">
                    <div class="col">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                    </div>
                    <div class="col">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter new password">
                </div>
                <button type="submit" class="btn btn-success">Save Changes</button>
            </form>
        `,
        security: `
            <h4 class="mb-4">Security Settings</h4>
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
                <button type="submit" class="btn btn-success">Save Security Settings</button>
            </form>
        `,
        privacy: `
            <h4 class="mb-4">Privacy Controls</h4>
            <form>
                <div class="mb-4">
                    <label class="form-label">Profile Visibility</label>
                    <select class="form-select">
                        <option>Public</option>
                        <option>Private</option>
                        <option>Only Me</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label">Data Sharing</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="shareData">
                        <label class="form-check-label" for="shareData">Allow sharing my data with partners</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save Privacy Settings</button>
            </form>
        `
    };

    // Handle sidebar link clicks
    document.querySelectorAll('.settings-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.settings-link').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            const section = this.getAttribute('data-section');
            document.getElementById('settings-content').innerHTML = content[section];
        });
    });

    // Load default content
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.settings-link.active').click();
    });
    </script>
</body>
</html>