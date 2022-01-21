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

delimiter limite

create procedure fillMonth(anneeDebut bigint, anneeFin bigint)
Begin

set autocommit =0;
while anneeDebut<=anneeFin do
    set @i = 0;
    while @i <12 do
        insert into mois(id, annee_id) values(@i, anneeDebut);
        set @i = @i+1;
    end while;
set anneeDebut =anneeDebut +1;
end while;
End; limite 

delimiter ; limite
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

Installer mailcatcher correctement :<br>
sudo apt install ruby-full;
sudo apt-get install -y libsqlite3-dev;
sudo gem install mailcatcher

configurer mailcatcher
MAIL_HOST=localhost dans le .env<br>
aller sur 127.0.0.1:1080

pour active le systeme de fichiers publics : faire php artisan storage:link<br>

<h4>Sources & Outils</h4>
Arborescence intéressante <br>
https://www.appvizer.fr/magazine/operations/gestion-de-projet/cahier-des-charges <br><br>
Exemple de cahier des charges <br>
https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fseraphin.legal%2Fwp-content%2Fuploads%2F2020%2F10%2FSeraphin.legal-Modele-de-cahier-des-charges-1.docx&wdOrigin=BROWSELINK <br><br>
Cloner correctement<br>
https://oshara.ca/fr/blog/comment-installer-une-application-web-laravel-que-vous-avez-clone-depuis-git<br><br>
Radio edit & update<br>
https://laracasts.com/discuss/channels/laravel/edit-radio-button-value-coming-from-database<br>
excel import et export<br>
https://github.com/SpartnerNL/Laravel-Excel<br><br>
Formation complete<br>
https://www.youtube.com/watch?v=2TIHglVz9NQ<br><br>
Resource Controller<br>
https://www.youtube.com/watch?v=J5WBTUr0QBE<br><br>

Les emojis<br>
https://unicode.org/emoji/charts/full-emoji-list.html<br><br>


<h5>Outils : Word(CDC), Mocodonline(MCD), Lucidchart(Arbre), Wirecc(Maquette), Github et GithubDesktop (Stockage et versioning du code), Laravel(Framework), Php(Langage), Php namespace resolver, Laravel Snippets(VSExtensions)</h5>
