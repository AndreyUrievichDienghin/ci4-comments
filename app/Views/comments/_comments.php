<?php foreach ($comments as $comment): ?>
    <div class="comment">
        <button type="button" class="btn btn-dark btn-comment-delete" data-id="<?= $comment['id'] ?>">Удалить</button>
        <p><strong>ID:</strong> <?= $comment['id'] ?></p>
        <p><strong>E-mail:</strong> <?= $comment['name'] ?></p>
        <p><strong>Текст:</strong> <?= $comment['text'] ?></p>
        <p><strong>Дата:</strong> <?= $comment['date'] ?></p>

    </div>
<?php endforeach; ?>