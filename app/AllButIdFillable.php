<?php

namespace App;

trait AllButIdFillable {
    // I'm entirely sure there's a better way to do this.
    protected function fillableFromArray(array $arr) {
        if (isset($arr['id'])) unset($arr['id']);
        return $arr;
    }
}
