<?php
namespace App\Models;

use PDO;
use QueryBuilder;

class Room
{
    public static function getById($room_id)
    {
        return QueryBuilder::table('rooms')->setFetchMode(PDO::FETCH_CLASS, get_called_class())->find($room_id);
    }

    public static function getByPlayerId(int $player_id)
    {
        return QueryBuilder::table('rooms')->where('owner_id', $player_id)->OrderBy('id', 'desc')->get();
    }

    public static function save($room_id, $room_name, $room_desc, $access_type, $max_users)
    {
        $data = array(
            'name'          => $room_name,
            'description'   => $room_desc,
            'state'         => $access_type,
            'users_max'      => $max_users
        );

        return QueryBuilder::table('rooms')->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('id', $room_id)->update($data);
    }
}