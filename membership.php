<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership – IdNNS</title>
    <link rel="icon" type="image/x-icon" sizes="32x32" href="assets/images/idnns.ico">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="assets/images/idnns.ico">
    <link rel="apple-touch-icon" href="assets/images/idnns.ico">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #000064;
            color: white;
            scroll-behavior: smooth;
        }
        .font-serif { font-family: 'Libre Baskerville', serif; }
        .bg-navy-dark  { background-color: #000064; }
        .bg-navy-light { background-color: rgba(255,255,255,0.05); }

        /* Mobile menu slide */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease, opacity 0.35s ease;
            opacity: 0;
        }
        #mobile-menu.open { max-height: 600px; opacity: 1; }

        /* Benefit card hover */
        .benefit-card { transition: border-color 0.25s ease, transform 0.25s ease; }
        .benefit-card:hover { border-color: rgba(96,165,250,0.5); transform: translateY(-2px); }

        /* Why-join icon pulse */
        .icon-wrap { transition: background 0.25s ease; }
        .icon-wrap:hover { background: rgba(96,165,250,0.15); }

        /* Card image hover */
        .card-preview { transition: transform 0.35s ease, box-shadow 0.35s ease; }
        .card-preview:hover { transform: scale(1.04); box-shadow: 0 30px 80px rgba(59,130,246,0.25); }

        /* Step connector line */
        .step-line::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -50%;
            width: 100%;
            height: 1px;
            background: rgba(255,255,255,0.1);
        }

        /* Gradient hero overlay */
        .hero-glow {
            background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(59,130,246,0.15) 0%, transparent 70%);
        }
    </style>
</head>
<body>

