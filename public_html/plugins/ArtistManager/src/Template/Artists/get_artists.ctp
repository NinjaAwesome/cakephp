<?php if(!empty($artists)){ ?>
<ul>
    <?php foreach ($artists as $artist){ ?>
    <li><a class="artist-select" data-id="<?= $artist->id ?>" ><?= $artist->name ?></a></li>
    <?php } ?>
</ul>
<?php } ?>