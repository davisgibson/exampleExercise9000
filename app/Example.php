<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class Example extends Model
{
    public static function getAll(): Collection
    {
        return collect(SimpleExcelReader::create(self::getPathToCsv())->getRows()->all());
    }

    public static function store(Array $data)
    {
        $data['id'] = self::getNextId();

        if(!file_exists(self::getPathToCsv()))
        {
            SimpleExcelWriter::create(self::getPathToCsv())->addRow($data);
            return;
        }

        //because SimpleExcelWriter doesnt support adding lines to an existing csv :/
        self::addLine($data);
    }

    public static function getPathToCsv()
    {
        return storage_path() . '/examples.csv';
    }

    private static function getNextId()
    {
        if(!file_exists(self::getPathToCsv()))
            return 1;

        return SimpleExcelReader::create(self::getPathToCsv())
                        ->getRows()->sortByDesc('id')->first()['id'] + 1;
    }

    private static function addLine(Array $data)
    {
        $handle = fopen(self::getPathToCsv(), 'a');

        fputcsv($handle, collect($data)->values()->toArray());

        fclose($handle);
    }  

    public static function findById($exampleId)
    {
        return self::getAll()->where('id', $exampleId)->first();
    }

    public static function updateById($exampleId, $updateData)
    {
        //I really wish there were a better way to do this
        $i = 0;
        $newdata = [];
        $handle = fopen(self::getPathToCsv(), "r");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {    
            if ($data[4] == $exampleId) {
                $newdata[$i][] = $updateData['title'];
                $newdata[$i][] = $updateData['url'];
                $newdata[$i][] = $updateData['is_approved'];
                $newdata[$i][] = $data[3];
                $newdata[$i][] = $data[4];
                $i++;
                continue;
            }  
            $newdata[$i][] = $data[0];
            $newdata[$i][] = $data[1];
            $newdata[$i][] = $data[2];
            $newdata[$i][] = $data[3];
            $newdata[$i][] = $data[4];
            $i++;    
        }

        $fp = fopen(self::getPathToCsv(), 'w');    
        foreach ($newdata as $rows) {
            fputcsv($fp, $rows);
        }    
        fclose($fp);
    }

    public static function deleteById($exampleId)
    {
        //I also wish there were a better way to do THIS
        $i = 0;
        $newdata = [];
        $handle = fopen(self::getPathToCsv(), "r");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {    
            if ($data[4] == $exampleId) {
                continue;
            }  
            $newdata[$i][] = $data[0];
            $newdata[$i][] = $data[1];
            $newdata[$i][] = $data[2];
            $newdata[$i][] = $data[3];
            $newdata[$i][] = $data[4];
            $i++;    
        }

        $fp = fopen(self::getPathToCsv(), 'w');    
        foreach ($newdata as $rows) {
            fputcsv($fp, $rows);
        }    
        fclose($fp);
    }
}
