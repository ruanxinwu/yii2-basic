<?php
function pd()
{
    echo '<pre>'.PHP_EOL;
    for($i=0;$i<func_num_args();$i++){
        echo '---------------'.($i+1).'---------------'.PHP_EOL;
        print_r(func_get_arg($i));
        echo PHP_EOL;
    }
    echo '</pre>';
    die;
}
function pd_var()
{
    echo '<pre>'.PHP_EOL;
    for($i=0;$i<func_num_args();$i++){
        echo '---------------'.($i+1).'---------------'.PHP_EOL;
        var_dump(func_get_arg($i));
        echo PHP_EOL;
    }
    echo '</pre>';
    die;
}
function class_basename($class)
{
    $class = is_object($class) ? get_class($class) : $class;

    return basename(str_replace('\\', '/', $class));
}
