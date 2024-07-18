<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;

class GeneralModel extends UserModel
{

    public array $statuses;
    public array $colors;

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        self::getStatuses();
    }

    public function getStatuses(): bool
    {
        $q = $this->db->table("statuses")->get()->getResult();
        foreach ($q as $rec)
            $this->statuses[$rec->type][$rec->value] = $rec->text;

        $q = $this->db->table("colors")->get()->getResult();
        foreach ($q as $rec)
            $this->colors[$rec->name] = $rec->color;

        return true;
    }

    public function get_dates($start, $end, $format = 'd.m.Y'): array
    {
        $day = 86400;
        $start = strtotime($start . ' -1 days');
        $end = strtotime($end . ' +1 days');
        $nums = round(($end - $start) / $day);

        $days = array();
        for ($i = 1; $i < $nums; $i++) {
            $days[] = date($format, ($start + ($i * $day)));
        }

        return $days;
    }

    public function setArrayKey(?array &$list= [],string $key= "id"):void
    {
        $results= [];

        foreach ($list as $item)
            $results[$item->{$key}] = $item;

        $list = $results;
    }

    public function replacementByRefers(array &$list,string $field,array $refer):void
    {
        foreach ($list as $key=>$item)
            $list[$key]->{$field} = $refer[$item->{$field}]??$item->{$field};

    }

}
