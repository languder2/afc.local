<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
class AFCModel extends GeneralModel {
    protected $table= "3report";
    private $byDays= "appDate";
    private $byTimes= "appDateTime";
    protected $dateFormat= "d.m";
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
    private function prepareGroupBy(&$groupBy):bool{
        if(!is_array($groupBy))
            $groupBy= [$groupBy];
        return true;
    }
    private function replaces(&$rec,array $replaces){
        foreach ($replaces as $field)
            $rec->{$field}= $this->statuses[$field][$rec->{$field}];
    }

    private function generateTreeByTerms($res,$fieldTrees):array{
        $results= [];
        foreach ($res as $rec){
            $day= date($this->dateFormat,strtotime($rec->{$this->byDays}));
            if($fieldTrees)
                $results[$day][$rec->{$fieldTrees}]= $rec->cnt;
            else
                $results[$day]= $rec->cnt;
        }
        return $results;
    }
    public function getAFC(
        array|string $groupBy,
        array|bool $select= false,
        array|bool|string $where= false,
        array|bool $orderBy= false,
        bool $dayTrees = false,
        bool|string $fieldTrees = false,
        array|bool $replaces= false
    ):array|object
    {
        self::prepareGroupBy($groupBy);
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
        if($dayTrees)
            $res= self::generateTreeByTerms($res,$fieldTrees);
        return $res;
    }
    public function prepareWhere($rec,$ops,&$where):bool
    {
        if(!is_array($ops)) $ops=[$ops];
        $where= [];
        foreach ($ops as $op)
            $where[$op]= $rec->{$op};
        return true;
    }
    public function getValuesByList(array &$list,string $code,string|array $ops,array|string $select,array|string $groupBy,?string $assoc= NULL):array|bool
    {
        if(!count($list))return false;
        foreach ($list as $key=>$rec){
            self::prepareWhere($rec,$ops,$where);
            $list[$key]->{$code}= $this->db
                ->table($this->table)
                ->select($select)
                ->where($where)
                ->groupBy($groupBy)
                ->get()
                ->getResult();
        }
        return true;
    }

}
