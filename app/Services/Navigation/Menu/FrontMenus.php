<?php

namespace App\Services\Navigation\Menu;

use app\Models\Article;
use App\Repositories\ArticleRepository;
use Spatie\Menu\Laravel\Menu;

class FrontMenus
{
    public function register()
    {
        Menu::macro('main', function () {
            return Menu::new()
                ->addClass('nav__list')
                ->url('/', 'Home')
                ->setActiveFromRequest(url(locale()));
        });

        Menu::macro('language', function () {
            return Menu::new()->fill(locales(), function (Menu $menu, string $locale) {
                $menu->url($locale, $locale);
            })->setActiveFromRequest(url('/'));
        });

        Menu::macro('articleSiblings', function (Article $article) {

            $articles = app(ArticleRepository::class)->getSiblings($article);

            return Menu::new()->fill($articles, function (Menu $menu, Article $article) {
                return $menu->url($article->fullUrl, $article->name);
            })->setActiveFromRequest(url(locale()));
        });
    }
}
