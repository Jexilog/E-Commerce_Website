const maxUsersPerPage = 5; // Change how many users to show per page

const totalPages = Math.ceil(allUsers.length / maxUsersPerPage);
let currentPage = 1;

function renderTable(page) {
    const start = (page - 1) * maxUsersPerPage;
    const end = start + maxUsersPerPage;
    const users = allUsers.slice(start, end);
    
    document.getElementById('userTableBody').innerHTML = users.map(user => `
        <tr>
            <td><input type="checkbox" class="user-checkbox"></td>
            <td><img src="${user.avatar}" alt="Avatar" class="avatar-img rounded-circle"></td>
            <td><span class="fw-semibold">${user.name}</span><div class="text-muted small">Registered: ${user.registered}</div></td>
            <td>${user.email}</td>
            <td><span class="badge ${user.status === 'Active' ? 'bg-success' : 'bg-secondary'}">${user.status}</span></td>
            <td class="text-center position-static">
                <div class="d-inline-flex align-items-center gap-1">
                    <div class="dropdown">
                        <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical fs-5"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Edit User Info</a></li>
                            <li><a class="dropdown-item" href="#">Reset Password</a></li>
                            <li><a class="dropdown-item" href="#">Ban/Unban</a></li>
                            <li><a class="dropdown-item text-danger" href="#">Delete Account</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="order-history.php?email=${encodeURIComponent(user.email)}&name=${encodeURIComponent(user.name)}">
                                    View Order History
                                </a>
                            </li>
                        </ul>
                    </div>
                    <button class="btn btn-sm btn-outline-danger" title="Delete" onclick="deleteUser('${user.email}')">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');

    // Update pagination active state
    document.querySelectorAll('#pagination .page-item').forEach((li, idx) => {
        li.classList.remove('active');
        if (li.querySelector('.page-link') && li.querySelector('.page-link').dataset.page == page) {
            li.classList.add('active');
        }
    });
    // Enable/disable prev/next
    document.getElementById('prevPage').classList.toggle('disabled', page === 1);
    document.getElementById('nextPage').classList.toggle('disabled', page === totalPages);
}

document.addEventListener('DOMContentLoaded', function() {
    // Dynamically generate page numbers based on totalPages
    const pagination = document.getElementById('pagination');
    // Remove old page numbers except prev/next
    while (pagination.children.length > 2) {
        pagination.removeChild(pagination.children[1]);
    }
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = 'page-item' + (i === 1 ? ' active' : '');
        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.dataset.page = i;
        a.textContent = i;
        li.appendChild(a);
        pagination.insertBefore(li, document.getElementById('nextPage'));
    }

    // Add event listeners
    document.querySelectorAll('#pagination .page-link[data-page]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const page = parseInt(this.dataset.page);
            if (page !== currentPage) {
                currentPage = page;
                renderTable(currentPage);
            }
        });
    });

    document.getElementById('prevPage').addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            renderTable(currentPage);
        }
    });
    document.getElementById('nextPage').addEventListener('click', function(e) {
        e.preventDefault();
        if (currentPage < totalPages) {
            currentPage++;
            renderTable(currentPage);
        }
    });

    // Initial render
    renderTable(currentPage);

    // Search filter
    document.getElementById('userSearchInput').addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#userTableBody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });

    // Event delegation for modal triggers
    document.getElementById('userTableBody').addEventListener('click', function(e) {
        // Edit User
        if (e.target.closest('.edit-user-btn')) {
            const btn = e.target.closest('.edit-user-btn');
            document.getElementById('editFirstName').value = btn.dataset.fname;
            document.getElementById('editLastName').value = btn.dataset.lname;
            document.getElementById('editEmail').value = btn.dataset.email;
            document.getElementById('editStatus').value = btn.dataset.status;
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        }
        // Reset Password
        if (e.target.closest('.reset-pass-btn')) {
            const btn = e.target.closest('.reset-pass-btn');
            document.getElementById('resetUserEmail').textContent = btn.dataset.email;
            document.getElementById('resetPassword').value = '';
            new bootstrap.Modal(document.getElementById('resetPasswordModal')).show();
        }
        // Ban/Unban
        if (e.target.closest('.ban-unban-btn')) {
            const btn = e.target.closest('.ban-unban-btn');
            const isBanned = btn.dataset.status.toLowerCase() !== 'active';
            document.getElementById('banUnbanTitle').textContent = isBanned ? 'Unban User' : 'Ban User';
            document.getElementById('banUnbanMessage').textContent = `Are you sure you want to ${isBanned ? 'unban' : 'ban'} ${btn.dataset.name}?`;
            document.getElementById('banUnbanActionBtn').textContent = isBanned ? 'Unban' : 'Ban';
            new bootstrap.Modal(document.getElementById('banUnbanModal')).show();
        }
        // Delete User
        if (e.target.closest('.delete-user-btn')) {
            const btn = e.target.closest('.delete-user-btn');
            document.getElementById('deleteUserName').textContent = btn.dataset.name;
            new bootstrap.Modal(document.getElementById('deleteAccountModal')).show();
        }
    });

    // Avatar preview for Add User
    const avatarInput = document.getElementById('userAvatar');
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const [file] = this.files;
            if (file) {
                document.getElementById('avatarPreview').src = URL.createObjectURL(file);
            }
        });
    }
});

// Add this function to your JS file

function addUserRow({ avatar = '', name, email, status = 'Active' }) {
    const userTableBody = document.getElementById('userTableBody');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td><input type="checkbox"></td>
        <td>${avatar}</td>
        <td>${name}</td>
        <td>${email}</td>
        <td><span class="badge bg-${status === 'Active' ? 'success' : 'secondary'}">${status}</span></td>
        <td class="text-center">
            <div class="dropdown">
                <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical fs-5"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Edit User Info</a></li>
                    <li><a class="dropdown-item" href="#">Reset Password</a></li>
                    <li><a class="dropdown-item" href="#">Ban/Unban</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Delete Account</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="order-history.php?email=${encodeURIComponent(email)}&name=${encodeURIComponent(name)}">
                            View Order History
                        </a>
                    </li>
                </ul>
            </div>
        </td>
    `;
    userTableBody.appendChild(row);
}

// Example usage:
addUserRow({
    avatar: '<img src="https://ui-avatars.com/api/?name=Jane+Doe" class="rounded-circle" width="32" height="32">',
    name: 'Jane Doe',
    email: 'jane@example.com',
    status: 'Active'
});

function deleteUser(email) {
    if (confirm('Are you sure you want to delete this user?')) {
        const idx = allUsers.findIndex(u => u.email === email);
        if (idx !== -1) {
            allUsers.splice(idx, 1);
            renderTable(currentPage);
        }
    }
}