Symfony
=======
Petit projet de gestion de bibliotheque (réservations, emprunts) avec Symfony
# g2_ms_bibliotheque
Memo of some useful commands:
Git:
git branch develop
git checkout develop
git branch --set-upstream-to=origin/develop develop # connecter branche locale et distante
# effacer et recréer la branche distante
git push origin :develop
git branch
git push origin develop:develop


- Manage database schema:
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force

- Doctrine cache:
php bin/console doctrine:cache:delete

- Generate entities:
bin/console doctrine:generate:entities OCPlatformBundle:Advert

-Dql request example:
php bin/console doctrine:query:dql "SELECT l FROM MSGestionBibliothequeBundle:Livre l WHERE l.id < 2"
php bin/console doctrine:query:dql "SELECT l FROM MSGestionBibliothequeBundle:Livre l JOIN l.auteur a"

- Load fixtures:
php bin/console hautelook:fixtures:load -b MSGestionBibliothequeBundle
php bin/console doctrine:fixtures:load --fixtures=/var/www/html/g2_ms_bibliotheque/src/MS/GestionBibliothequeBundle/DataFixtures/ORM/LoadDummy.php
php bin/console doctrine:fixtures:load --append --fixtures=/var/www/html/g2_ms_bibliotheque/src/MS/GestionBibliothequeBundle/DataFixtures/ORM/LoadExemplaire.php
php bin/console doctrine:fixtures:load --append --fixtures=/c/wamp64/www/g2_ms_bibliotheque/src/MS/GestionBibliothequeBundle/DataFixtures/ORM
/LoadExemplaire.php
php bin/console doctrine:fixtures:load --append --fixtures=/var/www/html/g2_ms_bibliotheque/src/OC/PlatformBundle/DataFixtures/ORM/LoadAdvert.php

-- PHP Unit with Composer
