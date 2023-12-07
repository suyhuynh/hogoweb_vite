<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Seo;
use Modules\User\Entities\User;

class AppModel extends Model
{
    public function seo()
    {
        return $this->morphOne(Seo::class, 'taxonomy')
        ->where('lang_code', currentLanguageCode())
        ->withDefault(['img' => '', 'title' => '', 'description' => '', 'keyword' => '', 'alias' => '', 'status' => false]);
    }

    public function seoLanguage()
    {
        return $this->morphOne(Seo::class, 'taxonomy')
        ->where('lang_code', currentLanguageCode())
        ->withDefault(['img' => '', 'title' => '', 'description' => '', 'keyword' => '', 'alias' => '', 'status' => false]);
    }

    public function getLayouts()
    {
        return !empty($this->layout) ? $this->layout->widgets : [];
    }

    public function getSeo()
    {
        $seo = Seo::where('taxonomy_id', $this->id)->where('lang_code', currentLanguageCode())->where('type', $this->getTable())->first();
        if (empty($seo)) {
            $seo = $this;
        }
        return $seo;
    }
    public function setURLFull($url)
    {
        // return url($url) . get_extension_seo();
        return '/' . $url . get_extension_seo();
    }

    public function getURLFull($url_fix = '')
    {
        $url = '';
        // if (!empty($this->seoLanguage)) {
        //     if (!empty($this->category)) {
        //         $url .= $this->category->seoLanguage->alias .'/';
        //     }
        //     $url .= $this->seoLanguage->alias;
        // }

        if (!empty($this->category)) {
            $url .= $this->category->translate->alias .'/';
        }
        $url .= $this->translate->alias;
    
        // if (!empty($this->seo)) {
        //     $url .= $this->seo->lang_code . '/';
        //     if (!empty($this->category)) {
        //         $url .= $this->category->seo->alias .'/';
        //     }
        //     $url .= $this->seo->alias;
        // }
        return !empty($url) ? $this->setURLFull($url) : null;
    }

    public function getBreadcrumb()
    {
        $breadcrumb = [];
        if (!empty($this->parent_id)) {
            $breadcrumb = array_merge($breadcrumb, $this->getBreadcrumbParent($this->parent));
        }

        if (!empty($this->category_id)) {
            $breadcrumb = array_merge($breadcrumb, $this->getBreadcrumbCategory($this->category));
        }

        $breadcrumb[] = [
            'title' => $this->translate->title,
            'alias' => $this->link
        ];
        return $breadcrumb;
    }

    public function getBreadcrumbParent($entity, $arr = [])
    {
        if (empty($entity->parent_id)) {
            return array_merge([
                [
                    'title' => $entity->translate->title,
                    'alias' => $entity->link
                ]
            ], $arr);
        }
        return $this->getBreadcrumbParent($entity->parent, [[
            'title' => $entity->translate->title,
            'alias' => $entity->link
        ]]);
    }

    public function getAliasParent($entity, $alias = '')
    {
        if (empty($entity->parent_id)) {
            return $this->setURLFull($this->seoLanguage->lang_code . '/' . $entity->seo->alias . '/' . $alias);
        }
        return $this->getAliasParent($entity->parent, $entity->seo->alias) . (!empty($alias) ? '/' . $alias : '') ;
    }

    public function getBreadcrumbCategory($entity, $arr = [])
    {
        if (empty($entity->category_id)) {
            return array_merge([
                [
                    'title' => $entity->translate->title,
                    'alias' => $entity->link
                ]
            ], $arr);
        }
        return $this->getBreadcrumbParent($entity->category, [[
            'title' => $entity->category->translate->title,
            'alias' => $entity->category->link
        ]]);
    }

    public function user_create()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->select('id', 'fullname')->withDefault(['fullname' => '', 'phone' => '', 'email' => '']);
    }

    public function updateOrCreateSeo()
    {
        if (!empty(request()->seo)) {
            $input = [
                "type" => $this->getTable(),
                "alias" => formatUrl(!empty(request()->seo['alias']) ? request()->seo['alias'] : request()->translate['alias']),
                "img" => !empty(request()->seo['img']) ? request()->seo['img'] : request()->translate['img'],
                "title" => !empty(request()->seo['title']) ? request()->seo['title'] : request()->translate['title'],
                "description" => !empty(request()->seo['description']) ? request()->seo['description'] : request()->translate['description'],
                "keyword"  => !empty(request()->seo['keyword']) ? request()->seo['keyword'] : request()->translate['title'],
                "expand"  => !empty(request()->seo['expand']) ? request()->seo['expand'] : null,
                "schema"  => !empty(request()->seo['schema']) ? request()->seo['schema'] : null,
                'lang_code' => currentLanguage()
            ];
            return $this->seo()->updateOrCreate([
                'taxonomy_id' => $this->id,
                'lang_code' => currentLanguage()
            ], $input);
        }
    }

    // public function updateOrCreateTranslate()
    // {
    //     if (!empty(request()->translate)) {
    //         $data = $this->translate()->updateOrCreate([
    //             'lang_code' => currentLanguage(),
    //         ], request()->translate);
    //         if (get_config_by_key('language')) {
    //             $languages = get_language_not_exist();
    //             foreach ($languages as $language) {
    //                 $this->translates()->firstOrCreate([
    //                     'lang_code' => $language['code'],
    //                 ], request()->translate);
    //             }
    //         }
    //         return $data;
    //     }
    // }

    public function updateOrCreateContent()
    {
        if (!empty(request()->contents)) {
            foreach (request()->contents as $content) {
                $this->contents()->updateOrCreate([
                    'tab_id' => $content['tab_id'],
                    'product_id' => $this->id,
                    'lang_code' => currentLanguage(),
                ], $content);
            }
        }
    }

    // public function seo()
    // {
    //     return $this->morphOne(Seo::class, 'taxonomy')->where('lang_code', currentLanguage())->withDefault(['img' => '', 'title' => '', 'description' => '', 'keyword' => '', 'alias' => '', 'status' => false]);
    // }

    // public function getLayouts()
    // {
    //     return !empty($this->layout) ? $this->layout->widgets : [];
    // }

    // public function getSeo()
    // {
    //     $seo = \Modules\Core\Entities\Seo::where('taxonomy_id', $this->id)->where('type', $this->getTable())->first();
    //     if (empty($seo)) {
    //         $seo = $this;
    //     }
    //     return $seo;
    // }
}
