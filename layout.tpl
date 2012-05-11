<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Indicateurs heuristiques</title>
        <link rel="Stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
        <link rel="Stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript" src="vendor/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="vendor/bootstrap-modal.js"></script>
        <script type="text/javascript" src="dialog.js"></script>
    </head>
    <body>
        <header>
            <div class="page-header">
                <h1>Indicateurs heuristiques</h1>
            </div>
            <blockquote>
                <p>Clean code that works</p>
                <small>Kent Beck</small>
            </blockquote>
        </header>

        <nav class="row">
            <?php $i = 0; ?>
            <?php foreach($summary as $title => $entries): ?>
                <?php $class_clear = ($i % 3 == 0) ? 'clear' : ''; ?>
                <div class="span4 well <?php print $class_clear; ?>">
                    <ul class="nav nav-list">
                        <li class="nav-header"><?php print $title; ?></li>
                        <?php foreach($entries as $rule): ?>
                            <li>
                                <a href="#<?php print $rule->id ?>">
                                    <span class="icon-chevron-right"></span>
                                    <?php print $rule->id; ?> :
                                    <?php print $rule->title; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php $i++; ?>
            <?php endforeach; ?>
        </nav>

        <section class="rules">
            <?php foreach($rules as $rule): ?>
                <article id="<?php print $rule->id; ?>">
                    <div class="title">
                        <h3><?php print $rule->title; ?></h3>
                    </div>
                    <div class="description">
                        <?php print $rule->description; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>

        <footer>
            <p class="pull-right"><a href="#">Back to top</a></p>
            <p>Code licensed under the <a target="_blank" href="http://en.wikipedia.org/wiki/Beerware">Beerware License</a>.
        </footer>

        <div id="dialog" class="modal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <div class="title"></div>
            </div>
            <div class="modal-body">
                <div class="description"></div>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Fermer</a>
            </div>
        </div>
    </body>
</html>

