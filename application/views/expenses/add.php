<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense - OneStack Tracker</title>
    
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
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            background-color: #f8f9fa;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: none;
            border-color: #764ba2;
            background-color: #fff;
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            border: none;
            background-color: #eaeef1;
            color: #6c757d;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
        }
        .btn-light {
            border-radius: 10px;
            padding: 12px;
            font-weight: 500;
            color: #666;
        }
        .btn-light:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark px-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= base_url('expenses/dashboard'); ?>">
                <i class="fas fa-wallet me-2"></i>OneStack Tracker
            </a>
            <div class="ms-auto">
                <a href="<?= base_url('expenses/dashboard'); ?>" class="btn btn-sm btn-outline-light rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                
                <div class="card p-4">
                    <div class="card-body">
                        
                        <div class="text-center mb-4">
                            <div class="d-inline-block p-3 rounded-circle bg-primary bg-opacity-10 mb-3" style="color: #764ba2;">
                                <i class="fas fa-receipt fa-2x"></i>
                            </div>
                            <h4 class="fw-bold">Add New Expense</h4>
                            <p class="text-muted small">Track your spending by filling out the details below.</p>
                        </div>

                        <?= validation_errors('<div class="alert alert-danger shadow-sm border-0 rounded-3"><i class="fas fa-exclamation-circle me-2"></i>', '</div>'); ?>

                        <?= form_open('expenses/add'); ?>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-secondary">Expense Title</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input type="text" name="title" class="form-control" placeholder="e.g. Grocery Shopping" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" name="amount" class="form-control" placeholder="0.00" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Category</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-list"></i></span>
                                        <select name="category" class="form-select">
                                            <option value="Food">🍔 Food</option>
                                            <option value="Travel">✈️ Travel</option>
                                            <option value="Bills">🧾 Bills</option>
                                            <option value="Entertainment">🎬 Entertainment</option>
                                            <option value="Shopping">🛍️ Shopping</option>
                                            <option value="Health">💊 Health</option>
                                            <option value="Other">🔹 Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-secondary">Date of Expense</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="expense_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-secondary">Description (Optional)</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Add any extra notes here..."></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary shadow-sm">
                                    <i class="fas fa-save me-2"></i> Save Expense
                                </button>
                                <a href="<?= base_url('expenses/dashboard'); ?>" class="btn btn-light">
                                    Cancel
                                </a>
                            </div>

                        <?= form_close(); ?>
                        </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>