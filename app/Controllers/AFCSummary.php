<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AFCModel;

class AFCSummary extends BaseController
{
    protected array $data;
    protected array $dates;
    protected array $datesFull;

    private AFCModel $afc;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger):void
    {
        parent::initController($request, $response, $logger); // TODO: Change the autogenerated stub
        $this->afc = model(AFCModel::class);
        $this->dates = $this->model->get_dates('2024-06-20', date("Y-m-d"), "d.m");
        $this->datesFull = $this->model->get_dates('2024-06-20', date("Y-m-d"), "Y-m-d");
    }

    public function list(): string
    {
        $priorities = ["Приоритет 1","Приоритет 2","Приоритет 3","Приоритет 4","Приоритет 5","Остальные"];
        //$shorts =     ["Приоритет 1","Остальные"];
        $max        = 0;


        $forms= $this->db
            ->table("edForms")
            ->get()
            ->getResult();

        $forms= $this->model->prepareList($forms,"id");

        $levels= $this->db
            ->table("edLevels")
            ->get()
            ->getResult();

        $levels= $this->model->prepareList($levels,"id");


        /* Заявки бюджет */
        $apps= $this->db
            ->table("data")
            ->where("basis",        "budget")
            ->where("form",         "all")
            ->where("level",        "all")
            ->where("day",          "all")
            ->get()
            ->getFirstRow();


        $appBudget= view("public/AFC/ChartSummary", [
            "chartID"       => "appBudget",
            "chartTitle"    => "Заявки: бюджет",
            "legend"        => null,
            "labels"        => json_encode($priorities,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $this->model->prepareDataset($apps,"apps",$max),
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        /* Заявки контракт */
        $apps= $this->db
            ->table("data")
            ->where("basis",        "contract")
            ->where("form",         "all")
            ->where("level",        "all")
            ->where("day",          "all")
            ->get()
            ->getFirstRow();

        $appContract= view("public/AFC/ChartSummary", [
            "chartID"       => "appContract",
            "chartTitle"    => "Заявки: контракт",
            "legend"        => null,
            "labels"        => json_encode($priorities,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $this->model->prepareDataset($apps,"apps",$max),
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        /* Форма обучения*/
        $apps= $this->db
            ->table("data")
            ->where([
                "day"       => "all",
                "basis"       => "all",
                "form!="    => "all",
                "level"       => "all",
            ])
            ->get()
            ->getResult();

        $labels = [" "];
        $datasets= $this->model->prepareFormDatasets($apps,$forms,$max, $labels);

        $appForms= view("public/AFC/ChartSummary", [
            "chartID"       => "appForms",
            "chartTitle"    => "Формы обучения",
            "legend"        => true,
            "labels"        => json_encode($labels,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $datasets,
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        /* Форма обучения по приориетеам */
        $apps= $this->db
            ->table("data")
            ->where([
                "day"       => "all",
                "basis"       => "all",
                "form!="    => "all",
                "level"       => "all",
            ])
            ->get()
            ->getResult();

        $datasets= $this->model->prepareFormDatasetsPR($apps,$forms,$max, true);

        $appFormsPR= view("public/AFC/ChartSummary", [
            "chartID"       => "appFormsPR",
            "chartTitle"    => "Формы обучения по приоритетам",
            "legend"        => true,
            "labels"        => json_encode($priorities,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $datasets,
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        /* Уровень обучения*/
        $apps= $this->db
            ->table("data")
            ->where([
                "day"       => "all",
                "basis"     => "all",
                "form"      => "all",
                "level!="   => "all",
            ])
            ->get()
            ->getResult();

        $labels = [" "];
        $datasets= $this->model->prepareLevelDatasets($apps,$levels,$max, $labels);

        $appLevels= view("public/AFC/ChartSummary", [
            "chartID"       => "appLevels",
            "chartTitle"    => "Уровень обучения",
            "legend"        => true,
            "labels"        => json_encode($labels,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $datasets,
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        /* Уровень обучения по приориетеам */
        $apps= $this->db
            ->table("data")
            ->where([
                "day"       => "all",
                "basis"     => "all",
                "form"      => "all",
                "level!="   => "all",
            ])
            ->get()
            ->getResult();

        $datasets= $this->model->prepareLevelDatasetsPR($apps,$levels,$max, true);

        $appLevelsPR= view("public/AFC/ChartSummary", [
            "chartID"       => "appLevelsPR",
            "chartTitle"    => "Формы обучения по приоритетам",
            "legend"        => true,
            "labels"        => json_encode($priorities,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $datasets,
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        /* Способ подачи обучения*/
        $apps= $this->db
            ->table("dataMS")
            ->where([
                "day"       => "all",
                "basis"     => "all",
            ])
            ->get()
            ->getResult();

        $labels = [" "];
        $datasets= $this->model->prepareMSDatasets($apps,$max);

        $appMS= view("public/AFC/ChartSummary", [
            "chartID"       => "appMS",
            "chartTitle"    => "Способ подачи",
            "legend"        => true,
            "labels"        => json_encode($labels,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $datasets,
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        $datasets= $this->model->prepareMSDatasetsPR($apps,$max);

        $appMSPR= view("public/AFC/ChartSummary", [
            "chartID"       => "appMSPR",
            "chartTitle"    => "Способ подачи",
            "legend"        => true,
            "labels"        => json_encode($priorities,JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE),
            "datasets"      => $datasets,
            "max"           => $max,
            "width"         => "100%",
            "height"        => "200px",
        ]);

        /**/

        $includes=(object)[
            'js'=>[
            ],
            'css'=>[
            ],
        ];

        $pageContent= view("public/AFC/Summary", [
            "appBudget"             => $appBudget,
            "appContract"           => $appContract,
            "appForms"              => $appForms,
            "appFormsPR"            => $appFormsPR,
            "appLevels"             => $appLevels,
            "appLevelsPR"           => $appLevelsPR,
            "appMS"                 => $appMS,
            "appMSPR"               => $appMSPR,
        ]);

        return view("public/page",[
            "pageContent"   =>  $pageContent,
            "includes"      =>  $includes,
        ]);
    }

}