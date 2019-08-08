<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\DbConfigAdmin;

use Config;
use DB;
use Input;
use Ofat\DbConfigAdmin\Utils\Diff;

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
        $fields   = \Input::get('field', []);
        $comments = \Input::get('comment', []);
        foreach($fields as $field=>$value) {
            $comment = isset($comments[$field]) ? $comments[$field] : '';

            \DB::transaction(function () use ($field, $value, $comment) {
                $oldValue   = \DbConfig::get($field);
                $oldComment = \DbConfig::get($field . '_comment');

                \DbConfig::forget($field);
                \DbConfig::forget($field . '_comment');

                foreach($value as $key=>$v)
                {
                    $value[$key] = preg_replace('/[^A-Za-z0-9\-\.\*\@]/', '', $v);
                    isset($oldValue[$key]) or $oldValue[$key] = '';
                    isset($oldComment[$key]) or $oldComment[$key] = '';
                }

                \DbConfig::store($field, $value);
                \DbConfig::store($field . '_comment', $comment);

                $oldData = '';
                $newData = '';
                foreach($oldValue as $k=>$v)
                {
                    $oldData .= $v.' - '.$oldComment[$k]."\n";
                }
                foreach($value as $k=>$v)
                {
                    $newData .= $v.' - '.$comment[$k]."\n";
                }

                $diff = Diff::compare($oldData, $newData);
                foreach($diff as $key=>$item)
                {
                    if($item[1] == Diff::UNMODIFIED)
                    {
                        unset($diff[$key]);
                    }
                }

                if(!empty($diff))
                {
                    LogItem::create([
                        'field'   => $field,
                        'diff'    => json_encode($diff),
                        'user_id' => \Auth::user()->getAuthIdentifier()
                    ]);
                }
            });
        }

        $previous = \URL::previous();
        $tab      = \Input::get('tab');

        return \Redirect::to($previous.'#'.$tab);
    }

    public function logs()
    {
        $input = Input::only(['search'], []);
        $query = LogItem::orderBy('created_at', 'desc');
        $str_search = preg_replace('/\\\/','\\\\\\\\\\',preg_replace('/^"(.*)"$/','\\1',json_encode($input['search'])));

        if(key_exists('search', $input)){
            $query->where(
                'diff',
                'like',
                '%' . $str_search . '%'
            );
        }

        $logs = $query->paginate();
        foreach($logs as $key=>$item)
        {
            $diff             = json_decode($item->diff, TRUE);
            $logs[$key]->diff = is_array($diff) ? array_values($diff) : $diff;
        }
        return \View::make('dbConfigAdmin::logs', compact('logs', 'input'));
    }
}