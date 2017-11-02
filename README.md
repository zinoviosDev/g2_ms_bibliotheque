Symfony
=======
Petit projet de gestion de bibliotheque (réservations, emprunts) avec Symfony
# g2_ms_bibliotheque
Memo of some useful commands:
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

- Load fixtures:
php bin/console -vv hautelook:fixtures:load -b MSGestionBibliothequeBundle
php bin/console doctrine:fixtures:load --fixtures=/var/www/html/g2_ms_bibliotheque/src/MS/GestionBibliothequeBundle/DataFixtures/ORM/LoadDummy.php
