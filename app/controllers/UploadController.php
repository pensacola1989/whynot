<?php
/**
 * Created by PhpStorm.
 * User: danielwu
 * Date: 12/3/14
 * Time: 4:18 PM
 */

class UploadController extends BaseController {

    public function uploadFile()
    {
        @set_time_limit(5 * 60);
        $uploadUrl = '/uploadFile/';
        $targetDir = public_path() . $uploadUrl;
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds
        $fileName = '';

        // Create target dir
        if (!file_exists($targetDir)) {
            @mkdir($targetDir,0777,true);
//            if(@mkdir($targetDir,0777,true)){
//                echo "目录创建成功";
//            }
//                echo "目录创建失败";
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = time() . '_' . $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["chunkfile"]["name"];

        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;

        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["chunkfile"]["error"] || !is_uploaded_file($_FILES["chunkfile"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded chunkfile."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp chunkfile
            if (!$in = @fopen($_FILES["chunkfile"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Strip the temp .part suffix off
            rename("{$filePath}.part", $filePath);
        }
        $ret = App::make('Hgy\Image\ImageRepository')->addImage($fileName);
        return ['url'=>url('..'.$uploadUrl . '/' .$fileName),'id'=>$ret->id];
//        return url($uploadUrl . '/' .$fileName);
    }
}