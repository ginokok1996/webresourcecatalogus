<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Organization;
use App\Entity\Slug;
use App\Entity\Style;
use App\Entity\Template;
use App\Entity\TemplateGroup;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ZuiddrechtFixtures extends Fixture
{
    private $params;
    /**
     * @var CommonGroundService
     */
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Zuid-Drecht
        $id = Uuid::fromString('4d1eded3-fbdf-438f-9536-8747dd8ab591');
        $organization = new Organization();
        $organization->setName('Zuid Drecht');
        $organization->setDescription('De meest inovatieve gemeenten van nederland');
        $organization->setRsin('809642451');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $favicon = new Image();
        $favicon->setName('Zuid-Drecht Favicon');
        $favicon->setBase64('data:image/svg+xml;base64,PHN2ZyBpZD0iw5HDq8Ouw6lfMSIgZGF0YS1uYW1lPSLDkcOrw67DqSAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MzkuNTcgMTA5OC44OSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMDA7fS5jbHMtMntmaWxsOiMzNjY5YTU7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT56dWlkIERyZWNodCBOb3BheW9mZjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTc2LDk2Ny4xMWMtNTYsNDEuMzktMTAxLjQzLDY2LjA1LTExMSw3MS4xMWE0LDQsMCwwLDEtMy43MiwwYy0yNS41Ny0xMy41LTMwNy40OC0xNjctMzYxLjM3LTQwNmE0LDQsMCwwLDEsNy4zOC0yLjgxYzM4LjU0LDY4LjkzLDEyNS4zNywxMTkuMjYsMTg3LjUxLDE1Mi42OSw1Mi41LDI4LjIzLDExMy42Miw1MC4yMSwxNjguMzQsODAuMzZDNTA4LjIyLDg4Ny4yOSw1NDksOTE3LjY5LDU3Nyw5NjEuNzVBNCw0LDAsMCwxLDU3Niw5NjcuMTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNODM0LjcxLDIxNS44NFYxMDEuNjVhOC45LDguOSwwLDAsMC04LjktOC45MWgtMjczQTE0LjU5LDE0LjU5LDAsMCwwLDUzOS40MywxMDNsLTE5LDcwLjI4YTE0LjU4LDE0LjU4LDAsMCwxLTEzLjM1LDEwLjIxSDM4M1YxNDcuMTJjMzYuODQtMS4zNCw2Mi40Mi03LjQ1LDgwLjE2LTE1LjEsMjkuNDktMTIuNzQsMzcuMzUtMjkuNzgsMzkuMzYtMzYuNDRhMi4yMiwyLjIyLDAsMCwwLTIuMTMtMi44NEgzMzQuNjFjLTMzLjg4LDAtNjcuOTEsOS4yLTg2LjA4LDQwLjEtMTkuMzgsMzIuOTQtMTguMjQsNzguMDctMTYuNDksMTE0Ljg5LDAsMC01MC02Ni4yMi00MC43Ni0xNDguODdhNS41MSw1LjUxLDAsMCwwLTUuNDgtNi4xMkgxMDAuMzJhOC43OSw4Ljc5LDAsMCwwLTguNzgsOC43OVYxMjRjNC44Niw3OS4yNiw0OS4xNCwyODguNTcsMzcxLjU4LDM4NS40QzczNSw1OTEuMDYsNzc1LjQyLDcxNi4zLDc4My4zMiw3MzguMjRhMS4zOCwxLjM4LDAsMCwwLDIuNTMuMTdjNzUuMy0xNDMuOS04MS40OS0yNDcuNTItODEuNDktMjQ3LjUyLDMxLjMzLDAsNzkuMjMsMTcuOTQsMTE4LDM5Ljc5YTguMjgsOC4yOCwwLDAsMCwxMi4zNy03LjIxVjM2My44M2ExNC42LDE0LjYsMCwwLDAtMTguMTUtMTQuMTdjLTEzLjUsMy4zOS0zMCw2LjY4LTMyLjg3LDcuMjMtMzkuNDYsNy43Ny04NC43NSwxMS4xNS0xMjItOC43M3MtNDcuMjYtNjYuMjctMTguMzMtOTguMjNjMjUuMy0yOCw2NS41My0zNy41LDEwMi4yOS0zNSwyMy41NiwxLjYyLDU1LjE4LDcuNTksNzMuNzEsMTIuNjNBMTIuMTYsMTIuMTYsMCwwLDAsODM0LjcxLDIxNS44NFoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik02NTQuODcsOTAxLjVhNCw0LDAsMCwxLTYtLjExYy0xMy41Ni0xNi4yNS03NS40Ni04Ni0xODUuNzMtMTQ2LjQyQTc1Ni40NCw3NTYuNDQsMCwwLDAsMzgzLDcxN2MtMTczLjUzLTcwLjE3LTI4Mi42OS0xNDMuMy0yOTEuNDItMzM4LjF2LTYuMjJhNCw0LDAsMCwxLDcuMjEtMi4zNGM2My42MSw4NywxNDQuNjksMTM3LjksMjQzLjE2LDE4Ni43Nyw0MC4yOCwyMCw4MS4xNywzNi4zMiwxMjEuMjEsNTMuMjUsNjYuMTUsMjgsMTMwLDU3LjU0LDE4NC43MywxMDcuOCwxNi4xOCwxNC44NSwyOS4wOSwyOS4xNSwzNi44MSw1MEM2OTUuNzUsNzk4LjEzLDcwMi41NSw4NDkuMTcsNjU0Ljg3LDkwMS41WiIvPjwvc3ZnPg==');
        $favicon->setDescription('Zuid-Drecht VNG');
        $favicon->setOrganization($organization);

        $id = Uuid::fromString('0e5b1531-4abb-4704-9bd3-feeb94717521');
        $newsimg = new Image();
        $newsimg->setName('news image');
        $newsimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/afbeeldingen/zuiddrecht_news.jpg', 'r')));
        $newsimg->setDescription('Zuid-Drecht news');
        $newsimg->setOrganization($organization);
        $manager->persist($newsimg);
        $newsimg->setId($id);
        $manager->persist($newsimg);
        $manager->flush();
        $newsimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('ff3ca823-234f-4874-9ee6-1067d47e4391');
        $headerimg = new Image();
        $headerimg->setName('header image');
        $headerimg->setBase64(base64_encode(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/afbeeldingen/zuiddrecht_header.jpg', 'r')));
        $headerimg->setDescription('Zuid-Drecht header');
        $headerimg->setOrganization($organization);
        $manager->persist($headerimg);
        $headerimg->setId($id);
        $manager->persist($headerimg);
        $manager->flush();
        $headerimg = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $logo = new Image();
        $logo->setName('Zuid-Drecht Logo');
        $logo->setDescription('Zuid-Drecht VNG');
        $logo->setOrganization($organization);

        $style = new Style();
        $style->setName('Zuid-Drecht');
        $style->setDescription('Huistlijl samenwerkingsverband West-Friesland');
        $style->setCss(':root {--primary: #CC0000;--primary2: white;--secondary: #3669A5;--secondary2: #FFC926;}
        .main-title {color: var(--primary2) !important;}.logo-header {background: var(--primary);}.navbar-header
        {background: var(--primary);}.bg-primary-gradient {background: linear-gradient(-45deg, var(--secondary),
         var(--secondary2)) !important;}

        a {
            text-decoration: none;
        }

        a:focus:not(.btn):not(.pagination__link):not(.nav__link){
            background: #3669A5;
            outline: none;
        }

        .headerImage {
            margin-top: -20px;
            height: 500px;
            background: none;
            background-size: cover !important;
            background-position: center !important;

        }

        .newsImage {
            display: none;
            margin-top: 50px;
            padding: 25px;
            margin-bottom: -50px;
            background: none;
            background-size: cover !important;
            background-position: center !important;
            }

        #news-1, #news-2, #news-3, #news-4 {
            display: none;
        }

        @media only screen and (min-width: 600px){

            .newsImage {
                display: block;
                margin-top: 50px;
                padding: 25px;
                margin-bottom: -50px;
                background: none;
                background-size: cover !important;
                background-position: center !important;
            }

            #news-1, #news-2 {
                display: block;
            }
        }

        @media only screen and (min-width: 900px){
            #news-3 {
                display: block;
            }
        }

        @media only screen and (min-width: 1200px){
            #news-4 {
                display: block;
            }
        }





        @media only screen and (min-width: 1376px){
            .headerImage {
                margin-top: -20px;
                height: 500px;
                background: none;
                background-size: 100% auto !important;
                background-position: center !important;
            }

            .newsImage {
                margin-top: 35px;
                padding: 25px;
                margin-bottom: -50px;
                background: none;
                background-size: 100% auto !important;
                background-position: center !important;
            }
        }

        .processen ul {
            clear: left;
            padding: 0 .5em
        }

        @media only screen and (min-width: 35em) {
            .processen ul {
                padding:0
            }

            .processen ul li {
                width: 32%;
                float: left;
                margin-right: 2%
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul {
                padding-right: .8em;
            }

            .processen ul li {
                width: 19%;
                float: left;
                margin-right: 1.25%
            }
        }

        .processen ul li {
            list-style: none;
            margin-top: 0;
            margin-bottom: .6em;
            padding: 0;
            background-image: none
        }

        @media only screen and (min-width: 35em) {
            ,.processen ul li:nth-child(3n) {
                margin-right:0
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul li:nth-child(3n) {
                margin-right:1.25%
            }

            .processen ul li:nth-child(5n) {
                margin-right: 0
            }

            .processen:after {
                display: none
            }

            .processen ul {
                width: 66.67%;
                float: left
            }
        }

        .processen ul li{
            background-image: none;
            padding-left: 0
        }

        @media only screen and (min-width: 35em) {
            .processen ul li {
                width:48%
            }

            .processen {
                margin-left: 17px;
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul li {
                width:32%;
                float: left;
                margin-bottom: .8em;
                margin-right: 2%

            }

            .processen {
            margin-left: 0px;
            }
        }

        @media only screen and (min-width: 35em) {
            .processen ul li:nth-child(2n) {
                margin-right:0
            }
        }

        @media only screen and (min-width: 60em) {
            .processen ul li:nth-child(2n) {
                margin-right:2%
            }

            .processen ul li:nth-child(3n) {
                margin-right: 0
            }

            .processen ul li:nth-child(5n) {
                margin-right: 2%
            }

            .processen a {
                min-height: 10.2em
            }
        }

        .processen {
            margin: 0 -1.2em
            margin-top: 25px;
        }

        @media only screen and (min-width: 35em) {
            .processen li:nth-child(3n) {
                margin-right:2%
            }
        }

        @media only screen and (min-width: 60em) {
            ..processen li:nth-child(3n) {
                margin-right:0
            }
        }

        .processen ul {
            margin-top: 0;
            margin-left: 0;
        }

        .processen a {
            display: block;
            text-align: center;
            position: relative;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: #CC0000;
            color: #FFF;
            text-decoration: none;
        }

        .processen a:hover {
            background-color: #3669A5;
            border-color: #3669A5;
            transform: scale(1.02)
        }

        .processen a span {
            font-size: 1.25em
        }

        @media only screen and (min-width: 35em) {
            .processen a {
                padding:2.5em .75em .75em;
                min-height: 9em
            }

            .processen a span {
                font-size: 1.125em;
                line-height: 1.2
            }
        }


        .header-logo a:after{
            background-image: none;
        }

        .flex-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footerStyle {
            background-color: #3669A5;
            color: white;
        }

        .top-nav-autoresize .nav__link:hover {
            background-color: #3669A5;
        }

        .menuStyle {
            background-color: #CC0000;
            color: white;
        }

        .newsCard {
        margin: 10px auto;
        width: 240px;
        background-color: white;
        padding: 15px;
        height:400px;
        }

        .contact {
        background-color: #3669A5;
        float:left;
        width: 100%;
        color: white;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        margin-left: 5px;
        }

        @media only screen and (min-width: 960px) {
            .contact {
                background-color: #3669A5;
                float:left;
                width: 33%;
                color: white;
                padding-left: 10px;
                padding-right: 10px;
                padding-top: 10px;
                margin-left: 0px;
            }
        }

        .header-logo a:before {
        background: url("data:image/svg+xml;base64,PHN2ZyBpZD0iw5HDq8Ouw6lfMSIgZGF0YS1uYW1lPSLDkcOrw67DqSAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA5MzkuNTcgMTA5OC44OSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNjMDA7fS5jbHMtMntmaWxsOiMzNjY5YTU7fTwvc3R5bGU+PC9kZWZzPjx0aXRsZT56dWlkIERyZWNodCBOb3BheW9mZjwvdGl0bGU+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNNTc2LDk2Ny4xMWMtNTYsNDEuMzktMTAxLjQzLDY2LjA1LTExMSw3MS4xMWE0LDQsMCwwLDEtMy43MiwwYy0yNS41Ny0xMy41LTMwNy40OC0xNjctMzYxLjM3LTQwNmE0LDQsMCwwLDEsNy4zOC0yLjgxYzM4LjU0LDY4LjkzLDEyNS4zNywxMTkuMjYsMTg3LjUxLDE1Mi42OSw1Mi41LDI4LjIzLDExMy42Miw1MC4yMSwxNjguMzQsODAuMzZDNTA4LjIyLDg4Ny4yOSw1NDksOTE3LjY5LDU3Nyw5NjEuNzVBNCw0LDAsMCwxLDU3Niw5NjcuMTFaIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNODM0LjcxLDIxNS44NFYxMDEuNjVhOC45LDguOSwwLDAsMC04LjktOC45MWgtMjczQTE0LjU5LDE0LjU5LDAsMCwwLDUzOS40MywxMDNsLTE5LDcwLjI4YTE0LjU4LDE0LjU4LDAsMCwxLTEzLjM1LDEwLjIxSDM4M1YxNDcuMTJjMzYuODQtMS4zNCw2Mi40Mi03LjQ1LDgwLjE2LTE1LjEsMjkuNDktMTIuNzQsMzcuMzUtMjkuNzgsMzkuMzYtMzYuNDRhMi4yMiwyLjIyLDAsMCwwLTIuMTMtMi44NEgzMzQuNjFjLTMzLjg4LDAtNjcuOTEsOS4yLTg2LjA4LDQwLjEtMTkuMzgsMzIuOTQtMTguMjQsNzguMDctMTYuNDksMTE0Ljg5LDAsMC01MC02Ni4yMi00MC43Ni0xNDguODdhNS41MSw1LjUxLDAsMCwwLTUuNDgtNi4xMkgxMDAuMzJhOC43OSw4Ljc5LDAsMCwwLTguNzgsOC43OVYxMjRjNC44Niw3OS4yNiw0OS4xNCwyODguNTcsMzcxLjU4LDM4NS40QzczNSw1OTEuMDYsNzc1LjQyLDcxNi4zLDc4My4zMiw3MzguMjRhMS4zOCwxLjM4LDAsMCwwLDIuNTMuMTdjNzUuMy0xNDMuOS04MS40OS0yNDcuNTItODEuNDktMjQ3LjUyLDMxLjMzLDAsNzkuMjMsMTcuOTQsMTE4LDM5Ljc5YTguMjgsOC4yOCwwLDAsMCwxMi4zNy03LjIxVjM2My44M2ExNC42LDE0LjYsMCwwLDAtMTguMTUtMTQuMTdjLTEzLjUsMy4zOS0zMCw2LjY4LTMyLjg3LDcuMjMtMzkuNDYsNy43Ny04NC43NSwxMS4xNS0xMjItOC43M3MtNDcuMjYtNjYuMjctMTguMzMtOTguMjNjMjUuMy0yOCw2NS41My0zNy41LDEwMi4yOS0zNSwyMy41NiwxLjYyLDU1LjE4LDcuNTksNzMuNzEsMTIuNjNBMTIuMTYsMTIuMTYsMCwwLDAsODM0LjcxLDIxNS44NFoiLz48cGF0aCBjbGFzcz0iY2xzLTIiIGQ9Ik02NTQuODcsOTAxLjVhNCw0LDAsMCwxLTYtLjExYy0xMy41Ni0xNi4yNS03NS40Ni04Ni0xODUuNzMtMTQ2LjQyQTc1Ni40NCw3NTYuNDQsMCwwLDAsMzgzLDcxN2MtMTczLjUzLTcwLjE3LTI4Mi42OS0xNDMuMy0yOTEuNDItMzM4LjF2LTYuMjJhNCw0LDAsMCwxLDcuMjEtMi4zNGM2My42MSw4NywxNDQuNjksMTM3LjksMjQzLjE2LDE4Ni43Nyw0MC4yOCwyMCw4MS4xNywzNi4zMiwxMjEuMjEsNTMuMjUsNjYuMTUsMjgsMTMwLDU3LjU0LDE4NC43MywxMDcuOCwxNi4xOCwxNC44NSwyOS4wOSwyOS4xNSwzNi44MSw1MEM2OTUuNzUsNzk4LjEzLDcwMi41NSw4NDkuMTcsNjU0Ljg3LDkwMS41WiIvPjwvc3ZnPg==") no-repeat bottom;
        background-size: 120%;
        content: ;
        left:  0;
        position: absolute;
        top: 0;}

        .footer3, .footer4 {
        display: none;
        }

        @media only screen and (min-width: 767px) {
            .footer3 {
                display: block;
            }
        }

        @media only screen and (min-width: 992px) {
            .footer4 {
                display: block;
            }
        }

        .challenge-card-picture {
            display: none;
        }

        @media only screen and (min-width: 1205px) {
            .challenge-card-picture {
                display: block;
            }
        }

        .calendarSelect {
            border: none;
            background-color: white;
            width: 70px;
        }

        @media only screen and (min-width: 990px) {
            .calendarSelect{
                width: 100%;
            }
        }

        .progressbar {
            background-color: grey;
            padding: 3px;
            position: relative;
            text-align: center;
        }

        .progressbar>div {
            background-color: #148839;
            width: 0%;
            height: 20px;
        }

        .progressbar>p {
            position: absolute;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            color: white;
        }
        ');

        $style->setfavicon($favicon);
        $style->setOrganization($organization);

        $manager->persist($organization);
        $manager->persist($favicon);
        $manager->persist($logo);
        $manager->persist($style);

        $manager->flush();

        // Website
        $id = Uuid::fromString('1163e443-5f9c-4aa6-802c-c619a14986c9');
        $application = new Application();
        $application->setName('Dashboard');
        $application->setDescription('het Dashboard van de gemeente zuid-drecht');
        $application->setDomain('db.zuid-drecht.nl');
        $application->setOrganization($organization);
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Website
        $id = Uuid::fromString('1ef30b69-6b28-4fbd-a0cd-83d6ff3c505e');
        $application = new Application();
        $application->setName('Zuid-Drecht');
        $application->setDescription('De website van de gemeente zuid-drecht');
        $application->setDomain('zuid-drecht.nl');
        $application->setOrganization($organization);
        $application->setStyle($style);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie
        $configuration = new Configuration();
        $configuration->setName('Website');
        $configuration->setDescription('De website van de gemeente zuid-drecht');
        $configuration->setOrganization($organization);
        $configuration->setApplication($application);
        $configuration->setConfiguration(
            [
                'mainMenu'          => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'ca1ca0b4-4c8f-4638-9869-16974426e3df']),
                'home'              => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'163f8616-abb7-411d-b7b2-0d11c6bd7dca']),
                'footer1'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'0dca3fd2-0124-46fb-88c1-4f0860b2888c']),
                'footer2'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'68003cd6-7729-4807-af24-d58a1dfe0870']),
                'footer3'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'facad633-27a9-499a-b3fc-4687215bf82a']),
                'footer4'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'4bc966b6-e310-4bce-b459-a7cf65651ce0']),
                'nieuws'            => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'template_groups', 'id'=>'5c59f238-1ce3-4c8d-8107-4bd8e2134648']),
                'newsimg'           => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'0e5b1531-4abb-4704-9bd3-feeb94717521']),
                'headerimg'         => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'images', 'id'=>'ff3ca823-234f-4874-9ee6-1067d47e4391']),
                'colorSchemeFooter' => 'footerStyle',
                'colorSchemeMenu'   => 'menuStyle', ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('ca1ca0b4-4c8f-4638-9869-16974426e3df');
        $menu = new Menu();
        $menu->setName('Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Zelf regelen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(4);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Ondernemers');
        $menuItem->setDescription('Lijst van ondernemers');
        $menuItem->setOrder(3);
        $menuItem->setType('slug');
        $menuItem->setHref('/ondernemers');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Nieuws');
        $menuItem->setDescription('Nieuws overzicht');
        $menuItem->setOrder(2);
        $menuItem->setType('slug');
        $menuItem->setHref('/nieuwsoverzicht');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        $menuItem = new MenuItem();
        $menuItem->setName('Home');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/home');
        $menuItem->setMenu($menu);
        $manager->persist($menuItem);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organization);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('163f8616-abb7-411d-b7b2-0d11c6bd7dca');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('Zuid drecht home page');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $id = Uuid::fromString('fc5cef2d-c64d-4cfc-ac8c-da0ea0c66063');
        $template = new Template();
        $template->setName('SubPage');
        $template->setDescription('tijdelijke subpage');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/subpage.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('subpage');
        $slug->setSlug('subpage');
        $manager->persist($slug);

        $id = Uuid::fromString('0dca3fd2-0124-46fb-88c1-4f0860b2888c');
        $template = new Template();
        $template->setName('footer1');
        $template->setDescription('footer1');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer1.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('68003cd6-7729-4807-af24-d58a1dfe0870');
        $template = new Template();
        $template->setName('footer2');
        $template->setDescription('footer2');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer2.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('facad633-27a9-499a-b3fc-4687215bf82a');
        $template = new Template();
        $template->setName('footer3');
        $template->setDescription('footer3');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer3.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('4bc966b6-e310-4bce-b459-a7cf65651ce0');
        $template = new Template();
        $template->setName('footer4');
        $template->setDescription('footer4');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/footer4.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $id = Uuid::fromString('42594401-3db2-42c5-b06a-0b6d5eaeb8c2');
        $template = new Template();
        $template->setName('nieuwsoverzicht');
        $template->setDescription('nieuwsoverzicht');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/nieuwsoverzicht.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('nieuwsoverzicht');
        $slug->setSlug('nieuwsoverzicht');
        $manager->persist($slug);

        $id = Uuid::fromString('bc227e94-e542-4623-a88b-ca9f74c52bf8');
        $template = new Template();
        $template->setName('cookies');
        $template->setDescription('cookies');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/cookies.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('cookies');
        $slug->setSlug('cookies');
        $manager->persist($slug);

        $id = Uuid::fromString('bdcd7f74-2407-4ca2-b89a-9fcb33ab6b1f');
        $template = new Template();
        $template->setName('proclaimer');
        $template->setDescription('proclaimer');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/proclaimer.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('proclaimer');
        $slug->setSlug('proclaimer');
        $manager->persist($slug);

        $id = Uuid::fromString('a8fe7cc7-d358-4081-8597-cd21ae87c295');
        $template = new Template();
        $template->setName('article');
        $template->setDescription('article');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/article.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('article');
        $slug->setSlug('article');
        $manager->persist($slug);

        $id = Uuid::fromString('70dd6462-85ef-45f4-b9dc-57eb9ac56646');
        $template = new Template();
        $template->setName('privacy');
        $template->setDescription('privacy');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/privacy.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('privacy');
        $slug->setSlug('privacy');
        $manager->persist($slug);

        $id = Uuid::fromString('16da42d1-4be6-499d-8a82-94acde4eac25');
        $template = new Template();
        $template->setName('pitches');
        $template->setDescription('pitches');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/pitches.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('pitches');
        $slug->setSlug('pitches');
        $manager->persist($slug);

        $id = Uuid::fromString('5c2164ad-b696-403c-999e-bc3ca92dd30a');
        $template = new Template();
        $template->setName('pitch');
        $template->setDescription('pitch');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/pitch.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('pitch');
        $slug->setSlug('pitch');
        $manager->persist($slug);

        $id = Uuid::fromString('eec83f6b-602e-4f72-94ce-f5d3870dd61b');
        $template = new Template();
        $template->setName('challenges');
        $template->setDescription('challenges');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/challenges.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('challenges');
        $slug->setSlug('challenges');
        $manager->persist($slug);

        $id = Uuid::fromString('8ca36a4e-8d4a-4fd7-a7c6-b7a87de1c379');
        $template = new Template();
        $template->setName('challenge');
        $template->setDescription('challenge');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/challenge.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('challenge');
        $slug->setSlug('challenge');
        $manager->persist($slug);

        $id = Uuid::fromString('efb8eb07-1bea-4946-b160-e7e4198194c6');
        $template = new Template();
        $template->setName('proposal');
        $template->setDescription('proposal');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/proposal.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('proposal');
        $slug->setSlug('proposal');
        $manager->persist($slug);

        $id = Uuid::fromString('93a13fa8-d81b-4e37-9fef-8320af96d0db');
        $template = new Template();
        $template->setName('deal');
        $template->setDescription('deal');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/proposal.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('deal');
        $slug->setSlug('deal');
        $manager->persist($slug);

        $id = Uuid::fromString('03e7b509-9868-40d3-9ecf-5ef725be99e5');
        $template = new Template();
        $template->setName('question');
        $template->setDescription('question');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/question.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('question');
        $slug->setSlug('question');
        $manager->persist($slug);

        $id = Uuid::fromString('71e84ed8-607a-4825-8240-695055be1e20');
        $template = new Template();
        $template->setName('new-pitch');
        $template->setDescription('new-pitch');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/new-pitch.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('new-pitch');
        $slug->setSlug('new-pitch');
        $manager->persist($slug);

        // Template groups
        $id = Uuid::fromString('5c59f238-1ce3-4c8d-8107-4bd8e2134648');
        $groupNews = new TemplateGroup();
        $groupNews->setOrganization($organization);
        $groupNews->setApplication($application);
        $groupNews->setName('Nieuws');
        $groupNews->setDescription('Webpages about news articles');
        $manager->persist($groupNews);
        $groupNews->setId($id);
        $manager->persist($groupNews);
        $manager->flush();
        $groupNews = $manager->getRepository('App:TemplateGroup')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('0ace23c9-3c95-4675-994c-596b9ef0144b');
        $template = new Template();
        $template->setName('pi event');
        $template->setTitle('pi event is van start');
        $template->setDescription('Het Pi event is eindelijk van start! In dit event gaan verschillende gemeentes hun nieuwe platformen tonen.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/pi-event.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $date = new \DateTime();
        $date->sub(new \DateInterval('P2D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('pi-event');
        $slug->setSlug('pi-event');
        $manager->persist($slug);

        $id = Uuid::fromString('67b1e403-4436-4cd9-a328-ce99e05511a1');
        $template = new Template();
        $template->setName('huwelijksplanner');
        $template->setTitle('Zuid drecht lanceert huwelijksplanner');
        $template->setDescription('De gemeente Zuid drecht heeft in samenwerking met het bedrijf Conduction een huwelijksplanner gelanceerd. Dit project is in leven gebracht om het aanvragen van een huwelijk een fijne en soepele ervaring te maken.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/huwelijksplanner.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P4D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('huwelijksplanner');
        $slug->setSlug('huwelijksplanner');
        $manager->persist($slug);

        $id = Uuid::fromString('90035899-fd96-4998-9d38-db7b0f5940f9');
        $template = new Template();
        $template->setName('corona');
        $template->setTitle('Corona maatregelen in Zuid-drecht');
        $template->setDescription('De corona maatregelingen worden per 1 Juli versoepeld in de gemeente Zuid drecht. De cijfers blijken dusdanig te dalen in deze gemeente dat er weer steeds meer mogenlijk is.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/corona.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P1D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('corona');
        $slug->setSlug('corona');
        $manager->persist($slug);

        $id = Uuid::fromString('12f475a7-151c-48b6-8b02-0e0dfcfc78d9');
        $template = new Template();
        $template->setName('groene stroom');
        $template->setTitle('zuid-drecht gaat over op groene stroom');
        $template->setDescription('De gemeente is sinds vandaag helemaal over op groene stroom. Dit is een heel groot project geweest maar het is de gemeente Zuid drecht gelukt om in iets minder dan een jaar compleet over te gaan op groene stroom.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/groene-stroom.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P3D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('groene-stroom');
        $slug->setSlug('groene-stroom');
        $manager->persist($slug);

        $id = Uuid::fromString('272a5076-dfb0-4adf-b5ca-d3525e7a31bf');
        $template = new Template();
        $template->setName('Woninginbraak gehalveerd');
        $template->setTitle('Woninginbraak gehalveerd in de gemeente zuid-drecht');
        $template->setDescription('Woning inbraken lijken steeds minder voor te komen in de gemeente Zuid drecht. Uit cijfers blijkt dat dit vergeleken vorig jaar alweer met 50% is gedaald.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/woning-inbraak.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('woning-inbraak');
        $slug->setSlug('woning-inbraak');
        $manager->persist($slug);

        $id = Uuid::fromString('6d38b11f-2edb-4a4e-894a-5b4677da2c53');
        $template = new Template();
        $template->setName('Beste gemeente');
        $template->setTitle('Zuid-drecht is uitgeroepen tot beste gemeente van 2020');
        $template->setDescription('De jaarlijkse prijs uitreiking voor de beste gemeente van het jaar is weer voorbij. Dit jaar hebben we als winnaar de nog best jonge gemeente Zuid drecht.');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/website/nieuws/beste-gemeente.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $date = new \DateTime();
        $date->sub(new \DateInterval('P5D'));
        $template->setDateCreated($date);
        $template->setDateModified($date);
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupNews);
        $manager->persist($template);
        $manager->flush();

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('beste-gemeente');
        $slug->setSlug('beste-gemeente');
        $manager->persist($slug);

        // Mijn Zuid Decht
        $id = Uuid::fromString('64f60afd-7506-48e0-928b-6bbede045812');
        $application = new Application();
        $application->setName('Mijn Zuidrecht');
        $application->setDescription('Het burgerportaal van de gemeente zuiddrecht');
        $application->setDomain('mijn.zuid-drecht.nl');
        $application->setOrganization($organization);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Configuratie van Begrafenisplanner
        $configuration = new Configuration();
        $configuration->setOrganization($organization);
        $configuration->setApplication($application);
        $configuration->setConfiguration(
            [
                'mainMenu'=> $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'menus', 'id'=>'350156d4-4eca-4bec-bc48-c906f20d2bda']),
                'home'    => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'f62792c9-d229-43b9-8f6a-3b368eee6739']),
            ]
        );
        $manager->persist($configuration);

        // Menu
        $id = Uuid::fromString('350156d4-4eca-4bec-bc48-c906f20d2bda');
        $menu = new Menu();
        $menu->setName('Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setName('Processen');
        $menuItem->setDescription('Doe een aanvraag');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/process');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        $menuItem = new MenuItem();
        $menuItem->setName('Verzoeken');
        $menuItem->setDescription('Het inzien en voortzetten van mijn verzoeken');
        $menuItem->setOrder(1);
        $menuItem->setType('slug');
        $menuItem->setHref('/requests');
        $menuItem->setMenu($menu);
        $manager->persist($menu);

        // Template groups
        $groupPages = new TemplateGroup();
        $groupPages->setOrganization($organization);
        $groupPages->setApplication($application);
        $groupPages->setName('Pages');
        $groupPages->setDescription('Webpages that are presented to visitors');
        $manager->persist($groupPages);

        // Pages
        $id = Uuid::fromString('f62792c9-d229-43b9-8f6a-3b368eee6739');
        $template = new Template();
        $template->setName('Home');
        $template->setDescription('De (web) applicatie waarop begravenisen kunnen worden doorgegeven');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/Zuiddrecht/mijnzuiddrecht/index.html.twig', 'r'));
        $template->setTemplateEngine('twig');
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $template->addTemplateGroup($groupPages);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);

        $manager->flush();
    }
}
