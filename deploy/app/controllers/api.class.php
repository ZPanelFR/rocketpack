<?php

class api extends controller {

    var $renderwith = "webservice_output.html";

    public function outWebserviceOutput() {
        if (isset($this->sub_requests['hello']) && $this->sub_requests['hello'] == "hi") {
            echo "You wanted a hi!";
        } elseif (isset($this->sub_requests['hello']) && $this->sub_requests['hello'] == "bye") {
            echo "Good bye to you too!";
        } else {
            echo "I didn't understand your request, sorry! (" . $this->sub_requests['hello'] . ")";
        }
    }

}

?>
