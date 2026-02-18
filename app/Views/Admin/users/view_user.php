<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>

<div class="content-wrapper">
    <div class="card">
        <div class="card-header">
           <div class="d-flex justify-content-between">
                <h4>User Details</h4>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-info">Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td><?= esc($user->name) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= esc($user->email) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= ($user->status == 1) ? 'Active' : 'Inactive' ?></td>
                        </tr>
                        <tr>
                            <th>Added By</th>
                            <td><?= esc($user->added_by) ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?= esc($user->created) ?></td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td><?= esc($user->updated) ?></td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                <?php if (isset($user->image) && $user->image != ''): ?>
                                    <img src="<?= base_url('assets/upload/users/' . $user->image) ?>" width="100"
                                        alt="User Image">
                                <?php else: ?>
                                    <span>No Image</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>

                    <!-- Optional Buttons -->
                    <a href="<?= base_url('admin/users/edit_user/' . $user->id) ?>" class="btn btn-warning">Edit</a>
                    <a href="<?= base_url('admin/users/delete_user/' . $user->id) ?>" class="btn btn-danger"
                        onclick="return confirm('Are you sure?')">Delete</a>0
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>