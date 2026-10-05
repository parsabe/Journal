<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Parsa Besharat</title>

    <meta name="description" content="Parsa Besharat is a Persian Researcher and AI Engineer. He is currently pursuing his MS.c degree in Data Science at the TU Freiberg University in Sachsen, Germany.">
    <meta name="author" content="Parsa Besharat">
    <meta name="keywords" content="Parsa Besharat, Researcher, AI Engineer, Data Scientist, Machine Learning, Deep Learning, Natural Language Processing, Computer Vision, TU Freiberg University, Germany">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="About - Parsa Besharat">
    <meta property="og:description" content="Parsa Besharat is a Persian Researcher and AI Engineer. He is currently pursuing his MS.c degree in Data Science at the TU Freiberg University in Sachsen, Germany.">
    <meta property="og:image" content="{{ asset('images/profile.jpg') }}">
    <meta property="profile:first_name" content="Parsa">
    <meta property="profile:last_name" content="Besharat">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="About - Parsa Besharat">
    <meta name="twitter:description" content="Parsa Besharat is a Persian Researcher and AI Engineer. He is currently pursuing his MS.c degree in Data Science at the TU Freiberg University in Sachsen, Germany.">
    <meta name="twitter:image" content="{{ asset('images/profile.jpg') }}">

    <script>window.tailwind = { config: { darkMode: 'class' } };</script>
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/profile.jpg') }}">
</head>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-E441FBGYXG"></script>
<script type="module" src="{{ asset('js/gtag.js') }}"></script>

