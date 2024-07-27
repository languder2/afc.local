<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Validation\ValidationInterface;
use mysql_xdevapi\Exception;

class AFCModel extends GeneralModel
{
    protected $table = "3report";
    protected $dateFormat = "d.m";
    private $byDays = "appDate";
    private $byTimes = "appDateTime";

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
    }

    public function getAFC(
        array|string      $groupBy,
        array|bool        $select = false,
        array|bool|string $where = false,
        array|bool        $orderBy = false,
        bool              $dayTrees = false,
        bool|string       $fieldTrees = false,
        array|bool        $replaces = false
    ): array|object
    {
        self::prepareGroupBy($groupBy);
        self::prepareSelect($groupBy, $select);
        $res = $this->db
            ->table($this->table)
            ->select($groupBy)
            ->select($select)
            ->where($where ? $where : [])
            ->groupBy($groupBy)
            ->orderBy($orderBy)
            ->get()
            ->getResult();
        if ($replaces)
            foreach ($res as $key => $rec)
                self::replaces($res[$key], $replaces);
        if ($dayTrees)
            $res = self::generateTreeByTerms($res, $fieldTrees);
        return $res;
    }

    private function prepareGroupBy(&$groupBy): bool
    {
        if (!is_array($groupBy))
            $groupBy = [$groupBy];
        return true;
    }

    private function prepareSelect($groupBy, &$select): bool
    {
        if ($select)
            $select = array_merge($groupBy, $select, ["COUNT(id) as cnt"]);
        else
            $select = array_merge($groupBy, ["COUNT(id) as cnt"]);
        return true;
    }

    private function replaces(&$rec, array $replaces)
    {
        foreach ($replaces as $field)
            $rec->{$field} = $this->statuses[$field][$rec->{$field}];
    }

    private function generateTreeByTerms($res, $fieldTrees): array
    {
        $results = [];
        foreach ($res as $rec) {
            $day = date($this->dateFormat, strtotime($rec->{$this->byDays}));
            if ($fieldTrees)
                $results[$day][$rec->{$fieldTrees}] = $rec->cnt;
            else
                $results[$day] = $rec->cnt;
        }
        return $results;
    }

    public function getAFCCount($groupBy = [], $where = []): int
    {
        return $this->db->table($this->table)->where($where)->groupBy($groupBy)->get()->getNumRows();
    }

    public function getValuesByList(array &$list, string $code, string|array $ops, array|string $select, array|string $groupBy, ?string $assoc = NULL): array|bool
    {
        if (!count($list)) return false;
        foreach ($list as $key => $rec) {
            self::prepareWhere($rec, $ops, $where);
            $list[$key]->{$code} = $this->db
                ->table($this->table)
                ->select($select)
                ->where($where)
                ->groupBy($groupBy)
                ->get()
                ->getResult();
        }
        return true;
    }

    public function prepareWhere($rec, $ops, &$where): bool
    {
        if (!is_array($ops)) $ops = [$ops];
        $where = [];
        foreach ($ops as $op)
            $where[$op] = $rec->{$op};
        return true;
    }

    public function prepareArrays(&$list, &$labels = [], $data, $field): bool
    {
        $list = [];
        foreach ($data as $rec) {
            $list[$rec->{$field}] = $rec->cnt;
            if (!in_array($rec->{$field}, $labels))
                $labels[] = $rec->{$field};
        }
        return true;
    }

    public function prepareDate($obj): string
    {
        $values = [];
        foreach ($obj as $value)
            $values[] = "'$value'";
        return implode(",", $values);
    }

    public function convertListToTreeFieldDate(array $list, ?string $field, bool $reverse = false): array
    {
        $result = [];
        foreach ($list as $rec)
            if ($field) {
                if ($reverse)
                    $result[$rec->{"appDate"}][$rec->{$field}] = $rec->cnt;
                else
                    $result[$rec->{$field}][$rec->{"appDate"}] = $rec->cnt;
            } else {
                $result[$rec->{"appDate"}] = $rec->cnt;
            }
        return $result;
    }

    public function fillMissingDates($dates, $list): array
    {
        $results = [];
        foreach ($dates as $date)
            $results[$date] = $list[$date] ?? 0;
        return $results;
    }


    public function buildSpecsTree(&$list):void
    {

        $fields= [
            "places",
            "cnt",
            "pr1",
            "pr2",
            "pr3",
            "pr4",
            "pr5",
            "other",
        ];

        $results= [];

        foreach ($list as $spec){
            if(!isset($results[$spec->code]))
                $results[$spec->code]= (object)[
                    "code"      => $spec->code,
                    "name"      => $spec->name,
                    "places"    => 0,
                    "cnt"       => 0,
                    "pr1"       => 0,
                    "pr2"       => 0,
                    "pr3"       => 0,
                    "pr4"       => 0,
                    "pr5"       => 0,
                    "other"     => 0,
                    "list"=> []
                ];

            $results[$spec->code]->list[]= $spec;
            foreach ($fields as $field)
                    $results[$spec->code]->{$field}   +=  $spec->{$field};
        }

        $list= $results;
    }


    public function getDatasetsFormDetailChart(array $list,string $chartID,string $title,array $dates):string
    {
        $max        = 0;

        $datasets   = [];

        $colors= (object)[
//            "total" =>  "#001AFF",
            "total" =>  "#001AFF",
            "pr1"    => "hsl(137, 100%, 14%)",
//            "pr1"    => "#820000",
        ];

        $labels= (object)[
            "total" =>  "суммарно",
            "pr1"    => "1-й приоритет",
        ];

        $data       = (object)[
            "total" => [],
            "pr1"   => []
        ];

        foreach ($list as $app){
            if($app->day == "all") continue;
            $data->total[]  = $app->total;
            $data->pr1[]    = $app->pr1;
        }

        foreach ($data as $key=>$set){
            $max= max($set)>$max?max($set):$max;

            $datasets[] = (object)[
                "label" => $labels->{$key},
                "color" => $colors->{$key},
                "list"  => json_encode($set,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }
        return view("public/AFC/ChartDetails",[
            "cid"           => $chartID,
            "chartTitle"    => $title,
            "legend"        => null,
            "labels"        => json_encode($dates,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $datasets,
            "max"           => $max??0,
            "width"         => "100%",
            "height"        => "35vh",
        ]);
    }

}
