<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddDriverRequest;
use App\Http\Requests\Admin\UpdateDriverRequest;
use App\Models\DriverProfile;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::all();

        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['name' => "Drivers"],
        ];

        $addNewBtn = "admin.driver.create";

        $pageConfigs = ['pageHeader' => true];

        return view('backend.drivers.list', compact('drivers', 'langs', 'pageConfigs', 'breadcrumbs', 'addNewBtn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/driver", 'name' => "Drivers"], ['name' => "Create"]
        ];

        $pageConfigs = ['pageHeader' => true];
        return view('backend.drivers.add', compact(['langs', 'pageConfigs', 'breadcrumbs']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddDriverRequest $request)
    {
        try {
            $driver = new Driver();
            $driver->first_name = $request->first_name;
            $driver->last_name = $request->last_name;
            $driver->phone = $request->phone;
            $driver->save();
            $driverProfile = new DriverProfile();
            $driverProfile->driver_id = $driver->id;
            $driverProfile->email = $request->email;

            if ($request->birthdate) {
                $dob = DateTime::createFromFormat('d/m/Y', $request->birthdate);
                $driverProfile->birthdate = $dob->format('Y-m-d');
            }
            $driverProfile->gender = $request->gender ? intval($request->gender) : null;
            $driverProfile->image = $request->hasFile('image') ? uploadFile('driver', $request->file('image'), $driverProfile->image) : $driverProfile->image;
            $driverProfile->save();

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        $langs = $this->lang;

        $breadcrumbs = [
            ['link' => "admin", 'name' => "Dashboard"], ['link' => "admin/driver", 'name' => "Drivers"], ['name' => "Update"]
        ];

        return view('backend.drivers.show', compact(['driver', 'langs', 'breadcrumbs']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        try {
            $driver->first_name = $request->first_name;
            $driver->last_name = $request->last_name;
            $driver->phone = $request->phone;
            $driver->save();

            $driverProfile = new DriverProfile();
            $driverProfile->driver_id = $driver->id;
            $driverProfile->email = $request->email;

            if ($request->birthdate) {
                $dob = DateTime::createFromFormat('d/m/Y', $request->birthdate);
                $driverProfile->birthdate = $dob->format('Y-m-d');
            }
            $driverProfile->gender = $request->gender ? intval($request->gender) : null;
            $driverProfile->image = $request->hasFile('image') ? uploadFile('driver', $request->file('image'), $driverProfile->image) : $driverProfile->image;
            $driverProfile->save();

            return redirect()->back()->with('success', __('system-messages.update'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect(route('admin.driver.index'))->with('success', __('system-messages.delete'));
    }
}
