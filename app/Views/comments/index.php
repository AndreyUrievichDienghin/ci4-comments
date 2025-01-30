<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комментарии</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?= link_tag('css/style.css') ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <?= script_tag('js/script.js') ?>

</head>
<body>
<div class="container mt-5">
    <div id="alert-container"></div>
    <h1 class="mb-4">Комментарии</h1>

    <div class="mb-4">
        <div class="form-inline rand-block">
            <input type="number" id="comment-count-input" class="form-control mr-2" min="1" value="10" placeholder="Количество">
            <button id="create-random" class="btn btn-success">Создать случайные комментарии</button>
        </div>
    </div>


    <div class="sort-buttons mb-4">
        <button id="sort-id" class="btn btn-outline-primary <?=$sortField == 'id' ? $sortDirection.' active' : ''?>">Сортировать по ID</button>
        <button id="sort-date" class="btn btn-outline-primary <?=$sortField == 'date' ? $sortDirection.' active' : ''?>">Сортировать по Дате</button>
    </div>


    <div id="comments-list">
        <?= view('comments/_comments', ['comments' => $comments]) ?>
    </div>


    <div id="pagination">
        <?= $pager->links('default', 'custom_pagination') ?>
    </div>


    <h2 class="mt-5">Добавить комментарий</h2>
    <form id="add-comment-form">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="text">Текст:</label>
            <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="date">Дата:</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить комментарий</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        CommentList.init('<?= $sortField ?>','<?= $sortDirection ?>',<?= $pager->getCurrentPage() ?>);
    })
</script>
</body>
</html>