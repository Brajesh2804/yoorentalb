<?= $this->extend("admin/_layouts/master") ?>
<?= $this->section("content") ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <!-- <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
            </span> --> Add User
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= base_url('admin/users') ?>" class="btn btn-primary">Back</a>
                </li>
            </ul>
        </nav>
    </div>
    <?php if (session()->getFlashdata('message')) { ?>
        <div class="alert alert-<?= session()->getFlashdata('type') ?>">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php } ?>
    <div class="card">
        <div class="card-body">
            <!-- <h4 class="card-title">Basic form elements</h4>
            <p class="card-description"> Basic form elements </p> -->
            <form action="<?= current_url() ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" name="name" id="name" value="<?= set_value('name') ?>"
                                class="form-control">
                            <span class="text-danger"><?= (isset($validation)) ? $validation->showError('name') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" value="<?= set_value('email') ?>"
                                class="form-control">
                            <span
                                class="text-danger"><?= (isset($validation)) ? $validation->showError('email') : '' ?></span>

                        </div>
                        <!-- <div class="form-group">
                            <label for="">Phone</label>
                            <input type="numeric" name="phone" id="phone" value="<?= set_value('phone') ?>"
                                class="form-control">
                            <span
                                class="text-danger"><?= (isset($validation)) ? $validation->showError('phone') : '' ?></span>

                        </div> -->
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" value="<?= set_value('password') ?>"
                                class="form-control">
                            <span
                                class="text-danger"><?= (isset($validation)) ? $validation->showError('password') : '' ?></span>

                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="cpassword" id="cpassword" value="<?= set_value('cpassword') ?>"
                                class="form-control">
                            <span
                                class="text-danger"><?= (isset($validation)) ? $validation->showError('cpassword') : '' ?></span>

                        </div>
                        <div class="form-group px-4">
                            <div class="form-check ">
                                <input class="form-check-input" type="radio" name="status" value="1" id="status"
                                    checked>
                                <label class="form-check-label" for="status">
                                    Active
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="0" id="status2">
                                <label class="form-check-label" for="status2">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="privilege_id" value="1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <!-- <a href="<?= base_url('admin/users') ?>" class="btn btn-info">Back</a> -->
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>

</div>

<?= $this->endSection() ?>