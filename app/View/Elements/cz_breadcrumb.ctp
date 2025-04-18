<div class="pd-content-01">
    <div class="col-sm-12">
        <ol class="breadcrumb">
        <?php if (isset($breadcrumb) && !empty($breadcrumb)) : ?>
            <?php foreach($breadcrumb as $crumb) : ?>
            <li class="<?php echo isset($crumb->active) ? 'active' : ''; ?>">
                <?php echo isset($crumb->link) ? '<a href="' . $crumb->link . '">' . $crumb->title . '</a>' : $crumb->title;?>
            </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li class="active">Home</li>
        </ol>
        <?php endif; ?>
    </div>
</div>
