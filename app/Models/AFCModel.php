<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
class AFCModel extends GeneralModel {
    protected $table= "3report";
    private $byDays= "appDate";
    private $byTimes= "appDateTime";
    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }

    private function prepareSelect($groupBy,&$select):bool{
        if($select)
            $select= array_merge($groupBy,$select,["COUNT(id) as cnt"]);
        else
            $select= array_merge($groupBy,["COUNT(id) as cnt"]);
        return true;
    }
    private function prepareGroupBy(&$groupBy,$byDays,$byTimes):bool{
        if(!is_array($groupBy))
            $groupBy= [$groupBy];
        if($byDays or $byTimes)
            $groupBy[]= $byTimes?$this->byTimes:$this->byDays;
        return true;
    }
    private function replaces(&$rec,array $replaces){
        foreach ($replaces as $field)
            $rec->{$field}= $this->statuses[$field][$rec->{$field}];
    }

    private function generateTreeByTerms($res,$field):array{
        $results= [];
        foreach ($res as $rec)
            $results[$rec->{$field}][]= $rec;
        return $results;
    }

    public function getAFC(array|string $groupBy,array|bool $select= false,bool $byDays=false,bool $byTimes=false,array|bool|string $where= false,array|bool $orderBy= false,array|bool $replaces= false):array{
        self::prepareGroupBy($groupBy,$byDays,$byTimes);
        self::prepareSelect($groupBy,$select);
        $res= $this->db
            ->table($this->table)
            ->select($groupBy)
            ->select($select)
            ->where($where?$where:[])
            ->groupBy($groupBy)
            ->orderBy($orderBy)
            ->get()
            ->getResult();
        if($replaces)
            foreach ($res as $key=>$rec)
                self::replaces($res[$key],$replaces);
        if($byDays or $byTimes)
            $res= self::generateTreeByTerms($res,$byTimes?$this->byTimes:$this->byDays);
        return $res;

    }

}
