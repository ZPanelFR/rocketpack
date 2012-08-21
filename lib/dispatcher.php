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

    if (headers_sent())
        die('Headers Sent');
    // Check for a custom content type from the controller and if so lets set the header.
    if (isset($this_object->contenttype)) {
        header("Content-type: " . $this_object->contenttype . "");
    }

    // Lets go through and complete any further custom headers.
    if (isset($this_object->headers)) {
        if (is_array($this_object->headers)) {
            foreach ($this_object->headers as $customheader) {
                header($customheader);
            }
        }
    }

    // Set the pulic path variable, if a CDN path has been set it will use this instead of the default 'public/*' path.
    if (app_cdnpath != '') {
        $public_path = app_cdnpath;
    } else {
        $public_path = link::webfolder();
    }

    $match = null;
    preg_match_all("'<%=\s(.*?)\s%>'si", $raw, $match);
    if ($match) {
        foreach ($match[1] as $method) {
            if (!stristr($method, '.')) {
                $raw = str_replace("<%= " . $method . " %>", call_user_func(array($this_object, "out" . $method)), $raw);
            } else {
                $namespace = explode('.', $method);
                $run_method = $namespace[0];
                $method_array = call_user_func(array($this_object, "out" . $run_method));
                $raw = str_replace("<%= " . $method . " %>", $method_array[$namespace[1]], $raw);
            }
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
    $raw = preg_replace('/\<% public_path\ %>/i', '' . $public_path . 'public/', $raw);

    // Multi part URL link generation.
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?) :otherid=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\',\'$4\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?)}\ %>/i', '<?php echo link::build(\'$1\'); ?>', $raw);

    if (isset($this_object->minifycode) && $this_object->minifycode == TRUE) {
        $raw = preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'), array('>', '<', '\\1'), $raw);
    }

    echo eval('?>' . $raw);
    notification::ResetNotice();
    notification::ResetWarning();
    notification::ResetSuccess();
} else {
    header("HTTP/1.0 404 Not Found");
    if (app_defaultcontrollernotfound != '')
        director::Redirect(link::build(app_defaultcontrollernotfound));
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
                if (!stristr($method, '.')) {
                    $raw = str_replace("<%= " . $method . " %>", call_user_func(array($tpl_controller, "out" . $method)), $raw);
                } else {
                    $namespace = explode('.', $method);
                    $run_method = $namespace[0];
                    $method_array = call_user_func(array($tpl_controller, "out" . $run_method));
                    $raw = str_replace("<%= " . $method . " %>", $method_array[$namespace[1]], $raw);
                }
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
    $raw = preg_replace('/\<% public_path\ %>/i', '' . $public_path . 'public/', $raw);

    // Multi part URL link generation.
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?) :otherid=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\',\'$4\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?) :id=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\',\'$3\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?) :action=(.+?)}\ %>/i', '<?php echo link::build(\'$1\',\'$2\'); ?>', $raw);
    $raw = preg_replace('/\<% link_to {:controller=(.+?)}\ %>/i', '<?php echo link::build(\'$1\'); ?>', $raw);

    if (isset($tpl_controller->minifycode) && $tpl_controller->minifycode == TRUE) {
        $raw = preg_replace(array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'), array('>', '<', '\\1'), $raw);
    }

    return eval('?>' . $raw);
}

if (isset($this_object->cache) && $this_object->cache == TRUE) {
    $simplecache->stop_cache();
}
$timer->stop_watch();
?>
