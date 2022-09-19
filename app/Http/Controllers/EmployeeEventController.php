<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreEmployeeEventRequest;
use App\Http\Requests\UpdateEmployeeEventRequest;
use App\Http\Requests\GenerateEventsForAllEmployees;
use App\Models\EmployeeEvent;
use App\Models\Employee;
use App\Models\Event;

class EmployeeEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee_events = EmployeeEvent::with('event')
                                        ->whereIn('employee_event_status', ['Pending', 'Not Approved'])
                                        ->orderBy(Employee::select('employee_name')->whereColumn('employees.employee_id', 'employee_events.employee_employee_id'))
                                        ->orderBy(Event::select('event_date')->whereColumn('events.event_id', 'employee_events.event_event_id'))
                                        ->get();
        return view('employee_event.list', ['employee_events' => $employee_events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $events = Event::all();
        return view('employee_event.create', compact('employees', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeEventRequest $request)
    {
        $validated = $request->validated();
        if($validated)
            EmployeeEvent::create([
                'employee_employee_id' => $request->input('employee_id'),
                'event_event_id' => $request->input('event_id'),
                'employee_event_status' => 'Pending'
            ]);
        return redirect()->route('employee_events.index')->with('status','Employee x Event has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeEvent  $employeeEvent
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeEvent $employeeEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeEvent  $employeeEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeEvent $employeeEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeEventRequest  $request
     * @param  \App\Models\EmployeeEvent  $employeeEvent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeEventRequest $request, EmployeeEvent $employeeEvent)
    {
        $validated = $request->validated();
        if($validated)
            $employeeEvent->fill($request->post())->save();
            
        return redirect()->route('employee_events.index')->with('status', 'Employee X Event has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeEvent  $employeeEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeEvent $employeeEvent)
    {
        $employeeEvent->delete();
        return redirect()->route('employee_events.index')->with('status', 'Employee X Event has been deleted successfully');
    }

    /**
     * Generate the event received as parameter to all Employees
     * 
     * @param  \App\Http\Requests\GenerateEventsForAllEmployees  $request
     * @return \Illuminate\Http\Response
     */
    public function generateEventForAllEmployees(GenerateEventsForAllEmployees $request) {
        $validated = $request->validated();
        if($validated) {
            $employees = Employee::all();
            foreach($employees as $employee) {
                $exists = EmployeeEvent::where('event_event_id', $request->input('event_id'))
                                        ->where('employee_employee_id', $employee->employee_id)->first();
                if(is_null($exists)) 
                    EmployeeEvent::create([
                        'employee_employee_id' => $employee->employee_id,
                        'event_event_id' => $request->input('event_id'),
                        'employee_event_status' => 'Pending'
                    ]);
            }
        }
        return redirect()->route('employee_events.index')->with('status', 'Employee X Event generated successfully');
    }
}
