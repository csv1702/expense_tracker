<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - OneStack Tracker</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f6; 
            color: #333;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.05); 
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .btn-primary {
            background-color: #764ba2;
            border-color: #764ba2;
        }
        .btn-primary:hover {
            background-color: #5a387e;
            border-color: #5a387e;
        }
        .badge {
            font-weight: 500;
            padding: 8px 12px;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark px-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="fas fa-wallet me-2"></i>OneStack Tracker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="ms-auto d-flex align-items-center">
                    <span class="text-white me-3 d-none d-lg-block">Welcome, <?= $this->session->userdata('username'); ?></span>
                    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-light text-primary fw-bold px-3 shadow-sm rounded-pill">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pb-5">
        
        <div class="row mb-4 g-4">
            <div class="col-md-6 col-lg-6">
                <div class="card h-100 bg-primary text-white" style="background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase ls-1">Total Spent</h6>
                            <h2 class="fw-bold mb-0 display-6">$<?= number_format($summary['total'], 2); ?></h2>
                        </div>
                        <div class="icon-circle bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-money-bill-wave fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-6">
                <div class="card h-100 bg-success text-white" style="background: linear-gradient(45deg, #43e97b 0%, #38f9d7 100%);">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase ls-1">This Month</h6>
                            <h2 class="fw-bold mb-0 display-6">$<?= number_format($summary['month'], 2); ?></h2>
                        </div>
                        <div class="icon-circle bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-calendar-day fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="card h-100 p-3">
                    <h5 class="card-title fw-bold mb-3 text-center">Spending by Category</h5>
                    <div style="position: relative; height: 250px; width:100%;">
                        <canvas id="expenseChart"></canvas>
                    </div>
                    <?php if(empty($chart_data)): ?>
                        <div class="text-center text-muted mt-5">
                            <small>No data to display yet.</small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="btn-group shadow-sm mb-2 mb-md-0">
                        <a href="<?= base_url('expenses/dashboard'); ?>" class="btn btn-outline-primary <?= ($current_filter == 'all' || !$current_filter) ? 'active' : '' ?>">All</a>
                        <a href="<?= base_url('expenses/dashboard?filter=daily'); ?>" class="btn btn-outline-primary <?= ($current_filter == 'daily') ? 'active' : '' ?>">Today</a>
                        <a href="<?= base_url('expenses/dashboard?filter=monthly'); ?>" class="btn btn-outline-primary <?= ($current_filter == 'monthly') ? 'active' : '' ?>">Month</a>
                        <a href="<?= base_url('expenses/dashboard?filter=yearly'); ?>" class="btn btn-outline-primary <?= ($current_filter == 'yearly') ? 'active' : '' ?>">Year</a>
                    </div>
                    
                    <div>
                        <a href="<?= base_url('expenses/export_csv'); ?>" class="btn btn-outline-success me-2 rounded-pill">
                            <i class="fas fa-file-csv me-1"></i> CSV
                        </a>
                        <a href="<?= base_url('expenses/add'); ?>" class="btn btn-primary shadow rounded-pill px-4">
                            <i class="fas fa-plus me-1"></i> Add Expense
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light text-secondary">
                                <tr>
                                    <th class="ps-4 py-3 border-0">Date</th>
                                    <th class="py-3 border-0">Details</th>
                                    <th class="py-3 border-0">Category</th>
                                    <th class="text-end py-3 border-0">Amount</th>
                                    <th class="text-center py-3 border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($expenses)): ?>
                                    <?php foreach($expenses as $exp): ?>
                                    <tr>
                                        <td class="ps-4 text-muted fw-bold">
                                            <?= date('M d', strtotime($exp['expense_date'])); ?>
                                            <br>
                                            <small class="fw-normal"><?= date('Y', strtotime($exp['expense_date'])); ?></small>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark"><?= $exp['title']; ?></div>
                                            <small class="text-muted text-truncate d-block" style="max-width: 150px;">
                                                <?= $exp['description']; ?>
                                            </small>
                                        </td>
                                        <td>
                                            <?php 
                                                $badgeClass = 'bg-secondary';
                                                $icon = 'fa-tag';
                                                
                                                if($exp['category'] == 'Food') { $badgeClass = 'bg-warning text-dark'; $icon = 'fa-utensils'; }
                                                elseif($exp['category'] == 'Travel') { $badgeClass = 'bg-info text-dark'; $icon = 'fa-plane'; }
                                                elseif($exp['category'] == 'Bills') { $badgeClass = 'bg-danger'; $icon = 'fa-file-invoice-dollar'; }
                                                elseif($exp['category'] == 'Entertainment') { $badgeClass = 'bg-success'; $icon = 'fa-film'; }
                                            ?>
                                            <span class="badge rounded-pill <?= $badgeClass; ?> shadow-sm">
                                                <i class="fas <?= $icon; ?> me-1"></i> <?= $exp['category']; ?>
                                            </span>
                                        </td>
                                        <td class="text-end fw-bold text-dark fs-6">
                                            $<?= number_format($exp['amount'], 2); ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('expenses/edit/'.$exp['id']); ?>" class="btn btn-sm btn-light text-primary rounded-circle shadow-sm me-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('expenses/delete/'.$exp['id']); ?>" class="btn btn-sm btn-light text-danger rounded-circle shadow-sm delete-btn" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted mb-3"><i class="fas fa-inbox fa-3x opacity-25"></i></div>
                                            <h6 class="text-muted">No expenses found</h6>
                                            <a href="<?= base_url('expenses/add'); ?>" class="btn btn-sm btn-primary mt-2">Add your first expense</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // --- 1. SweetAlert Logic ---
        document.querySelectorAll('.delete-btn').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const url = item.getAttribute('href');
                
                Swal.fire({
                    title: 'Delete Expense?',
                    text: "You won't be able to recover this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                })
            });
        });

        // --- 2. Chart.js Logic ---
        // We safely pass PHP data to JavaScript
        const chartDataRaw = <?= json_encode($chart_data ?? []); ?>;
        
        // If we have data, render chart. If not, showing empty state in HTML
        if(chartDataRaw.length > 0) {
            const ctx = document.getElementById('expenseChart').getContext('2d');
            
            // Extract labels and values
            const labels = chartDataRaw.map(item => item.category);
            const data = chartDataRaw.map(item => item.total);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            '#FF6384', // Red
                            '#36A2EB', // Blue
                            '#FFCE56', // Yellow
                            '#4BC0C0', // Teal
                            '#9966FF', // Purple
                            '#FF9F40'  // Orange
                        ],
                        borderWidth: 2,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    },
                    layout: {
                        padding: 10
                    }
                }
            });
        }
    </script>
</body>
</html>