<?php if ($pager->getPageCount() > 1): ?>
    <nav class="pagination-wrapper">
        <ul class="pagination">
            <?php if ($pager->hasPrevious()): ?>
                <li><a href="<?= $pager->getPreviousPage() ?>">&laquo; Prev</a></li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link): ?>
                <li class="<?= $link['active'] ? 'active' : '' ?>">
                    <a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNext()): ?>
                <li><a href="<?= $pager->getNextPage() ?>">Next &raquo;</a></li>
            <?php endif ?>
        </ul>
    </nav>
<?php endif ?>
