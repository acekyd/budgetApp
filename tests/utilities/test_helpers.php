<?php

function create($class, $attributes = [], $times = null) {
    return factory($class, $times)->create($attributes);
}