<!-- ─────────────────────────── NAVIGATION (identical to index.php) ─────────────────────────── -->
<nav class="sticky top-0 z-50 bg-[#000064]/95 backdrop-blur-md border-b border-white/10">

    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center flex-1">
            <img src="assets/images/idnnslogo1-removebg-preview.png"
                 alt="IdNNS Logo"
                 class="w-36 h-auto object-contain"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
            <span style="display:none" class="text-white font-bold text-xl tracking-tight">IdNNS</span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:flex gap-8 flex-1 justify-center">
            <?php
            $navItems = ['Home', 'About', 'Journals', 'Conferences', 'Membership', 'Contact'];
        
            foreach ($navItems as $item):
                $lower = strtolower($item);
        
                if ($item === 'Home') {
                    $href = 'index.php';
                } elseif ($item === 'Membership') {
                    $href = 'membership.php';
                } else {
                    $href = 'index.php#' . $lower;
                }
            ?>
                <a href="<?php echo $href; ?>"
                   class="text-sm uppercase tracking-widest font-bold <?php echo $item === 'Membership' ? 'opacity-100 text-blue-400' : 'opacity-60 hover:opacity-100'; ?> transition-opacity">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Right: hamburger + join -->
        <div class="flex items-center gap-3 flex-1 justify-end">
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl hover:bg-white/10 transition-colors">
                <i data-lucide="menu" class="w-6 h-6" id="icon-menu"></i>
                <i data-lucide="x" class="w-6 h-6 hidden" id="icon-x"></i>
            </button>
            <a href="register.php"
               class="px-5 py-2 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-[#050a30] transition-all">
                Join Now
            </a>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden border-t border-white/10 bg-[#000064]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-1">
            <?php
            foreach ($navItems as $item): ?>
                <a href="<?php echo $item === 'Home' ? 'index.php' : '#' . strtolower($item); ?>"
                   onclick="closeMenu()"
                   class="text-sm uppercase tracking-widest font-bold opacity-70 hover:opacity-100 py-3 px-4 rounded-xl hover:bg-white/5 transition-all">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>


<!-- ─────────────────────────── HERO SECTION ─────────────────────────── -->
<section id="membership" class="relative pt-20 pb-20 px-6 hero-glow">
    <div class="max-w-4xl mx-auto text-center">
        <p class="text-blue-400 text-xs uppercase tracking-[0.4em] font-bold mb-6">
            Indonesian Neural Network Society
        </p>
        <h1 class="text-4xl md:text-6xl font-serif leading-tight mb-8">
            Become an IdNNS Member
        </h1>
        <p class="text-blue-100/60 text-lg font-light leading-relaxed mb-12 max-w-2xl mx-auto">
            Join a thriving community of researchers, academics, and industry leaders advancing neural networks,
            artificial intelligence, and intelligent systems across Indonesia and the Asia-Pacific region.
        </p>
    </div>

    <!-- Stat strip -->
    <div class="max-w-3xl mx-auto mt-20 grid grid-cols-3 gap-4 text-center">
        <?php
        $stats = [
            ['value' => '250+', 'label' => 'Active Members'],
            ['value' => '3',    'label' => 'Peer-Reviewed Journals'],
            ['value' => '2026', 'label' => 'Est. Conference Year'],
        ];
        foreach ($stats as $s): ?>
        <div class="bg-navy-light border border-white/10 rounded-2xl py-6 px-4">
            <p class="text-3xl font-bold text-blue-400 mb-1"><?= $s['value']; ?></p>
            <p class="text-[10px] uppercase tracking-widest font-bold opacity-50"><?= $s['label']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- ─────────────────────────── WHY JOIN ─────────────────────────── -->
<section id="why-join" class="py-24 px-6">
    <div class="max-w-7xl mx-auto">

        <!-- Heading -->
        <div class="text-center mb-16">
            <p class="text-blue-400 text-xs uppercase tracking-[0.4em] font-bold mb-4">Reasons to Join</p>
            <h2 class="text-3xl md:text-5xl font-serif leading-tight">Why Become a Member?</h2>
        </div>

        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php
            $reasons = [
                [
                    'icon'  => 'users',
                    'title' => 'Professional Network',
                    'desc'  => 'Connect with 250+ researchers, academics, and industry practitioners across Indonesia and the Asia-Pacific region.',
                ],
                [
                    'icon'  => 'book-open',
                    'title' => 'Access to Journals',
                    'desc'  => 'Get exclusive access to IdNNS peer-reviewed journals covering machine learning, cybersecurity, and intelligent systems.',
                ],
                [
                    'icon'  => 'calendar',
                    'title' => 'Conferences & Events',
                    'desc'  => 'Priority registration and discounted fees for IConCIS and other international conferences organised by IdNNS.',
                ],
                [
                    'icon'  => 'trending-up',
                    'title' => 'Career Growth',
                    'desc'  => 'Boost your academic profile through co-authored publications, awards recognition, and mentorship programmes.',
                ],
            ];
            foreach ($reasons as $r): ?>
            <div class="bg-navy-light border border-white/10 rounded-3xl p-8 hover:border-blue-400/40 transition-all group">
                <div class="icon-wrap w-12 h-12 rounded-2xl bg-blue-400/10 flex items-center justify-center mb-6">
                    <i data-lucide="<?= $r['icon']; ?>" class="w-5 h-5 text-blue-400"></i>
                </div>
                <h3 class="font-bold text-lg mb-3"><?= $r['title']; ?></h3>
                <p class="text-blue-100/50 text-sm leading-relaxed font-light"><?= $r['desc']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ─────────────────────────── BENEFITS ─────────────────────────── -->
<section id="benefits" class="py-20 px-6">
    <div class="max-w-7xl mx-auto">

        <div class="mb-16">
            <p class="text-blue-400 text-[10px] uppercase tracking-widest font-bold mb-2">What You Get</p>
            <h2 class="text-3xl font-serif">Member Benefits</h2>
        </div>

        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-5">
            <?php
            $benefits = [
                ['icon' => 'award',           'title' => 'Official Digital Member Card',    'desc' => 'Receive a personalized digital membership card valid for one membership year, recognised by IdNNS partners.'],
                ['icon' => 'file-text',       'title' => 'Journal Publication Support',     'desc' => 'Priority fast-track review and fee waivers for submitting to IJMLIS, IJCyber, and IJCASI.'],
                ['icon' => 'mic',             'title' => 'Conference Speaking Invitations', 'desc' => 'Eligible to submit papers and speak at IConCIS and affiliated international conferences.'],
                ['icon' => 'shield',          'title' => 'Professional Certification',      'desc' => 'Earn IdNNS-certified badges recognised in academia and the AI industry across ASEAN.'],
                ['icon' => 'message-circle',  'title' => 'Exclusive Community Access',      'desc' => 'Join moderated WhatsApp channels for research discussion, announcements, and peer collaboration.'],
                ['icon' => 'gift',            'title' => 'Member-Only Resources',           'desc' => 'Download exclusive research toolkits, datasets, and templates curated by the IdNNS board.'],
            ];
            foreach ($benefits as $b): ?>
            <div class="benefit-card bg-navy-dark border border-white/5 rounded-2xl p-6 cursor-default">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-400/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                        <i data-lucide="<?= $b['icon']; ?>" class="w-4 h-4 text-blue-400"></i>
                    </div>
                    <div>
                        <h4 class="font-bold mb-2"><?= $b['title']; ?></h4>
                        <p class="text-blue-100/50 text-sm leading-relaxed font-light"><?= $b['desc']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ─────────────────────────── MEMBER CARD PREVIEW ─────────────────────────── -->
<section id="card-preview" class="py-20 px-6">
    <div class="max-w-3xl mx-auto text-center">

        <p class="text-blue-400 text-xs uppercase tracking-[0.4em] font-bold mb-4">Official Identity</p>
        <h2 class="text-3xl md:text-4xl font-serif mb-4">Your Member Card</h2>
        <p class="text-blue-100/50 text-base font-light mb-12 max-w-lg mx-auto">
            Every active IdNNS member receives an official digital membership card, personalised with your name, role, and membership period.
        </p>

        <!-- Card image -->
        <div class="inline-block">
            <img src="assets/images/johndoe.png"
                 alt="IdNNS Member Card Preview"
                 class="card-preview rounded-3xl shadow-xl border border-white/10 w-full max-w-2xl mx-auto"
                 onerror="this.closest('.card-fallback-wrap').querySelector('.card-fallback').style.display='flex'; this.style.display='none'">

            <!-- Fallback rendered card (shown when image is missing) -->
            <div class="card-fallback hidden rounded-3xl overflow-hidden border border-white/10 shadow-2xl card-preview w-full max-w-2xl" style="background:#07114a;">
                <!-- Header bar -->
                <div class="flex items-center justify-between px-8 py-5" style="background:#050a30; border-bottom:1px solid rgba(255,255,255,0.08);">
                    <div class="flex items-center gap-3">
                        <img src="assets/images/IdNNS.png" alt="Logo" class="h-8 object-contain"
                             onerror="this.style.display='none'">
                        <span class="text-white font-bold tracking-tight text-base hidden">IdNNS</span>
                    </div>
                    <span class="text-blue-300 text-xs font-semibold tracking-widest">IdNNS.org</span>
                </div>
                <!-- Card body -->
                <div class="px-10 py-10 text-left relative overflow-hidden">
                    <!-- Watermark icon -->
                    <svg class="absolute right-6 top-4 opacity-10 w-44 h-44" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="30" cy="30" r="12" fill="#6098f2"/>
                        <circle cx="70" cy="30" r="12" fill="#6098f2"/>
                        <circle cx="50" cy="70" r="12" fill="#6098f2"/>
                        <line x1="30" y1="30" x2="70" y2="30" stroke="#6098f2" stroke-width="4"/>
                        <line x1="30" y1="30" x2="50" y2="70" stroke="#6098f2" stroke-width="4"/>
                        <line x1="70" y1="30" x2="50" y2="70" stroke="#6098f2" stroke-width="4"/>
                    </svg>

                    <p class="text-xl font-bold tracking-wide text-white mb-1">FULL NAME</p>
                    <p class="text-xs font-bold uppercase tracking-widest text-blue-300 mb-8">Researcher</p>

                    <div class="border-t border-white/10 pt-5 flex items-end justify-between">
                        <div>
                            <p class="text-white/60 text-xs mb-1">Member &nbsp; 04 / 01 / 2026 – 04 / 01 / 2027</p>
                            <p class="text-white font-semibold text-sm tracking-wide">000-000-0000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-white/60 text-[10px] leading-snug">Prof. Dr. Teddy Mantoro, M.Sc.,<br>Ph.D., SMIEEE</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-6 text-blue-100/40 text-xs uppercase tracking-[0.3em] font-bold">
            Your official digital membership card
        </p>
    </div>
</section>


<!-- ─────────────────────────── MEMBERSHIP DETAILS ─────────────────────────── -->
<section id="details" class="py-24 px-6">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-start">

        <!-- Left: Info -->
        <div>
            <p class="text-blue-400 text-[10px] uppercase tracking-widest font-bold mb-4">Details</p>
            <h2 class="text-3xl md:text-4xl font-serif mb-10">Membership Details</h2>

            <div class="space-y-8">

                <!-- Duration -->
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 rounded-xl bg-blue-400/10 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="clock" class="w-4 h-4 text-blue-400"></i>
                    </div>
                    <div>
                        <h4 class="font-bold mb-1">Duration</h4>
                        <p class="text-blue-100/50 text-sm leading-relaxed font-light">
                            Annual membership valid for 12 months from the confirmed activation date. Renewable each year.
                        </p>
                    </div>
                </div>

                <!-- Eligibility -->
                <div class="flex items-start gap-5">
                    <div class="w-10 h-10 rounded-xl bg-blue-400/10 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="user-check" class="w-4 h-4 text-blue-400"></i>
                    </div>
                    <div>
                        <h4 class="font-bold mb-2">Eligibility</h4>
                        <ul class="text-blue-100/50 text-sm leading-relaxed font-light space-y-1">
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3 h-3 text-blue-400 flex-shrink-0"></i> Undergraduate, graduate, or doctoral students</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3 h-3 text-blue-400 flex-shrink-0"></i> Academics, lecturers, and professors</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3 h-3 text-blue-400 flex-shrink-0"></i> Industry professionals in AI, ML, or cybersecurity</li>
                            <li class="flex items-center gap-2"><i data-lucide="check" class="w-3 h-3 text-blue-400 flex-shrink-0"></i> Independent researchers and practitioners</li>
                        </ul>
                    </div>
                </div>

                <!-- Fee -->
                <!-- Combined Fee & Payment Info -->
                <div class="flex items-start gap-5">
                    <!-- Single Icon -->
                    <div class="w-10 h-10 rounded-xl bg-blue-400/10 flex items-center justify-center flex-shrink-0">
                        <i data-lucide="credit-card" class="w-4 h-4 text-blue-400"></i>
                    </div>
                    
                    <!-- Unified Content -->
                    <div class="space-y-6">
                        <!-- Membership Fee Description -->
                        <div>
                            <h4 class="font-bold mb-1 text-blue-100">Membership Fee</h4>
                            <p class="text-blue-100/50 text-sm leading-relaxed font-light">
                                Annual membership fee is set at <span class="font-bold text-blue-100">$2</span> for international members and <span class="font-bold text-blue-100">IDR 25,000</span> for locals.
                            </p>
                        </div>
                
                        <!-- Bank Transfer Details (Right Underneath) -->
                        <div class="text-sm leading-relaxed">
                            <h4 class="font-bold mb-2 text-blue-100">Bank Transfer Information</h4>
                            <div class="space-y-1 text-blue-100/50 font-light">
                                <p>Bank Name: <span class="font-bold text-blue-100">Bank Negara Indonesia (BNI)</span></p>
                                <p>Branch: <span class="font-bold text-blue-100">Cabang Sukabumi Kota, West Java, Indonesia</span></p>
                                <p>SWIFT Code: <span class="font-bold text-blue-100">BNINIDJASKM</span></p>
                                <p>Account Name: <span class="font-bold text-blue-100">Pasca Ilmu Komputer</span></p>
                                <p>Account Number: <span class="font-bold text-blue-100">871-246-828</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Steps -->
        <div>
            <p class="text-blue-400 text-[10px] uppercase tracking-widest font-bold mb-4">How to Join</p>
            <h2 class="text-3xl md:text-4xl font-serif mb-10">Registration Steps</h2>

            <div class="space-y-4">
                <?php
                $steps = [
                    ['num' => '01', 'icon' => 'user-plus',   'title' => 'Register',      'desc' => 'Fill out the online registration form at register.php with your personal and professional information.'],
                    ['num' => '02', 'icon' => 'credit-card', 'title' => 'Payment',       'desc' => 'Complete the annual membership fee payment via bank transfer or the available payment gateway.'],
                    ['num' => '03', 'icon' => 'mail-check',  'title' => 'Confirmation',  'desc' => 'Receive your official confirmation email and digital member card within 3 working days of verified payment.'],
                    ['num' => '04', 'icon' => 'star',        'title' => 'Welcome!',      'desc' => 'Access the IdNNS member community, journals, and conference benefits immediately after activation.'],
                ];
                foreach ($steps as $s): ?>
                <div class="flex gap-5 p-6 bg-navy-dark border border-white/5 rounded-2xl hover:border-blue-400/30 transition-colors">
                    <div class="flex-shrink-0">
                        <span class="text-blue-400/30 font-bold text-2xl leading-none"><?= $s['num']; ?></span>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-9 h-9 rounded-xl bg-blue-400/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="<?= $s['icon']; ?>" class="w-4 h-4 text-blue-400"></i>
                        </div>
                        <div>
                            <h4 class="font-bold mb-1"><?= $s['title']; ?></h4>
                            <p class="text-blue-100/50 text-sm leading-relaxed font-light"><?= $s['desc']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<!-- ─────────────────────────── FINAL CTA ─────────────────────────── -->
<section id="join" class="py-12 px-6">
    <div class="max-w-3xl mx-auto text-center">

        <!-- Decorative ring -->
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-blue-400/10 border border-blue-400/20 mb-8">
            <i data-lucide="zap" class="w-8 h-8 text-blue-400"></i>
        </div>

        <p class="text-blue-400 text-xs uppercase tracking-[0.4em] font-bold mb-6">Ready to Join?</p>
        <h2 class="text-4xl md:text-5xl font-serif leading-tight mb-6">
            Shape the Future of AI in Indonesia
        </h2>
        <p class="text-blue-100/50 text-lg font-light leading-relaxed mb-12">
            Your membership directly contributes to building Indonesia's premier neural network and AI research community.
            Don't miss the opportunity to be part of this growing movement.
        </p>

        <div class="flex flex-wrap justify-center gap-5">
            <a href="register.php"
               class="px-12 py-5 bg-white text-[#050a30] rounded-full text-xs font-bold uppercase tracking-widest hover:scale-105 transition-transform">
                Join Now
            </a>
            <a href="mailto:info@idnns.org"
               class="px-12 py-5 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white/5 transition-all flex items-center gap-2">
                <i data-lucide="mail" class="w-4 h-4"></i> Contact Us
            </a>
        </div>
    </div>
</section>


<!-- ─────────────────────────── FOOTER (identical to index.php) ─────────────────────────── -->
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

    /* Mobile menu toggle */
    const btn      = document.getElementById("mobile-menu-btn");
    const menu     = document.getElementById("mobile-menu");
    const iconMenu = document.getElementById("icon-menu");
    const iconX    = document.getElementById("icon-x");
    let isOpen = false;

    btn.addEventListener("click", () => {
        isOpen = !isOpen;
        menu.classList.toggle("open", isOpen);
        iconMenu.classList.toggle("hidden", isOpen);
        iconX.classList.toggle("hidden", !isOpen);
    });

    function closeMenu() {
        isOpen = false;
        menu.classList.remove("open");
        iconMenu.classList.remove("hidden");
        iconX.classList.add("hidden");
    }

    /* Show card fallback wrapper correctly */
    const cardImg = document.querySelector('.card-preview');
    if (cardImg && cardImg.tagName === 'IMG') {
        cardImg.addEventListener('error', () => {
            document.querySelector('.card-fallback').style.display = 'flex';
            cardImg.style.display = 'none';
        });
    }
</script>
</body>
</html>