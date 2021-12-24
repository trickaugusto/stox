<?php

namespace Stox\Helpers;

class FormFields
{
    public function urlActive($match)
    {
        if (preg_match("/$match/", $_SERVER['REQUEST_URI'])) {
            echo 'class="active"';
        }
    }
    public function input($type, $name, $model=null, $field=null)
    {
        $value = null;
        if (isset($model->$name)) {
            $value = $model->$name;
        }
        $input = '<input placeholder="%s" '
                . 'class="form-control" '
                . 'type="%s" name="%s" value="%s">';
        echo sprintf($input, $field, $type, $name, $value);
    }
    
    public function textarea($name, $model=null, $field=null)
    {
        $value = null;
        if (isset($model->$name)) {
            $value = $model->$name;
        }
        $input = '<textarea placeholder="%s" '
                . 'class="form-control" '
                . ' name="%s">%s</textarea>';
        echo sprintf($input, $field, $name, $value);
    }
    
    public function select($name, $elements, $model=null)
    {
        $id = null;
        if (isset($model->$name)) {
            $id = $model->$name;
        }
        $active = null;
        echo '<select class="form-control" name="' . $name . '">';
        foreach ($elements as $element) {
            $single = array_values((array)$element);
            if ($id == $single[0]) {
                $active = 'selected';
            }
            $option = '<option value="%s" %s>%s</option>';
            printf($option, $single[0], $active, $single[1]);
            $active = null;
        }
        echo '</select>';
    }
}

