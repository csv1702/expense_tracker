<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - OneStack Tracker</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        .card-header {
            background: #fff;
            border-bottom: none;
            padding-top: 30px;
            text-align: center;
        }
        .btn-success {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            border: none;
            color: #0d5e42;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(56, 249, 215, 0.4);
            color: #0d5e42;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            background-color: #f4f6f9;
            border: 1px solid #eee;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #38f9d7;
            box-shadow: none;
        }
        .input-group-text {
            border: none;
            background: #f4f6f9;
            color: #888;
            border-radius: 10px 0 0 10px;
        }
        .logo-icon {
            font-size: 3rem;
            background: -webkit-linear-gradient(#43e97b, #38f9d7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                
                <div class="card p-4">
                    <div class="card-header">
                        <i class="fas fa-user-plus logo-icon mb-2"></i>
                        <h4 class="fw-bold text-dark mt-2">Create Account</h4>
                        <p class="text-muted small">Join OneStack Tracker today</p>
                    </div>
                    
                    <div class="card-body">
                        <?= validation_errors('<div class="alert alert-danger py-2 text-center small rounded-3 border-0 bg-danger bg-opacity-10 text-danger mb-3">', '</div>'); ?>

                        <?= form_open('auth/register'); ?>
                            
                            <div class="mb-3">
                                <label class="form-label small text-muted fw-bold ms-1">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="johndoe" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small text-muted fw-bold ms-1">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small text-muted fw-bold ms-1">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success">Sign Up</button>
                            </div>

                        <?= form_close(); ?>

                        <div class="text-center mt-3">
                            <p class="small text-muted mb-0">Already have an account?</p>
                            <a href="<?= base_url('auth/login'); ?>" class="fw-bold text-decoration-none" style="color: #20c997;">Login Here</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>