<?php

include_once("BaseRepository.php");

class FilesPdfRepo extends BaseRepository
{
    public function get($id)
    {
        return $this->pdo->query("SELECT * FROM files_pdfs WHERE id = {$id}")->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data = array())
    {
        $stmt = $this->pdo->prepare("INSERT INTO files_pdfs (name, path_image, type, created_at) VALUES (:name, :path_image, :type, NOW())");
        if($stmt->execute($data)){
            $id = $this->pdo->lastInsertId();
            return $this->get($id);
        }else{
            $error = $query->errorInfo();
            return $error[2];
        }
    }

    public function getToday($type)
    {
        return $this->pdo->query("SELECT * FROM files_pdfs WHERE type = '{$type}' AND DATE_FORMAT(created_at, '%Y-%m-%d') = '" . date('Y-m-d') . "' ORDER BY id DESC")->fetch(\PDO::FETCH_ASSOC);   
    }
}
