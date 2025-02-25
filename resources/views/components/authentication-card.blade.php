<div class="min-h-screen flex" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24"
         x-show="loaded"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="glassmorphism py-8 px-6 shadow-2xl rounded-xl relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 backdrop-blur-xl"></div>
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="hidden lg:block relative w-0 flex-1 overflow-hidden">
        <!-- Particles Background -->
        <div id="particles-js" class="absolute inset-0 z-0"></div>

        <!-- Animated gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 via-indigo-600/85 to-purple-600/80 animate-gradient mix-blend-overlay"></div>
        
        <!-- Background image with parallax -->
        <div class="absolute inset-0 bg-cover bg-center transform scale-105 animate-slow-zoom" 
             style="background-image: url('/images/luxury-hotel-room.jpg');"
             x-data
             x-on:mousemove="$el.style.transform = `scale(1.05) translate(${event.clientX * 0.01}px, ${event.clientY * 0.01}px)`">
        </div>

        <!-- Floating elements with 3D rotation -->
        <div class="absolute inset-0">
            <div class="floating-element perspective top-1/4 left-1/4">
                <img src="/images/icons/plane.svg" class="w-12 h-12 text-white opacity-50 hover:scale-110 transition-transform">
            </div>
            <div class="floating-element perspective top-1/2 right-1/3" style="animation-delay: -2s;">
                <img src="/images/icons/hotel.svg" class="w-16 h-16 text-white opacity-40 hover:scale-110 transition-transform">
            </div>
            <div class="floating-element perspective bottom-1/4 right-1/4" style="animation-delay: -4s;">
                <img src="/images/icons/map.svg" class="w-10 h-10 text-white opacity-60 hover:scale-110 transition-transform">
            </div>
        </div>

        <!-- Content overlay with improved typography -->
        <div class="absolute inset-0 flex items-center justify-center text-white z-10"
             x-show="loaded"
             x-transition:enter="transition ease-out duration-500 delay-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0">
            <div class="max-w-2xl px-8">
                <h1 class="text-6xl font-bold text-shadow-lg bg-clip-text text-transparent bg-gradient-to-r from-white to-white/80">
                    Welcome to TouriStay
                </h1>
                <p class="mt-6 text-xl font-light leading-relaxed text-shadow tracking-wide">
                    Your gateway to unique travel experiences and comfortable stays around the world.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .glassmorphism {
        background: rgba(255, 255, 255, 0.7);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .perspective {
        perspective: 1000px;
        transform-style: preserve-3d;
    }

    @keyframes floating {
        0% { transform: translateY(0px) rotateX(0deg) rotateY(0deg); }
        50% { transform: translateY(-20px) rotateX(5deg) rotateY(5deg); }
        100% { transform: translateY(0px) rotateX(0deg) rotateY(0deg); }
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .floating-element {
        position: absolute;
        animation: floating 6s ease-in-out infinite;
        filter: drop-shadow(0 0 8px rgba(255,255,255,0.3));
    }

    .floating-element img {
        transition: all 0.3s ease;
    }

    .floating-element:hover img {
        filter: drop-shadow(0 0 12px rgba(255,255,255,0.5));
    }

    .animate-gradient {
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }

    .animate-slow-zoom {
        animation: slowZoom 20s ease infinite;
    }

    @keyframes slowZoom {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .text-shadow {
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .text-shadow-lg {
        text-shadow: 0 4px 8px rgba(0,0,0,0.4);
    }
</style>

<!-- Add particles.js -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        particlesJS("particles-js", {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: true },
                size: { value: 3, random: true },
                move: {
                    enable: true,
                    speed: 1,
                    direction: "none",
                    random: true,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                }
            },
            interactivity: {
                detect_on: "canvas",
                events: {
                    onhover: { enable: true, mode: "repulse" },
                    onclick: { enable: true, mode: "push" },
                    resize: true
                }
            },
            retina_detect: true
        });
    });
</script>
