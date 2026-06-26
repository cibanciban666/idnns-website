<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration – IdNNS</title>
    <link rel="icon" type="image/x-icon" href="assets/images/idnns.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* ── Design tokens ── */
        :root {
            --navy:          #00008c;
            --navy-deep:     #000070;
            --navy-soft:     rgba(255, 255, 255, 0.055);
            --line-soft:     rgba(255, 255, 255, 0.10);
            --text-soft:     rgba(219, 234, 254, 0.66);
            --blue-accent:   #60a5fa;
            --yellow-accent: #facc15;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--navy);
            color: white;
            scroll-behavior: smooth;
        }
        .font-serif    { font-family: 'Libre Baskerville', serif; }
        .bg-navy-light { background-color: var(--navy-soft); }

        /* Nav — overrides Tailwind bg-[#000064]/95 */
        nav {
            background-color: color-mix(in srgb, var(--navy) 90%, transparent) !important;
            transition: background-color 0.35s ease, box-shadow 0.35s ease;
        }
        nav.is-scrolled {
            background-color: color-mix(in srgb, var(--navy-deep) 97%, transparent) !important;
            box-shadow: 0 4px 28px rgba(0, 0, 0, 0.40);
        }
        #mobile-menu { background-color: var(--navy) !important; }

        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease, opacity 0.35s ease;
            opacity: 0;
        }
        #mobile-menu.open { max-height: 600px; opacity: 1; }

        .hero-glow {
            background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(59,130,246,0.12) 0%, transparent 70%);
        }
        .hero-glow-red {
            background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(239,68,68,0.1) 0%, transparent 70%);
        }

        /* Animated checkmark ring */
        @keyframes pop-in {
            0%   { transform: scale(0.5); opacity: 0; }
            70%  { transform: scale(1.1); }
            100% { transform: scale(1);   opacity: 1; }
        }
        .pop-in { animation: pop-in 0.5s ease forwards; }

        @keyframes draw-check {
            from { stroke-dashoffset: 60; }
            to   { stroke-dashoffset: 0; }
        }
        .draw-check {
            stroke-dasharray: 60;
            stroke-dashoffset: 60;
            animation: draw-check 0.4s ease 0.4s forwards;
        }
    </style>
</head>
<body>

<?php
// ======================
// CONFIG
// ======================
$upload_dir   = __DIR__ . '/uploads/payments/';
$max_size     = 5 * 1024 * 1024;
$allowed_mime = ['image/jpeg', 'image/png', 'application/pdf'];

// ======================
// ONLY POST
// ======================
$success = false;
$error   = '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $error = 'Invalid request. Please submit the form.';
} else {

    include 'config.local.php';

    // 1. Ambil data form
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name']  ?? '');
    $email      = trim($_POST['email']      ?? '');
    $category   = $_POST['category']        ?? '';

    // 2. Handle country
    if (($_POST['country'] ?? '') === 'Other') {
        $country = trim($_POST['country_other'] ?? '');
        if (empty($country)) {
            $error = 'Country is required.';
        }
    } else {
        $country = $_POST['country'] ?? '';
    }

    if (empty($error)) {

        // 3. Membership type
        $membership_type = (strtolower($country) === 'indonesia') ? 'local' : 'international';

        // 4. Handle file upload
        if (!isset($_FILES['payment_proof']) || $_FILES['payment_proof']['error'] !== UPLOAD_ERR_OK) {
            $error = 'File not found or upload error. Please try again.';
        } else {
            $file = $_FILES['payment_proof'];

            if ($file['size'] > $max_size) {
                $error = 'File exceeds 5 MB limit.';
            } else {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime  = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                if (!in_array($mime, $allowed_mime)) {
                    $error = 'Invalid file type. Please upload a JPG, PNG, or PDF.';
                } else {
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }

                    $ext         = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $safe_name   = bin2hex(random_bytes(16)) . '.' . $ext;
                    $target_path = $upload_dir . $safe_name;

                    if (!move_uploaded_file($file['tmp_name'], $target_path)) {
                        $error = 'Upload failed. Please try again.';
                    } else {
                        chmod($target_path, 0640);

                        // 5. Insert database
                        $stmt = $conn->prepare("
                            INSERT INTO members 
                            (first_name, last_name, email, country, category, membership_type, payment_proof) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)
                        ");
                        $stmt->bind_param(
                            "sssssss",
                            $first_name,
                            $last_name,
                            $email,
                            $country,
                            $category,
                            $membership_type,
                            $safe_name
                        );

                        if ($stmt->execute()) {
                            $success = true;
                        } else {
                            $error = 'Database error. Please contact us at info@idnns.org.';
                        }
                        $stmt->close();
                    }
                }
            }
        }
    }
}
?>

