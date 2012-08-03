<?php

/**
 * The main template parser.
 */
$simplecache = new cache();
$timer = new iotimer();

$simplecache->set_cache_dir(app_cachepath);
$timer->start_watch();

if (!isset($_GET['controller'])) {
    $_GET['controller'] = app_defaultcontroller;
}

$class = $_GET['controller'];
if (class_exists('' . $class . '')) {
    $this_object = new $class();
    // Lets see if this controller requests that the page is cached first and if so we'll send the cached version..
    if (isset($this_object->cache) && $this_object->cache == TRUE) {
        if (isset($this_object->cache_life))
            $simplecache->set_cache_life($this_object->cache_life);
        $simplecache->start_cache();
    }
    // Lets execute the class method (prefixed with 'action') if one exsits for the URL 'action' part.
    if (isset($_REQUEST['action'])) {
        $action_runner = 'action' . $_REQUEST['action'];
        if (method_exists($this_object, $action_runner)) {
            $this_object->$action_runner();
        }
    }
    // If its a GET request we'll continue to execute the template and MVC parser..
    if (isset($this_object->renderwith)) {
        $raw = file::ReadFile("app/view/" . $this_object->renderwith . ".html");
    } else {
        $raw = file::ReadFile("app/view/" . $class . ".html");
    }

    $match = null;
    preg_match_all("'<%=\s(.*?)\s%>'si", $raw, $match);
    if ($match) {
        foreach ($match[1] as $method) {
            $raw = str_replace("<%= " . $method . " %>", call_user_func(array($this_object, "out" . $method)), $raw);
        }
    }
    $raw = str_replace('?>', ']', $raw);
    $raw = str_replace('<?', 'PHP execution is not permitted! Caught: [', $raw);
    $raw = str_replace('<% else %>', '<?php } else { ?>', $raw);
    $raw = str_replace('<% end %>', '<?php } ?>', $raw);
    $raw = preg_replace('/\<% if (.+?)\ %>/i', '<?php if(\$this_object->out$1()){ ?>', $raw);
    $raw = preg_replace('/\<% control (.+?)\ %>/i', "<?php foreach(\$this_object->out$1() as \$key => \$value){ ?>", $raw);
    $raw = preg_replace('/\<%@ (.+?)\ %>/i', '<?php echo \$value[\'$1\']; ?>', $raw);
    $raw = preg_replace('/\<% include (.+?)\ %>/i', '<?php echo ParseInclude(@file::ReadFile(\'app/view/\'.$1.\'.html\')); ?>', $raw);
    $raw = preg_replace('/\<% public_path\ %>/i', '' . link::webfolder() . 'public/', $raw);

    // Multi part URL link generation.
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?) :otherid=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\',\'$4\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?)}\ %>/i', '<?php echo link::build(\'$1\'); ?>', $raw);

    if (isset($this_object->minifycode) && $this_object->minifycode == TRUE) {
        $raw = str_replace("\n", "", $raw);
        $raw = str_replace("\t", "", $raw);
        $raw = str_replace("\r", "", $raw);
    }

    echo eval('?>' . $raw);
    notification::ResetNotice();
    notification::ResetWarning();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Sorry no controller found for '" . $_GET['controller'] . "'.</h1>";
    exit;
}

function ParseInclude($raw) {
    $match = null;
    preg_match_all("'<%=\s(.*?)\s%>'si", $raw, $match);

    if ($match) {
        if (file_exists("app/controller/_viewinclude.php")) {
            require_once "app/controller/_viewinclude.php";
        }
        if (class_exists('_viewinclude')) {
            $tpl_controller = new _viewinclude();

            foreach ($match[1] as $method) {
                $raw = str_replace("<%= " . $method . " %>", call_user_func(array($tpl_controller, "out" . $method)), $raw);
            }
        }
    }
    $raw = str_replace('?>', ']', $raw);
    $raw = str_replace('<?', 'PHP execution is not permitted! Caught: [', $raw);
    $raw = str_replace('<% else %>', '<?php } else { ?>', $raw);
    $raw = str_replace('<% end %>', '<?php } ?>', $raw);
    $raw = preg_replace('/\<% if (.+?)\ %>/i', '<?php if(\$tpl_controller->out$1()){ ?>', $raw);
    $raw = preg_replace('/\<% control (.+?)\ %>/i', "<?php foreach(\$tpl_controller->out$1() as \$key => \$value){ ?>", $raw);
    $raw = preg_replace('/\<%@ (.+?)\ %>/i', '<?php echo \$value[\'$1\']; ?>', $raw);
    $raw = preg_replace('/\<% include (.+?)\ %>/i', '<?php echo @file::ReadFile(\'app/view/\'.$1.\'.html\'); ?>', $raw);
    $raw = preg_replace('/\<% public_path\ %>/i', '' . link::webfolder() . 'public/', $raw);

    // Multi part URL link generation.
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?) :otherid=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\',\'$4\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?)}\ %>/i', '<?php echo link::build(\'$1\'); ?>', $raw);

    if (isset($tpl_controller->minifycode) && $tpl_controller->minifycode == TRUE) {
        $raw = str_replace("\n", "", $raw);
        $raw = str_replace("\t", "", $raw);
        $raw = str_replace("\r", "", $raw);
    }

    return eval('?>' . $raw);
}

if (isset($this_object->cache) && $this_object->cache == TRUE) {
    $simplecache->stop_cache();
}
$timer->stop_watch();
?>
