<?php

namespace App;

require_once 'file/logger.php';

use App\file\FileLogger;


// Класс, добавляющий в FileLogger новую функциональность
class FileLoggerDebug extends FileLogger
{
    // Конструктор нового класса. Просто переадресует вызов
    // конструктору базового класса, передавая немного другие
    // параметры.
    public function __construct($fname)
    {
        // Такой синтаксис используется для вызова
        // методов базового класса.
        // Обратите внимание, что ссылки $this нет! Она подразумевается.
        parent::__construct(basename($fname), $fname);
        // Здесь можно проинициализировать другие свойства текущего
        // класса, если они будут
    }

    // Добавляем новый метод
    public function debug($s, $level = 0)
    {
        $stack = debug_backtrace();
        $file = basename($stack[$level]['file']);
        $line = $stack[$level]['line'];
        // Вызываем функцию базового класса
        $this->log("[at $file line $line] $s");
    }

    // Все остальные методы и свойства наследуются автоматически!
}
