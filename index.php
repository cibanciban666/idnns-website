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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* ── Design tokens — single source of truth for colours ── */
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
        .font-serif {
            font-family: 'Libre Baskerville', serif;
        }
        .bg-navy-dark  { background-color: var(--navy); }
        .bg-navy-light { background-color: var(--navy-soft); }

        /* Hero section gradient */
        #home {
            background: linear-gradient(160deg, var(--navy) 0%, var(--navy-deep) 100%);
            position: relative; /* needed for ::after pseudo-element */
        }

        /* Smooth fade-out at the bottom of the hero so the transition
           into the "Who We Are" section (body bg = --navy) is gradual,
           not a hard colour-shift at the section boundary. */
        #home::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 140px;
            background: linear-gradient(to bottom, transparent, var(--navy));
            pointer-events: none;
            z-index: 1;
        }

        /* Reveal animation — override interactions.js defaults for this page only.
           duration is set per-element via data-duration; easing overridden here. */
        .reveal {
            transition-timing-function: cubic-bezier(0.16, 1, 0.3, 1) !important;
        }

        /* Nav initial state — slightly transparent, overrides Tailwind */
        nav {
            background-color: color-mix(in srgb, var(--navy) 90%, transparent) !important;
            transition: background-color 0.5s ease, box-shadow 0.35s ease;
        }
        /* Nav scrolled state — more opaque, deeper colour, shadow */
        nav.is-scrolled {
            background-color: color-mix(in srgb, var(--navy-deep) 97%, transparent) !important;
            box-shadow: 0 4px 28px rgba(0, 0, 0, 0.40);
        }
        /* Mobile menu matches nav colour */
        #mobile-menu {
            background-color: var(--navy) !important;
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
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-[#000064]/95 backdrop-blur-md border-b border-white/10">

        <!-- Navbar Row -->
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
                foreach ($navItems as $item): ?>
                    <a href="<?php echo $item === 'Membership' ? 'membership.php' : '#' . strtolower($item); ?>"
                        class="text-sm uppercase tracking-widest font-bold opacity-60 hover:opacity-100 transition-opacity">
                        <?php echo $item; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        
            <!-- Right side: hamburger + join -->
            <div class="flex items-center gap-3 flex-1 justify-end">
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl hover:bg-white/10 transition-colors">
                    <i data-lucide="menu" class="w-6 h-6" id="icon-menu"></i>
                    <i data-lucide="x" class="w-6 h-6 hidden" id="icon-x"></i>
                </button>
                <a href="register.php"
                   class="px-5 py-2 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white hover:text-[#000064] transition-all">
                    Join Now
                </a>
            </div>
        </div>

        <!-- Mobile Menu: OUTSIDE the flex row -->
        <div id="mobile-menu" class="lg:hidden border-t border-white/10 bg-[#000064]">
            <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-1">
                <?php 
                $navItems = ['Home', 'About', 'Journals', 'Conferences', 'Membership', 'Contact'];
                foreach ($navItems as $item): ?>
                    <a href="<?php echo $item === 'Home' ? 'index.php' : ($item === 'Membership' ? 'membership.php' : '#' . strtolower($item)); ?>"
                       onclick="closeMenu()"
                       class="text-sm uppercase tracking-widest font-bold opacity-70 hover:opacity-100 py-3 px-4 rounded-xl hover:bg-white/5 transition-all">
                        <?php echo $item; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative pt-16 pb-24 px-6 reveal" data-duration="900">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-blue-400 text-2xl font-bold mb-6">Welcome to IdNNS (Indonesian Artificial Neural Network Society)</h2>
            <h1 class="text-4xl md:text-6xl font-serif leading-tight mb-8">
                Advancing Neural Networks, Artificial Intelligence, and Intelligent Systems Research in Indonesia and Beyond.
            </h1>
            <p class="text-blue-100/60 text-lg font-light leading-relaxed mb-12">
                As a society, IdNNS is considered as a non-profit organization. The society connects researchers, academics, industry leaders, and policymakers to accelerate AI-driven transformation in Indonesia and the Asia-Pacific region.
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="membership.php" class="px-10 py-4 bg-white text-[#000064] rounded-full text-xs font-bold uppercase tracking-widest hover:scale-105 transition-transform">
                    Get Started
                </a>
                <a href="#about" class="px-10 py-4 border border-white/20 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-white/5 transition-all">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Video Introduction Section -->
    <section id="about" class="pt-5 pb-24 px-6 reveal" data-duration="900">
        <div class="max-w-5xl mx-auto">

            <!-- Label + heading -->
            <div class="text-center mb-12">
                <p class="text-blue-400 text-xs uppercase tracking-[0.4em] font-bold mb-4">Who We Are</p>
                <h2 class="text-3xl md:text-5xl font-serif leading-tight mb-4">
                    Get to Know IdNNS
                </h2>
                <p class="text-blue-100/50 text-base font-light max-w-xl mx-auto">
                    Watch a brief introduction to our society, our mission, and the community behind it.
                </p>
            </div>

            <!-- Video container -->
            <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-2xl shadow-blue-900/30 bg-navy-light">

                
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
                <div id="video-placeholder" class="absolute inset-0 flex flex-col items-center justify-center bg-[#000064]/80 backdrop-blur-sm cursor-pointer group" onclick="playVideo()">
                    <div class="w-20 h-20 rounded-full bg-white/10 border border-white/20 flex items-center justify-center mb-4 group-hover:bg-blue-500/30 group-hover:border-blue-400 transition-all duration-300">
                        <i data-lucide="play" class="w-8 h-8 text-white ml-1"></i>
                    </div>
                    <p class="text-white font-bold text-lg">Watch Introduction</p>
                </div>
            </div>

            <!-- Stats bawah video -->
            <div class="mt-12 grid grid-cols-3 gap-3 text-center">
                <div class="p-4 md:p-6 rounded-2xl bg-navy-light border border-white/5">
                    <p class="text-2xl md:text-3xl font-bold text-blue-400 mb-1" data-count="250" data-suffix="+">250+</p>
                    <p class="text-[9px] md:text-xs uppercase tracking-widest font-bold opacity-40">Members</p>
                </div>
                <div class="p-4 md:p-6 rounded-2xl bg-navy-light border border-white/5">
                    <p class="text-2xl md:text-3xl font-bold text-blue-400 mb-1" data-count="3">3</p>
                    <p class="text-[9px] md:text-xs uppercase tracking-widest font-bold opacity-40">Journals</p>
                </div>
                <div class="p-4 md:p-6 rounded-2xl bg-navy-light border border-white/5">
                    <p class="text-2xl md:text-3xl font-bold text-blue-400 mb-1" data-count="2020" data-start="2000">2020</p>
                    <p class="text-[9px] md:text-xs uppercase tracking-widest font-bold opacity-40">Est.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Journals & Conferences -->
    <section class="py-24 px-6 bg-navy-light reveal" data-duration="900">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16">
            <!-- Journals -->
            <div id="journals">
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
                       class="flex items-center justify-between p-6 bg-navy-dark border border-white/5 rounded-2xl hover:border-blue-400/50 transition-all cursor-pointer group">

                        <div class="flex items-center gap-4">
                            <i data-lucide="book-open" class="w-5 h-5 text-blue-400 flex-shrink-0"></i>
                            <div>
                                <span class="text-lg font-bold block"><?= $j['abbr']; ?></span>
                                <span class="text-sm font-medium" style="color: #facc15;"><?= $j['full']; ?></span>
                            </div>
                        </div>

                        <i data-lucide="arrow-right"
                           class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-all flex-shrink-0"></i>
                    </a>

                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Conferences -->
            <div id="conferences">
                <div class="mb-12">
                    <h2 class="text-3xl font-serif mb-2">Conferences</h2>
                    <p class="text-blue-400 text-[10px] uppercase tracking-widest font-bold">Events</p>
                </div>
                <div class="space-y-6">
                    <!-- Main conference card with both IConCIS and ICCED -->
                    <div class="p-8 bg-white/5 border border-white/10 rounded-3xl">
                        <div class="flex items-center gap-3 text-neutral-400 mb-4">
                            <i data-lucide="calendar" class="w-5 h-5 text-blue-400"></i>
                            <span class="text-[12px] font-bold uppercase tracking-widest">Upcoming Conference</span>
                        </div>
                        
            
                        <!-- IConCIS -->
                        <div class="mb-8">
                            <h3 class="text-1xl font-bold mb-1">
                                <a href="https://iconcis.idnns.org/" class="hover:underline">IConCIS 2026</a>
                            </h3>
                            <p class="text-sm font-medium mb-2" style="color: #facc15;">International Conference on Cybersecurity and Intelligent Systems</p>
                            <p class="text-blue-100/60">Jakarta, Indonesia  <br> November 4-5, 2026</p>
                        </div>
            
                        <!-- ICCED -->
                        <div>
                            <h3 class="text-1xl font-bold mb-1">
                                <a href="https://icced.nusaputra.ac.id/" class="hover:underline">ICCED 2026</a>
                            </h3>
                            <p class="text-sm font-medium mb-2" style="color: #facc15;">International Conference on Computing, Engineering, and Design</p>
                            <p class="text-blue-100/60">Buraimi, Oman <br> December 3-4, 2026</p>
                        </div>
                    </div>
            
                    <!-- Other Useful Links -->
                    <div class="p-8 bg-white/5 border border-white/10 rounded-3xl">
                        <div class="flex items-center gap-3 text-neutral-400 mb-4">
                            <i data-lucide="link" class="w-5 h-5 text-blue-400"></i>
                            <span class="text-[12px] font-bold uppercase tracking-widest">Other Useful Links</span>
                        </div>
            
                        <!-- Bootcamp -->
                        <div class="mb-2"> <h3 class="text-1xl font-bold mb-1">
                            <a href="https://aibc.idnns.org/" class="hover:underline">AIBC 2026</a>
                            </h3>
                            <p class="text-sm font-medium mb-2" style="color: #facc15;">ARTIFICIAL INTELLIGENCE & DEEP LEARNING BOOTCAMP 2026</p>
                            <p class="text-blue-100/60">Jakarta, Indonesia <br> July 5-9, 2026</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Section -->
    <section id="community" class="py-32 px-6 reveal" data-duration="900">
        <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="text-4xl font-serif mb-8">IdNNS Community</h2>
                <div class="flex items-center gap-4 mb-8">
                    <span class="text-5xl font-bold text-blue-400">250+</span>
                    <span class="text-[10px] uppercase tracking-widest font-bold opacity-60">Active Members <br> Nationwide</span>
                </div>
                <p class="text-blue-100/60 text-lg font-light leading-relaxed mb-8">
                    Official WhatsApp Community Platform of IdNNS, designed to connect researchers, lecturers, students, and industry practitioners nationwide.
                </p>
                <ul class="space-y-4 mb-10">
                    <li class="flex items-center gap-3 text-sm opacity-80"><i data-lucide="message-square" class="w-4 h-4 text-blue-400"></i> Official Announcement Channel</li>
                    <li class="flex items-center gap-3 text-sm opacity-80"><i data-lucide="message-square" class="w-4 h-4 text-blue-400"></i> Research & Technical Discussion</li>
                    <li class="flex items-center gap-3 text-sm opacity-80"><i data-lucide="message-square" class="w-4 h-4 text-blue-400"></i> Student & Early Researcher Forum</li>
                </ul>
                <button class="px-10 py-5 bg-green-600 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-green-500 transition-colors">
                    Join the Official Community
                </button>
                <p class="text-sm text-white opacity-80 mt-6">Kemenkumham RI No: AHU-0004309.AH.01.07 Tahun 2026</p>
            </div> 
            <div class="bg-navy-light border border-white/10 rounded-[40px] p-12">
                <h3 class="text-2xl font-bold mb-10 flex items-center gap-3">
                    <i data-lucide="shield" class="w-6 h-6 text-blue-400"></i> Governance
                </h3>
                <div class="space-y-8">
                    <div>
                        <h4 class="font-bold mb-1">Moderated</h4>
                        <p class="text-sm opacity-40">Moderated by IdNNS Board Members</p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-1">Professional</h4>
                        <p class="text-sm opacity-40">Academic and professional discussion only</p>
                    </div>
                    <div>
                        <h4 class="font-bold mb-1">Code of Conduct</h4>
                        <p class="text-sm opacity-40">Strictly enforced for all members</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
        function playVideo() {
            const placeholder = document.getElementById("video-placeholder");
            const video = document.getElementById("intro-video");
    
            placeholder.style.display = "none";
            video.play();
        }

        lucide.createIcons();

        const btn = document.getElementById("mobile-menu-btn");
        const menu = document.getElementById("mobile-menu");
        const iconMenu = document.getElementById("icon-menu");
        const iconX = document.getElementById("icon-x");
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
    </script>
    <script src="assets/js/interactions.js"></script>
</body>
</html>