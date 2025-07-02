<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>{{ $title ?? 'Elite Rental - Solusi Rental Berkualitas' }}</title>

    <style>
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-scroll {
            animation: scroll 40s linear infinite;
            width: max-content;
        }

        .carousel-container:hover .animate-scroll {
            animation-play-state: paused;
        }

        /* Style untuk icon love */
        .ui-like {
            --icon-size: 24px;
            --icon-hover-color: rgb(211, 205, 205);
            --icon-primary-color: rgb(230, 26, 26);
            --icon-circle-border: 1px solid var(--icon-primary-color);
            --icon-circle-size: 35px;
            --icon-anmt-duration: 0.3s;
        }

        .ui-like input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: none;
        }

        .ui-like .like {
            width: var(--icon-size);
            height: auto;
            fill: var(--icon-hover-color);
            cursor: pointer;
            -webkit-transition: 0.2s;
            -o-transition: 0.2s;
            transition: 0.2s;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            position: relative;
            -webkit-transform-origin: top;
            -ms-transform-origin: top;
            transform-origin: top;
        }

        .like::after {
            content: "";
            position: absolute;
            width: 10px;
            height: 10px;
            -webkit-box-shadow: 0 30px 0 -4px var(--icon-primary-color),
                30px 0 0 -4px var(--icon-primary-color),
                0 -30px 0 -4px var(--icon-primary-color),
                -30px 0 0 -4px var(--icon-primary-color),
                -22px 22px 0 -4px var(--icon-primary-color),
                -22px -22px 0 -4px var(--icon-primary-color),
                22px -22px 0 -4px var(--icon-primary-color),
                22px 22px 0 -4px var(--icon-primary-color);
            box-shadow: 0 30px 0 -4px var(--icon-primary-color),
                30px 0 0 -4px var(--icon-primary-color),
                0 -30px 0 -4px var(--icon-primary-color),
                -30px 0 0 -4px var(--icon-primary-color),
                -22px 22px 0 -4px var(--icon-primary-color),
                -22px -22px 0 -4px var(--icon-primary-color),
                22px -22px 0 -4px var(--icon-primary-color),
                22px 22px 0 -4px var(--icon-primary-color);
            border-radius: 50%;
            -webkit-transform: scale(0);
            -ms-transform: scale(0);
            transform: scale(0);
        }

        .like::before {
            content: "";
            position: absolute;
            border-radius: 50%;
            border: var(--icon-circle-border);
            opacity: 0;
        }

        /* actions */

        .ui-like:hover .like {
            fill: var(--icon-primary-color);
        }

        .ui-like input:checked+.like::after {
            -webkit-animation: circles var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            animation: circles var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            -webkit-animation-delay: var(--icon-anmt-duration);
            animation-delay: var(--icon-anmt-duration);
        }

        .ui-like input:checked+.like {
            fill: var(--icon-primary-color);
            -webkit-animation: like var(--icon-anmt-duration) forwards;
            animation: like var(--icon-anmt-duration) forwards;
            -webkit-transition-delay: 0.3s;
            -o-transition-delay: 0.3s;
            transition-delay: 0.3s;
        }

        .ui-like input:checked+.like::before {
            -webkit-animation: circle var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            animation: circle var(--icon-anmt-duration) cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            -webkit-animation-delay: var(--icon-anmt-duration);
            animation-delay: var(--icon-anmt-duration);
        }

        @-webkit-keyframes like {
            50% {
                -webkit-transform: scaleY(0.6);
                transform: scaleY(0.6);
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
            }
        }

        @keyframes like {
            50% {
                -webkit-transform: scaleY(0.6);
                transform: scaleY(0.6);
            }

            100% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
            }
        }

        @-webkit-keyframes circle {
            from {
                width: 0;
                height: 0;
                opacity: 0;
            }

            90% {
                width: var(--icon-circle-size);
                height: var(--icon-circle-size);
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        @keyframes circle {
            from {
                width: 0;
                height: 0;
                opacity: 0;
            }

            90% {
                width: var(--icon-circle-size);
                height: var(--icon-circle-size);
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        @-webkit-keyframes circles {
            from {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            40% {
                opacity: 1;
            }

            to {
                -webkit-transform: scale(0.8);
                transform: scale(0.8);
                opacity: 0;
            }
        }

        @keyframes circles {
            from {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            40% {
                opacity: 1;
            }

            to {
                -webkit-transform: scale(0.8);
                transform: scale(0.8);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-light-gray">
    @include('components.navigation.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <button id="scrollTop"
        class="fixed bottom-6 right-6 bg-gold text-navy p-3 rounded-full opacity-0 shadow-lg transition-all duration-300 hover:bg-yellow-500 hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.style.opacity = '1';
                scrollTopBtn.style.transform = 'translateY(0)';
            } else {
                scrollTopBtn.style.opacity = '0';
                scrollTopBtn.style.transform = 'translateY(10px)';
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-slide-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s ease-out';
            observer.observe(el);
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.md\\:hidden button');
        const mobileMenu = document.createElement('div');
        mobileMenu.className = 'md:hidden bg-navy';
        mobileMenu.innerHTML = `
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#beranda" class="block px-3 py-2 text-white hover:text-gold">Beranda</a>
                <a href="#tentang" class="block px-3 py-2 text-white hover:text-gold">Tentang</a>
                <a href="#layanan" class="block px-3 py-2 text-white hover:text-gold">Layanan</a>
                <a href="#kendaraan" class="block px-3 py-2 text-white hover:text-gold">Kendaraan</a>
                <a href="#kontak" class="block px-3 py-2 text-white hover:text-gold">Kontak</a>
            </div>
        `;
        mobileMenu.style.display = 'none';
        document.querySelector('nav').appendChild(mobileMenu);

        mobileMenuBtn.addEventListener('click', () => {
            if (mobileMenu.style.display === 'none') {
                mobileMenu.style.display = 'block';
            } else {
                mobileMenu.style.display = 'none';
            }
        });
    </script>
</body>

</html>
