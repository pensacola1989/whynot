<?php namespace Hgy\VltField;
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 11/16/14
 * Time: 3:03 PM
 */
use App,Auth;
use McCool\LaravelAutoPresenter\BasePresenter;

class VltAttributePresenter extends BasePresenter {

    public function __construct(VltAttribute $attribute)
    {
        $this->resource = $attribute;
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
                    $li .= '<input value="' .$key. '" name=' . $this->resource->attr_field_name. ' type="checkbox">';
                }
                $li .= '</label><p>' . $value . '</p></li>';
                $ul .= $li;
                $li = '';
            }
        }
        $ul .= '</ul>';

        return $ul;
    }

    /**
     * Radio buttons
     */
    public function parseRadio()
    {
        $ul = '<ul class="ui-list">';
        $li = '';
        if($this->resource->attr_type != 'radio') return ;
        if($this->resource->attr_extra == '') return ;
        $itemArr = explode(',', $this->resource->attr_extra);
        if(count($itemArr)) {
            foreach($itemArr as $arr) {
                $li .= ' <li class="ui-border-t"><label class="ui-radio" for="radio">';
                if(list($key, $value) = explode(':', $arr)) {
                    $li .= '<input type="radio" value="' . $key. '" name="' . $this->resource->attr_field_name . '">' . $value . '</label></li>';
                }
                $ul .= $li;
                $li = '';
            }
        }
        $ul .= '</ul>';

        return $ul;
    }

}