<?php

namespace app\services;

use app\core\Response;
use app\core\Session;

class DownloadFileService
{
    /**
     * @param $folder
     * @param $fileName
     * @return void
     */
    public function download($folder, $fileName): void
    {
        $safeFileName = basename($fileName);
        $path = FILE_UPLOAD_DIR . '/' . $folder . '/' . $safeFileName;

        if(!file_exists($path)){
            Response::status(404);
            Session::setSession('errors', 'Файл не найден');
            return;
        }
        header("Content-Length: " . filesize($path));
        header("Content-Disposition: attachment; filename=" . $safeFileName);
        header("Content-Type: application/x-force-download; name=\"" . $safeFileName . "\"");
        readfile($path);
        exit;
    }
}