<?php

namespace app\services;

use app\core\Session;

class UploadService
{
    private const FILE_AVAILABLE_TYPE = ['application/pdf', 'text/plain'];

    private const MAX_FILE_SIZE = 1024 * 1024 * 10;

    public const UPLOAD_FILE_ERRORS = [
        1 => 'Файл не найден',
        2 => 'Файл превышает допустимый размер',
        3 => 'Файл должен быть в формате pdf или txt',
        4 => 'Папка для загрузки файла не выбрана',
        5 => 'Ошибка перемещения файла',
    ];

    /**
     * UploadService handles validated storage of PDF and TXT files for assignments and submissions.
     * @param array $file
     * @param string $dirName
     * @return string
     */
    public function upload(array $file, string $dirName = ''): string
    {
        if(!isset($file) || empty($file['tmp_name'])){
            return self::UPLOAD_FILE_ERRORS[1];
        }
        if($file['error'] !== UPLOAD_ERR_OK){
            return self::UPLOAD_FILE_ERRORS[$file['error']] ?? 'Неизвестная ошибка';
        }
        if($file['size'] > self::MAX_FILE_SIZE){
            return self::UPLOAD_FILE_ERRORS[2];
        }
        $mimeType = mime_content_type($file['tmp_name']);
        if(!$mimeType || !in_array($mimeType, self::FILE_AVAILABLE_TYPE)){
            return self::UPLOAD_FILE_ERRORS[3];
        }
        if(!in_array($dirName, ['submission' , 'assignment'])){
            return self::UPLOAD_FILE_ERRORS[4];
        }
        $folder = $dirName === 'submission' ? 'submissions' : 'assignments';
        $uploadDir = FILE_UPLOAD_DIR . "/$folder";
        $fileName = uniqid() . '_' . basename($file['name']);
        $filePath = $uploadDir . '/' . $fileName;

        if(!is_dir($uploadDir)){
            mkdir($uploadDir, 0777, true);
        }
        if(!move_uploaded_file($file['tmp_name'], $filePath)){
            return self::UPLOAD_FILE_ERRORS[5];
        }
        return $fileName;
    }

    /**
     * Handles loading a file from the global $_FILES array
     * @param string $path
     * @return string|null
     */
    public function uploadedFile(string $path): ?string
    {
        if(!isset($_FILES['file'])){
            return null;
        }
        $file = $this->upload($_FILES['file'], $path);
        if(in_array($file,self::UPLOAD_FILE_ERRORS, true)){
            Session::setSession('errors', $file);
            return null;
        }
        return $file;
    }
}