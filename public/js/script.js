

CommentList = {};

CommentList.init = function (currentSortField,currentSortDirection,currentPage) {


    $('#add-comment-form').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: '/comments/create',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#add-comment-form')[0].reset();

                    showAlert(response.message, 'success');
                    loadComments();
                } else {
                    showAlert(response.errors, 'danger');
                }
            },
            error: function() {
                alert('Ошибка при отправке данных.');
            }
        });
    });

    function loadComments() {
        $.get('/comments', {
            sort: currentSortField,
            dir: currentSortDirection,
            page: currentPage
        }, function(response) {
            $('#comments-list').html(response.comments);
            $('#pagination').html(response.pagination);
        });
    }

    $('#sort-id').click(function() {
        if (currentSortField === 'id') {
            if (currentSortDirection === 'desc'){
                currentSortField = null;
                currentSortDirection = null;
                $('.sort-buttons button').removeClass('asc desc active')
            }
            else{
                currentSortDirection =  'desc' ;
                $(this).removeClass('asc').addClass('desc')
            }

        } else {
            currentSortField = 'id';
            currentSortDirection = 'asc';
            $('.sort-buttons button').removeClass('asc desc active')
            $(this).addClass('active asc')
        }
        loadComments();
    });

    $('#sort-date').click(function() {
        if (currentSortField === 'date') {
            if (currentSortDirection === 'desc'){
                currentSortField = null;
                currentSortDirection = null;
                $('.sort-buttons button').removeClass('asc desc active')
            }
            else{
                currentSortDirection =  'desc' ;
                $(this).removeClass('asc').addClass('desc')
            }

        } else {
            currentSortField = 'date';
            currentSortDirection = 'asc';
            $('.sort-buttons button').removeClass('asc desc active')
            $(this).addClass('active asc')
        }
        loadComments();
    });

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        currentPage = $(this).data('page');
        loadComments();
    });

    $('#create-random').click(function() {
        const count = $('#comment-count-input').val();

        $.post('/comments/create-random', { createCount: count }, function(response) {
            if (response.status === 'success') {
                showAlert(response.message, 'success');
                loadComments();
            } else {
                showAlert(response.message, 'danger');
            }
        });
    });

    function showAlert(message, type) {
        const alert = $(`
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);
        $('#alert-container').append(alert);
        setTimeout(() => alert.alert('close'), 5000); // Автоматически закрыть через 5 секунд
    }
        }
