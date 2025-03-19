<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    <div class="relative flex flex-col justify-center items-center h-screen bg-gray-100 dark:bg-black overflow-hidden">
        <!-- Background -->
        <img src="<?php echo e(asset('bank_sampah/images/background.svg')); ?>" class="absolute -left-20 top-0 max-w-[877px]" />

        <div class="relative w-full max-w-5xl px-6">
            <header class="grid grid-cols-3 items-center py-4">
                <div class="flex justify-center col-start-2 mb-10">
                    <img src="<?php echo e(asset('bank_sampah/images/logo2.jpg')); ?>" alt="Logo" class="rounded-full w-20 h-20">
                </div>
            </header>

            <main class="grid grid-cols-2 gap-6 items-center">
                <!-- Slogan -->
                <div class="text-center font-mono">
                    <h5 class="text-4xl lg:text-5xl text-white font-bold mb-5">Reuse</h5>
                    <h5 class="text-4xl lg:text-5xl text-white font-bold mb-5">Reduce</h5>
                    <h5 class="text-4xl lg:text-5xl text-white font-bold mb-0">Recycle</h5>
                </div>

                <!-- Login Form -->
                <div class="bg-white p-5 rounded-lg shadow-lg ring-1 ring-gray-200 dark:bg-zinc-900 dark:ring-zinc-800">
                    <h2 class="text-center text-xl font-bold text-green-600">Portal Bank Sampah RSUD Bangil</h2>

                    <form class="needs-validation" novalidate method="POST" action="<?php echo e(route('register')); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="useremail" class="block text-sm font-medium text-gray-700">Email <span class="text-danger">*</span></label>
                            <input type="email" class="w-full p-2 border rounded focus:ring-2 focus:ring-green-500 text-black <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                                value="<?php echo e(old('email')); ?>" id="useremail" placeholder="Enter email address" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="block text-sm font-medium text-gray-700">Username <span class="text-danger">*</span></label>
                            <input type="text" class="w-full p-2 border rounded focus:ring-2 focus:ring-green-500 text-black <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name"
                                value="<?php echo e(old('name')); ?>" id="username" placeholder="Enter username" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="userpassword" class="block text-sm font-medium text-gray-700">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" class="w-full p-2 border rounded focus:ring-2 focus:ring-green-500 text-black <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="password" id="userpassword" placeholder="Enter password" required>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password"
                                class="w-full p-2 border rounded focus:ring-2 focus:ring-green-500 text-black <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="password_confirmation" id="input-password" placeholder="Enter Confirm Password"
                                required>

                            <div class="form-floating-icon">
                                <i data-feather="lock"></i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700">Asal Ruangan <span class="text-danger">*</span></label>
                            <select class="w-full p-2 border rounded focus:ring-2 focus:ring-green-500 text-black" name="room_id">
                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($room->id); ?>" class="text-black">
                                    <?php echo e($room->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="role" value="U">
                        </div>

                        <div class="mt-3">
                            <button class="mt-4 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition" type="submit">Sign Up</button>
                        </div>

                        <!-- <div class="mt-3 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                            </div>

                                            <div>
                                                <button type="button"
                                                    class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                        class="ri-facebook-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                        class="ri-google-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                        class="ri-github-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-info btn-icon waves-effect waves-light"><i
                                                        class="ri-twitter-fill fs-16"></i></button>
                                            </div>
                                        </div> -->
                    </form>

                    <p class="text-center text-sm text-gray-600 mt-2">
                        Do you have an account?
                        <a href="<?php echo e(route('welcome')); ?>" class="text-green-600 font-semibold hover:underline">Sign
                            In</a>
                    </p>
                </div>
            </main>

            <footer class="text-center text-sm text-black dark:text-white/70 mt-4">
                <!-- Footer -->
            </footer>
        </div>
    </div>

    <!-- Dark Mode Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            let passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="ri-eye-line"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="ri-eye-off-line"></i>';
            }
        });
    </script>
</body>

</html><?php /**PATH D:\xampp\htdocs\bank_sampah\resources\views/auth/register.blade.php ENDPATH**/ ?>