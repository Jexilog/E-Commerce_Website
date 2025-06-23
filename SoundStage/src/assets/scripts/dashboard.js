// --- SAMPLE DATA ---
const sampleCategories = [
    {
        img: '../assets/images/iem.webp',
        alt: 'In-Ear Monitor',
        title: "In-Ear Monitor",
        display: "IEM's",
        count: 18,
        stock: 'in'
    },
    {
        img: '../assets/images/headphones.png',
        alt: 'Headphones',
        title: 'Headphones',
        display: 'Headphone',
        count: 12,
        stock: 'in'
    },
    {
        img: '../assets/images/tws-earbuds.png',
        alt: 'Earbuds (TWS)',
        title: 'Earbuds (TWS)',
        display: 'Earbuds (TWS)',
        count: 9,
        stock: 'low'
    },
    {
        img: '../assets/images/audio-access.webp',
        alt: 'Audio Accessories',
        title: 'Audio Accessories',
        display: 'Audio Accessories',
        count: 7,
        stock: 'in'
    },
    {
        img: '../assets/images/dap-new.png',
        alt: 'Digital Audio Player',
        title: 'Digital Audio Player',
        display: 'Digital Audio Player',
        count: 5,
        stock: 'out'
    },
    {
        img: '../assets/images/speaker.png',
        alt: 'Speaker',
        title: 'Speaker',
        display: 'Speaker',
        count: 11,
        stock: 'low'
    }
];

const sampleSalesData = {
    total_sales: "$15,230",
    orders: 134,
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    sales: [2100, 1800, 2500, 2200, 2000, 1700, 1930]
};

const sampleUserActivity = {
    users: [
        { name: "Alice", status: "Active", last_seen: "Just now" },
        { name: "Bob", status: "Idle", last_seen: "3 min ago" },
        { name: "Charlie", status: "Inactive", last_seen: "15 min ago" },
        { name: "Diana", status: "Active", last_seen: "1 min ago" }
    ],
    alerts: [
        { message: "Multiple failed login attempts detected for user Bob." }
    ]
};

// --- PRODUCT CATEGORIES TABLE & PAGINATION ---
const ROWS_PER_PAGE = 5;
let currentPage = 1;
let filteredCategories = [...sampleCategories];

function renderProductCategoriesTable(categories, page = 1) {
    const tbody = document.getElementById('product-categories-tbody');
    tbody.innerHTML = '';
    const start = (page - 1) * ROWS_PER_PAGE;
    const end = start + ROWS_PER_PAGE;
    const paged = categories.slice(start, end);

    paged.forEach(cat => {
        let stockBadge = '';
        if (cat.stock === 'in') stockBadge = '<span class="badge bg-success">In Stock</span>';
        else if (cat.stock === 'low') stockBadge = '<span class="badge bg-warning text-dark">Low Stock</span>';
        else stockBadge = '<span class="badge bg-danger">Out of Stock</span>';

        tbody.innerHTML += `
            <tr>
                <td class="text-center"><img src="${cat.img}" alt="${cat.alt}" style="width:40px;height:40px;object-fit:contain;" class="rounded"></td>
                <td>${cat.display}</td>
                <td>${cat.count}</td>
                <td>${stockBadge}</td>
                <td><a href="products.php?category=${encodeURIComponent(cat.title)}" class="btn btn-outline-primary btn-sm">View</a></td>
            </tr>
        `;
    });

    renderPagination(categories.length, page);
}

