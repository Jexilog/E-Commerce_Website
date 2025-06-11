document.addEventListener('DOMContentLoaded', function() {
    // Tooltip init
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Sales Trends Chart Data
    const salesTrendsData = {
        '2024': {
            'January': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'February': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'March': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'April': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'May': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'June': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'July': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'August': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'September': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'October': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 2700],
            'November': [1200, 1900, 3000, 500, 2000, 3000, 4000, 3500, 4500, 3000, 2000, 2500],
            'December': [1500, 2100, 3200, 700, 2200, 3100, 4200, 3700, 4700, 3200, 2200, 5000],
            // ...add more months
        },
        // ...add more years
    };
    let selectedYear = '2024';
    let selectedMonth = 'January';

    // Show spinner while loading chart
    setTimeout(() => {
        const spinner = document.getElementById('chartSpinner');
        if (spinner) spinner.style.display = 'none';
        renderSalesTrendsChart();
    }, 600);

    function renderSalesTrendsChart() {
        const ctx = document.getElementById('reportChart').getContext('2d');
        if (window.salesTrendsChart) window.salesTrendsChart.destroy();
        window.salesTrendsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Sales',
                    data: [3000, 4000, 3500, 4500],
                    borderColor: '#1976d2',
                    backgroundColor: 'rgba(25, 118, 210, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10000, // Set your desired max
                        ticks: {
                            stepSize: 1000,
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
        document.getElementById('salesTrendsLabel').textContent = `Showing: Monthly (${selectedMonth} ${selectedYear})`;
        document.getElementById('monthDropdownBtn').textContent = selectedMonth;
        document.getElementById('yearDropdownBtn').textContent = selectedYear;
    }

    // Month/Year Dropdowns
    const monthDropdown = document.getElementById('monthDropdown');
    if (monthDropdown) {
        monthDropdown.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') {
                selectedMonth = e.target.textContent;
                renderSalesTrendsChart();
            }
        });
    }
    const yearDropdown = document.getElementById('yearDropdown');
    if (yearDropdown) {
        yearDropdown.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') {
                selectedYear = e.target.textContent;
                renderSalesTrendsChart();
            }
        });
    }

    // Best Sellers Data
    let bestSellers = [
        { product: "IE Monitor X1", img: "../assets/images/products/monitorx1.jpg", sold: 50, revenue: 25000 },
        { product: "Headphones Pro", img: "../assets/images/products/headphonespro.jpg", sold: 30, revenue: 18000 },
        { product: "Speaker Mini", img: "../assets/images/products/speakermini.jpg", sold: 20, revenue: 10000 }
    ];
    let bestSellersSort = { key: 'sold', dir: 'desc' };

    function renderBestSellers() {
        let sorted = [...bestSellers].sort((a, b) => {
            if (bestSellersSort.key === 'product') {
                return bestSellersSort.dir === 'asc'
                    ? a.product.localeCompare(b.product)
                    : b.product.localeCompare(a.product);
            } else {
                return bestSellersSort.dir === 'asc'
                    ? a[bestSellersSort.key] - b[bestSellersSort.key]
                    : b[bestSellersSort.key] - a[bestSellersSort.key];
            }
        });
        document.getElementById('bestSellersTable').innerHTML = sorted.map(item => `
            <tr>
                <td>
                    <img src="${item.img}" class="avatar-sm me-2" alt="${item.product}"> ${item.product}
                </td>
                <td>${item.sold}</td>
                <td>₱ ${item.revenue.toLocaleString()}</td>
            </tr>
        `).join('');
    }
    window.sortBestSellers = function(key) {
        if (bestSellersSort.key === key) {
            bestSellersSort.dir = bestSellersSort.dir === 'asc' ? 'desc' : 'asc';
        } else {
            bestSellersSort.key = key;
            bestSellersSort.dir = 'desc';
        }
        renderBestSellers();
    }
    renderBestSellers();

    // Pie/Donut Chart for Sales by Category
    setTimeout(() => {
        new Chart(document.getElementById('categoryPieChart'), {
            type: 'doughnut',
            data: {
                labels: ['IEMs', 'Earbuds', 'Headphones'],
                datasets: [{
                    data: [60, 30, 20],
                    backgroundColor: ['#1976d2', '#43a047', '#ffa000']
                }]
            },
            options: {
                plugins: {
                    legend: { display: true, position: 'bottom' }
                },
                responsive: false,
                maintainAspectRatio: false
            }
        });
    }, 700);

    // Delegate click event for dynamically generated buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-order-btn')) {
            const orderId = e.target.getAttribute('data-order-id');
            const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            document.getElementById('orderDetailsModalBody').innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>';
            modal.show();

            // Fetch order details via AJAX (replace with your endpoint)
            fetch(`order-details-content.php?id=${orderId}`)
                .then(res => res.text())
                .then(html => {
                    document.getElementById('orderDetailsModalBody').innerHTML = html;
                })
                .catch(() => {
                    document.getElementById('orderDetailsModalBody').innerHTML = '<div class="alert alert-danger">Failed to load order details.</div>';
                });
        }
    });
});