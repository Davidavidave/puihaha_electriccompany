<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?= esc($title) ?></title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-4"><div class="card shadow-sm mx-auto" style="max-width:850px"><div class="card-body p-4">
<h2 class="mb-4"><?= esc($title) ?></h2>
<?php if ($message = session()->getFlashdata('error')): ?><div class="alert alert-danger"><?= esc($message) ?></div><?php endif; ?>
<?php $editing = $account !== null; $action = $editing ? 'account/update/' . $account['id'] : 'account/store'; ?>
<form action="<?= base_url($action) ?>" method="post"><?= csrf_field() ?>
<div class="row g-3">
<div class="col-md-6"><label class="form-label">Account Number</label><input name="account_number" class="form-control" required maxlength="50" value="<?= esc(old('account_number', $account['account_number'] ?? '')) ?>"></div>
<div class="col-md-6"><label class="form-label">Customer Name</label><input name="customer_name" class="form-control" required maxlength="150" value="<?= esc(old('customer_name', $account['customer_name'] ?? '')) ?>"></div>
<div class="col-12"><label class="form-label">Address</label><textarea name="address" class="form-control" required><?= esc(old('address', $account['address'] ?? '')) ?></textarea></div>
<div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control" value="<?= esc(old('phone', $account['phone'] ?? '')) ?>"></div>
<div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?= esc(old('email', $account['email'] ?? '')) ?>"></div>
<div class="col-md-6"><label class="form-label">Meter Number</label><input name="meter_number" class="form-control" value="<?= esc(old('meter_number', $account['meter_number'] ?? '')) ?>"></div>
<div class="col-md-3"><label class="form-label">Connection Type</label><select name="connection_type" class="form-select"><option value="residential" <?= old('connection_type', $account['connection_type'] ?? '') === 'residential' ? 'selected' : '' ?>>Residential</option><option value="commercial" <?= old('connection_type', $account['connection_type'] ?? '') === 'commercial' ? 'selected' : '' ?>>Commercial</option><option value="industrial" <?= old('connection_type', $account['connection_type'] ?? '') === 'industrial' ? 'selected' : '' ?>>Industrial</option></select></div>
<div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" <?= old('status', $account['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option><option value="inactive" <?= old('status', $account['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option><option value="suspended" <?= old('status', $account['status'] ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option></select></div>
</div><div class="mt-4"><button class="btn btn-primary">Save Account</button><a href="<?= base_url('dashboard') ?>" class="btn btn-secondary ms-2">Cancel</a></div></form>
</div></div></div></body></html>
