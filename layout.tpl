<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Indicateurs heuristiques</title>
    </head>
    <body>
        <ul id="summary">
            <?php foreach($rules as $rule): ?>
                <li><a href="#<?php print $rule->id ?>"><?php print $rule->title ?></a></li>
            <?php endforeach; ?>
        </ul>

        <?php foreach($rules as $rule): ?>
            <div class="rule">
                <h2 id="<?php print $rule->id ?>"><?php print $rule->title ?></h2>
                <p><?php print $rule->description ?></p>
            </div>
        <?php endforeach; ?>
    </body>
</html>

