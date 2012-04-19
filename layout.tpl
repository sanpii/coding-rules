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
        <div class="page-header">
            <h1>Indicateurs heuristiques</h1>
        </div>
        <blockquote>
            <p>Clean code that works</p>
            <small>Kent Beck</small>
        </blockquote>
        <div id="summary" class="row">
            <?php foreach($summary as $title => $entries): ?>
                <div class="span4 well">
                    <h2><?php print $title; ?></h2>
                    <ul>
                        <?php foreach($entries as $rule): ?>
                            <li><a href="#<?php print $rule->id ?>"><?php print $rule->title; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="rules">
            <?php foreach($rules as $rule): ?>
                <div class="rule" id="<?php print $rule->id; ?>">
                    <div class="title">
                        <h3><?php print $rule->title; ?></h3>
                    </div>
                    <div class="description">
                        <p><?php print $rule->description; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="dialog" class="modal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <div class="title"></div>
            </div>
            <div class="modal-body">
                <div class="description"></div>
            </div>
        </div>
    </body>
</html>

