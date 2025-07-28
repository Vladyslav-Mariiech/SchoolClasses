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
    public function add(string $name, string $link, int $ownerId): int|string
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

    /**
     * Finds a class by its unique invite link.
     * @param string $link
     * @return bool|array|null
     */
    public function findByLink(string $link): bool|array|null
    {
        $result =  $this->db->query("SELECT id, name FROM classes WHERE link = ?", "s", [$link]);
        if($result){
            return $result[0];
        }
        return null;
    }

}