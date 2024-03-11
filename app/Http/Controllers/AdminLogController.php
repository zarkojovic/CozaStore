<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminLogController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        // get logs with username and name of action

        $logs = Log::join('users', 'logs.user_id', '=', 'users.id')
            ->join('actions', 'actions.id', '=', 'logs.action_id')
            ->select('logs.id', 'users.username', 'logs.log_message',
                'actions.action_name', 'logs.created_at as action_date')
            ->paginate(10);
        if ($logs->isEmpty()) {
            $columns = [];
        }
        else {
            // get names of the columns from the results
            $columns = array_keys($logs[0]->getAttributes());
        }
        return view('pages.admin.logs.home',
            ['logs' => $logs, 'columns' => $columns]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        // delete the log
        $log = Log::find($id);
        if ($log->delete()) {
            return redirect()->route('logs.index');
        }
    }

}
