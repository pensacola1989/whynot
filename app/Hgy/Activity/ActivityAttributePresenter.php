<?php namespace Hgy\Activity;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 1/5/15
 * Time: 2:44 AM
 */

use Illuminate\Support\Facades\Auth;
use McCool\LaravelAutoPresenter\BasePresenter;

class ActivityAttributePresenter extends BasePresenter {

    public function __construct(ActivityAttribute $activityAttribute)
    {
        $this->resource = $activityAttribute;
    }

    /**
     * checkbox
     */
    public function parseEnum()
    {
        $ul = '<ul class="ui-list ui-list-text ui-list-checkbox ui-border-tb">  ';
        $li = '';
        if($this->resource->attr_type != 'enum') return ;
        if($this->resource->attr_extra == '') return ;
        $itemArr = explode(',', $this->resource->attr_extra);
        if(count($itemArr)) {
            foreach($itemArr as $arr) {
                $li .= ' <li class="ui-border-t"><label class="ui-checkbox">';
                if(list($key, $value) = explode(':', $arr)) {
                    $li .= '<input type="checkbox">';
                }
                $li .= '</label><p>' . $value . '</p></li>';
                $ul .= $li;
                $li = '';
            }
        }
        $ul .= '</ul>';

        return $ul;
    }
}