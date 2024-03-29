<?php

namespace App\Imports;

use App\EmailRegistry;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EmailRegistryImport implements ToModel, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new EmailRegistry([
			'email'    => trim($row[0]),
		]);
    }
	
	public function batchSize(): int
	{
		return 1000;
	}
	
	public function chunkSize(): int
	{
		return 1000;
	}
}
