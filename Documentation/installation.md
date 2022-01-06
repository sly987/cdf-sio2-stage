<h1>Notes personnelles</h1>
<br>
<h4>Prérequis laravel/github desktop sur ubuntu</h4>
sudo apt install php <br>
sudo apt install composer <br>
composer create-project --prefer-dist laravel/laravel nomduprojet 

sudo wget https://github.com/shiftkey/desktop/releases/download/release-2.9.3-linux3/GitHubDesktop-linux-2.9.3-linux3.deb <br>
sudo apt-get install gdebi-core <br>
sudo gdebi GitHubDesktop-linux-2.9.3-linux3.deb<br> <br>
Après clone, faire sudo apt install php-xml, composer update,composer install, cp .env.example .env, php artisan key:generate.<br>

<h4>Domaines Laravel</h4>
resource controller<br>
eloquent : https://laravel.com/docs/5.1/quickstart<br>
policies : https://laravel.com/docs/8.x/authorization<br>
notif : https://laravel.com/docs/8.x/notifications<br>
mail : https://laravel.com/docs/8.x/mail<br>
file storage = disque privé(no url) : https://laravel.com/docs/8.x/filesystem<br>
task scheduling : https://laravel.com/docs/5.1/scheduling<br>
css : https://laravel.com/docs/8.x/mix<br>
queues = mode sync(début), mode queue(deploiement) : https://laravel.com/docs/8.x/queues<br>
mailcatcher pour tester les envoie de mail<br><br>

déploiement sur docker<br>

<h4>Sources & Outils</h4>
Arborescence intéressante <br>
https://www.appvizer.fr/magazine/operations/gestion-de-projet/cahier-des-charges <br><br>
Exemple de cahier des charges <br>
https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fseraphin.legal%2Fwp-content%2Fuploads%2F2020%2F10%2FSeraphin.legal-Modele-de-cahier-des-charges-1.docx&wdOrigin=BROWSELINK <br><br>
Cloner correctement<br>
https://oshara.ca/fr/blog/comment-installer-une-application-web-laravel-que-vous-avez-clone-depuis-git<br><br>

<h5>Outils : Word(CDC), Mocodonline(MCD), Lucidchart(Arbre), Figma(Maquette), Github et GithubDesktop (Stockage et versioning du code), Laravel(Framework), Php(Langage)</h5>
