<?php

$messages = [
    'success' => session()->getFlashdata('message'),
    'error' => session()->getFlashdata('error'),
    'errors' => session()->getFlashdata('errors')
];

// Display Success Message
if (!empty($messages['success'])): ?>
    <div class="alert alert-success"><?= $messages['success']; ?></div>
<?php endif;

// Display Error Message
if (!empty($messages['error'])): ?>
    <div class="alert alert-danger"><?= $messages['error']; ?></div>
<?php endif;

// Display Validation Errors
if (!empty($messages['errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($messages['errors'] as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif;