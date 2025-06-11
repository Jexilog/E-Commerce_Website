<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Security & Policy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        html, body {
            height: 100%;
        }
        body {
            height: 100vh;
            background: #f8f9fa;
        }
        .container-fit {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 1rem 0 1rem 0; /* top, right, bottom, left */
        }
        .card-header {
            background: #fff;
        }
        .card-body {
            padding: 1rem 1rem 0.5rem 1rem; /* top, right, bottom, left */
        }
        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }
        .row.g-4.flex-grow-1 {
            padding-top: 0 !important; /* Removes any top padding */
        }


    </style>
</head>
<body>
    <div class="container container-fit px-3 pt-0">
        <!-- Back Button -->
        <div class="mb-4 mt-4">
            <a href="dashboard.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="row mb-2">
            <div class="col">
                <h2 class="fw-bold mb-1 text-primary"><i class="bi bi-shield-lock"></i> Admin Security & Policy</h2>
                <p class="text-muted">Manage platform security, user access, and review administrative policies.</p>
            </div>
        </div>
        
        <div class="row g-4 flex-grow-1">
            <!-- Admin Security Controls -->
            <div class="col-12 col-lg-6 d-flex">
                <div class="card shadow-sm border-0 w-100">
                    <div class="card-header">
                        <h5 class="mb-0 text-success"><i class="bi bi-shield-shaded"></i> Platform Security Controls</h5>
                    </div>
                    <div class="card-body">
                        <!-- User Management -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">User Access & Roles</h6>
                            <p class="text-muted small">
                                Assign, modify, or revoke user roles and permissions to control access to sensitive modules.
                            </p>
                            <a href="users.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-people"></i> Manage Users</a>
                        </div>
                        <!-- Account Lock/Unlock -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Account Lock/Unlock</h6>
                            <p class="text-muted small">
                                Lock or unlock user accounts in case of suspicious activity or policy violations.
                            </p>
                            <a href="users.php" class="btn btn-outline-danger btn-sm"><i class="bi bi-person-x"></i> View Accounts</a>
                        </div>
                        <!-- Security Alerts -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Security Alerts & Audit Logs</h6>
                            <p class="text-muted small">
                                Monitor security alerts, failed login attempts, and review audit logs for administrative actions.
                            </p>
                            <a href="notifications.php" class="btn btn-outline-warning btn-sm"><i class="bi bi-bell"></i> View Alerts</a>
                            <a href="audit-logs.php" class="btn btn-outline-secondary btn-sm ms-2"><i class="bi bi-journal-text"></i> Audit Logs</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Policy Section -->
            <div class="col-12 col-lg-6 d-flex">
                <div class="card shadow-sm border-0 w-100">
                    <div class="card-header">
                        <h5 class="mb-0 text-info"><i class="bi bi-file-earmark-text"></i> Administrative Policies</h5>
                    </div>
                    <div class="card-body">
                        <!-- Privacy Policy -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Data Privacy Policy</h6>
                            <p class="text-muted small">
                                Ensure all user and transaction data is handled according to privacy regulations. Admins must not export or share data outside authorized channels.
                                <a href="#" class="link-primary" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal">Read full policy</a>
                            </p>
                        </div>
                        <!-- Terms of Use -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Admin Terms of Use</h6>
                            <p class="text-muted small">
                                Admins are required to follow platform guidelines, maintain confidentiality, and act in the best interest of users and the company.
                                <a href="#" class="link-primary" data-bs-toggle="modal" data-bs-target="#termsModal">Read full terms</a>
                            </p>
                        </div>
                        <!-- Compliance & Updates -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Compliance & Policy Updates</h6>
                            <p class="text-muted small">
                                Stay updated with the latest compliance requirements (GDPR, CCPA, etc.) and review policy changes regularly.
                                <a href="#" class="link-primary" data-bs-toggle="modal" data-bs-target="#complianceModal">Learn more</a>
                            </p>
                        </div>
                        <!-- Admin Support -->
                        <div>
                            <h6 class="fw-bold mb-2">Admin Support</h6>
                            <p class="text-muted small">
                                For security incidents or policy questions, contact the IT security team.
                            </p>
                            <a href="mailto:itsecurity@soundstage.com" class="btn btn-outline-info btn-sm"><i class="bi bi-envelope"></i> Contact IT Security</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Privacy Policy Modal -->
    <div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="privacyPolicyModalLabel"><i class="bi bi-shield-lock"></i> Data Privacy Policy</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h6>Overview</h6>
            <p>
                All user and transaction data must be handled in accordance with applicable privacy laws and company policy. Admins are prohibited from exporting, copying, or sharing data outside authorized channels.
            </p>
            <h6>Data Handling</h6>
            <ul>
                <li>Access to user data is restricted to authorized personnel only.</li>
                <li>Data must not be stored on personal devices or external drives.</li>
                <li>All data exports must be logged and approved by management.</li>
            </ul>
            <h6>Breach Notification</h6>
            <p>
                Any suspected data breach must be reported immediately to the IT security team. Failure to comply may result in disciplinary action.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Terms of Use Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="termsModalLabel"><i class="bi bi-file-earmark-text"></i> Admin Terms of Use</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h6>Responsibilities</h6>
            <ul>
                <li>Maintain confidentiality of all platform and user information.</li>
                <li>Use admin privileges only for legitimate business purposes.</li>
                <li>Comply with all company policies and legal requirements.</li>
            </ul>
            <h6>Prohibited Actions</h6>
            <ul>
                <li>Sharing login credentials or access with unauthorized persons.</li>
                <li>Altering or deleting records without proper authorization.</li>
                <li>Engaging in activities that may harm the platform or its users.</li>
            </ul>
            <h6>Enforcement</h6>
            <p>
                Violations of these terms may result in suspension or termination of admin access and further legal action.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Compliance Modal -->
    <div class="modal fade" id="complianceModal" tabindex="-1" aria-labelledby="complianceModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="complianceModalLabel"><i class="bi bi-journal-check"></i> Compliance & Policy Updates</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h6>Compliance Standards</h6>
            <ul>
                <li>Follow GDPR, CCPA, and other relevant data protection regulations.</li>
                <li>Participate in regular compliance training and audits.</li>
                <li>Stay informed about updates to company policies and legal requirements.</li>
            </ul>
            <h6>Policy Updates</h6>
            <p>
                All admins will be notified of significant policy changes via email and dashboard notifications. It is your responsibility to review and adhere to updated policies.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Security Settings Modal -->
    <div class="modal fade" id="editSecurityModal" tabindex="-1" aria-labelledby="editSecurityModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editSecurityModalLabel"><i class="bi bi-gear"></i> Edit Security Settings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="passwordPolicy">Password Policy</label>
                    <select class="form-select" id="passwordPolicy">
                        <option selected>Strong (min. 8 chars, upper/lower, number, symbol)</option>
                        <option>Medium (min. 6 chars, upper/lower, number)</option>
                        <option>Weak (min. 6 chars, any)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="admin2FA">Admin 2FA Requirement</label>
                    <select class="form-select" id="admin2FA">
                        <option selected>Required for all admins</option>
                        <option>Optional</option>
                        <option>Disabled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="sessionTimeout">Session Timeout</label>
                    <input type="number" class="form-control" id="sessionTimeout" min="5" max="120" value="30">
                    <small class="text-muted">Minutes before automatic logout</small>
                </div>
                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>