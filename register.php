<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – IdNNS</title>
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

        /* Mobile menu */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease, opacity 0.35s ease;
            opacity: 0;
        }
        #mobile-menu.open { max-height: 600px; opacity: 1; }

        /* Field label */
        .field-label {
            display: block;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.45);
            margin-bottom: 0.5rem;
        }

        /* Input / select shared style */
        .field-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.75rem;
            padding: 0.85rem 1rem;
            color: white;
            font-size: 0.875rem;
            outline: none;
            transition: border-color 0.2s ease, background 0.2s ease;
            appearance: none;
            -webkit-appearance: none;
        }
        .field-input::placeholder { color: rgba(255,255,255,0.25); }
        .field-input:focus {
            border-color: rgba(96,165,250,0.6);
            background: rgba(96,165,250,0.06);
        }
        .field-input option { background: #07114a; color: white; }

        /* File upload zone */
        .upload-zone {
            border: 1px dashed rgba(255,255,255,0.15);
            border-radius: 0.75rem;
            padding: 2rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s ease, background 0.2s ease;
            background: rgba(255,255,255,0.03);
        }
        .upload-zone:hover,
        .upload-zone.drag-over {
            border-color: rgba(96,165,250,0.5);
            background: rgba(96,165,250,0.05);
        }
        #payment_proof { display: none; }

        /* Hero glow */
        .hero-glow {
            background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(59,130,246,0.12) 0%, transparent 70%);
        }

        /* Submit button */
        .btn-submit { transition: transform 0.2s ease; }
        .btn-submit:hover  { transform: scale(1.03); }
        .btn-submit:active { transform: scale(0.98); }

        /* ── Custom Dropdown ── */
        .custom-dropdown { position: relative; }

        .dropdown-trigger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            text-align: left;
            user-select: none;
            -webkit-user-select: none;
        }
        .dropdown-trigger .dd-label { flex: 1; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .dropdown-trigger .dd-chevron { flex-shrink: 0; width: 1rem; height: 1rem; color: rgba(255,255,255,0.40); transition: transform 0.2s ease; }
        .custom-dropdown.open .dd-chevron { transform: rotate(180deg); }
        .dropdown-trigger.dd-placeholder .dd-label { color: rgba(255,255,255,0.25); }

        .dropdown-list {
            display: none;
            position: absolute;
            top: calc(100% + 6px);
            left: 0; right: 0;
            z-index: 300;
            background: var(--navy-deep, #000070);
            border: 1px solid var(--line-soft, rgba(255,255,255,0.10));
            border-radius: 0.75rem;
            max-height: 220px;
            overflow-y: auto;
            padding: 0.35rem 0;
            box-shadow: 0 12px 32px rgba(0,0,0,0.55);
        }
        .custom-dropdown.open .dropdown-list { display: block; }

        .dropdown-item {
            padding: 0.65rem 1rem;
            font-size: 0.875rem;
            color: rgba(255,255,255,0.88);
            cursor: pointer;
            transition: background 0.12s ease, color 0.12s ease;
        }
        .dropdown-item:hover { background: rgba(96,165,250,0.14); color: #fff; }
        .dropdown-item.dd-selected { color: var(--blue-accent, #60a5fa); }

        /* Custom scrollbar */
        .dropdown-list::-webkit-scrollbar { width: 5px; }
        .dropdown-list::-webkit-scrollbar-track { background: transparent; }
        .dropdown-list::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.14); border-radius: 9999px; }
        .dropdown-list::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.28); }
    </style>
</head>
<body>

<!-- ───────────────────── NAVIGATION ───────────────────── -->
<nav class="sticky top-0 z-50 bg-[#000064]/95 backdrop-blur-md border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

        <div class="flex items-center flex-1">
            <img src="assets/images/idnnslogo1-removebg-preview.png" alt="IdNNS Logo" class="w-36 h-auto object-contain"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
            <span style="display:none" class="text-white font-bold text-xl tracking-tight">IdNNS</span>
        </div>

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
                   class="text-sm uppercase tracking-widest font-bold opacity-60 hover:opacity-100 transition-opacity">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="flex items-center gap-3 flex-1 justify-end">
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-xl hover:bg-white/10 transition-colors">
                <i data-lucide="menu" class="w-6 h-6" id="icon-menu"></i>
                <i data-lucide="x"    class="w-6 h-6 hidden" id="icon-x"></i>
            </button>
            <a href="register.php"
               class="px-5 py-2 bg-white text-[#000064] rounded-full text-xs font-bold uppercase tracking-widest hover:scale-105 transition-transform">
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


<!-- ───────────────────── HERO ───────────────────── -->
<section class="relative pt-16 pb-10 px-6 hero-glow reveal">
    <div class="max-w-2xl mx-auto text-center">
        <p class="text-blue-400 text-xs uppercase tracking-[0.4em] font-bold mb-4">Membership Registration</p>
        <h1 class="text-3xl md:text-5xl font-serif leading-tight mb-4">Join IdNNS</h1>
        <p class="text-blue-100/50 text-base font-light leading-relaxed">
            Complete the form below to become an official member of the Indonesian Neural Network Society.
        </p>
    </div>
</section>


<!-- ───────────────────── FORM ───────────────────── -->
<section class="py-12 px-6 pb-28 reveal reveal-up" data-delay="80">
    <div class="max-w-2xl mx-auto">

        <div class="bg-navy-light border border-white/10 rounded-3xl p-8 md:p-10">

            <form action="process_register.php" method="POST" enctype="multipart/form-data" id="register-form" novalidate>

                <!-- First + Last Name -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label for="first_name" class="field-label">First Name <span class="text-blue-400">*</span></label>
                        <input type="text" id="first_name" name="first_name" class="field-input" placeholder="e.g. John" required>
                        <p class="hidden mt-1.5 text-red-400 text-xs" id="err-first_name">Please enter your first name.</p>
                    </div>
                    <div>
                        <label for="last_name" class="field-label">Last Name <span class="text-blue-400">*</span></label>
                        <input type="text" id="last_name" name="last_name" class="field-input" placeholder="e.g. Doe" required>
                        <p class="hidden mt-1.5 text-red-400 text-xs" id="err-last_name">Please enter your last name.</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="field-label">Email Address <span class="text-blue-400">*</span></label>
                    <input type="email" id="email" name="email" class="field-input" placeholder="you@example.com" required>
                    <p class="hidden mt-1.5 text-red-400 text-xs" id="err-email">Please enter a valid email address.</p>
                </div>

                <!-- Country -->
                <div class="mb-6">
                    <label class="field-label">Country <span class="text-blue-400">*</span></label>
                    <div class="custom-dropdown" id="dropdown-country">
                        <button type="button" id="country-trigger" class="dropdown-trigger field-input dd-placeholder"
                                aria-haspopup="listbox" aria-expanded="false">
                            <span class="dd-label">Select your country</span>
                            <svg class="dd-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <input type="hidden" id="country" name="country">
                        <div class="dropdown-list" role="listbox">
                            <div class="dropdown-item" data-value="Australia">Australia</div>
                            <div class="dropdown-item" data-value="Bangladesh">Bangladesh</div>
                            <div class="dropdown-item" data-value="Brunei">Brunei</div>
                            <div class="dropdown-item" data-value="Canada">Canada</div>
                            <div class="dropdown-item" data-value="China">China</div>
                            <div class="dropdown-item" data-value="France">France</div>
                            <div class="dropdown-item" data-value="Germany">Germany</div>
                            <div class="dropdown-item" data-value="India">India</div>
                            <div class="dropdown-item" data-value="Indonesia">Indonesia</div>
                            <div class="dropdown-item" data-value="Japan">Japan</div>
                            <div class="dropdown-item" data-value="Malaysia">Malaysia</div>
                            <div class="dropdown-item" data-value="Myanmar">Myanmar</div>
                            <div class="dropdown-item" data-value="Netherlands">Netherlands</div>
                            <div class="dropdown-item" data-value="Oman">Oman</div>
                            <div class="dropdown-item" data-value="Pakistan">Pakistan</div>
                            <div class="dropdown-item" data-value="Philippines">Philippines</div>
                            <div class="dropdown-item" data-value="Saudi Arabia">Saudi Arabia</div>
                            <div class="dropdown-item" data-value="Singapore">Singapore</div>
                            <div class="dropdown-item" data-value="South Korea">South Korea</div>
                            <div class="dropdown-item" data-value="Thailand">Thailand</div>
                            <div class="dropdown-item" data-value="United Arab Emirates">United Arab Emirates</div>
                            <div class="dropdown-item" data-value="United Kingdom">United Kingdom</div>
                            <div class="dropdown-item" data-value="United States">United States</div>
                            <div class="dropdown-item" data-value="Vietnam">Vietnam</div>
                            <div class="dropdown-item" data-value="Other">Other</div>
                        </div>
                    </div>
                    <p class="hidden mt-1.5 text-red-400 text-xs" id="err-country">Please select your country.</p>

                    <!-- Shown only when "Other" is selected -->
                    <div id="country-other-wrap" class="hidden mt-3">
                        <input type="text" id="country_other" name="country_other" class="field-input" placeholder="Type your country name...">
                        <p class="hidden mt-1.5 text-red-400 text-xs" id="err-country_other">Please type your country.</p>
                    </div>
                </div>

                <!-- Membership Category -->
                <div class="mb-6">
                    <label class="field-label">Membership Category <span class="text-blue-400">*</span></label>
                    <div class="custom-dropdown" id="dropdown-category">
                        <button type="button" id="category-trigger" class="dropdown-trigger field-input dd-placeholder"
                                aria-haspopup="listbox" aria-expanded="false">
                            <span class="dd-label">Select a category</span>
                            <svg class="dd-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <input type="hidden" id="category" name="category">
                        <div class="dropdown-list" role="listbox">
                            <div class="dropdown-item" data-value="General Public">General Public</div>
                            <div class="dropdown-item" data-value="Lecturer">Lecturer</div>
                            <div class="dropdown-item" data-value="Professional">Professional</div>
                            <div class="dropdown-item" data-value="Student">Student</div>
                        </div>
                    </div>
                    <p class="hidden mt-1.5 text-red-400 text-xs" id="err-category">Please select a membership category.</p>
                </div>

                <!-- Payment Proof -->
                <div class="mb-8">
                    <label class="field-label">Payment Proof <span class="text-blue-400">*</span></label>
                    <div class="upload-zone" id="upload-zone" onclick="document.getElementById('payment_proof').click()">
                        <i data-lucide="upload-cloud" class="w-8 h-8 text-blue-400/60 mx-auto mb-3"></i>
                        <p class="text-sm text-white/50 mb-1">Click to upload or drag & drop</p>
                        <p class="text-[10px] uppercase tracking-widest text-white/25 font-bold">JPG · JPEG · PNG · PDF — max 5 MB</p>
                        <p id="file-name" class="mt-3 text-xs text-blue-400 font-semibold hidden"></p>
                    </div>
                    <input type="file" id="payment_proof" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required>
                    <p class="hidden mt-1.5 text-red-400 text-xs" id="err-payment_proof"></p>
                </div>

                <div class="border-t border-white/5 mb-8"></div>

                <button type="submit" class="btn-submit w-full py-4 bg-white text-[#000064] rounded-full text-xs font-bold uppercase tracking-widest">
                    Register
                </button>

                <p class="mt-4 text-center text-blue-100/30 text-xs">
                    Already a member?
                    <a href="membership.php" class="text-blue-400 underline underline-offset-2 hover:text-blue-300 transition-colors">Back to membership page</a>
                </p>

            </form>
        </div>

        <!-- Info note -->
        <div class="mt-6 flex items-start gap-3 px-2">
            <i data-lucide="info" class="w-4 h-4 text-blue-400/60 flex-shrink-0 mt-0.5"></i>
            <p class="text-blue-100/30 text-xs leading-relaxed font-light">
                After submitting, our team will verify your payment and send a confirmation email within
                <strong class="text-white/50">3 working days</strong>.
                For questions, contact <a href="mailto:info@idnns.org" class="text-blue-400 underline underline-offset-2">info@idnns.org</a>.
            </p>
        </div>
    </div>
</section>


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

    /* ── Mobile menu ── */
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

    /* ── Custom Dropdown logic ── */
    function initCustomDropdown(wrapperId, triggerId, hiddenId, placeholder) {
        const wrapper  = document.getElementById(wrapperId);
        const trigger  = document.getElementById(triggerId);
        const hidden   = document.getElementById(hiddenId);
        const list     = wrapper.querySelector('.dropdown-list');
        const label    = trigger.querySelector('.dd-label');

        function openDropdown() {
            wrapper.classList.add('open');
            trigger.setAttribute('aria-expanded', 'true');
        }
        function closeDropdown() {
            wrapper.classList.remove('open');
            trigger.setAttribute('aria-expanded', 'false');
        }

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            wrapper.classList.contains('open') ? closeDropdown() : openDropdown();
        });

        list.addEventListener('click', (e) => {
            const item = e.target.closest('.dropdown-item');
            if (!item) return;
            const val = item.dataset.value;

            /* Update hidden input and fire change so listeners pick it up */
            hidden.value = val;
            hidden.dispatchEvent(new Event('change', { bubbles: true }));

            /* Update trigger label */
            label.textContent = val;
            trigger.classList.remove('dd-placeholder');

            /* Mark selected item */
            list.querySelectorAll('.dropdown-item').forEach(i => i.classList.remove('dd-selected'));
            item.classList.add('dd-selected');

            closeDropdown();
        });

        /* Close on outside click / touch */
        document.addEventListener('click', (e) => {
            if (!wrapper.contains(e.target)) closeDropdown();
        });

        /* Close on Escape */
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeDropdown();
        });
    }

    initCustomDropdown('dropdown-country',  'country-trigger',  'country',  'Select your country');
    initCustomDropdown('dropdown-category', 'category-trigger', 'category', 'Select a category');

    /* ── Country "Other" toggle ── */
    const countrySelect     = document.getElementById('country');
    const countryOtherWrap  = document.getElementById('country-other-wrap');
    const countryOtherInput = document.getElementById('country_other');

    countrySelect.addEventListener('change', () => {
        const isOther = countrySelect.value === 'Other';
        countryOtherWrap.classList.toggle('hidden', !isOther);
        countryOtherInput.required = isOther;
        if (!isOther) countryOtherInput.value = '';
    });

    /* ── File upload UI ── */
    const fileInput  = document.getElementById('payment_proof');
    const uploadZone = document.getElementById('upload-zone');
    const fileLabel  = document.getElementById('file-name');
    let   selectedFile = null;

    /* Returns null if file is valid, or a specific human-readable error string. */
    function validateFile(file) {
        if (!file) return 'Please upload your payment proof (JPG, JPEG, PNG, or PDF).';
        const allowed = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        if (!allowed.includes(file.type)) {
            return 'Format tidak didukung. Gunakan JPG, JPEG, PNG, atau PDF.';
        }
        if (file.size > 5 * 1024 * 1024) {
            const mb = (file.size / (1024 * 1024)).toFixed(1);
            return `File terlalu besar (${mb} MB). Maksimal ukuran file adalah 5 MB.`;
        }
        return null;
    }

    /* Show or clear the file error message and update upload zone border colour. */
    function setFileError(msg) {
        const el = document.getElementById('err-payment_proof');
        if (!el) return;
        if (msg) {
            el.textContent = msg;
            el.classList.remove('hidden');
            uploadZone.style.borderColor = 'rgba(248,113,113,0.6)';
        } else {
            el.textContent = '';
            el.classList.add('hidden');
            uploadZone.style.borderColor = 'rgba(96,165,250,0.5)';
        }
    }

    /* Validate and update UI immediately whenever a file is chosen. */
    function handleFileChosen(file) {
        selectedFile = file;
        fileLabel.textContent = file.name;
        fileLabel.classList.remove('hidden');
        setFileError(validateFile(file));
    }

    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) handleFileChosen(fileInput.files[0]);
    });

    uploadZone.addEventListener('dragover', (e) => { e.preventDefault(); uploadZone.classList.add('drag-over'); });
    uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('drag-over'));
    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.classList.remove('drag-over');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            /* Use DataTransfer to properly inject the dropped file into <input>
               so the browser includes it in the multipart form submission.
               Direct assignment (fileInput.files = e.dataTransfer.files) is
               read-only and silently fails in most browsers. */
            try {
                const dt = new DataTransfer();
                dt.items.add(files[0]);
                fileInput.files = dt.files;
            } catch (_) { /* DataTransfer unavailable — server will catch the missing file */ }
            handleFileChosen(files[0]);
        }
    });

    /* ── Validation ── */
    const form = document.getElementById('register-form');

    function showError(id, show) {
        const errEl = document.getElementById('err-' + id);
        if (errEl) errEl.classList.toggle('hidden', !show);
        /* For custom dropdowns highlight the visible trigger button, not the hidden input */
        const visual = document.getElementById(id + '-trigger') || document.getElementById(id);
        if (visual) visual.style.borderColor = show ? 'rgba(248,113,113,0.6)' : '';
    }

    form.addEventListener('submit', (e) => {
        let valid = true;

        /* First name */
        if (!document.getElementById('first_name').value.trim()) {
            showError('first_name', true); valid = false;
        } else showError('first_name', false);

        /* Last name */
        if (!document.getElementById('last_name').value.trim()) {
            showError('last_name', true); valid = false;
        } else showError('last_name', false);

        /* Email */
        const email = document.getElementById('email').value.trim();
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError('email', true); valid = false;
        } else showError('email', false);

        /* Country */
        if (!countrySelect.value) {
            showError('country', true); valid = false;
        } else {
            showError('country', false);
            if (countrySelect.value === 'Other' && !countryOtherInput.value.trim()) {
                showError('country_other', true); valid = false;
            } else showError('country_other', false);
        }

        /* Category */
        if (!document.getElementById('category').value) {
            showError('category', true); valid = false;
        } else showError('category', false);

        /* Payment proof — prefer selectedFile (covers both click-pick and drag-drop) */
        const fileErr = validateFile(selectedFile || fileInput.files[0]);
        setFileError(fileErr);
        if (fileErr) valid = false;

        if (!valid) e.preventDefault();
    });

    /* Clear error on change */
    ['first_name', 'last_name', 'email', 'country', 'category'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('change', () => showError(id, false));
    });
</script>

<script src="assets/js/interactions.js"></script>
</body>
</html>