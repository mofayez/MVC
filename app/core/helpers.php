<?php


/**
 * pretty print_r value
 * @param $value
 * @return voif
 * @author muhammad_fayez
 *
 */
function pre($value) {
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
