<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual & Guide | SoundStage</title>
    <link rel="icon" href="../assets/icons/website-icon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            font-family: 'Segoe UI', sans-serif;
        }
        .manual-searchbar {
            background: #003366;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(25, 118, 210, 0.06);
            padding: 1rem 2rem 1rem 2rem;
            margin-bottom: 1.5rem;
        }
        .manual-section-card {
            background: #003366;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(25, 118, 210, 0.06);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .manual-folder {
            border: 1px solid #e3e6ef;
            border-radius: 6px;
            padding: 1.2rem 1.5rem;
            margin-bottom: 1rem;
            background: #f9fafc;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: box-shadow 0.2s;
        }
        .manual-folder:hover {
            box-shadow: 0 2px 12px rgba(25, 118, 210, 0.10);
        }
        .manual-folder-title {
            font-weight: 600;
            font-size: 1.15rem;
            color: #1976d2;
        }
        .manual-folder-meta {
            color: #888;
            font-size: 0.98rem;
        }
        .manual-article-list {
            margin-top: 1.2rem;
        }
        .manual-article-list li {
            color: #ffffff;
            margin-bottom: 0.7rem;
            padding-left: 0.2rem;
        }
        .manual-article-list .bi {
            color: #1976d2;
            margin-right: 0.5rem;
        }
        .manual-sidebar {
            background: #003366;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(25, 118, 210, 0.06);
            padding: 1.5rem;
        }
        .manual-sidebar h6 {
            font-weight: 700;
            margin-top: 1.2rem;
            color: #1976d2;
        }
        .manual-sidebar ul {
            list-style: none;
            padding-left: 0;
        }
        .manual-sidebar li {
            color: #ffffff;
            margin-bottom: 0.5rem;
        }
        .manual-sidebar .bi {
            margin-right: 0.5rem;
            color: #1976d2;
        }
        .breadcrumb {
            background: transparent;
            font-size: 1rem;
        }
        .breadcrumb-item a {
            color: #1976d2;
            text-decoration: none;
            cursor: pointer;
        }
        .breadcrumb-item.active {
            color: #444;
        }
        .kb-header {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1976d2;
            margin-bottom: 0.5rem;
        }
        .kb-desc {
            color: #ffffff;
            font-size: 1.05rem;
            margin-bottom: 1.2rem;
        }
        .btn-primary, .btn-outline-primary {
            border-radius: 6px;
        }
        .btn-primary {
            background: #1976d2;
            border-color: #1976d2;
        }
        .btn-primary:hover, .btn-outline-primary:hover {
            background: #1251a3;
            border-color: #1251a3;
        }
        @media (max-width: 900px) {
            .manual-sidebar { margin-top: 2rem; }
        }
    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <?php include '../components/header/header.php'; ?>

    <div class="container py-4">
        <!-- Search Bar -->
        <div class="manual-searchbar mb-4">
            <form class="d-flex align-items-center" autocomplete="off" onsubmit="return false;">
                <input type="text" class="form-control form-control-lg me-2" placeholder="Search articles" aria-label="Search articles">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Tabs for Knowledge Base and AudioHub Manual -->
                <ul class="nav nav-tabs mb-3" id="manualTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-primary" id="kb-tab" data-bs-toggle="tab" data-bs-target="#kb" type="button" role="tab" aria-controls="kb" aria-selected="true">
                            Knowledge Base
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-primary" id="manual-tab" data-bs-toggle="tab" data-bs-target="#manual" type="button" role="tab" aria-controls="manual" aria-selected="false">
                            SoundStage Manual
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="manualTabContent">
                    <!-- Knowledge Base Content -->
                    <div class="tab-pane fade show active" id="kb" role="tabpanel" aria-labelledby="kb-tab">
                        <div class="manual-section-card mb-4">
                            <div class="kb-header">Knowledge Base</div>
                            <div class="kb-desc">
                                Explore our comprehensive Knowledge Base for SoundStage. Find answers, best practices, and tips to maximize your experience.
                            </div>
                            <div class="manual-folder mb-3">
                                <div>
                                    <i class="bi bi-folder2-open" style="font-size:1.5rem;color:#1976d2;"></i>
                                    <span class="manual-folder-title">Getting Started</span>
                                </div>
                                <span class="manual-folder-meta">8 Articles &nbsp;•&nbsp; 2 Sections</span>
                            </div>
                            <ul class="manual-article-list">
                                <li><i class="bi bi-file-earmark-text"></i>Introduction to SoundStage</li>
                                <li><i class="bi bi-file-earmark-text"></i>System Requirements</li>
                                <li><i class="bi bi-file-earmark-text"></i>Creating Your First Project</li>
                                <li><i class="bi bi-file-earmark-text"></i>Basic Navigation</li>
                            </ul>
                            <div class="manual-folder mb-3">
                                <div>
                                    <i class="bi bi-folder2-open" style="font-size:1.5rem;color:#1976d2;"></i>
                                    <span class="manual-folder-title">Account & Security</span>
                                </div>
                                <span class="manual-folder-meta">6 Articles &nbsp;•&nbsp; 1 Section</span>
                            </div>
                            <ul class="manual-article-list">
                                <li><i class="bi bi-file-earmark-text"></i>Managing Your Profile</li>
                                <li><i class="bi bi-file-earmark-text"></i>Two-Factor Authentication</li>
                                <li><i class="bi bi-file-earmark-text"></i>Privacy Settings</li>
                                <li><i class="bi bi-file-earmark-text"></i>Account Recovery</li>
                            </ul>
                        </div>
                    </div>
                    <!-- AudioHub Manual Content -->
                    <div class="tab-pane fade" id="manual" role="tabpanel" aria-labelledby="manual-tab">
                        <div class="manual-section-card mb-4">
                            <div class="kb-header">SoundStage Manual</div>
                            <div class="kb-desc">
                                Detailed guides and step-by-step instructions for using SoundStage features.
                            </div>
                            <div class="manual-folder mb-3">
                                <div>
                                    <i class="bi bi-folder2-open" style="font-size:1.5rem;color:#1976d2;"></i>
                                    <span class="manual-folder-title">Help Guide</span>
                                </div>
                                <span class="manual-folder-meta">12 Articles &nbsp;•&nbsp; 4 Sections</span>
                            </div>
                            <ul class="manual-article-list">
                                <li><i class="bi bi-file-earmark-text"></i>How to Create an Account</li>
                                <li><i class="bi bi-file-earmark-text"></i>Uploading and Managing Tracks</li>
                                <li><i class="bi bi-file-earmark-text"></i>Organizing Playlists</li>
                                <li><i class="bi bi-file-earmark-text"></i>Using the AudioHub Mobile App</li>
                                <li><i class="bi bi-file-earmark-text"></i>Customizing Your Dashboard</li>
                                <li><i class="bi bi-file-earmark-text"></i>Integrating with Other Apps</li>
                            </ul>
                            <div class="manual-folder mb-3">
                                <div>
                                    <i class="bi bi-folder2-open" style="font-size:1.5rem;color:#1976d2;"></i>
                                    <span class="manual-folder-title">FAQ</span>
                                </div>
                                <span class="manual-folder-meta">7 Articles &nbsp;•&nbsp; 2 Sections</span>
                            </div>
                            <ul class="manual-article-list">
                                <li><i class="bi bi-file-earmark-text"></i>What audio formats are supported?</li>
                                <li><i class="bi bi-file-earmark-text"></i>How to reset your password?</li>
                                <li><i class="bi bi-file-earmark-text"></i>How to share tracks with others?</li>
                                <li><i class="bi bi-file-earmark-text"></i>How to contact support?</li>
                                <li><i class="bi bi-file-earmark-text"></i>Subscription and Billing</li>
                            </ul>
                            <div class="manual-folder mb-3">
                                <div>
                                    <i class="bi bi-folder2-open" style="font-size:1.5rem;color:#1976d2;"></i>
                                    <span class="manual-folder-title">Troubleshooting</span>
                                </div>
                                <span class="manual-folder-meta">5 Articles &nbsp;•&nbsp; 1 Section</span>
                            </div>
                            <ul class="manual-article-list">
                                <li><i class="bi bi-file-earmark-text"></i>Audio not playing? Here’s what to do</li>
                                <li><i class="bi bi-file-earmark-text"></i>Issues with uploading files</li>
                                <li><i class="bi bi-file-earmark-text"></i>Mobile app crashes</li>
                                <li><i class="bi bi-file-earmark-text"></i>Playback errors</li>
                                <li><i class="bi bi-file-earmark-text"></i>Account locked out</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="manual-sidebar">
                    <div class="d-flex align-items-center mb-2">
                        <img src="../assets/icons/website-icon.png" alt="AudioHub" style="width:32px;height:32px;margin-right:0.7rem;">
                        <div>
                            <div style="font-weight:700; color:#1976d2;">SoundStage</div>
                            <div style="font-size:0.98rem;color:#888;">Manual & Support</div>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm mb-3">Follow</button>
                    <h6>Popular Articles</h6>
                    <ul>
                        <li><i class="bi bi-file-earmark-text"></i>Getting Started with SoundStage</li>
                        <li><i class="bi bi-file-earmark-text"></i>Uploading Your First Track</li>
                        <li><i class="bi bi-file-earmark-text"></i>Account Settings Overview</li>
                        <li><i class="bi bi-file-earmark-text"></i>Audio Formats Supported</li>
                        <li><i class="bi bi-file-earmark-text"></i>How to Contact Support</li>
                    </ul>
                    <h6>Recent Articles</h6>
                    <ul>
                        <li><i class="bi bi-file-earmark-text"></i>Playlist Collaboration</li>
                        <li><i class="bi bi-file-earmark-text"></i>Resetting Your Password</li>
                        <li><i class="bi bi-file-earmark-text"></i>Sharing Tracks Securely</li>
                        <li><i class="bi bi-file-earmark-text"></i>Mobile App Features</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../components/header/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>