<!-- ───────────────────── NAVIGATION ───────────────────── -->
<nav class="sticky top-0 z-50 bg-[#000064]/95 backdrop-blur-md border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

        <div class="flex items-center">
            <img src="assets/images/idnnslogo1-removebg-preview.png" alt="IdNNS Logo" class="w-36 object-contain"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
            <span style="display:none" class="text-white font-bold text-xl tracking-tight">IdNNS</span>
        </div>

        <div class="hidden lg:flex gap-8">
            <?php
            $navItems = ['Home', 'About', 'Journals', 'Conferences', 'Membership', 'Contact'];
            foreach ($navItems as $item): ?>
                <a href="<?php echo $item === 'Home' ? 'index.php' : ($item === 'Membership' ? 'membership.php' : 'index.php#' . strtolower($item)); ?>"
                   class="text-sm uppercase tracking-widest font-bold opacity-60 hover:opacity-100 transition-opacity">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex items-center gap-3">
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl hover:bg-white/10 transition-colors">
                <i data-lucide="menu" class="w-6 h-6" id="icon-menu"></i>
                <i data-lucide="x"    class="w-6 h-6 hidden" id="icon-x"></i>
            </button>
            <a href="register.php"
               class="px-5 py-2 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-[#000064] transition-all">
                Join Now
            </a>
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden border-t border-white/10 bg-[#000064]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-1">
            <?php foreach ($navItems as $item): ?>
                <a href="<?php echo $item === 'Home' ? 'index.php' : ($item === 'Membership' ? 'membership.php' : 'index.php#' . strtolower($item)); ?>"
                   onclick="closeMenu()"
                   class="text-sm uppercase tracking-widest font-bold opacity-70 hover:opacity-100 py-3 px-4 rounded-xl hover:bg-white/5 transition-all">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>


<!-- ───────────────────── RESULT PAGE ───────────────────── -->

<?php if ($success): ?>

<!-- ══ SUCCESS ══ -->
<section class="relative min-h-[80vh] flex items-center justify-center px-6 py-24 hero-glow">
    <div class="max-w-xl mx-auto text-center">

        <!-- Animated check icon -->
        <div class="pop-in inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-500/10 border border-green-400/30 mb-10 mx-auto">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="draw-check" d="M10 22L19 31L34 14" stroke="#4ade80" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <p class="text-green-400 text-xs uppercase tracking-[0.4em] font-bold mb-4">Registration Successful</p>
        <h1 class="text-3xl md:text-5xl font-serif leading-tight mb-6">
            Welcome to IdNNS,<br><?php echo htmlspecialchars($first_name); ?>!
        </h1>
        <p class="text-blue-100/50 text-base font-light leading-relaxed mb-12">
            Your registration has been received. Our team will verify your payment and send a confirmation email to
            <span class="text-white/70 font-medium"><?php echo htmlspecialchars($email); ?></span>
            within <strong class="text-white/70">3 working days</strong>.
        </p>

        <!-- Summary card -->
        <div class="bg-navy-light border border-white/10 rounded-3xl p-8 text-left mb-10">
            <p class="text-[10px] uppercase tracking-widest font-bold text-blue-400/70 mb-6">Registration Summary</p>
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-white/5">
                    <span class="text-white/40 text-sm">Full Name</span>
                    <span class="font-semibold text-sm"><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-white/5">
                    <span class="text-white/40 text-sm">Email</span>
                    <span class="font-semibold text-sm"><?php echo htmlspecialchars($email); ?></span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-white/5">
                    <span class="text-white/40 text-sm">Country</span>
                    <span class="font-semibold text-sm"><?php echo htmlspecialchars($country); ?></span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-white/5">
                    <span class="text-white/40 text-sm">Category</span>
                    <span class="font-semibold text-sm"><?php echo htmlspecialchars($category); ?></span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-white/40 text-sm">Membership Type</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest
                        <?php echo $membership_type === 'local' ? 'bg-blue-400/15 text-blue-400' : 'bg-purple-400/15 text-purple-400'; ?>">
                        <?php echo ucfirst($membership_type); ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- CTAs -->
        <div class="flex flex-wrap justify-center gap-4">
            <a href="index.php"
               class="px-10 py-4 bg-white text-[#000064] rounded-full text-xs font-bold uppercase tracking-widest hover:scale-105 transition-transform">
                Back to Home
            </a>
            <a href="membership.php"
               class="px-10 py-4 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white/5 transition-all">
                Membership Page
            </a>
        </div>
    </div>
</section>

<?php else: ?>

<!-- ══ ERROR ══ -->
<section class="relative min-h-[80vh] flex items-center justify-center px-6 py-24 hero-glow-red">
    <div class="max-w-xl mx-auto text-center">

        <!-- Error icon -->
        <div class="pop-in inline-flex items-center justify-center w-24 h-24 rounded-full bg-red-500/10 border border-red-400/30 mb-10 mx-auto">
            <i data-lucide="x-circle" class="w-10 h-10 text-red-400"></i>
        </div>

        <p class="text-red-400 text-xs uppercase tracking-[0.4em] font-bold mb-4">Registration Failed</p>
        <h1 class="text-3xl md:text-5xl font-serif leading-tight mb-6">Something Went Wrong</h1>
        <p class="text-blue-100/50 text-base font-light leading-relaxed mb-10">
            <?php echo htmlspecialchars($error); ?>
        </p>

        <!-- Error detail card -->
        <div class="bg-red-500/5 border border-red-400/20 rounded-2xl px-8 py-6 text-left mb-10">
            <div class="flex items-start gap-4">
                <i data-lucide="info" class="w-4 h-4 text-red-400/70 flex-shrink-0 mt-0.5"></i>
                <p class="text-blue-100/40 text-sm leading-relaxed font-light">
                    If this issue persists, please contact us directly at
                    <a href="mailto:info@idnns.org" class="text-blue-400 underline underline-offset-2">info@idnns.org</a>
                    and include a description of the error.
                </p>
            </div>
        </div>

        <!-- CTAs -->
        <div class="flex flex-wrap justify-center gap-4">
            <a href="register.php"
               class="px-10 py-4 bg-white text-[#000064] rounded-full text-xs font-bold uppercase tracking-widest hover:scale-105 transition-transform">
                Try Again
            </a>
            <a href="index.php"
               class="px-10 py-4 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white/5 transition-all">
                Back to Home
            </a>
        </div>
    </div>
</section>

<?php endif; ?>


<!-- ───────────────────── FOOTER ───────────────────── -->
    <footer id="contact" class="py-20 px-6 border-t border-white/5 text-center">
        <div class="max-w-7xl mx-auto">
            <p class="text-[10px] uppercase tracking-[0.3em] font-bold opacity-20 mb-4">
                Indonesian Neural Network Society &copy; <?php echo date('Y'); ?>
            </p>
            <div class="flex justify-center gap-8 opacity-40">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@idnns.org" target="_blank" class="flex items-center gap-2 hover:opacity-100 transition-opacity">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                    <span class="text-xs">info@idnns.org</span>
                </a>
                <a href="tel:+628588901686" class="flex items-center gap-2 hover:opacity-100 transition-opacity">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                    <span class="text-xs">+62 858-8901-6864</span>
                </a>
            </div>
        </div>
    </footer>


<script>
    lucide.createIcons();

    const btn      = document.getElementById('mobile-menu-btn');
    const menu     = document.getElementById('mobile-menu');
    const iconMenu = document.getElementById('icon-menu');
    const iconX    = document.getElementById('icon-x');
    let isOpen = false;

    btn.addEventListener('click', () => {
        isOpen = !isOpen;
        menu.classList.toggle('open', isOpen);
        iconMenu.classList.toggle('hidden', isOpen);
        iconX.classList.toggle('hidden', !isOpen);
    });

    function closeMenu() {
        isOpen = false;
        menu.classList.remove('open');
        iconMenu.classList.remove('hidden');
        iconX.classList.add('hidden');
    }
</script>

<script src="assets/js/interactions.js"></script>
</body>
</html>