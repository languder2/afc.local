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

    public function prepareList($list, $key):array
    {
        $results= [];
        foreach ($list as $item)
            $results[$item->{$key}] = $item;

        return  $results;
    }
    public function prepareDataset($item,string $code, int &$max, bool $short= false):array
    {
        $arr = [
            $item->pr1,
            $item->pr2,
            $item->pr3,
            $item->pr4,
            $item->pr5,
            $item->other,
        ];

        $max= max($arr);

        $dataset[] = (object)[
            "label" => $code,
            "color" => "#001AFF",
            "list"  => json_encode($arr,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
        ];

        return $dataset;
    }
    public function prepareFormDatasets($list, $forms, int &$max, &$labels):array
    {
        $max= 0;

        $datasets = [];

        $arr = [];

        $colors= ["#001AFF","#820000","#CE9400","#001AFF","#820000","#CE9400",];


        foreach ($list as $key=>$item){
            $label= $this->statuses['specShape'][$forms[$item->form]->name]??$forms[$item->form]->name;
            $arr[] = $item->total;
            $datasets[] = (object)[
                "label" => $label,
                "color" => $colors[$key],
                "list"  => json_encode([$item->total],JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }

        $max= max($arr);

        return $datasets;
    }
    public function prepareFormDatasetsPR($list, $forms, int &$max, $short= false):array
    {
        $max= 0;

        $datasets = [];

        $colors= ["#001AFF","#820000","#CE9400","#001AFF","#820000","#CE9400",];

        //dd($this->colors);

        foreach ($list as $key=>$item){
            if($short)
                $arr= [
                    $item->pr1,
                    $item->pr2,
                    $item->pr3,
                    $item->pr4,
                    $item->pr5,
                    $item->other,
                ];
            else
                $arr = [
                    $item->pr1,
                    $item->total - $item->pr1,
                ];

            $max= (max($arr)>$max)?max($arr):$max;

            $label= $this->statuses['specShape'][$forms[$item->form]->name]??$forms[$item->form]->name;

            $datasets[] = (object)[
                "label" => $label,
                "color" => $colors[$key],
                "list"  => json_encode($arr,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }
        return $datasets;
    }

    public function prepareLevelDatasets($list, $levels, int &$max, &$labels):array
    {
        $max= 0;

        $datasets = [];

        $arr = [];

        foreach ($list as $key=>$item){
            $label= $levels[$item->level]->code;
            $arr[] = $item->total;
            $datasets[] = (object)[
                "label" => $label,
                "color" => $this->colors[$levels[$item->level]->name],
                "list"  => json_encode([$item->total],JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }

        $max= max($arr);

        return $datasets;
    }

    public function prepareLevelDatasetsPR($list, $levels, int &$max, $short= false):array
    {
        $max= 0;

        $datasets = [];

        foreach ($list as $key=>$item){
            if($short)
                $arr= [
                    $item->pr1,
                    $item->pr2,
                    $item->pr3,
                    $item->pr4,
                    $item->pr5,
                    $item->other,
                ];
            else
                $arr = [
                    $item->pr1,
                    $item->total - $item->pr1,
                ];

            $max= (max($arr)>$max)?max($arr):$max;

            $label= $levels[$item->level]->code;

            $datasets[] = (object)[
                "label" => $label,
                "color" => $this->colors[$levels[$item->level]->name],
                "list"  => json_encode($arr,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }
        return $datasets;
    }

    public function prepareMSDatasets($list, int &$max):array
    {
        $max= 0;

        $datasets = [];

        $arr = [];

        $colors= ["#001AFF","#820000","#CE9400"];

        foreach ($list as $key=>$item){
            $label= $this->statuses['methodSubmitting'][$item->op]??$item->op;
            $arr[] = $item->total;
            $datasets[] = (object)[
                "label" => $label,
                "color" => $colors[$key],
                "list"  => json_encode([$item->total],JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }

        $max= max($arr);

        return $datasets;
    }
    public function prepareMSDatasetsPR($list, int &$max, $short= false):array
    {
        $max= 0;

        $datasets = [];

        $colors= ["#001AFF","#820000","#CE9400","#001AFF","#820000","#CE9400",];

        //dd($this->colors);
        foreach ($list as $key=>$item){
            if(!$short)
                $arr= [
                    $item->pr1,
                    $item->pr2,
                    $item->pr3,
                    $item->pr4,
                    $item->pr5,
                    $item->other,
                ];
            else
                $arr = [
                    $item->pr1,
                    $item->total - $item->pr1,
                ];

            $max= (max($arr)>$max)?max($arr):$max;

            $label= $this->statuses['methodSubmitting'][$item->op]??$item->op;

            $datasets[] = (object)[
                "label" => $label,
                "color" => $colors[$key],
                "list"  => json_encode($arr,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }
        return $datasets;
    }

    public function getDatasets(array $list,string $code, int &$max, bool $short= false):array
    {
        $replaces= $this->statuses[$code];

        $colors = ["#001AFF","#820000"];

        $datasets= [];

        $max= 0;
        foreach ($list as $key=>$item){
            if($short)
                $arr= [
                    $item->pr1,
                    $item->cnt-$item->pr1,
                    $item->pr1 + $item->pr2 + $item->pr4 + $item->pr5 + $item->other,
                ];
            else
                $arr= [
                    $item->pr1,
                    $item->pr2,
                    $item->pr3,
                    $item->pr4,
                    $item->pr5,
                    $item->other,
                ];

            $max= (max($arr)>$max)?max($arr):$max;

            $datasets[] = (object)[
                "label" => $replaces[$item->op]??$item->op,
                "color" => $colors[$key],
                "list"  => json_encode($arr,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE)
            ];
        }

        return $datasets;
    }


}

