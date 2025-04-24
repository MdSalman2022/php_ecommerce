<div class="error-container">
    <h2>Error</h2>
    <div class="error-message">
        <?php echo $errorMessage; ?>
    </div>
    <div class="error-actions">
        <a href="<?php echo $backUrl ?? 'index.php'; ?>">Go Back</a>
    </div>
</div>