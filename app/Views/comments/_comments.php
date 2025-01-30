<?php foreach ($comments as $comment): ?>
    <div class="comment">
        <p><strong>ID:</strong> <?= $comment['id'] ?></p>
        <p><strong>E-mail:</strong> <?= $comment['name'] ?></p>
        <p><strong>Текст:</strong> <?= $comment['text'] ?></p>
        <p><strong>Дата:</strong> <?= $comment['date'] ?></p>
    </div>
<?php endforeach; ?>