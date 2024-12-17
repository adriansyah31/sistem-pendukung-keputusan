<?php

namespace Models;

class User {

    protected $pdo;

    public function __construct ($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index ()
    {
        $query = "SELECT * FROM user WHERE level = 0";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function find($username, $password)
    {
        try {
            if ($username !== "" && $password !== "") {

                $password = md5($password);
    
                $query = "SELECT * FROM user WHERE username = ? AND password = ?";
                
                $statement = $this->pdo->prepare($query);
                
                $statement->execute([
                    $username,
                    $password
                ]);

                if ($statement->rowCount() <= 0) {
                    return null;
                }

                return $statement->fetch(\PDO::FETCH_ASSOC);
            } else {
                
                return null;
               
            }
        } catch (Exception $e) {
            return null;
        } 
    }

    public function create ($data)
    {
        try {
            $username = $data['username'] ?? null;
            $password = $data['password'] ?? null;
            $nama = $data['nama'] ?? null;
            $alamat = $data['alamat'] ?? null;
            $telpon = $data['telpon'] ?? null;
            $level = $data['level'] ?? null;
    
            if ($username !== "" && $password !== "" && $nama !== "" && $alamat !== "" && $telpon !== "" && $level !== "") {
                
                $password = md5($password);

                $query = "INSERT INTO user VALUES(null, ?, ?, ?, ?, ?, ?)";
                
                $statement = $this->pdo->prepare($query);
                
                $execute = $statement->execute([
                    $username,
                    $password,
                    $nama,
                    $alamat,
                    $telpon,
                    $level
                ]);

                return $execute ? 'success' : 'fail';
            } else {
                return 'validation';
               
            }
        } catch (\Exception $e) {
            return 'fail';
        }    
    }

    public function delete($id)
    {
        try {
            if ($id !== "") {
    
                $query = "DELETE FROM user WHERE id = ?";
                
                $statement = $this->pdo->prepare($query);
                
                $execute = $statement->execute([
                    $id,
                ]);

                return $execute;
            } else {
                return false;
               
            }
        } catch (\Exception $e) {
            return false;
        } 
    }

    public function forget ($data)
    {
        try {
            $telpon = $data['telpon'] ?? null;
            $password = $data['password'] ?? null;

            if ($telpon !== "" && $password !== "" ) {

                $password = md5($password);
    
                $query = "UPDATE user SET password = ? WHERE telpon = ?";
                
                $statement = $this->pdo->prepare($query);
                
                $execute = $statement->execute([
                    $password,
                    $telpon
                    
                ]);

                return $execute ? 'success' : 'fail';
            } else {
                return 'validation';
               
            }
        } catch (\Exception $e) {
            return 'fail';
        }    
    }
}