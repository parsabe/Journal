<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\SchemaOrg\Schema; // 1. ADD THIS IMPORT HERE!

class PageController extends Controller
{
    public function home()
    {
        // 1. Build your personal data (with the email fixed!)
        $personData = Schema::person()
            ->name('Parsa Besharat')
            ->url(url('/'))
            ->jobTitle('Researcher - AI Engineer')
            ->email('parsa.besharat@student.tu-freiberg.de')
            ->affiliation(
                Schema::organization()->name('TU Bergakademie Freiberg')
            )
            ->sameAs([
                'https://www.linkedin.com/in/parsabe',
                'https://github.com/parsabe',
                'https://researchgate.net/profile/Parsa-Besharat'
            ]);

        // 2. Wrap it all in the ProfilePage schema so Google Rich Results accepts it
        $profileSchema = Schema::profilePage()
            ->mainEntity($personData);

        $author = [
            'name' => 'Parsa Besharat',
            'title' => 'AI Researcher • Data Scientist • Architect',
            'website' => 'https://parsabe.com',
            'avatar' => asset('images/profile.jpg'),
        ];

        $sections = [
            [
                'step' => 0,
                'id' => 'overview',
                'title' => '00 OVERVIEW',
                'badge' => 'SPACETIME METRIC // SCHWARZSCHILD & KERR',
                'desc' => 'Interactive 5D spacetime singularity simulation modeling relativistic gravitational collapse, geodesic trajectories, and dimensional projection.'
            ],
            [
                'step' => 1,
                'id' => 'about',
                'title' => '01 ABOUT',
                'badge' => 'ARCHITECT DOSSIER // PARSA BESHARAT',
                'desc' => 'Researcher in Artificial Intelligence, Deep Learning architectures, and relativistic physics modeling. Creator of high-dimensional neural visualizations.'
            ],
            [
                'step' => 2,
                'id' => 'projects',
                'title' => '02 PROJECTS',
                'badge' => 'RESEARCH & ENGINEERING SYSTEMS',
                'desc' => 'AquaPulse neural vision telemetry, Vectra Gaussian framework, BlackWall safeguards, and real-time spacetime simulation.'
            ],
            [
                'step' => 3,
                'id' => 'publications',
                'title' => '03 PUBLICATIONS',
                'badge' => 'SCIENTIFIC PAPERS & MANUSCRIPTS',
                'desc' => 'Peer-reviewed research and mathematical formulations on higher-dimensional embeddings and spacetime manifolds.'
            ],
            [
                'step' => 4,
                'id' => 'playlist',
                'title' => '04 MY PLAYLIST',
                'badge' => 'TRANSMISSION ACOUSTICS',
                'desc' => 'Hans Zimmer - Interstellar Organ Variations, ambient sub-bass spacetime drones, and cosmic minimalist compositions.'
            ],
            [
                'step' => 5,
                'id' => 'books',
                'title' => '05 FAVORITE BOOKS',
                'badge' => 'KNOWLEDGE REPOSITORY',
                'desc' => 'The Science of Interstellar, Sapiens, Life 3.0, and foundation texts in computational cosmology.'
            ],
            [
                'step' => 6,
                'id' => 'contact',
                'title' => '06 CONTACT',
                'badge' => 'QUANTUM COMMUNICATIONS LINK',
                'desc' => 'Direct comms uplink to Parsa Besharat via parsabe.com, academic correspondence, and collaborative research.'
            ],
        ];

        $soundtrack = [
            'track' => 'Organ Variation',
            'composer' => 'Hans Zimmer',
            'album' => 'Interstellar (Original Motion Picture Soundtrack) [Expanded Edition]',
            'label' => 'WaterTower Music / Warner Bros. Entertainment Inc.',
            'year' => 2014,
            'copyright' => '℗ & © 2014 WaterTower Music. All Rights Reserved.',
            'publishing' => 'Warner-Olive Music, LLC (ASCAP) / Paramount Allegra Music (ASCAP)',
            'fair_use_notice' => 'Featured for educational, personal portfolio showcase, and tribute demonstration purposes under fair use doctrine. All rights, master sound recording copyrights, and publishing rights reside with Hans Zimmer, WaterTower Music, and Warner Bros. Pictures.',
            'official_stream_url' => 'https://www.watertowermusic.com/releases/interstellar/'
        ];

        // 3. Pass the schema and singularity parameters to home view
        return view('home', compact('profileSchema', 'author', 'sections', 'soundtrack'));
    }





    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact');
    }

    public function projects()
    {
        return view('pages.projects');
    }
    public function vectra()
    {
        return view('pages.projects.vectra');
    }
    public function vectra_pc_game()
    {
        return view('pages.projects.vectra-pc-game');
    }
    public function BlackWall()
    {
        return view('pages.projects.blackwall');
    }
    public function Mlmatrix()
    {
        return view('pages.projects.mlmatrix');
    }
    public function SCP()
    {
        return view('pages.projects.scp');
    }

    public function CeasarToolkit()
    {
        return view('pages.projects.ceasartoolkit');
    }

    public function parsai()
    {
        return view('pages.projects.parsai');
    }

    public function netnexus()
    {
        return view('pages.projects.netnexus');
    }

    public function hounaartoolkit()
    {
        return view('pages.projects.hounaartoolkit');
    }
    public function proj_sandika()
    {
        return view('pages.projects.sandika');
    }

    public function funroot()
    {
        return view('pages.projects.funroot');
    }

    public function aquapulse()
    {
        return view('pages.projects.aquapulse');
    }







    public function publications()
    {
        return view('pages.publications');
    }
    public function vectra_paper()
    {
        return view('pages.publications.vectra_paper');
    }
    public function blackwall_paper()
    {
        return view('pages.publications.blackwall_paper');
    }

    public function moodium()
    {
        return view('pages.publications.moodium');
    }

    public function scm()
    {
        return view('pages.publications.scm');
    }

    public function captcha()
    {
        return view('pages.publications.captcha');
    }
    public function ai_blockchain()
    {
        return view('pages.publications.ai-blockchain');
    }
    public function synergy_blockchain()
    {
        return view('pages.publications.synergy-blockchain');
    }
    public function php_vuls()
    {
        return view('pages.publications.php-vuls');
    }
    public function crm()
    {
        return view('pages.publications.crm');
    }
    public function qca()
    {
        return view('pages.publications.qca');
    }

    public function aquapulse_paper()
    {
        return view('pages.publications.aquapulse');
    }


    public function myplaylist()
    {
        return view('pages.myplaylist');
    }

    public function search()
    {
        return view('pages.search');
    }

    public function VPN_server()
    {
        return view('pages.vpn');
    }


    public function fun()
    {
        return view('pages.club');
    }

    public function support()
    {
        return view('pages.support');
    }

    public function nigma()
    {
        return view('pages.nigma.nigma');
    }
    public function chat()
    {
        return view('pages.chat.chat');
    }
    public function books()
    {
        return view('pages.books');
    }
    public function sandika()
    {
        return view('pages.sandika.sandika');
    }



    public function blog()
    {
        $posts = \App\Models\BlogPost::with('author')
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return view('pages.blog', compact('posts'));
    }
}
