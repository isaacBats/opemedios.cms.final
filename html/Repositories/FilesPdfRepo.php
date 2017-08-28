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
        $stmt = $this->pdo->prepare("INSERT INTO files_pdfs (nombre, path_imagen, created_at) VALUES (:nombre, :path_imagen, NOW())");
        if($stmt->execute($data)){
            $id = $this->pdo->lastInsertId();
            return $this->get($id);
        }else{
            $error = $query->errorInfo();
            return $error[2];
        }
    }
}
