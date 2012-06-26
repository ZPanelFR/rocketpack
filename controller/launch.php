<?php

class launch extends rocketpack {
    
    public function outPathLogs(){
        return app_logpath;
    }
    
    public function outPathTemp(){
        return app_tmppath;
    }
    
    public function outPathCache(){
        return app_cachepath;
    }


    public function outIsWritableLogs(){
        return is_writable(app_logpath);
    }
    
    public function outIsWritableCache(){
        return is_writable(app_cachepath);
    }
    
    public function outIsWritableTemp(){
        return is_writable(app_tmppath);
    }
    
    public function outIsExistLogs(){
        return file_exists(app_logpath);
    }
    
    public function outIsExistCache(){
        return file_exists(app_cachepath);
    }
    
    public function outIsExistTemp(){
        return file_exists(app_tmppath);
    }
    
}

?>
