<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\History;
use App\Models\Computer;
use App\Models\Customer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{

    // Search computer by brand
    public function search(Request $request)
    {
        $form = $request->validate([
            'brand' => 'required',
        ]);

        $computers = Computer::where('brand', '=', $form['brand'])->get();

        return view('rental', compact('computers'));
    }

    // View computer list for rental
    public function rent()
    {
        $computers = Computer::all();
        return view('rental', compact('computers'));
    }

    // View a computer details
    public function view(Computer $computer)
    {
        return view('computer', compact('computer'));
    }

    // Create a new computer
    public function create(Request $request)
    {
        $form = $request->validate([
            'brand' => 'required',
            'price' => 'required',
            'system' => 'required',
            'display' => 'required',
            'ram' => 'required',
            'usbCount' => 'required',
            'hdmi' => 'required'
        ]);

        // store the path of the image into the database
        if ($request->hasFile('image')) {
            $form['image'] = $request->file('image')->store('assets', 'public');
        }

        Computer::create($form);

        return redirect('/master');
    }

    // View computer edit page
    public function edit(Computer $computer)
    {
        return view('computerEdit', compact('computer'));
    }

    // Update a computer
    public function update(Request $request, Computer $computer)
    {
        $form = $request->validate([
            'brand' => 'required',
            'price' => 'required',
            'system' => 'required',
            'display' => 'required',
            'ram' => 'required',
            'usbCount' => 'required',
            'hdmi' => 'required'
        ]);

        $computer->update($form);

        return redirect('/master');
    }

    // Delete a computer
    public function delete(Computer $computer)
    {
        $computer->delete();
        return redirect('/')->with('message', 'Computer Deleted!');
    }

    // View the rental creation page of a computer
    public function createRent(Computer $computer)
    {
        $customer = Customer::where('id', '=', auth()->user()->id)->get()[0];
        return view('rentalCreate', compact('computer', 'customer'));
    }

    // Update the status of computer and balance of user
    public function updateRent(Request $request, Computer $computer)
    {

        // Get the total rent
        $form = $request->validate([
            'balance' => 'required'
        ]);

        // Update customer's balance
        $customer = Customer::where('id', '=', auth()->user()->id)->get()[0];
        $form['balance'] = $customer['balance'] - $form['balance'];
        $customer->update($form);

        // Update computer's rental state (0: unrented; 1: rented; 2: returning)
        $computer['isRented'] = 1;
        $computer['userId'] = auth()->user()->id;
        $computer->save();

        // Create a rental history
        $form_history['userId'] = auth()->user()->id;
        $form_history['computerId'] = $computer->id;
        $currentTime = Carbon::now()->toDateTimeString();
        $form_history['dateOfTime'] = $currentTime;
        History::create($form_history);

        return redirect('/user');
    }

    // View the return rental Page
    public function return()
    {
        // get computer rental history list by logged in user
        $histories = History::where('userId', '=', auth()->user()->id)->get();

        // retrieve the array of rented computer Id from histories
        $computerId = [];
        foreach ($histories as $history) {
            array_push($computerId, $history['computerId']);
        }

        // get the computer list that has been rented by the authenticated user
        $computers = Computer::where('isRented', '=', 1)->where('id', '=', $computerId)->get();

        return view('rentalReturn', compact('computers'));
    }

    // Return the computer
    public function returnComputer(Computer $computer)
    {
        // update the rental state of the computer: Pending return(2)
        $computer['isRented'] = 2;
        $computer['userId'] = NULL;
        $computer->save();

        return redirect('/user');
    }

    // Manage the returned computers
    public function returnManage()
    {
        // retrieve all the computers that currently rented(1) or pending return(2)
        $computers = Computer::where('isRented', '=', 1)->orwhere('isRented', '=', 2)->orderBy('isRented')->get();

        return view('rentalManage', compact('computers'));
    }

    // Comfirm the return of computer, update the rental and damage status
    public function returnConfirm(Request $request, Computer $computer)
    {
        // get the damage status of the computer
        $form = $request->validate([
            'isDamaged' => 'required',
        ]);

        // get the loggin customer
        $customer = Customer::where('id', '=', auth()->user()->id)->get()[0];

        // not damage: balance + $50 
        if (!$form['isDamaged']) {
            $customer['balance'] = $customer['balance'] + 50;

            // minor Damage and no insurance: balance - $100
        } elseif (!$computer['hasInsurance'] && $form['isDamaged'] == 1) {
            $customer['balance'] = $customer['balance'] - 100;
            $customer['damageTime'] = $customer['damageTime'] + 1;

            // major damage and no insurance: balance - $500
        } elseif (!$computer['hasInsurance'] && $form['isDamaged'] == 2) {
            $customer['balance'] = $customer['balance'] - 500;
            $customer['damageTime'] = $customer['damageTime'] + 1;

            // damage with insurance
        } else {
            $customer['damageTime'] = $customer['damageTime'] + 1;
        }

        // save customer update
        $customer->save();

        // update the rental status of the computer: not rented(0)
        $form['isRented'] = 0;

        // update damage and rental status of the computer
        $computer->update($form);

        return redirect('/return/manage');
    }

    // View Computer list for master
    public function master()
    {
        $computers = Computer::all();
        return view('master', compact('computers'));
    }
}
