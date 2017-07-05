<?php
namespace common\util;


interface IContentSummaryDataProvider
{
    public function getColumns();

    public function getData();
}