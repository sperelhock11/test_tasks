<?php
namespace genre;
/**
 * Class Genre
 * Класс содержит в себе возможные музыкальные жанры.
 * @package genre
 */
class Genre
{
   // музыкальные жанры
   public static $listGenres = [
       'blues',
       'classical',
       'country',
       'dance',
       'easy listening',
       'electronic',
       'folk',
       'heavy metal',
       'hip hop',
       'jazz',
       'latin',
       'opera',
       'pop',
       'rap',
       'reggae',
       'rock',
       'techno',
   ];

    /**
     * Метод вернет массив случайных не повторяющихся жанров
     * @param int $count - сколько вернуть жанров
     * @return array
     */
   public static function getRandomGenres(int $count) {
       $list = self::$listGenres;
       $result = [];
       for ($i = 0; $i < $count; $i++) {
           $key = rand(0, (count($list)-1));
           $result[] = $list[$key];
           unset($list[$key]);
           $list = array_values($list);
       }
       return $result;
   }
}