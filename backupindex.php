<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IdNNS - Indonesian Neural Network Society</title>
    <link rel="icon" type="image/x-icon" sizes="32x32" href="assets/images/idnns.ico">
    <link rel="icon" type="image/x-icon" sizes="16x16" href="assets/images/idnns.ico">
    <link rel="apple-touch-icon" href="assets/images/idnns.ico">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- GSAP + ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <!-- Lenis Smooth Scroll -->
    <script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.42/bundled/lenis.min.js"></script>

    <style>
        :root {
            --navy: #00008c;
            --navy-deep: #000070;
            --navy-soft: rgba(255, 255, 255, 0.055);
            --line-soft: rgba(255, 255, 255, 0.10);
            --text-soft: rgba(219, 234, 254, 0.66);
            --blue-accent: #60a5fa;
            --yellow-accent: #facc15;
        }

        html {
            scroll-behavior: smooth;
        }

        html.lenis,
        html.lenis body {
            height: auto;
        }

        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }

        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }

        .lenis.lenis-stopped {
            overflow: hidden;
        }

        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(59, 130, 246, 0.24), transparent 32rem),
                radial-gradient(circle at 85% 18%, rgba(250, 204, 21, 0.08), transparent 24rem),
                linear-gradient(180deg, var(--navy) 0%, #00007a 45%, var(--navy-deep) 100%);
            color: white;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: -2;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 54px 54px;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,0.75), rgba(0,0,0,0.18));
        }

        .font-serif {
            font-family: 'Libre Baskerville', serif;
        }

        .bg-navy-dark {
            background-color: var(--navy);
        }

        .bg-navy-light {
            background-color: var(--navy-soft);
        }

        .text-accent-yellow {
            color: var(--yellow-accent);
            font-weight: 700;
        }

        .section-soft {
            background:
                linear-gradient(180deg, rgba(255,255,255,0.055), rgba(255,255,255,0.025)),
                radial-gradient(circle at 70% 10%, rgba(59, 130, 246, 0.14), transparent 30rem);
        }

        /* Scroll Progress Bar */
        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            z-index: 9999;
            transform: scaleX(0);
            transform-origin: left center;
            background: linear-gradient(90deg, rgba(96, 165, 250, 0.25), #60a5fa, rgba(250, 204, 21, 0.75));
            box-shadow: 0 0 18px rgba(96, 165, 250, 0.55);
            pointer-events: none;
        }

        .nav-shell {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.16);
            transition: background-color 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
        }

        .nav-shell.is-scrolled {
            background-color: rgba(0, 0, 112, 0.96);
            border-color: rgba(255, 255, 255, 0.14);
            box-shadow: 0 18px 60px rgba(0, 0, 0, 0.30);
        }

        .nav-row {
            transition: height 0.35s ease;
        }

        .nav-shell.is-scrolled .nav-row {
            height: 4.25rem;
        }

        .nav-logo {
            transition: transform 0.35s ease, width 0.35s ease;
        }

        .nav-shell.is-scrolled .nav-logo {
            width: 8rem;
            transform: translateY(-1px);
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -8px;
            height: 2px;
            transform: scaleX(0);
            transform-origin: center;
            background: linear-gradient(90deg, transparent, var(--blue-accent), transparent);
            transition: transform 0.35s ease;
        }

        .nav-link:hover::after,
        .nav-link.is-active::after {
            transform: scaleX(1);
        }

        .nav-link.is-active {
            opacity: 1;
            color: #ffffff;
            text-shadow: 0 0 18px rgba(96, 165, 250, 0.35);
        }

        .mobile-link.is-active {
            opacity: 1;
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.075);
        }

        .btn-primary,
        .btn-secondary,
        .btn-community {
            position: relative;
            overflow: hidden;
            transform: translateZ(0);
        }

        .btn-primary::before,
        .btn-secondary::before,
        .btn-community::before {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 90%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.26), transparent);
            transform: skewX(-22deg);
            transition: left 0.7s ease;
        }

        .btn-primary:hover::before,
        .btn-secondary:hover::before,
        .btn-community:hover::before {
            left: 130%;
        }

        .smooth-card {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            --spotlight-x: 50%;
            --spotlight-y: 50%;
            transition: transform 0.45s ease, border-color 0.45s ease, background-color 0.45s ease, box-shadow 0.45s ease;
        }

        .smooth-card > * {
            position: relative;
            z-index: 2;
        }

        .smooth-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(circle at top right, rgba(96, 165, 250, 0.16), transparent 36%);
            opacity: 0;
            transition: opacity 0.45s ease;
            z-index: 0;
        }

        .smooth-card::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(circle 220px at var(--spotlight-x) var(--spotlight-y), rgba(96, 165, 250, 0.20), rgba(250, 204, 21, 0.06) 36%, transparent 66%);
            opacity: 0;
            transition: opacity 0.35s ease;
            pointer-events: none;
            z-index: 1;
        }

        .smooth-card:hover {
            transform: translateY(-6px);
            border-color: rgba(96, 165, 250, 0.45);
            box-shadow: 0 22px 70px rgba(0, 0, 0, 0.24);
        }

        .smooth-card:hover::before,
        .smooth-card:hover::after {
            opacity: 1;
        }

        .icon-soft {
            filter: drop-shadow(0 8px 18px rgba(96, 165, 250, 0.20));
        }

        .hero-bg-grid {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
            background-size: 80px 80px;
            opacity: 0.40;
            mask-image: radial-gradient(circle at center, rgba(0,0,0,0.82), transparent 72%);
        }

        .hero-orb {
            position: absolute;
            border-radius: 9999px;
            filter: blur(40px);
            opacity: 0.55;
            pointer-events: none;
            will-change: transform;
        }

        .hero-orb-1 {
            width: 260px;
            height: 260px;
            top: 26px;
            left: 8%;
            background: rgba(59, 130, 246, 0.26);
        }

        .hero-orb-2 {
            width: 220px;
            height: 220px;
            right: 10%;
            bottom: 20px;
            background: rgba(250, 204, 21, 0.10);
        }

        .video-shell {
            box-shadow: 0 28px 90px rgba(0, 0, 0, 0.26), inset 0 1px 0 rgba(255,255,255,0.08);
        }

        .video-shell::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            border-radius: inherit;
            background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent 35%, rgba(96,165,250,0.12));
        }

        .stat-card {
            transition: transform 0.4s ease, background-color 0.4s ease, border-color 0.4s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background-color: rgba(255, 255, 255, 0.075);
            border-color: rgba(96, 165, 250, 0.35);
        }

        .count-up {
            display: inline-block;
            min-width: 3ch;
            font-variant-numeric: tabular-nums;
        }

        /* Mobile menu slide animation */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease, opacity 0.35s ease;
            opacity: 0;
        }

        #mobile-menu.open {
            max-height: 600px;
            opacity: 1;
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                animation-duration: 0.001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.001ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>
<body>

    <!-- Scroll Progress Bar -->
    <div id="scroll-progress" aria-hidden="true"></div>

    <!-- Navigation -->
    <nav class="nav-shell sticky top-0 z-50 bg-[#00008c]/90 backdrop-blur-xl border-b border-white/10">

        <!-- Navbar Row -->
        <div class="nav-row max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center flex-1">
                <img src="assets/images/idnnslogo1-removebg-preview.png" 
                     alt="IdNNS Logo"
                     class="nav-logo w-36 h-auto object-contain transition-transform duration-300 hover:scale-[1.03]"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                <span style="display:none" class="text-white font-bold text-xl tracking-tight">IdNNS</span>
            </div>
        
            <!-- Desktop Menu -->
            <div class="hidden lg:flex gap-8 flex-1 justify-center">
                <?php 
                $navItems = ['Home', 'About', 'Journals', 'Conferences', 'Membership', 'Contact'];
                foreach ($navItems as $item): ?>
                    <a href="<?php echo $item === 'Membership' ? 'membership.php' : '#' . strtolower($item); ?>"
                        class="nav-link text-sm uppercase tracking-widest font-bold opacity-60 hover:opacity-100 transition-opacity duration-300">
                        <?php echo $item; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        
            <!-- Right side: hamburger + join -->
            <div class="flex items-center gap-3 flex-1 justify-end">
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl hover:bg-white/10 transition-colors duration-300" aria-label="Toggle mobile menu">
                    <i data-lucide="menu" class="w-6 h-6" id="icon-menu"></i>
                    <i data-lucide="x" class="w-6 h-6 hidden" id="icon-x"></i>
                </button>
                <a href="register.php"
                   class="btn-secondary px-5 py-2 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-[#00008c] transition-all duration-300">
                    Join Now
                </a>
            </div>
        </div>

        <!-- Mobile Menu: OUTSIDE the flex row -->
        <div id="mobile-menu" class="lg:hidden border-t border-white/10 bg-[#00008c]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-1">
                <?php 
                $navItems = ['Home', 'About', 'Journals', 'Conferences', 'Membership', 'Contact'];
                foreach ($navItems as $item): ?>
                    <a href="<?php echo $item === 'Home' ? 'index.php' : ($item === 'Membership' ? 'membership.php' : '#' . strtolower($item)); ?>"
                       onclick="closeMenu()"
                       class="mobile-link text-sm uppercase tracking-widest font-bold opacity-70 hover:opacity-100 py-3 px-4 rounded-xl hover:bg-white/5 transition-all duration-300">
                        <?php echo $item; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative pt-16 pb-24 px-6 overflow-hidden">
        <div class="hero-bg-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>

        <div class="hero-content max-w-4xl mx-auto text-center relative z-10">
            <h2 class="hero-kicker text-blue-400 text-2xl font-bold mb-6">Welcome to IdNNS (Indonesian Artificial Neural Network Society)</h2>
            <h1 class="hero-title text-4xl md:text-6xl font-serif leading-tight mb-8">
                Advancing Neural Networks, Artificial Intelligence, and Intelligent Systems Research in Indonesia and Beyond.
            </h1>
            <p class="hero-copy text-accent-yellow text-lg leading-relaxed mb-12">
                As a society, IdNNS is considered as a non-profit organization. The society connects researchers, academics, industry leaders, and policymakers to accelerate AI-driven transformation in Indonesia and the Asia-Pacific region.
            </p>
            <div class="hero-actions w-full">
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 max-w-fit mx-auto">
                    <a href="membership.php" class="btn-primary inline-flex items-center justify-center min-w-[220px] px-10 py-4 bg-white text-[#00008c] rounded-full text-xs font-bold uppercase tracking-widest hover:scale-105 transition-transform duration-300 shadow-2xl shadow-blue-950/20">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Introduction Section -->
    <section id="about" class="pt-5 pb-24 px-6">
        <div class="max-w-5xl mx-auto">

            <!-- Label + heading -->
            <div class="text-center mb-12 reveal-up">
                <p class="text-blue-400 text-xs uppercase tracking-[0.4em] font-bold mb-4">Who We Are</p>
                <h2 class="text-3xl md:text-5xl font-serif leading-tight mb-4">
                    Get to Know IdNNS
                </h2>
                <p class="text-blue-100/50 text-base font-light max-w-xl mx-auto">
                    Watch a brief introduction to our society, our mission, and the community behind it.
                </p>
            </div>

            <!-- Video container -->
            <div class="video-shell reveal-up relative rounded-3xl overflow-hidden border border-white/10 bg-navy-light">
                <div class="aspect-video w-full">
                    <video
                        id="intro-video"
                        class="w-full h-full rounded-2xl"
                        controls
                        preload="metadata">
                        <source src="assets/IDNNS%20REVISI%202.mp4" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>
                </div>
                
                <!-- Overlay placeholder (tampil saat belum ada video) -->
                <div id="video-placeholder" class="absolute inset-0 flex flex-col items-center justify-center bg-[#00008c]/80 backdrop-blur-sm cursor-pointer group" onclick="playVideo()">
                    <div class="w-20 h-20 rounded-full bg-white/10 border border-white/20 flex items-center justify-center mb-4 group-hover:bg-blue-500/30 group-hover:border-blue-400 transition-all duration-300 group-hover:scale-105">
                        <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                    </div>
                    <p class="text-white font-bold text-lg">Watch Introduction</p>
                </div>
            </div>

            <!-- Stats bawah video -->
            <div class="mt-12 grid grid-cols-3 gap-3 text-center">
                <div class="stat-card stagger-item p-4 md:p-6 rounded-2xl bg-navy-light border border-white/5">
                    <p class="text-2xl md:text-3xl font-bold text-blue-400 mb-1"><span class="count-up" data-count="250" data-start="0" data-suffix="+">250+</span></p>
                    <p class="text-[9px] md:text-xs uppercase tracking-widest font-bold opacity-40">Members</p>
                </div>
                <div class="stat-card stagger-item p-4 md:p-6 rounded-2xl bg-navy-light border border-white/5">
                    <p class="text-2xl md:text-3xl font-bold text-blue-400 mb-1"><span class="count-up" data-count="4" data-start="0" data-suffix="">4</span></p>
                    <p class="text-[9px] md:text-xs uppercase tracking-widest font-bold opacity-40">Journals</p>
                </div>
                <div class="stat-card stagger-item p-4 md:p-6 rounded-2xl bg-navy-light border border-white/5">
                    <p class="text-2xl md:text-3xl font-bold text-blue-400 mb-1"><span class="count-up" data-count="2020" data-start="2000" data-suffix="">2020</span></p>
                    <p class="text-[9px] md:text-xs uppercase tracking-widest font-bold opacity-40">Est.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Journals & Conferences -->
    <section class="section-soft py-24 px-6 border-y border-white/5">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16">
            <!-- Journals -->
            <div id="journals" class="reveal-left">
                <div class="mb-12">
                    <h2 class="text-3xl font-serif mb-2">Journals</h2>
                    <p class="text-blue-400 text-[10px] uppercase tracking-widest font-bold">Publications</p>
                </div>
                <div class="space-y-4">
                    <?php 
                    $journals = [
                        ['abbr' => 'IJMLIS', 'full' => 'Indonesian Journal of Machine Learning and Intelligent Systems', 'url' => 'https://ijmlis.idnns.org'],
                        ['abbr' => 'IJCyber', 'full' => 'Indonesian Journal of Cybersecurity and Emerging Risks', 'url' => 'https://ijcyber.idnns.org'],
                        ['abbr' => 'IJCASI', 'full' => 'Indonesian Journal of Cyber-AI and Security Intelligence', 'url' => 'https://ijcasi.idnns.org'],
                        ['abbr' => 'JISCoDe', 'full' => 'Journal of Intelligent Systems for Community Development', 'url' => 'https://jiscode.idnns.org']
                    ];

                    foreach ($journals as $j): ?>

                    <a href="<?= $j['url']; ?>" target="_blank"
                       class="smooth-card journal-card flex items-center justify-between p-6 bg-navy-dark/90 border border-white/5 rounded-2xl cursor-pointer group">

                        <div class="flex items-center gap-4">
                            <i data-lucide="book-open" class="icon-soft w-5 h-5 text-blue-400 flex-shrink-0"></i>
                            <div>
                                <span class="text-lg font-bold block"><?= $j['abbr']; ?></span>
                                <span class="text-sm text-accent-yellow"><?= $j['full']; ?></span>
                            </div>
                        </div>

                        <i data-lucide="arrow-right"
                           class="w-5 h-5 opacity-0 -translate-x-2 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300 flex-shrink-0"></i>
                    </a>

                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Conferences -->
            <div id="conferences" class="reveal-right">
                <div class="mb-12">
                    <h2 class="text-3xl font-serif mb-2">Conferences</h2>
                    <p class="text-blue-400 text-[10px] uppercase tracking-widest font-bold">Events</p>
                </div>
                <div class="space-y-6">
                    <!-- Main conference card with both IConCIS and ICCED -->
                    <div class="smooth-card conference-card p-8 bg-white/5 border border-white/10 rounded-3xl">
                        <div class="flex items-center gap-3 text-neutral-400 mb-4">
                            <i data-lucide="calendar" class="icon-soft w-5 h-5 text-blue-400"></i>
                            <span class="text-[12px] font-bold uppercase tracking-widest">Upcoming Conference</span>
                        </div>
                        
            
                        <!-- IConCIS -->
                        <div class="mb-8">
                            <h3 class="text-1xl font-bold mb-1">
                                <a href="https://iconcis.idnns.org/" class="hover:underline underline-offset-4 decoration-blue-400/70">IConCIS 2026</a>
                            </h3>
                            <p class="text-sm text-accent-yellow mb-2">International Conference on Cybersecurity and Intelligent Systems</p>
                            <p class="text-blue-100/60">Jakarta, Indonesia  <br> December 3-4, 2026</p>
                        </div>
            
                        <!-- ICCED -->
                        <div>
                            <h3 class="text-1xl font-bold mb-1">
                                <a href="https://icced.nusaputra.ac.id/" class="hover:underline underline-offset-4 decoration-blue-400/70">ICCED 2026</a>
                            </h3>
                            <p class="text-sm text-accent-yellow mb-2">International Conference on Computing, Engineering, and Design</p>
                            <p class="text-blue-100/60">Buraimi, Oman <br> November 4-5, 2026</p>
                        </div>
                    </div>
            
                    <!-- Other Useful Links -->
                    <div class="smooth-card conference-card p-8 bg-white/5 border border-white/10 rounded-3xl">
                        <div class="flex items-center gap-3 text-neutral-400 mb-4">
                            <i data-lucide="link" class="icon-soft w-5 h-5 text-blue-400"></i>
                            <span class="text-[12px] font-bold uppercase tracking-widest">Other Useful Links</span>
                        </div>
            
                        <!-- Bootcamp -->
                        <div class="mb-2">
                            <h3 class="text-1xl font-bold mb-1">
                                <a href="https://aibc.idnns.org/" class="hover:underline underline-offset-4 decoration-blue-400/70">AIBC 2026</a>
                            </h3>
                            <p class="text-sm text-accent-yellow mb-2">ARTIFICIAL INTELLIGENCE & DEEP LEARNING BOOTCAMP 2026</p>
                            <p class="text-blue-100/60">Jakarta, Indonesia <br> July 5-9, 2026</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section id="community" class="py-32 px-6 relative overflow-hidden">
        <div class="hero-orb hero-orb-1 opacity-30"></div>
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center relative z-10">
            <div class="reveal-left">
                <h2 class="text-4xl font-serif mb-8">IdNNS Community</h2>
                <div class="flex items-center gap-4 mb-8">
                    <span class="text-5xl font-bold text-blue-400">250+</span>
                    <span class="text-[10px] uppercase tracking-widest font-bold text-accent-yellow">Active Members <br> Nationwide</span>
                </div>
                <p class="text-blue-100/60 text-lg font-light leading-relaxed mb-8">
                    Official WhatsApp Community Platform of IdNNS, designed to connect researchers, lecturers, students, and industry practitioners nationwide.
                </p>
                <ul class="space-y-4 mb-10">
                    <li class="community-list-item flex items-center gap-3 text-sm opacity-80"><i data-lucide="message-square" class="w-4 h-4 text-blue-400"></i> Official Announcement Channel</li>
                    <li class="community-list-item flex items-center gap-3 text-sm opacity-80"><i data-lucide="message-square" class="w-4 h-4 text-blue-400"></i> Research & Technical Discussion</li>
                    <li class="community-list-item flex items-center gap-3 text-sm opacity-80"><i data-lucide="message-square" class="w-4 h-4 text-blue-400"></i> Student & Early Researcher Forum</li>
                </ul>
                <button class="btn-community px-10 py-5 bg-green-600 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-green-500 transition-colors duration-300 shadow-2xl shadow-green-950/20">
                    Join the Official Community
                </button>
            </div>
            <div class="reveal-right smooth-card bg-navy-light border border-white/10 rounded-[40px] p-12">
                <h3 class="text-2xl font-bold mb-10 flex items-center gap-3">
                    <i data-lucide="shield" class="icon-soft w-6 h-6 text-blue-400"></i> Governance
                </h3>
                <div class="space-y-8">
                    <div class="governance-item">
                        <h4 class="font-bold mb-1">Moderated</h4>
                        <p class="text-sm opacity-40">Moderated by IdNNS Board Members</p>
                    </div>
                    <div class="governance-item">
                        <h4 class="font-bold mb-1">Professional</h4>
                        <p class="text-sm opacity-40">Academic and professional discussion only</p>
                    </div>
                    <div class="governance-item">
                        <h4 class="font-bold mb-1">Code of Conduct</h4>
                        <p class="text-sm opacity-40">Strictly enforced for all members</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="py-20 px-6 border-t border-white/5 text-center">
        <div class="max-w-7xl mx-auto reveal-up">
            <p class="text-[10px] uppercase tracking-[0.3em] font-bold opacity-20 mb-4">
                Indonesian Neural Network Society &copy; <?php echo date('Y'); ?>
            </p>
            <div class="flex justify-center gap-8 opacity-40">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@idnns.org" target="_blank" class="hover:opacity-100 transition-opacity duration-300" aria-label="Email IdNNS">
                    <i data-lucide="mail" class="w-5 h-5 cursor-pointer"></i>
                </a>
                <a href="https://idnns.org" target="_blank" class="hover:opacity-100 transition-opacity duration-300" aria-label="Visit IdNNS website">
                    <i data-lucide="globe" class="w-5 h-5 cursor-pointer"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function playVideo() {
            const placeholder = document.getElementById("video-placeholder");
            const video = document.getElementById("intro-video");

            if (window.gsap && !prefersReducedMotion) {
                gsap.to(placeholder, {
                    autoAlpha: 0,
                    scale: 1.02,
                    duration: 0.45,
                    ease: "power2.out",
                    onComplete: () => {
                        placeholder.style.display = "none";
                        video.play();
                    }
                });
            } else {
                placeholder.style.display = "none";
                video.play();
            }
        }

        lucide.createIcons();

        const btn = document.getElementById("mobile-menu-btn");
        const menu = document.getElementById("mobile-menu");
        const iconMenu = document.getElementById("icon-menu");
        const iconX = document.getElementById("icon-x");
        const mobileLinks = document.querySelectorAll(".mobile-link");
        const navShell = document.querySelector(".nav-shell");
        const scrollProgress = document.getElementById("scroll-progress");
        let isOpen = false;

        btn.addEventListener("click", () => {
            isOpen = !isOpen;
            menu.classList.toggle("open", isOpen);
            iconMenu.classList.toggle("hidden", isOpen);
            iconX.classList.toggle("hidden", !isOpen);

            if (window.gsap && isOpen && !prefersReducedMotion) {
                gsap.fromTo(mobileLinks,
                    { y: 8, autoAlpha: 0 },
                    { y: 0, autoAlpha: 1, duration: 0.28, stagger: 0.045, ease: "power2.out" }
                );
            }
        });

        function closeMenu() {
            isOpen = false;
            menu.classList.remove("open");
            iconMenu.classList.remove("hidden");
            iconX.classList.add("hidden");
        }

        function updateScrollProgress() {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? scrollTop / docHeight : 0;

            if (window.gsap && !prefersReducedMotion) {
                gsap.to(scrollProgress, {
                    scaleX: progress,
                    duration: 0.18,
                    ease: "power2.out",
                    overwrite: true
                });
            } else {
                scrollProgress.style.transform = `scaleX(${progress})`;
            }

            navShell.classList.toggle("is-scrolled", scrollTop > 18);
        }

        window.addEventListener("scroll", updateScrollProgress, { passive: true });
        window.addEventListener("resize", updateScrollProgress);
        updateScrollProgress();

        function initSpotlightCards() {
            const cards = document.querySelectorAll(".smooth-card");

            cards.forEach((card) => {
                card.addEventListener("pointermove", (event) => {
                    const rect = card.getBoundingClientRect();
                    const x = ((event.clientX - rect.left) / rect.width) * 100;
                    const y = ((event.clientY - rect.top) / rect.height) * 100;

                    card.style.setProperty("--spotlight-x", `${x}%`);
                    card.style.setProperty("--spotlight-y", `${y}%`);
                });
            });
        }

        initSpotlightCards();

        if (window.gsap && window.ScrollTrigger) {
            gsap.registerPlugin(ScrollTrigger);

            gsap.config({
                nullTargetWarn: false
            });

            if (window.Lenis && !prefersReducedMotion) {
                const lenis = new Lenis({
                    duration: 1.05,
                    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                    smoothWheel: true,
                    wheelMultiplier: 0.88,
                    touchMultiplier: 1.15,
                    infinite: false
                });

                lenis.on("scroll", () => {
                    ScrollTrigger.update();
                    updateScrollProgress();
                });

                gsap.ticker.add((time) => {
                    lenis.raf(time * 1000);
                });

                gsap.ticker.lagSmoothing(0);
            }

            const heroTimeline = gsap.timeline({ defaults: { ease: "power3.out" } });
            heroTimeline
                .from(".nav-shell", { y: -24, autoAlpha: 0, duration: 0.55 })
                .from(".hero-kicker", { y: 18, autoAlpha: 0, duration: 0.55 }, "-=0.20")
                .from(".hero-title", { y: 24, autoAlpha: 0, duration: 0.75 }, "-=0.22")
                .from(".hero-copy", { y: 18, autoAlpha: 0, duration: 0.65 }, "-=0.28")
                .from(".hero-actions a", { y: 14, autoAlpha: 0, duration: 0.50, stagger: 0.10 }, "-=0.24");

            gsap.to(".hero-orb-1", {
                scale: 1.08,
                opacity: 0.62,
                duration: 5.5,
                ease: "sine.inOut",
                repeat: -1,
                yoyo: true
            });

            gsap.to(".hero-orb-2", {
                scale: 1.06,
                opacity: 0.48,
                duration: 6.2,
                ease: "sine.inOut",
                repeat: -1,
                yoyo: true
            });

            gsap.to(".hero-bg-grid", {
                scrollTrigger: {
                    trigger: "#home",
                    start: "top top",
                    end: "bottom top",
                    scrub: 1.2
                },
                yPercent: 14,
                opacity: 0.18,
                ease: "none"
            });

            gsap.to(".hero-content", {
                scrollTrigger: {
                    trigger: "#home",
                    start: "top top",
                    end: "bottom top",
                    scrub: 1.1
                },
                y: -22,
                ease: "none"
            });

            gsap.to(".hero-orb-1", {
                scrollTrigger: {
                    trigger: "#home",
                    start: "top top",
                    end: "bottom top",
                    scrub: 1.3
                },
                y: 95,
                ease: "none"
            });

            gsap.to(".hero-orb-2", {
                scrollTrigger: {
                    trigger: "#home",
                    start: "top top",
                    end: "bottom top",
                    scrub: 1.3
                },
                y: 70,
                ease: "none"
            });

            const moveOrb1X = gsap.quickTo(".hero-orb-1", "x", { duration: 1.1, ease: "power3.out" });
            const moveOrb2X = gsap.quickTo(".hero-orb-2", "x", { duration: 1.2, ease: "power3.out" });
            const moveGridX = gsap.quickTo(".hero-bg-grid", "x", { duration: 1.4, ease: "power3.out" });
            const moveGridY = gsap.quickTo(".hero-bg-grid", "y", { duration: 1.4, ease: "power3.out" });
            const homeSection = document.getElementById("home");

            homeSection.addEventListener("mousemove", (event) => {
                const centerX = window.innerWidth / 2;
                const centerY = window.innerHeight / 2;
                const deltaX = (event.clientX - centerX) / centerX;
                const deltaY = (event.clientY - centerY) / centerY;

                moveOrb1X(deltaX * 16);
                moveOrb2X(deltaX * -14);
                moveGridX(deltaX * 8);
                moveGridY(deltaY * 6);
            });

            homeSection.addEventListener("mouseleave", () => {
                moveOrb1X(0);
                moveOrb2X(0);
                moveGridX(0);
                moveGridY(0);
            });

            gsap.utils.toArray(".reveal-up").forEach((item) => {
                gsap.from(item, {
                    scrollTrigger: {
                        trigger: item,
                        start: "top 82%",
                        toggleActions: "play none none reverse"
                    },
                    y: 34,
                    autoAlpha: 0,
                    duration: 0.75,
                    ease: "power3.out"
                });
            });

            gsap.utils.toArray(".reveal-left").forEach((item) => {
                gsap.from(item, {
                    scrollTrigger: {
                        trigger: item,
                        start: "top 82%",
                        toggleActions: "play none none reverse"
                    },
                    x: -34,
                    y: 14,
                    autoAlpha: 0,
                    duration: 0.75,
                    ease: "power3.out"
                });
            });

            gsap.utils.toArray(".reveal-right").forEach((item) => {
                gsap.from(item, {
                    scrollTrigger: {
                        trigger: item,
                        start: "top 82%",
                        toggleActions: "play none none reverse"
                    },
                    x: 34,
                    y: 14,
                    autoAlpha: 0,
                    duration: 0.75,
                    ease: "power3.out"
                });
            });

            ScrollTrigger.batch(".stagger-item", {
                start: "top 86%",
                onEnter: (batch) => gsap.fromTo(batch,
                    { y: 24, autoAlpha: 0 },
                    { y: 0, autoAlpha: 1, duration: 0.55, stagger: 0.10, ease: "power3.out" }
                ),
                onLeaveBack: (batch) => gsap.to(batch, {
                    y: 24,
                    autoAlpha: 0,
                    duration: 0.35,
                    stagger: 0.04,
                    ease: "power2.inOut"
                })
            });

            ScrollTrigger.batch(".journal-card", {
                start: "top 86%",
                onEnter: (batch) => gsap.fromTo(batch,
                    { y: 26, autoAlpha: 0 },
                    { y: 0, autoAlpha: 1, duration: 0.58, stagger: 0.09, ease: "power3.out" }
                )
            });

            ScrollTrigger.batch(".conference-card", {
                start: "top 86%",
                onEnter: (batch) => gsap.fromTo(batch,
                    { y: 26, autoAlpha: 0 },
                    { y: 0, autoAlpha: 1, duration: 0.58, stagger: 0.10, ease: "power3.out" }
                )
            });

            ScrollTrigger.batch(".community-list-item", {
                start: "top 88%",
                onEnter: (batch) => gsap.fromTo(batch,
                    { x: -14, autoAlpha: 0 },
                    { x: 0, autoAlpha: 1, duration: 0.42, stagger: 0.08, ease: "power2.out" }
                )
            });

            ScrollTrigger.batch(".governance-item", {
                start: "top 88%",
                onEnter: (batch) => gsap.fromTo(batch,
                    { y: 14, autoAlpha: 0 },
                    { y: 0, autoAlpha: 1, duration: 0.45, stagger: 0.08, ease: "power2.out" }
                )
            });

            const countItems = document.querySelectorAll(".count-up");
            countItems.forEach((item) => {
                const target = Number(item.dataset.count || 0);
                const start = Number(item.dataset.start || 0);
                const suffix = item.dataset.suffix || "";
                const counter = { value: start };

                ScrollTrigger.create({
                    trigger: item,
                    start: "top 88%",
                    once: true,
                    onEnter: () => {
                        gsap.fromTo(counter,
                            { value: start },
                            {
                                value: target,
                                duration: target === 2020 ? 1.15 : 1.35,
                                ease: "power2.out",
                                onUpdate: () => {
                                    item.textContent = `${Math.round(counter.value)}${suffix}`;
                                },
                                onComplete: () => {
                                    item.textContent = `${target}${suffix}`;
                                }
                            }
                        );
                    }
                });
            });

            const navLinks = document.querySelectorAll(".nav-link[href^='#'], .mobile-link[href^='#']");
            const sectionIds = ["home", "about", "journals", "conferences", "contact"];

            function setActiveNav(sectionId) {
                navLinks.forEach((link) => {
                    const href = link.getAttribute("href");
                    const isJournalConferenceArea = sectionId === "journals" || sectionId === "conferences";
                    const isCurrent = href === `#${sectionId}` || (isJournalConferenceArea && (href === "#journals" || href === "#conferences"));

                    link.classList.toggle("is-active", isCurrent);

                    if (isCurrent) {
                        link.setAttribute("aria-current", "page");
                    } else {
                        link.removeAttribute("aria-current");
                    }
                });
            }

            navLinks.forEach((link) => {
                link.addEventListener("click", () => {
                    const targetId = link.getAttribute("href").replace("#", "");
                    if (targetId) setActiveNav(targetId);
                });
            });

            sectionIds.forEach((sectionId) => {
                const section = document.getElementById(sectionId);
                if (!section) return;

                ScrollTrigger.create({
                    trigger: section,
                    start: "top 52%",
                    end: "bottom 52%",
                    onEnter: () => setActiveNav(sectionId),
                    onEnterBack: () => setActiveNav(sectionId)
                });
            });

            setActiveNav("home");
        }
    </script>
</body>
</html>
