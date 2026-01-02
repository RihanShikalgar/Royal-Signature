<?php
// pages/feedback.php - Feedback page
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /Royal-Signature/index.php');
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/backend/config.php';

$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Royal Signature</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/Royal-Signature/css/style.css">
    <style>
        .star {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
            margin: 0 5px;
            transition: color 0.2s;
        }
        .star.active {
            color: #d4af37;
        }
    </style>
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/header.php'; ?>

<!-- Feedback Section -->
<section class="py-5">
    <div class="container">
        <h1 class="mb-5 text-center">Give us Your Feedback</h1>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            Thank you for your feedback! We appreciate your input.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        <?php endif; ?>

                        <form method="POST" action="/Royal-Signature/backend/submit-feedback.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="feedback_type" class="form-label">Feedback Type</label>
                                <select class="form-select" id="feedback_type" name="feedback_type" required>
                                    <option value="">Select a type...</option>
                                    <option value="Product Quality">Product Quality</option>
                                    <option value="Delivery">Delivery Experience</option>
                                    <option value="Customer Service">Customer Service</option>
                                    <option value="Website">Website Experience</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div id="rating">
                                    <span class="star" data-value="1"><i class="fas fa-star"></i></span>
                                    <span class="star" data-value="2"><i class="fas fa-star"></i></span>
                                    <span class="star" data-value="3"><i class="fas fa-star"></i></span>
                                    <span class="star" data-value="4"><i class="fas fa-star"></i></span>
                                    <span class="star" data-value="5"><i class="fas fa-star"></i></span>
                                </div>
                                <input type="hidden" id="rating_value" name="rating" value="0">
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Your Feedback</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-gold w-100">Submit Feedback</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/Royal-Signature/includes/footer.php'; ?>

<script>
document.querySelectorAll('#rating .star').forEach(star => {
    star.addEventListener('click', function() {
        const value = this.dataset.value;
        document.getElementById('rating_value').value = value;
        document.querySelectorAll('#rating .star').forEach(s => s.classList.remove('active'));
        document.querySelectorAll('#rating .star').forEach((s, i) => {
            if (i < value) s.classList.add('active');
        });
    });
});
</script>

</body>
</html>
