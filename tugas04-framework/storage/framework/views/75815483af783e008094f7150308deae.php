<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($pageTitle); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/sass/app.scss'); ?>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mb-0 h1" href="<?php echo e(route('home')); ?>"><i class="bi-hexagon-fill me-2"></i> Data Master </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <hr class="d-lg-none text-white-50">
                <ul class="navbar-nav flex-row flex-wrap">
                    <li class="nav-item col-2 col-md-auto">
                        <a class="nav-link active" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item col-2 col-md-auto">
                        <a class="nav-link" href="<?php echo e(route('employees.index')); ?>">Employee List</a>
                    </li>
                </ul>
                <hr class="d-lg-none text-white-50">
                <a class="btn btn-outline-light my-2 ms-md-auto" href="<?php echo e(route('profile')); ?>"><i class="bi-person-circle me-1"></i>My Profile</a>
            </div>
        </div>
    </nav>

    <div class="container-sm mt-5">
        <form action="<?php echo e(route('employees.update',['employee' => $employee->employee_id])); ?>" method="POST">
            <?php echo method_field('put'); ?>
            <input type="hidden" name="employee_id" id="employee_id" value="<?php echo e($employee->employee_id); ?>">
            <div class="row justify-content-center">
                <div class="p-5 bg-light rounded-3 border col-xl-6">
                    <div class="mb-3 text-center">
                        <i class="bi-person-circle fs-1"></i>
                        <h4>Edit Employee</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input class="form-control" type="text" name="firstName" id="firstName" value="<?php echo e($employee->firstname); ?>" placeholder="Enter First Name">
                            <?php if($errors->has('firstName')): ?>
                                <span>
                                    <?php echo e($error); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo e($employee->lastname); ?>" placeholder="Enter Last Name">
                            <?php if($errors->has('lastName')): ?>
                                <span>
                                    <strong><?php echo e($error); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo e($employee->email); ?>" placeholder="Enter Email">
                            <?php if($errors->has('email')): ?>
                                <span>
                                    <strong><?php echo e($error); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input class="form-control" type="text" name="age" id="age" value="<?php echo e($employee->age); ?>" placeholder="Enter Age">
                            <?php if($errors->has('age')): ?>
                                <span>
                                    <strong><?php echo e($error); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <select name="position" id="position" class="form-select">
                            <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($position->id); ?>" <?php echo e($employee->id == $position->id ? 'selected' : ''); ?> > <?php echo e($position->code.' - '.$position->name); ?>></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="<?php echo e(route('employees.index')); ?>" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-dark btn-lg mt-3"><i class="bi-check-circle me-2"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo csrf_field(); ?>
        </form>
    </div>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
</body>
</html>
<?php /**PATH C:\Users\Husni\tugas04-framework\resources\views/employee/edit.blade.php ENDPATH**/ ?>