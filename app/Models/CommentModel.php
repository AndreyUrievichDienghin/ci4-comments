<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments'; // Имя таблицы в базе данных
    protected $primaryKey = 'id'; // Первичный ключ
    protected $allowedFields = ['name', 'text', 'date']; // Разрешенные поля для заполнения
    protected $useTimestamps = false; // Отключаем автоматические метки времени


}
