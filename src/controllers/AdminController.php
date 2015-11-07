<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\DbConfigAdmin;

use Config;

class AdminController extends \BaseController
{
    public function manage($url)
    {
        $pages = Config::get('dbConfigAdmin::pages', []);
        if(! array_key_exists($url, $pages) )
        {
            \App::abort(404, 'Page not found');
        }

        return \View::make('dbConfigAdmin::manage', ['page' => $pages[$url]]);
    }

    /**
     * @todo: rewrite logging
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $fields = \Input::get('field', []);
        $comments = \Input::get('comment', []);
        foreach($fields as $field=>$value) {
            $comment = isset($comments[$field]) ? $comments[$field] : '';

            \DB::transaction(function () use ($field, $value, $comment) {
                $oldValue = \DbConfig::get($field);
                $oldComment = \DbConfig::get($field . '_comment');

                \DbConfig::forget($field);
                \DbConfig::forget($field . '_comment');

                if(is_array($value))
                {
                    foreach($value as $key=>$v)
                    {
                        isset($oldValue[$key]) or $oldValue[$key] = '';
                        isset($oldComment[$key]) or $oldComment[$key] = '';

                        if($oldValue[$key] != $value[$key] || $oldComment[$key] != $comment[$key])
                        {
                            LogItem::create([
                                'field' => $field.'.'.$key,
                                'old_value' => $oldValue[$key],
                                'new_value' => $value[$key],
                                'old_comment' => $oldComment[$key],
                                'new_comment' => $comment[$key],
                                'user_id' => \Auth::user()->getAuthIdentifier()
                            ]);
                        }
                    }
                }

                \DbConfig::store($field, $value);
                \DbConfig::store($field . '_comment', $comment);
            });
        }

        return \Redirect::back();
    }

    public function logs()
    {
        $logs = LogItem
                ::orderBy('created_at', 'desc')
                ->paginate();
        return \View::make('dbConfigAdmin::logs', compact('logs'));
    }
}