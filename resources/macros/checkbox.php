<?php

/**
 * Checkbox inside label macros
 */
Form::macro('checkboxInLabel', function ($name, $value, $label) {
    // Get existing attribute's value.
    // (http://laravel-tricks.com/tricks/getting-formmodel-values-in-custom-formmacros)
    $checked = Form::getValueAttribute($name);

    return
        '<div class="checkbox">'
            . '<label>'
                . '<input name="' . $name . '" type="checkbox" value="' . $value . '" '
                    . ($checked ? 'checked' : '') . '>'
                . $label
            . '</label>'
        . '</div>';
});
