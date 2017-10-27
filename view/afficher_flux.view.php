<html>
<head>
<title>Flux RSS</title>
<meta charset="UTF-8"/>
<meta http-equiv="content-type" content="text/html;" />
</head>

<body>
    <?php foreach($fluxs as $f) { ?>
    <a href=<?php echo $f->getUrl()?>><?php echo $f->getUrl()?></a> <br>
    <?php } ?>
</body>
</html>