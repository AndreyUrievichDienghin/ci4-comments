<?php
/** @var CodeIgniter\Pager\PagerRenderer $pager */
if ($pager->getPageCount() > 1):
    $links = $pager->links()?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!-- Кнопка "Первая страница" -->
            <?php if ($pager->hasPrevious()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getFirst() ?>" data-page="1" aria-label="First">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Кнопка "Предыдущая страница" -->
            <?php if ($pager->hasPrevious()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPreviousPage() ?>" data-page="<?= $pager->getPreviousPageNumber() ?>" aria-label="Previous">
                        <span aria-hidden="true">&lsaquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Первая страница -->
            <li class="page-item <?= $pager->getCurrentPageNumber() === 1 ? 'active' : '' ?>">
                <a class="page-link" href="<?= $links[1]['uri'] ?>" data-page="1">1</a>
            </li>

            <!-- Троеточие, если текущая страница далеко от первой -->
            <?php if ($pager->getCurrentPageNumber() > 3): ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>

            <!-- Ближайшие страницы -->
            <?php
            $start = max(2, $pager->getCurrentPageNumber() - 2);
            $end = min($pager->getPageCount() - 1, $pager->getCurrentPageNumber() + 2);

            for ($i = $start; $i <= $end; $i++): ?>
                <li class="page-item <?= $pager->getCurrentPageNumber() === $i ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $links[$i]['uri'] ?>" data-page="<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <!-- Троеточие, если текущая страница далеко от последней -->
            <?php if ($pager->getCurrentPageNumber() < $pager->getPageCount() - 3): ?>
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
            <?php endif; ?>

            <!-- Последняя страница -->
            <?php if ($pager->getPageCount() > 1): ?>
                <li class="page-item <?= $pager->getCurrentPageNumber() === $pager->getPageCount() ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $links[$pager->getPageCount()] ?>" data-page="<?= $pager->getPageCount() ?>">
                        <?= $pager->getPageCount() ?>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Кнопка "Следующая страница" -->
            <?php if ($pager->hasNext()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNextPage() ?>" data-page="<?= $pager->getNextPageNumber() ?>" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Кнопка "Последняя страница" -->
            <?php if ($pager->hasNext()): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getLast() ?>" data-page="<?= $pager->getPageCount() ?>" aria-label="Last">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>