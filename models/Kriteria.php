<?php

namespace Models;

class Kriteria {

    protected $pdo;

    protected $filter = [];

    public function __construct ($pdo)
    {
        $this->pdo = $pdo;
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function index ()
    {
        $query = "SELECT * FROM kriteria";

        if ( ! empty($this->filter)) {
            $query .= " WHERE ";

            $countFilter = count($this->filter);

            $noFilter = 1;
            foreach ($this->filter as $filterKey => $filter) {
                $query .= " $filterKey=$filter ";

                if ($countFilter > $noFilter) {
                    $noFilter++;

                    $query .= " AND ";
                }
            }
        }

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getKriteriaAndSubKriteria()
    {
        $query = "SELECT kriteria.id AS id, kriteria.nama AS nama, kriteria.status_sub AS status_sub, sub_kriteria.id AS sub_kriteria_id, sub_kriteria.nama AS sub_kriteria_nama FROM kriteria " .
                 "LEFT JOIN sub_kriteria ON kriteria.id = sub_kriteria.kriteria_id";

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $resultReduce = [];

        foreach ($result as $resultItem) {
            if ( ! isset($resultReduce[$resultItem['id']])) {
                $resultReduce[$resultItem['id']] = [
                    'id' => $resultItem['id'],
                    'nama' => $resultItem['nama'],
                    'status_sub' => $resultItem['status_sub'],
                    'sub_kriteria' => []
                ];
            }

            if ($resultReduce[$resultItem['id']]['status_sub'] == 1) {
                $resultReduce[$resultItem['id']]['sub_kriteria'][] = [
                    'id' => $resultItem['sub_kriteria_id'],
                    'nama' => $resultItem['sub_kriteria_nama']
                ];
            }
        }

        return $resultReduce;
    }

    public function create ($data)
    {
        try {
            $nama = $data['nama'] ?? null;
            $bobot = $data['bobot'] ?? null;
            $status = $data['status'] ?? null;
            $sub = $data['sub'] ?? null;
    
            if ($nama !== "" && $bobot !== "" && $status !== "" && $sub !== "") {
    
                $query = "INSERT INTO kriteria VALUES(null, ?, ?, ?, ?)";
                
                $statement = $this->pdo->prepare($query);
                
                $execute = $statement->execute([
                    $nama,
                    $bobot,
                    $status,
                    $sub
                ]);

                return $execute ? 'success' : 'fail';
            } else {
                return 'validation';
               
            }
        } catch (Exception $e) {
            return 'fail';
        }    
    }

    public function find($id)
    {
        try {
            if ($id !== "") {
    
                $query = "SELECT * FROM kriteria WHERE id = ?";
                
                $statement = $this->pdo->prepare($query);
                
                $statement->execute([
                    $id,
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

    public function findLatest()
    {
        try {
            $query = "SELECT * FROM kriteria ORDER BY id DESC LIMIT 1";
            
            $statement = $this->pdo->prepare($query);
            
            $statement->execute();

            if ($statement->rowCount() <= 0) {
                return null;
            }

            return $statement->fetch(\PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        } 
    }

    public function update ($data)
    {
        try {
            $id = $data['id'] ?? null;
            $nama = $data['nama'] ?? null;
            $bobot = $data['bobot'] ?? null;
            $status = $data['status'] ?? null;
            $sub = $data['sub'] ?? null;

            if ($id !== "" && $nama !== "" && $bobot !== "" && $status !== "" && $sub !== "") {
    
                $query = "UPDATE kriteria SET nama = ?, bobot = ?, status = ?, status_sub = ? WHERE id = ?";
                
                $statement = $this->pdo->prepare($query);
                
                $execute = $statement->execute([
                    $nama,
                    $bobot,
                    $status,
                    $sub,
                    $id
                ]);

                return $execute ? 'success' : 'fail';
            } else {
                return 'validation';
               
            }
        } catch (\Exception $e) {
            return 'fail';
        }    
    }

    public function updateBobotToNol ($id)
    {
        try {
            if ($id !== null) {

                $query = "UPDATE kriteria SET bobot = ? WHERE NOT id IN (?)";
                
                $statement = $this->pdo->prepare($query);
                
                $execute = $statement->execute([
                    "0",
                    $id
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
    
                $query = "DELETE FROM kriteria WHERE id = ?";
                
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
}