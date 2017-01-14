<?php

/**
 * Radiobutton inside label macros
 */
Form::macro('radioInLabel', function ($name, $value, $label, $check=false) {

    $stringCheck = ($check ? 'checked="checked"' : '');

    return
        '<div class="radio">
            <label>
                <input ' . $stringCheck . ' name="' . $name . '" type="radio" value="' . $value . '"> '
                . $label
            . '</label>
        </div>';
});
