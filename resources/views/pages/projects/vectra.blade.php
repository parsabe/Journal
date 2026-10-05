<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vectra Project - Parsa Besharat</title>

    <meta name="description" content="Vectra is an end-to-end spatial computing framework engineered to generate, extract, and simulate high-fidelity 3D objects directly from simple visual and textual data.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Vectra, 3D Gaussian Splatting, NeRF, DreamGaussian, LGM, TRELLIS, Deep Splat Excavation, DBSE, VRAM Orchestration, Cannon.js, Three.js, Parsa Besharat">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Vectra Project - Parsa Besharat">
    <meta property="og:description" content="Vectra is an end-to-end spatial computing framework engineered to generate, extract, and simulate high-fidelity 3D objects directly from simple visual and textual data.">
    <meta property="og:image" content="{{ asset('images/vectra.png') }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Vectra Project - Parsa Besharat">
    <meta name="twitter:description" content="Vectra is an end-to-end spatial computing framework engineered to generate, extract, and simulate high-fidelity 3D objects directly from simple visual and textual data.">
    <meta name="twitter:image" content="{{ asset('images/vectra.png') }}">

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E441FBGYXG"></script>
<script type="module" src="{{ asset('js/gtag.js') }}"></script>

<body
    class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-4 lg:p-10 min-h-screen relative overflow-x-hidden">

    <div id="main-container"
        class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700">

        <div class="absolute top-6 right-8 flex items-center gap-5 z-50">

            <div class="flex gap-2">
                <div class="w-3.5 h-3.5 rounded-full bg-[#ff5f56] shadow-sm border border-[#e0443e]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#ffbd2e] shadow-sm border border-[#dea123]"></div>
                <div class="w-3.5 h-3.5 rounded-full bg-[#27c93f] shadow-sm border border-[#1aab29]"></div>
            </div>
        </div>

        @include('sidebar')

        <main class="flex-1 overflow-y-auto p-6 md:p-10 scroll-smooth">
            <div class="max-w-4xl mx-auto space-y-10">
                
                <!-- Header -->
                <div class="text-center space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-600 dark:from-white dark:to-gray-400">
                        Vectra
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300 font-medium">
                        The Quarantine Matrix: Constraining Neural Hallucinations in 3D Gaussian Environments
                    </p>
                    <div class="flex justify-center">
                        <img src="{{ asset('images/vectra.png') }}" 
                             alt="Vectra Poster" 
                             class="rounded-2xl shadow-lg max-w-full h-auto border border-gray-200 dark:border-gray-700">
                    </div>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="https://github.com/parsabe/Vectra" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                            </svg>
                            Source Code
                        </a>
                        <a href="https://www.researchgate.net/publication/408133286_Vectra_The_Quarantine_Matrix_Constraining_Neural_Hallucinations_in_3D_Gaussian_Environments" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-500 to-emerald-600 text-white rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Research Paper
                        </a>
                        <a href="https://vectra.parsabe.com" target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-full font-bold shadow-lg hover:scale-105 transition-transform duration-200">
                            Launch Portal
                        </a>
                    </div>
                </div>

                <!-- Overview & Video -->
                <section class="space-y-6">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Overview</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="space-y-3 text-center group">
                            <a href="https://youtu.be/D-EFJVIRx9Y" target="_blank" class="block relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <img src="https://img.youtube.com/vi/D-EFJVIRx9Y/maxresdefault.jpg" alt="Vectra Demonstration" class="w-full object-cover aspect-video">
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="w-12 h-12 bg-white/90 rounded-full flex items-center justify-center pl-1">
                                        <svg class="w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                            </a>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 font-mono">Quarantine Matrix Demonstration Video</p>
                        </div>

                        <div class="space-y-3 text-center group">
                            <a href="https://vectra.parsabe.com" target="_blank" class="block relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-gray-950 to-neutral-900 p-8 flex flex-col items-center justify-center aspect-video border border-neutral-800">
                                <div class="text-white font-mono tracking-widest text-lg font-bold mb-2">// VECTRA PORTAL //</div>
                                <div class="text-xs text-blue-500 font-mono">[ LAUNCH 3D VIEWPORT ]</div>
                                <div class="absolute inset-0 bg-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400 font-mono">Live navigtion and asset injection portal</p>
                        </div>
                    </div>
                </section>

                <!-- Abstract -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Abstract</h2>
                    </div>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
                        <p>
                            As spatial computing and generative artificial intelligence converge, the necessity for robust, secure, and highly optimized integration architectures becomes strictly paramount. The <strong>Vectra Spatial Computing Protocol</strong> bridges the gap between high-fidelity digital twins and localized generative AI pipelines without relying on external cloud computing. 
                        </p>
                        <p>
                            By enforcing a strictly decoupled, asynchronous client-server architecture, computationally expensive deep learning models (U<sup>2</sup>-Net, SDXL-Lightning, and TripoSR) are successfully orchestrated on constrained consumer-grade edge hardware (strictly within an <strong>8GB VRAM</strong> threshold). Furthermore, the introduction of the <strong>Deep Splat Excavation (DBSE)</strong> algorithm resolves critical spatial occlusion problems inherent to dense Gaussian Splatting environments. This methodology lays the foundational groundwork for embedding definitive mathematical safeguards into the next generation of spatial rendering pipelines.
                        </p>
                    </div>
                </section>

                <!-- Introduction -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Introduction</h2>
                    </div>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-300 leading-relaxed text-justify space-y-4">
                        <p>
                            Integrating AI-generated 3D assets into scanned physical environments traditionally suffers from severe hardware bottlenecks and geometric visual artifacts (such as Z-fighting and object clipping). Vectra solves this through two primary computational innovations:
                        </p>
                        <ul class="list-disc list-inside space-y-2 ml-4">
                            <li><strong>The Edge-Computed Generative Pipeline:</strong> A robust local GPU Forge that aggressively manages memory cycles to prevent Out-Of-Memory (OOM) kernel panics when generating meshes via localized Text-to-3D and Image-to-3D prompts.</li>
                            <li><strong>Non-Destructive Spatial Masking:</strong> Instead of permanently altering source point cloud data, the system mathematically calculates volumetric raycast bounds to dynamically override shader alpha values, allowing new assets to spawn seamlessly within the original spatial coordinates.</li>
                        </ul>
                    </div>
                </section>

                <!-- System Architecture -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">System Architecture</h2>
                    </div>
                    <div class="grid md:grid-cols-2 gap-8 text-gray-600 dark:text-gray-300">
                        <div class="bg-gray-50/50 dark:bg-gray-800/30 p-6 rounded-2xl border border-gray-100 dark:border-gray-800/80 space-y-4">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Client-Side (The Viewport)</h3>
                            <p class="text-sm">Operates entirely within a standard web browser. Strictly responsible for real-time interaction, asynchronous data transmission, and physics calculations.</p>
                            <ul class="list-disc list-inside text-xs space-y-1">
                                <li><strong>Rendering:</strong> Three.js + gsplat.js</li>
                                <li><strong>Physics Middleware:</strong> Cannon.js</li>
                                <li><strong>UI Architecture:</strong> Asynchronous Glassmorphism</li>
                            </ul>
                        </div>
                        <div class="bg-gray-50/50 dark:bg-gray-800/30 p-6 rounded-2xl border border-gray-100 dark:border-gray-800/80 space-y-4">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Server-Side (The GPU Forge)</h3>
                            <p class="text-sm">An autonomous Python backend hosting the neural networks, systematically managing VRAM flushing protocols.</p>
                            <ul class="list-disc list-inside text-xs space-y-1">
                                <li><strong>Computational Core:</strong> FastAPI</li>
                                <li><strong>Semantic Masking:</strong> U2-Net</li>
                                <li><strong>Volumetric Forging:</strong> TripoSR</li>
                                <li><strong>Latent Generation:</strong> SDXL-Lightning (FP16)</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Hardware Requirements -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Hardware Requirements</h2>
                    </div>
                    <div class="p-6 bg-red-500/5 border border-red-500/20 rounded-2xl space-y-3">
                        <h3 class="text-lg font-semibold text-red-600 dark:text-red-400">Strict Memory Constraint Warning</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed text-justify">
                            This protocol is explicitly engineered to run on standard edge-computing hardware. Attempting to bypass the sequential loading limits without sufficient hardware architecture will result in immediate CUDA OOM errors.
                        </p>
                    </div>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300 ml-4">
                        <li><strong>GPU:</strong> NVIDIA RTX 4060 (or equivalent architecture)</li>
                        <li><strong>VRAM:</strong> 8GB Minimum (System usage peaks at roughly 7.8GB during TripoSR inference)</li>
                        <li><strong>OS:</strong> Ubuntu / Debian-based Linux environment is highly recommended for deep learning and tensor dependencies.</li>
                    </ul>
                </section>

                <!-- Citation & Research -->
                <section class="space-y-4">
                    <div class="flex items-center gap-3 border-b border-gray-200 dark:border-gray-700 pb-3">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Citation</h2>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        If you utilize this protocol, the VRAM orchestration logic, or the Deep Splat Excavation (DBSE) algorithm in your own academic research, please cite the associated Master's Thesis:
                    </p>
                    <pre class="bg-[#1e1e1e] text-[#d4d4d4] p-4 rounded-xl shadow-inner border border-gray-700/50 overflow-x-auto text-sm font-mono mt-2 mb-4"><code>@article{vectra2026,
  author  = {Parsa Besharat},
  title   = {Vectra: The Quarantine Matrix, Constraining Neural Hallucinations in 3D Gaussian Environment},
  school  = {TU Bergakademie Freiberg},
  year    = {2026}
}</code></pre>
                </section>

            </div>
        </main>
    </div>
</body>
</html>
