<?php

namespace App\Libs\Action;

use App\Models\Record;

class RecordAction
{
    private $record;
    public function __construct(array $record)
    {
        $this->record = $record;
    }

    public function added ()
    {
        if ($this->record['record_id'] == 'new') {
            $this->record['record_id'] = Record::max('record_id')+1;
        }
        Record::create($this->record);

        return $this->record;
    }
}
