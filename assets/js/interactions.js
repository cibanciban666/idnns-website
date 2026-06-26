/**
 * interactions.js
 * 1.  Scroll-reveal via IntersectionObserver (.reveal)
 * 2.  Animated count-up ([data-count])
 * 3.  Scrollspy — highlight active nav link
 * 4.  Hover effects — cards, buttons, icons (auto-detected, no HTML changes)
 * 5.  Cursor spotlight — hero section radial glow follows mouse
 * 6.  Grid stagger — card children inside grids appear sequentially
 * 7.  Ripple — click burst on buttons and CTA links
 */

(function () {
    'use strict';

    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ─────────────────────────────────────────────
     * CSS — injected once, covers all modules
     * ───────────────────────────────────────────── */

    function injectStyles() {
        if (document.getElementById('interactions-styles')) return;

        var css = [

            /* ── 1. Scroll-reveal ── */
            '.reveal {',
            '  opacity: 0;',
            '  transition-property: opacity, transform;',
            '  transition-timing-function: cubic-bezier(0.22, 1, 0.36, 1);',
            '}',
            '.reveal.reveal-up    { transform: translateY(48px); }',
            '.reveal.reveal-left  { transform: translateX(-48px); }',
            '.reveal.reveal-right { transform: translateX(48px); }',
            '.reveal:not(.reveal-up):not(.reveal-left):not(.reveal-right) { transform: translateY(44px); }',
            '.reveal.is-visible { opacity: 1 !important; transform: translate(0,0) !important; }',

            /* ── 6. Grid stagger items ── */
            '.js-stagger-item {',
            '  opacity: 0;',
            '  transform: translateY(32px);',
            '  transition: opacity 0.5s cubic-bezier(0.22,1,0.36,1),',
            '              transform 0.5s cubic-bezier(0.22,1,0.36,1);',
            '}',
            '.js-stagger-item.is-visible {',
            '  opacity: 1;',
            '  transform: translateY(0);',
            '}',

            /* ── 4. Card hover ── */
            '.js-card {',
            '  transition: transform 0.25s cubic-bezier(0.22,1,0.36,1),',
            '              box-shadow 0.25s cubic-bezier(0.22,1,0.36,1),',
            '              border-color 0.25s ease !important;',
            '  will-change: transform;',
            '}',
            '.js-card:hover {',
            '  transform: translateY(-4px) scale(1.025);',
            '  box-shadow: 0 24px 60px rgba(0,0,0,0.35), 0 0 0 1px rgba(96,165,250,0.18);',
            '}',
            /* icon inside card scales on parent hover */
            '.js-card [data-lucide], .js-card svg {',
            '  transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);',
            '}',
            '.js-card:hover [data-lucide], .js-card:hover svg {',
            '  transform: scale(1.18) rotate(6deg);',
            '}',

            /* ── 4. Button hover ── */
            '.js-btn {',
            '  transition: transform 0.2s cubic-bezier(0.22,1,0.36,1),',
            '              filter 0.2s ease,',
            '              box-shadow 0.2s ease !important;',
            '  will-change: transform;',
            '}',
            '.js-btn:hover  { transform: scale(1.05); filter: brightness(1.08); }',
            '.js-btn:active { transform: scale(0.97) !important; filter: brightness(0.97) !important; }',

            /* ── 7. Ripple ── */
            '.js-ripple-wrap { position: relative; overflow: hidden; }',
            '@keyframes js-ripple-anim {',
            '  from { transform: scale(0); opacity: 0.45; }',
            '  to   { transform: scale(4); opacity: 0; }',
            '}',
            '.js-ripple {',
            '  position: absolute;',
            '  border-radius: 50%;',
            '  width: 80px; height: 80px;',
            '  margin-top: -40px; margin-left: -40px;',
            '  background: rgba(255,255,255,0.35);',
            '  pointer-events: none;',
            '  animation: js-ripple-anim 0.55s cubic-bezier(0.22,1,0.36,1) forwards;',
            '}',

            /* ── 5. Spotlight ── */
            '.js-spotlight { overflow: hidden; }',
            '.js-spotlight-orb {',
            '  position: absolute;',
            '  width: 480px; height: 480px;',
            '  border-radius: 50%;',
            '  pointer-events: none;',
            '  transform: translate(-50%, -50%);',
            '  background: radial-gradient(circle, rgba(96,165,250,0.11) 0%, rgba(96,165,250,0.04) 40%, transparent 70%);',
            '  transition: left 0.08s linear, top 0.08s linear;',
            '  z-index: 0;',
            '  will-change: left, top;',
            '}',

            /* ── Nav: desktop link underline — expands from centre on hover/active ── */
            '.js-nav-link { position: relative; }',
            '.js-nav-link::after {',
            '  content: "";',
            '  position: absolute;',
            '  left: 50%; right: 50%;',  /* zero-width centred = invisible */
            '  bottom: -5px;',
            '  height: 2px;',
            '  background: var(--blue-accent, #60a5fa);',
            '  transition: left 0.22s ease, right 0.22s ease;',
            '}',
            /* Hover: expand underline to full link width */
            '@media (hover: hover) {',
            '  .js-nav-link:hover::after { left: 0; right: 0; }',
            '}',
            /* Active (set by scrollspy via is-active class) */
            '.js-nav-link.is-active { opacity: 1 !important; }',
            '.js-nav-link.is-active::after {',
            '  left: 0; right: 0;',
            '  background: var(--blue-accent, #60a5fa);',
            '}',

            /* ── Nav: logo subtle scale on hover ── */
            '.js-nav-logo {',
            '  transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);',
            '}',
            '@media (hover: hover) {',
            '  .js-nav-logo:hover { transform: scale(1.03); }',
            '}',

            /* ── Nav: Join Now — extra blue glow stacked on existing js-btn scale ── */
            '@media (hover: hover) {',
            '  .js-nav-join.js-btn:hover {',
            '    box-shadow: 0 0 0 2px var(--blue-accent, #60a5fa),',
            '                0 6px 20px rgba(96, 165, 250, 0.28);',
            '  }',
            '}',

        ].join('\n');

        var tag = document.createElement('style');
        tag.id  = 'interactions-styles';
        tag.textContent = css;
        document.head.appendChild(tag);
    }

    /* ─────────────────────────────────────────────
     * HELPERS — auto-detect cards and buttons
     * ───────────────────────────────────────────── */

    /* Returns true for block elements that look like visual cards */
    function looksLikeCard(el) {
        var tag = el.tagName;
        if (tag !== 'DIV' && tag !== 'A' && tag !== 'ARTICLE' && tag !== 'LI') return false;
        var cls = el.className || '';
        var hasRounded = /rounded-(2xl|3xl|xl|\[)/.test(cls);
        var hasSurface = /border|bg-/.test(cls);
        var hasPadding = /\bp-\d|px-\d|py-\d/.test(cls);
        return hasRounded && hasSurface && hasPadding;
    }

    /* Returns true for clickable CTA-style elements */
    function looksLikeBtn(el) {
        var tag = el.tagName;
        if (tag !== 'BUTTON' && tag !== 'A') return false;
        var cls = el.className || '';
        return /rounded-full/.test(cls) && /px-\d/.test(cls);
    }

    /* ─────────────────────────────────────────────
     * 1. SCROLL-REVEAL  (translate distance bumped to 44-48 px)
     * ───────────────────────────────────────────── */

    function initScrollReveal() {
        var elements = document.querySelectorAll('.reveal');
        if (!elements.length) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var el       = entry.target;
                var delay    = parseInt(el.dataset.delay    || '0',   10);
                var duration = parseInt(el.dataset.duration || '650', 10);

                el.style.transitionDuration = duration + 'ms';
                el.style.transitionDelay    = delay    + 'ms';

                requestAnimationFrame(function () {
                    el.classList.add('is-visible');
                });

                observer.unobserve(el);
            });
        }, { threshold: 0.10, rootMargin: '0px 0px -48px 0px' });

        elements.forEach(function (el) { observer.observe(el); });
    }

    /* ─────────────────────────────────────────────
     * 2. COUNT-UP
     * ───────────────────────────────────────────── */

    function easeOutQuart(t) { return 1 - Math.pow(1 - t, 4); }

    function animateCount(el) {
        var target   = parseFloat(el.dataset.count    || '0');
        var start    = parseFloat(el.dataset.start    || '0');
        var suffix   = el.dataset.suffix   || '';
        var prefix   = el.dataset.prefix   || '';
        var duration = parseInt(el.dataset.duration || '1400', 10);
        var decimals = parseInt(el.dataset.decimals  || '0',   10);
        var startTime = null;

        function step(ts) {
            if (!startTime) startTime = ts;
            var progress = Math.min((ts - startTime) / duration, 1);
            var value    = start + (target - start) * easeOutQuart(progress);
            el.textContent = prefix + value.toFixed(decimals) + suffix;
            if (progress < 1) requestAnimationFrame(step);
            else el.textContent = prefix + target.toFixed(decimals) + suffix;
        }
        requestAnimationFrame(step);
    }

    function initCountUp() {
        var elements = document.querySelectorAll('[data-count]');
        if (!elements.length) return;

        if (prefersReduced) {
            elements.forEach(function (el) {
                var t = parseFloat(el.dataset.count || '0');
                var d = parseInt(el.dataset.decimals || '0', 10);
                el.textContent = (el.dataset.prefix || '') + t.toFixed(d) + (el.dataset.suffix || '');
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                animateCount(entry.target);
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.5 });

        elements.forEach(function (el) { observer.observe(el); });
    }

    /* ─────────────────────────────────────────────
     * 3. SCROLLSPY
     * ───────────────────────────────────────────── */

    var NAV_SELECTOR = 'nav';
    var ACTIVE_CLASS = 'is-active';
    var SPY_OFFSET   = 80;

    function initScrollspy() {
        var navEl = document.querySelector(NAV_SELECTOR);
        if (!navEl) return;

        var links = Array.prototype.slice.call(
            navEl.querySelectorAll('a[href^="#"]')
        ).filter(function (a) {
            var id = a.getAttribute('href').slice(1);
            return id && document.getElementById(id);
        });
        if (!links.length) return;

        var sections = links.map(function (a) {
            return document.getElementById(a.getAttribute('href').slice(1));
        });

        function getActive() {
            var y = window.scrollY || window.pageYOffset;
            for (var i = sections.length - 1; i >= 0; i--) {
                if (sections[i].offsetTop - SPY_OFFSET <= y) return i;
            }
            return 0;
        }

        function update() {
            var active = getActive();
            links.forEach(function (a, i) {
                if (i === active) {
                    a.classList.add(ACTIVE_CLASS);
                    a.setAttribute('aria-current', 'page');
                } else {
                    a.classList.remove(ACTIVE_CLASS);
                    a.removeAttribute('aria-current');
                }
            });
        }

        var ticking = false;
        window.addEventListener('scroll', function () {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(function () { update(); ticking = false; });
        }, { passive: true });

        update();
    }

    /* ─────────────────────────────────────────────
     * 4. HOVER EFFECTS — cards + buttons + icons
     *    Auto-detected; no HTML changes needed.
     * ───────────────────────────────────────────── */

    function initHoverEffects() {
        if (prefersReduced) return;

        /* Walk every element in sections and tag it */
        var candidates = document.querySelectorAll('section *');
        candidates.forEach(function (el) {
            if (looksLikeCard(el) && !el.classList.contains('js-card')) {
                el.classList.add('js-card');
            }
        });

        /* Buttons and CTA links across the whole page */
        var btnCandidates = document.querySelectorAll('button, a');
        btnCandidates.forEach(function (el) {
            if (looksLikeBtn(el) && !el.classList.contains('js-btn')) {
                el.classList.add('js-btn');
            }
        });
    }

    /* ─────────────────────────────────────────────
     * 5. CURSOR SPOTLIGHT — hero section (#home or first <section>)
     * ───────────────────────────────────────────── */

    function initSpotlight() {
        if (prefersReduced) return;

        var hero = document.getElementById('home') || document.querySelector('section');
        if (!hero) return;

        /* Ensure the section can contain absolute children */
        var pos = window.getComputedStyle(hero).position;
        if (pos === 'static') hero.style.position = 'relative';

        hero.classList.add('js-spotlight');

        var orb = document.createElement('div');
        orb.className = 'js-spotlight-orb';
        /* Start centred so it's not visible in a corner before first move */
        orb.style.left = '50%';
        orb.style.top  = '50%';
        hero.insertBefore(orb, hero.firstChild);

        hero.addEventListener('mousemove', function (e) {
            var rect = hero.getBoundingClientRect();
            orb.style.left = (e.clientX - rect.left)  + 'px';
            orb.style.top  = (e.clientY - rect.top)   + 'px';
        }, { passive: true });

        hero.addEventListener('mouseleave', function () {
            /* fade orb to centre on leave */
            orb.style.left = '50%';
            orb.style.top  = '-100px'; /* above viewport — invisible */
        }, { passive: true });
    }

    /* ─────────────────────────────────────────────
     * 6. GRID STAGGER
     *    Finds grid/list containers inside sections.
     *    Tags direct children that look like cards as
     *    .js-stagger-item, then reveals them sequentially
     *    (90 ms apart) when the container enters viewport.
     * ───────────────────────────────────────────── */

    function initStagger() {
        if (prefersReduced) return;

        /* Containers whose direct children should stagger */
        var containers = document.querySelectorAll(
            'section [class*="grid"], section [class*="space-y"]'
        );

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;

                var children = Array.prototype.slice.call(entry.target.children);
                var staggerable = children.filter(function (child) {
                    return child.classList.contains('js-stagger-item');
                });

                staggerable.forEach(function (child, i) {
                    child.style.transitionDelay = (i * 90) + 'ms';
                    /* tiny rAF so browser registers the initial opacity:0 state */
                    requestAnimationFrame(function () {
                        child.classList.add('is-visible');
                    });
                });

                observer.unobserve(entry.target);
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -32px 0px' });

        containers.forEach(function (container) {
            var tagged = false;
            Array.prototype.slice.call(container.children).forEach(function (child) {
                if (looksLikeCard(child)) {
                    child.classList.add('js-stagger-item');
                    /* Remove js-card from stagger items to avoid double-transform conflict */
                    child.classList.remove('js-card');
                    tagged = true;
                }
            });
            if (tagged) observer.observe(container);
        });
    }

    /* ─────────────────────────────────────────────
     * 7. RIPPLE
     *    Attaches to .js-btn elements.
     *    Creates a circle that expands from the click point.
     * ───────────────────────────────────────────── */

    function spawnRipple(el, e) {
        /* Ensure the element can clip the ripple */
        if (!el.classList.contains('js-ripple-wrap')) {
            el.classList.add('js-ripple-wrap');
        }

        var rect   = el.getBoundingClientRect();
        var ripple = document.createElement('span');
        ripple.className = 'js-ripple';
        ripple.style.left = (e.clientX - rect.left)  + 'px';
        ripple.style.top  = (e.clientY - rect.top)   + 'px';
        el.appendChild(ripple);

        ripple.addEventListener('animationend', function () {
            ripple.remove();
        });
    }

    function initRipple() {
        if (prefersReduced) return;

        /* Use event delegation on the document so dynamically tagged .js-btn
           elements are also covered without re-querying. */
        document.addEventListener('click', function (e) {
            var target = e.target;
            /* Walk up to find the nearest .js-btn ancestor (handles icon children) */
            while (target && target !== document.body) {
                if (target.classList && target.classList.contains('js-btn')) {
                    spawnRipple(target, e);
                    return;
                }
                target = target.parentElement;
            }
        });
    }

    /* ─────────────────────────────────────────────
     * 8. NAV LINK STYLING
     *    Tags desktop nav links with js-nav-link (underline animation),
     *    the logo with js-nav-logo, and the Join Now button with
     *    js-nav-join (extra glow on top of existing js-btn scale).
     *    Mobile menu links are intentionally excluded so touch UX
     *    is unaffected.
     * ───────────────────────────────────────────── */

    function initNavLinks() {
        var nav = document.querySelector('nav');
        if (!nav) return;

        /* Desktop links = any nav anchor NOT inside #mobile-menu
           AND NOT the Join Now button (which has rounded-full) */
        Array.prototype.slice.call(nav.querySelectorAll('a[href]'))
            .filter(function (a) {
                if (a.closest('#mobile-menu')) return false;       /* skip mobile */
                if (/rounded-full/.test(a.className || '')) return false; /* skip Join Now */
                return true;
            })
            .forEach(function (a) { a.classList.add('js-nav-link'); });

        /* Logo */
        var logo = nav.querySelector('img');
        if (logo) logo.classList.add('js-nav-logo');

        /* Join Now — add extra class for the glow rule, after js-btn is set by initHoverEffects */
        var joinBtn = nav.querySelector('a[href="register.php"]');
        if (joinBtn) joinBtn.classList.add('js-nav-join');
    }

    /* ─────────────────────────────────────────────
     * 9. NAV SCROLL EFFECT
     *    Adds .is-scrolled to <nav> once the page scrolls past
     *    50 px so the background darkens and a shadow appears.
     *    Transition is defined in CSS so it stays smooth even
     *    on low-end devices (no JS animation frame budget spent).
     * ───────────────────────────────────────────── */

    function initNavScroll() {
        var nav = document.querySelector('nav');
        if (!nav) return;

        function update() {
            var past = (window.scrollY || window.pageYOffset) > 50;
            nav.classList.toggle('is-scrolled', past);
        }

        var ticking = false;
        window.addEventListener('scroll', function () {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(function () { update(); ticking = false; });
        }, { passive: true });

        update(); /* correct state on initial load */
    }

    /* ─────────────────────────────────────────────
     * INIT
     * ───────────────────────────────────────────── */

    function init() {
        injectStyles();
        initStagger();        /* tag grid children before reveal observes them  */
        initScrollReveal();
        initCountUp();
        initScrollspy();
        initHoverEffects();   /* adds js-btn to buttons including Join Now       */
        initNavLinks();       /* adds js-nav-link, js-nav-logo, js-nav-join      */
        initNavScroll();      /* toggles nav.is-scrolled on scroll > 50 px       */
        initSpotlight();
        initRipple();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

}());
