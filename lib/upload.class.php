<?php

/**
 * Example usage:
 * $up = new upload();
 * $up->setMaxSize('2000000');
 * $up->setAllowedExtenions('jpg,gif,png')
 * if($up->upload('uploadPic','pictures/')){
 *	echo 'File uploaded. File information: ';
 *	echo $up->fileInfo['ext'].'';
 *	echo $up->fileInfo['name'].'';
 *	echo $up->fileInfo['size'];
 *}
 * If the file was not uploaded, the error will be accessible via. notice::ShowWarning(); also is logged to the error log by default. 
 */

class upload extends rocketpack {

    var $maxSize;
    var $allowedExt;
    var $fileInfo = array();

    /**
     * Sets the maximum allowed file size to upload.
     * @param int $maxSize 
     */
    public function setMaxSize($maxSize) {
        $this->maxSize = $maxSize;
    }

    /**
     * Sets the allowed extentions to upload.
     * @param string $allowedExt 
     */
    public function setAllowedExtenions($allowedExt) {
        $this->allowedExt = $allowedExt;
    }

    /**
     * Generates a random string of which is used for the filename.
     * @param type $length
     * @return type 
     */
    public function generateRandStr($length) {
        $randstr = "";
        for ($i = 0; $i < $length; $i++) {
            $randnum = mt_rand(0, 61);
            if ($randnum < 10) {
                $randstr .= chr($randnum + 48);
            } else if ($randnum < 36) {
                $randstr .= chr($randnum + 55);
            } else {
                $randstr .= chr($randnum + 61);
            }
        }
        return $randstr;
    }

    /**
     * Does prechecking for the upload, checks the file hasn't exceeded its max filesize as well as checks the file extentsion and sanitises the return vars.
     * @param string $uploadName The HTML form field name of the 'File' field.
     * @return boolean 
     */
    public function Check($uploadName) {
        if (isset($_FILES[$uploadName])) {
            $this->fileInfo['ext'] = substr(strrchr($_FILES[$uploadName]["name"], '.'), 1);
            $this->fileInfo['name'] = basename($_FILES[$uploadName]["name"]);
            $this->fileInfo['size'] = $_FILES[$uploadName]["size"];
            $this->fileInfo['temp'] = $_FILES[$uploadName]["tmp_name"];
            if ($this->fileInfo['size'] < $this->maxSize) {
                if (strlen($this->allowedExt) > 0) {
                    $exts = explode(',', $this->allowedExt);
                    if (in_array($this->fileInfo['ext'], $exts)) {
                        return true;
                    }
                    $this->Log()->LogToFile('Invalid file extension. Allowed extensions are ' . $this->allowedExt);
                    notice::ResetWarning();
                    notice::StoreWarning('Invalid file extension. Allowed extensions are ' . $this->allowedExt);
                    return false;
                }
                $this->Log()->LogToFile('Sorry but there is an error in our server. Please try again later.');
                notice::ResetWarning();
                notice::StoreWarning('Sorry but there is an error in our server. Please try again later.');
                return false;
            } else {
                if ($this->maxSize < 1000000) {
                    $rsi = round($this->maxSize / 1000, 2) . ' Kb';
                } else if ($this->maxSize < 1000000000) {
                    $rsi = round($this->maxSize / 1000000, 2) . ' Mb';
                } else {
                    $rsi = round($this->maxSize / 1000000000, 2) . ' Gb';
                }
                $this->Log()->LogToFile('File is too big. Maximum allowed size is ' . $rsi);
                notice::ResetWarning();
                notice::StoreWarning('File is too big. Maximum allowed size is ' . $rsi);
                return false;
            }
        }
        notice::ResetWarning();
        notice::StoreWarning('An unexpected error has occured, please try again later!');
        return false;
    }

    /**
     * Does the actual file upload.
     * @param string $name The HTML form field name of the 'File' field.
     * @param string $dir The upload directory to upload the file too.
     * @param string $fname The filename to use for the uploaded file (If not set will geenrate a random filename)
     * @return boolean 
     */
    public function Upload($name, $dir, $fname = false) {
        if (!is_dir($dir)) {
            $this->Log()->LogToFile('Sorry but there is an error in our server. Please try again later.');
            notice::ResetWarning();
            notice::StoreWarning('Sorry but there is an error in our server. Please try again later.');
            return false;
        }
        if ($this->Check($name)) {
            if (!$fname) {
                $this->fileInfo['fname'] = $this->generateRandStr(15) . '.' . $this->fileInfo['ext'];
            } else {
                $this->fileInfo['fname'] = $fname;
            }
            while (file_exists($dir . $this->fileInfo['fname'])) {
                $this->fileInfo['fname'] = $this->generateRandStr(15) . '.' . $this->fileInfo['ext'];
            }
            if (@move_uploaded_file($this->fileInfo['temp'], $dir . $this->fileInfo['fname'])) {
                return true;
            } else {
                $this->Log()->LogToFile('The file could not be uploaded, although everything went ok  ... Please try again later.');
                notice::ResetWarning();
                notice::StoreWarning('The file could not be uploaded, although everything went ok  ... Please try again later.');
                return false;
            }
        } else {
            return false;
        }
    }

}
?>