<body class="text-gray-800 dark:text-gray-100 antialiased flex items-center justify-center p-4 lg:p-10 min-h-screen relative overflow-x-hidden">

    <div id="main-container" class="ios-glass relative w-full max-w-6xl flex flex-col md:flex-row rounded-[2.5rem] overflow-hidden h-[85vh] z-10 transition-colors duration-700 animate-page-zoom-in">

        @include('top-header-controls')

        @include('sidebar')

        <main class="flex-1 p-8 pt-12 lg:p-14 lg:pt-14 relative overflow-y-auto scroll-smooth">
            <div class="relative z-10 animate-page-slide-up">
                <div>
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 ios-glass text-gray-900 dark:text-white rounded-full text-sm font-bold mb-6">
                        {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'ÜBER MICH' : 'ABOUT ME' }}
                    </span>

                    <h1 class="text-4xl lg:text-5xl font-extrabold mb-6 tracking-tight text-gray-900 dark:text-white drop-shadow-sm">
                        Parsa <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-pink-600 dark:from-orange-400 dark:to-pink-500">Besharat.</span>
                    </h1>

                    @if(session('app_locale') === 'de' || app()->getLocale() === 'de')
                        <div class="text-base lg:text-lg text-gray-800 dark:text-gray-200 leading-relaxed mb-10 font-medium drop-shadow-sm space-y-4">
                            <p>Ich absolviere derzeit ein Masterstudium in Data Science an der TU Freiberg, angetrieben von einer tiefen Leidenschaft für die Nutzung von Daten zur Erstellung wirkungsvoller Lösungen.</p>
                            <p>Mein Weg hat mich zu einer Position als Werkstudent Senior Software Engineer geführt, wo ich mein Fachwissen einbringen und zur bildbasierten Datenkoordination beitragen möchte.</p>
                            <p>Zusätzlich habe ich ein starkes Interesse an Künstlicher Intelligenz und ihrem immensen Potenzial. Mein Ziel ist es, mich in diesem Bereich zu spezialisieren und meine Grundlagen in Data Science zu nutzen, um Erkenntnisse zu gewinnen, die die betriebliche Effizienz steigern und strategische Innovationen vorantreiben.</p>
                            <p>Die Zusammenführung von Künstlicher Intelligenz, Data Science, Software- und IT-Engineering definiert meine berufliche Vision. Ich glaube, dass dieser vernetzte Ansatz der Schlüssel zur Entwicklung bahnbrechender Lösungen und zur Erzielung nachhaltiger Wirkung ist.</p>
                            <p>Ich freue mich darauf, mich zu vernetzen und neue Möglichkeiten zu erkunden, bei denen datengestützte Erkenntnisse zu transformativen Möglichkeiten führen!</p>
                        </div>
                    @else
                        <div class="text-base lg:text-lg text-gray-800 dark:text-gray-200 leading-relaxed mb-10 font-medium drop-shadow-sm space-y-4">
                            <p>I am currently pursuing a Master's degree in Data Science at TU Freiberg, fueled by a deep passion for utilizing data to create impactful solutions.</p>
                            <p>My journey has led me to a position as a Working Student Senior Software Engineer, where I am eager to apply my expertise and contribute to image-based data coordination.</p>
                            <p>In addition, I have a strong interest in Artificial Intelligence and its vast potential. My goal is to specialize in this domain, leveraging my foundation in Data Science to uncover insights that enhance operational efficiency and drive strategic innovation.</p>
                            <p>Bringing together Artificial Intelligence, Data Science, Software, and IT Engineering defines my professional vision. I believe that this interconnected approach is the key to developing groundbreaking solutions and making a lasting difference.</p>
                            <p>I’d love to connect and explore new opportunities where data-driven insights lead to transformative possibilities!</p>
                        </div>
                    @endif

                    <!-- Work Experience Section -->
                    <div id="work" class="mb-16">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                            <span class="p-2 bg-orange-100 dark:bg-orange-900/40 rounded-lg text-orange-600 dark:text-orange-300 text-xl">💼</span>
                            {{ (session('app_locale') === 'de' || app()->getLocale() === 'de') ? 'Berufserfahrung' : 'Work Experience' }}
                        </h3>

                        <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-3.5 space-y-12 pb-4">

                            <!-- TU Bergakademie Freiberg -->
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 h-5 w-5 rounded-full border-4 border-white dark:border-gray-900 bg-orange-500"></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-baseline mb-1">
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">TU Bergakademie Freiberg</h4>
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-200">Part-time · 1 yr 5 mos</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Freiberg, Saxony, Germany</p>

                                <div class="space-y-8">
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Working Student AI Engineer</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">May 2025 – Present · 1 Year · On-site</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['Local LLMs', 'Agentic AI', 'Azure Data Factory', 'Azure Data Lake', 'Azure Databricks', 'Azure ML', 'Azure Data Warehouse', 'Microsoft Fabric'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Working Student Data Scientist</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">Jan 2025 – May 2025 · 5 mos · Hybrid</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['Deep Learning', 'NI LabVIEW'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Working Student Software Engineer</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">Sep 2024 – Dec 2024 · 4 mos · On-site</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['DBT', 'Kali Linux', 'Software Development', 'Snowflake', 'Deep Learning', 'NI LabVIEW'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SAPCO Company -->
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 h-5 w-5 rounded-full border-4 border-white dark:border-gray-900 bg-orange-500"></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-baseline mb-1">
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">SAPCO</h4>
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-200">Full-time · 1 yr 9 mos</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Tehran, Iran · On-site</p>

                                <div class="space-y-8">
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">AI Engineer</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">Sep 2022 – Sep 2023 · 1 yr 1 mo</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['Machine Learning', 'NLP', 'Responsible AI', 'Local LLMs', 'Generative AI', 'Deep Learning'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Data Scientist</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">Jan 2022 – Sep 2022 · 9 mos</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['Machine Learning', 'Power BI', 'Google Data Studio', 'Deep Learning', 'Python'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ApexTeam -->
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 h-5 w-5 rounded-full border-4 border-white dark:border-gray-900 bg-orange-500"></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-baseline mb-1">
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">ApexTeam</h4>
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-200">Part-time · 2 yrs 11 mos</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Karaj, Iran · Hybrid</p>

                                <div class="space-y-8">
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Data Scientist</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">May 2020 – Jan 2022 · 1 yr 9 mos</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['Data Analysis', 'Deep Learning', 'MySQL / PostgreSQL'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Software Engineer</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">Mar 2019 – May 2020 · 1 yr 3 mos</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['PHP', 'Laravel', 'Backend Development', 'Nginx'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Islamic Azad University -->
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 h-5 w-5 rounded-full border-4 border-white dark:border-gray-900 bg-orange-500"></div>
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-baseline mb-1">
                                    <h4 class="text-xl font-bold text-gray-900 dark:text-white">Islamic Azad University</h4>
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-200">Part-time · 6 mos</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">Karaj, Iran · On-site</p>

                                <div class="space-y-8">
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Research Assistant</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">Jan 2019 – Mar 2019 · 3 mos</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['IT Infrastructure', 'SQL', 'MySQL'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-1 pl-6">
                                        <div class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full bg-gray-400 dark:bg-orange-400"></div>
                                        <h5 class="font-semibold text-gray-900 dark:text-white">Teacher Assistant</h5>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-2">Oct 2018 – Dec 2018 · 3 mos</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(['SQL', 'PHP', 'Python'] as $skill)
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-white/10 text-gray-800 dark:text-white border border-gray-200 dark:border-white/20">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Education Section -->
                    <div id="education" class="mb-16">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                            <span class="p-2 bg-pink-100 dark:bg-pink-900/40 rounded-lg text-pink-600 dark:text-pink-300 text-xl">🎓</span>
                            Education
                        </h3>

                        <div class="relative border-l-2 border-gray-300 dark:border-gray-700 ml-3.5 space-y-10 pb-4">
                            <!-- TU Bergakademie Freiberg -->
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 h-5 w-5 rounded-full border-4 border-white dark:border-gray-900 bg-pink-500"></div>
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white">TU Bergakademie Freiberg</h4>
                                <p class="text-base font-medium text-gray-800 dark:text-gray-100 mt-1">Master's Degree – Data Science and Data Processing & AI Technology</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Oct 2023 – Present · Freiberg, Germany</p>
                                <p class="text-sm text-gray-700 dark:text-gray-200 mt-2"><strong class="text-gray-900 dark:text-white font-bold">Key Topics:</strong> Data Science, Machine Learning and +3 skills</p>
                            </div>

                            <!-- Islamic Azad University -->
                            <div class="relative pl-8">
                                <div class="absolute -left-[9px] top-1.5 h-5 w-5 rounded-full border-4 border-white dark:border-gray-900 bg-pink-500"></div>
                                <h4 class="text-xl font-bold text-gray-900 dark:text-white">Islamic Azad University</h4>
                                <p class="text-base font-medium text-gray-800 dark:text-gray-100 mt-1">Bachelor's Degree – Computer Engineering</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Oct 2018 – Apr 2023 · Karaj, Iran</p>
                                <p class="text-sm text-gray-700 dark:text-gray-200 mt-2"><strong class="text-gray-900 dark:text-white font-bold">Key Topics:</strong> Microsoft SQL Server, PostgreSQL and +9 skills</p>
                            </div>
                        </div>
                    </div>

                    <!-- Certificates Section -->
                    <div id="certificates" class="mb-16">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                            <span class="p-2 bg-blue-100 dark:bg-blue-900/40 rounded-lg text-blue-600 dark:text-blue-300 text-xl">📜</span>
                            Certificates
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php
                                $certs = [
                                    ['title' => 'Artificial Intelligence and Business Strategy', 'issuer' => 'Project Management Institute', 'date' => 'Issued July 2025', 'skills' => 'Business Strategy • AI for Business'],
                                    ['title' => 'AZ-900 Microsoft Azure Fundamentals', 'issuer' => 'Microsoft', 'date' => 'Issued July 2025', 'skills' => 'Azure Products • Microsoft Fabric • IAM • Cloud Compute • Storage • ML Studio'],
                                    ['title' => 'Microsoft Power BI Data Analyst Associate (PL-300)', 'issuer' => 'Microsoft', 'date' => 'Issued July 2025', 'skills' => 'Microsoft Fabric • Power BI • Linux • Python • ML • Data Science'],
                                    ['title' => 'AI with Python — CS50', 'issuer' => 'Harvard University', 'date' => 'Issued April 2024', 'skills' => 'SQL • Neural Networks • Search/Optimization'],
                                ];
                            @endphp
                            @foreach($certs as $cert)
                                <div class="ios-glass p-5 rounded-2xl border border-white/20 dark:border-white/10 hover:scale-[1.02] transition-transform duration-300 bg-white/40 dark:bg-black/40">
                                    <h5 class="font-bold text-gray-900 dark:text-white mb-1 text-base">{{ $cert['title'] }}</h5>
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $cert['issuer'] }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-300 mt-2 font-mono">{{ $cert['date'] }}</p>
                                    @if(isset($cert['skills']))
                                        <p class="text-xs text-gray-600 dark:text-gray-200 mt-2 pt-2 border-t border-gray-200 dark:border-white/15">
                                            <strong class="text-gray-900 dark:text-white font-bold">Skills:</strong>
                                            {{ $cert['skills'] }}
                                        </p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Skills Section -->
                    <div id="skills" class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                            <span class="p-2 bg-green-100 dark:bg-green-900/40 rounded-lg text-green-600 dark:text-green-300 text-xl">🛠️</span>
                            Skills
                        </h3>

                        @php
                            $skillCategories = [
                                'Industry Knowledge' => ['Data Science', 'Machine Learning', 'Data Analysis', 'Software Development', 'IT Infrastructure Management', 'Computer Networking', 'SEO'],
                                'Tools & Technologies' => ['AWS', 'Microsoft SQL Server', 'PostgreSQL', 'MySQL', 'Oracle Database', 'Power BI', 'Jupyter', 'Git', 'Docker', 'Nginx', 'Linux', 'Bash', 'PHP', 'Laravel', 'Kubernetes', 'Azure IOT', 'Azure ML', 'Azure DevOps', 'Azure Databricks', 'Azure Data Factory', 'Office Suite'],
                                'Data Science & AI' => ['Machine Learning', 'Deep Learning', 'Python', 'PyTorch', 'Scikit-learn', 'Matplotlib & Seaborn', 'Tableau'],
                                'Networking & Systems' => ['CompTIA Network+', 'MCSE: Server Infrastructure', 'Cisco Systems Products', 'Cisco CCNA SP']
                            ];
                        @endphp

                        <div class="space-y-8">
                            @foreach($skillCategories as $category => $skills)
                                <div>
                                    <h5 class="text-sm font-bold text-gray-700 dark:text-white uppercase tracking-wider mb-3 font-mono">
                                        {{ $category }}
                                    </h5>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($skills as $skill)
                                            <span class="px-3 py-1.5 rounded-lg text-xs font-medium bg-white/60 dark:bg-white/10 border border-gray-200 dark:border-white/20 text-gray-800 dark:text-white hover:bg-white dark:hover:bg-white/20 transition-colors cursor-default">
                                                {{ $skill }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </div>

    <!-- Taskbar & Mac Window Controls -->
    @include('taskbar')
    <script src="{{ asset('js/mac-window-controls.js') }}"></script>
</body>

</html>