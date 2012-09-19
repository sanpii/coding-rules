# Coding rules

## Description

Application reprenant les bonnes pratiques issue du livre « Coder proprement »
de Robert C. Martin. Fatigué de les paraphraser par mail, je me contente
d'un simple lien.

## Installation

Télécharger et extraire l'application :

    $ wget https://github.com/sanpii/tbs-map/tarball/master -O - | tar zx

Ou cloner le dépôt :

    $ git clone https://github.com/sanpii/coding-rules

Installer les dépendances :

    $ wget http://getcomposer.org/installer -O - | php
    $ php composer.phar install

Lancer le serveur HTTP (apache, nginx, …). Pour le développement, il est possible
d'utiliser le server interne de php :

    $ php -S localhost:8080 -t web/ web/index.php