function renderPagination(totalRows, page) {
    const totalPages = Math.ceil(totalRows / ROWS_PER_PAGE);
    const ul = document.getElementById('product-pagination');
    ul.innerHTML = '';

    // Previous
    ul.innerHTML += `
        <li class="page-item${page === 1 ? ' disabled' : ''}">
            <a class="page-link" href="#" data-page="${page - 1}">&laquo;</a>
        </li>
    `;

    // Page numbers (show max 3 pages for compactness)
    let startPage = Math.max(1, page - 1);
    let endPage = Math.min(totalPages, startPage + 2);
    if (endPage - startPage < 2) startPage = Math.max(1, endPage - 2);

    for (let i = startPage; i <= endPage; i++) {
        ul.innerHTML += `
            <li class="page-item${i === page ? ' active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>
        `;
    }

    // Next
    ul.innerHTML += `
        <li class="page-item${page === totalPages ? ' disabled' : ''}">
            <a class="page-link" href="#" data-page="${page + 1}">&raquo;</a>
        </li>
    `;

    // Pagination click events
    ul.querySelectorAll('a.page-link').forEach(link => {
        link.onclick = function(e) {
            e.preventDefault();
            const newPage = parseInt(this.getAttribute('data-page'));
            if (!isNaN(newPage) && newPage >= 1 && newPage <= totalPages) {
                currentPage = newPage;
                renderProductCategoriesTable(filteredCategories, currentPage);
            }
        };
    });
}

function filterCategories() {
    const selected = document.getElementById('categoryFilter').value;
    if (selected === 'all') {
        filteredCategories = [...sampleCategories];
    } else {
        filteredCategories = sampleCategories.filter(cat => cat.display === selected || cat.title === selected);
    }
    currentPage = 1;
    renderProductCategoriesTable(filteredCategories, currentPage);
}

// --- SALES OVERVIEW ---
function renderSalesSummary(data) {
    document.getElementById('totalSalesAmount').textContent = data.total_sales;
    document.getElementById('totalOrders').textContent = data.orders;
    document.getElementById('totalCategories').textContent = sampleCategories.length;
}

function renderSalesChart(data) {
    const canvas = document.getElementById('salesChart');
    if (!canvas) return; // Prevents error if canvas is missing
    if (window.salesChartInstance) window.salesChartInstance.destroy();
    const ctx = canvas.getContext('2d');
    window.salesChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Sales ($)',
                data: data.sales,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderRadius: 6
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 500 } }
            }
        }
    });
}

// --- USER ACTIVITY ---
function renderUserActivity(users) {
    const list = document.getElementById('user-activity-list');
    list.innerHTML = '';
    users.forEach(user => {
        let statusClass = 'text-secondary';
        if (user.status === 'Active') statusClass = 'text-success';
        else if (user.status === 'Idle') statusClass = 'text-warning';
        list.innerHTML += `
            <li class="list-group-item d-flex align-items-center">
                <span class="me-2"><i class="bi bi-circle-fill ${statusClass}"></i></span>
                <span>${user.name} - <span class="fw-bold ${statusClass}">${user.status}</span></span>
                <span class="ms-auto text-muted small">(${user.last_seen})</span>
            </li>
        `;
    });
}

function renderUserAlerts(alerts) {
    const alertDiv = document.getElementById('user-alerts');
    alertDiv.innerHTML = '';
    alerts.forEach(alert => {
        alertDiv.innerHTML += `
            <div class="alert alert-danger alert-dismissible fade show py-2 mb-2" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>${alert.message}
                <button type="button" class="btn-close btn-sm py-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    });
}

// --- INITIAL LOAD ---
document.addEventListener('DOMContentLoaded', function () {
    // Product categories table and filter
    renderProductCategoriesTable(sampleCategories, 1);
    document.getElementById('categoryFilter').addEventListener('change', filterCategories);

    // Sales overview
    renderSalesSummary(sampleSalesData);
    renderSalesChart(sampleSalesData);

    // User activity
    renderUserActivity(sampleUserActivity.users);
    renderUserAlerts(sampleUserActivity.alerts);

    // Sales filter button (just re-renders sample data)
    const salesBtn = document.getElementById('salesFilterBtn');
    if (salesBtn) {
        salesBtn.addEventListener('click', function(e) {
            e.preventDefault();
            renderSalesSummary(sampleSalesData);
            renderSalesChart(sampleSalesData);
        });
    }

    // User activity refresh (just re-renders sample data)
    const refreshBtn = document.getElementById('refreshUserActivity');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            renderUserActivity(sampleUserActivity.users);
            renderUserAlerts(sampleUserActivity.alerts);
        });
    }
});