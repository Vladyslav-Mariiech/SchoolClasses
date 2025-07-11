<?php

namespace app\models;

class ClassModel extends BaseModel
{
    /**
     * Create new class
     * @param string $name
     * @param string $link
     * @param int $ownerId
     * @return int|string
     */
    public function add(string $name, string $link, int $ownerId)
    {
        $this->db->query(
            'INSERT INTO classes (name, link, owner_id) VALUES (?,?,?)',
            'ssi',
            [$name, $link, $ownerId],
        );
        //TODO Exception
        $lastId = $this->db->getConnection()->insert_id;
        
        return $lastId;
    }
}