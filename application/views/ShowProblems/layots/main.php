<div class="col-md-9">
    <?php include 'libs/decorate.php'; ?>
    <?php foreach ($problems as $problem): ?>
        <?php printProblem($problem); ?>
    <?php endforeach; ?>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($data['page'] > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo buildPaginationLink($data['page'] - 1, $data); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $maxPages; $i++): ?>
                <li class="page-item <?php if ($i == $data['page']) echo 'active'; ?>">
                    <a class="page-link" href="<?php echo buildPaginationLink($i, $data); ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($data['page'] < $maxPages): ?>
                <li class="page-item">
                    <a class="page-link" href="<?php echo buildPaginationLink($data['page'] + 1, $data); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>


