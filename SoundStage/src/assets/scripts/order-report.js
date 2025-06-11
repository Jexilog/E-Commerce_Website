const orderData = [
    {
        id: 1001,
        date: '2025-05-25',
        customer: 'Jane Doe',
        status: 'Delivered',
        total: 2500.00
    },
    {
        id: 1002,
        date: '2025-05-25',
        customer: 'Maria Santos',
        status: 'Pending',
        total: 1200.00
    },
    {
        id: 1003,
        date: '2025-05-25',
        customer: 'Keven the Great',
        status: 'Processing',
        total: 1800.00
    },
    {
        id: 1004,
        date: '2025-05-25',
        customer: 'Justine Avio',
        status: 'Shipped',
        total: 1200.00
    },
    {
        id: 1005,
        date: '2025-05-25',
        customer: 'Sam Smith',
        status: 'Cancelled',
        total: 900.00
    }
];

// Chart.js Doughnut Chart for Order Status
document.addEventListener('DOMContentLoaded', function() {
    // Count status occurrences
    const statusLabels = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
    const statusColors = ['#ffc107', '#0dcaf0', '#6c757d', '#198754', '#dc3545'];
    const statusCounts = statusLabels.map(
        label => orderData.filter(order => order.status === label).length
    );

    const ctx = document.getElementById('orderStatusChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts,
                    backgroundColor: statusColors
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } }
            }
        });
    }

    renderOrderTable();
});

function getStatusBadge(status) {
    switch(status) {
        case 'Delivered': return '<span class="badge bg-success">Delivered</span>';
        case 'Pending': return '<span class="badge bg-warning text-dark">Pending</span>';
        case 'Processing': return '<span class="badge bg-info text-dark">Processing</span>';
        case 'Shipped': return '<span class="badge bg-secondary">Shipped</span>';
        case 'Cancelled': return '<span class="badge bg-danger">Cancelled</span>';
        default: return `<span class="badge bg-secondary">${status}</span>`;
    }
}

function renderOrderTable() {
    const tbody = document.getElementById('orderReportTable');
    if (!tbody) return;
    tbody.innerHTML = orderData.map(order => `
        <tr>
            <td>#${order.id}</td>
            <td>${order.date}</td>
            <td>${order.customer}</td>
            <td>${getStatusBadge(order.status)}</td>
            <td>₱ ${order.total.toLocaleString(undefined, {minimumFractionDigits:2})}</td>
            <td><a href="order-details.php?id=${order.id}" class="btn btn-sm btn-outline-primary">View</a></td>
        </tr>
    `).join('');
}