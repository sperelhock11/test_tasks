<?php
use building\Bar;
use visitor\VisitorBar;
use genre\Genre;
use name\Name;

/////////////Автозагрузка классов////////////////
function autoload($Class) {
    // может быть для проверки в Linux нужно не \ а /
    // но у меня windows и вот так работает
    include(__DIR__ . "\\" . $Class . ".php");
}
spl_autoload_register("autoload");
/////////////////////////////////////////////////


// создаем бар
$bar = new Bar();
// создаем 10 поситителей и запускаем их в бар
// число поситителей может быть любым
// 10 это для примера
$visitors = [];
for ($i=0; $i<10; $i++) {
    $visitor = new VisitorBar();
    $countGenre = Genre::getRandomGenres(
        rand(
            VisitorBar::MIN_COUNT_GENRES,
            VisitorBar::MAX_COUNT_GENRES
        )
    );
    $key = array_rand(Name::$listNames, 1);
    $visitor->setName(Name::$listNames[$key]);
    $visitor->setGenres($countGenre);
    $bar->attach($visitor);
}

// бар принимает заказ на музыку, музыка начинает играть
$bar->readyAcceptMusic();
print_r("-------------------------------------------------------------------------------------- \n");
// проверяем бар, кто что делает ?
print_r("Что сейчас делают поситители в баре ?\n");
print_r("-------------------------------------------------------------------------------------- \n");
$bar->whatDoVisitorsDo();
print_r("-------------------------------------------------------------------------------------- \n");
// меняем музыкальный жанр принудительно
$key = array_rand(Genre::$listGenres, 1);
print_r("Музыка принудительно сменена на музыку жанра ". Genre::$listGenres[$key]. "\n");
print_r("-------------------------------------------------------------------------------------- \n");
$bar->acceptOrderMusic(Genre::$listGenres[$key]);
print_r("-------------------------------------------------------------------------------------- \n");
// меняем музыкальный жанр принудительно
print_r("Музыка прекратила играть, стоит тишина \n");
$bar->acceptOrderMusic("");
print_r("-------------------------------------------------------------------------------------- \n");
