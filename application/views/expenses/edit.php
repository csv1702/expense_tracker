<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card">
            <div class="card-header">Edit Expense</div>
            <div class="card-body">
                <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                
                <?= form_open('expenses/edit/'.$expense['id']); ?>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?= $expense['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" step="0.01" name="amount" class="form-control" value="<?= $expense['amount']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <select name="category" class="form-control">
                            <option value="Food" <?= ($expense['category'] == 'Food') ? 'selected' : ''; ?>>Food</option>
                            <option value="Travel" <?= ($expense['category'] == 'Travel') ? 'selected' : ''; ?>>Travel</option>
                            <option value="Bills" <?= ($expense['category'] == 'Bills') ? 'selected' : ''; ?>>Bills</option>
                            <option value="Entertainment" <?= ($expense['category'] == 'Entertainment') ? 'selected' : ''; ?>>Entertainment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Date</label>
                        <input type="date" name="expense_date" class="form-control" value="<?= $expense['expense_date']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"><?= $expense['description']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Expense</button>
                    <a href="<?= base_url('expenses/dashboard'); ?>" class="btn btn-secondary">Cancel</a>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</body>
</html>