<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ExportController extends Controller
{
    public function export()
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        $dump = [];

        foreach ($tables as $table) {
            $dump[$table] = DB::table($table)->get();
        }

        $filename = 'backup-' . now()->format('Y-m-d_H-i-s') . '.json';

        return response()->streamDownload(function () use ($dump) {
            echo json_encode($dump, JSON_PRETTY_PRINT);
        }, $filename);
    }
}

