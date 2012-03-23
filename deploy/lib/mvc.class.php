<?php

class mvc extends controller {

    function __construct() {
        parent::__construct();
    }

    static function ParseTempate($raw) {
        
    }

    public function ParseTemplate() {
        $class = $this->controller_request;
        if (class_exists('' . $class . '')) {
            $this_object = new $class();
            $raw = file::ReadFile("app/views/" . $this_object->renderwith . "");
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
            $raw = preg_replace('/\<% include (.+?)\ %>/i', '<?php echo @file::ReadFile(\'app/views/\'.$1.\'.html\'); ?>', $raw);
            $raw = preg_replace('/\<%@ (.+?)\ %>/i', '<?php echo \$value[\'$1\']; ?>', $raw);
            $raw = preg_replace('/\<% link_all_css %>/i', '<?php taglib::link_all_css(); ?>', $raw);
            $raw = preg_replace('/\<% link_all_js %>/i', '<?php taglib::link_all_js(); ?>', $raw);
            $raw = preg_replace('/\<% form_init\ controller=\"(.+?)\"\ execute=\"(.+?)\"\ %>/i', '<form action="<?php echo "/$1?action=$2"; ?>" method="post">', $raw);
            $raw = preg_replace('/\<% form_end %>/i', '</form>', $raw);
            return eval('?>' . $raw);
        } else {
            return false;
        }
    }

}

?>
