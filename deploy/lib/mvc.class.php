<?php

class mvc extends controller {

    function __construct() {
        parent::__construct();
    }

    public function ParseTemplate() {
        $class = $this->controller_request;
        if (class_exists('' . $class . '')) {
            $this_object = new $class();
            $template_raw = file::ReadFile("app/views/" . $this_object->renderwith . "");
            $match = null;
            $raw = $template_raw;
            preg_match_all("'<%=\s(.*?)\s%>'si", $raw, $match);
            if ($match) {
                foreach ($match[1] as $method) {
                    $raw = str_replace("<%= " . $method . " %>", call_user_func(array($this_object, $method)), $raw);
                }
            }
            $raw = str_replace('<?', 'PHP execution is not permitted! Caught: [', $raw);
            $raw = str_replace('?>', ']', $raw);
            $raw = str_replace('<% else %>', '<?php } else { ?>', $raw);
            $raw = str_replace('<% end %>', '<?php } ?>', $raw);
            $raw = preg_replace('/\<% if (.+?)\ %>/i', '<?php if(\$this_object->$1()){ ?>', $raw);
            $raw = preg_replace('/\<% control (.+?)\ %>/i', "<?php foreach(\$this_object->$1() as \$key => \$value){ ?>", $raw);
            $raw = preg_replace('/\<%@ (.+?)\ %>/i', '<?php echo \$value[\'$1\']; ?>', $raw);
            return eval('?>' . $raw);
        } else {
            return false;
        }
    }

}

?>
