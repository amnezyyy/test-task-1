<?php

namespace App\Http\Controllers;

use App\Libs\Action\RecordAction;
use App\Models\Record;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index () : object
    {
        $records = Record::get()->take(50);
        $records = $records->unique('record_id');
        foreach ($records as $record) {
            foreach (Record::where('record_id', $record->record_id)->get() as $item) {
                $result[$record->record_id][] = [
                    'text' => $item->text,
                    'comment' => $item->comment,
                ];
            }
        }
        return view('index', compact('result'));
    }

    public function record (Request $request)
    {
        $action = new RecordAction($request->all());
        return $action->added();
    }
}
