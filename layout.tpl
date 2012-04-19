<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Indicateurs heuristiques</title>
        <link rel="Stylesheet" type="text/css" href="css/style.less.css" />
        <script type="text/javascript" src="vendor/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="js/dialog.js"></script>
    </head>
    <body>
        <div id="summary">
            <?php foreach($summary as $title => $entries): ?>
                <h2><?php print $title; ?></h2>
                <ul>
                    <?php foreach($entries as $rule): ?>
                        <li><a href="#<?php print $rule->id ?>"><?php print $rule->title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>

        <div class="rules">
            <?php foreach($rules as $rule): ?>
                <div class="rule" id="<?php print $rule->id; ?>">
                    <h3><?php print $rule->title; ?></h3>
                    <p><?php print $rule->description; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="dialog"></div>
        <div id="mask"></div>
    </body>
</html>

