<?php
/**
 * Helper Functions
 *
 *
 *
 * Filename:        helpers.php
 * Location:        FILE_LOCATION
 * Project:         KTW-SaaS-Vanilla-MVC
 * Date Created:    28/8/2024
 *
 * Author:          Kobe Williams
 *
 */
/**
 * Get the base path (operating system)
 *
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

function loadView($name, $data = [])
{
    $viewPath = basePath("App/Views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "Partial '{$name} not found.'";
    }
}

function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function inspectAndDie($value)
{
    inspect($value);
    die();
}

function dump(): void
{
    echo "<pre class='bg-gray-100 color-black m-2 p-2 rounded shadow flex-grow text-sm'>";
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    echo "</pre>";
}

function dd(): void
{
    echo "<pre class='bg-gray-100 color-black m-2 p-2 rounded shadow flex-grow text-sm'>";
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    echo "</pre>";
    die();
}

function sanitize($dirty)
{
    return filter_van(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

function redirect($url)
{
    header("Location: $url");
    exit;
}