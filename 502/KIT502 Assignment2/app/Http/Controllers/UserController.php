<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use App\Models\Computer;
use App\Models\Customer;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // View user registration form
    public function register()
    {
        return view('registration');
    }

    // Create a new user
    public function store(Request $request)
    {
        $form = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => ['required', 'confirmed', 'min:8'],
            'isStudent' => 'required'
        ]);

        // create a new user
        $form_user['name'] = $form['name'];
        $form_user['email'] = $form['email'];

        // hash password
        $form_user['password'] = bcrypt($form['password']);
        $user = User::create($form_user);

        // create customer attributes
        $form_customer['id'] = $user->id;
        $form_customer['isStudent'] = $form['isStudent'];
        Customer::create($form_customer);

        // login the registrated user
        auth()->login($user);

        return redirect('/user');
    }

    // Login user
    public function login(Request $request)
    {
        $form = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // if login success
        if (auth()->attempt($form)) {
            $request->session()->regenerate();

            // if the authenticated user is customer
            if (auth()->user()->accessLevel == 0) {
                return redirect('/user')->with('message', 'Login Success!');
            }

            // if the authenticated user is staff
            elseif (auth()->user()->accessLevel == 1) {
                return redirect('/master');
            }

            // if the authenticated user is manager
            else {
                return redirect('/manager');
            }
        }

        // only show error message under username
        return back()->withErrors(['name' => 'Invalid Credentials'])->onlyInput('name');
    }

    // View customer dashboard
    public function view()
    {
        $user = User::where('id', '=', auth()->user()->id)->get()[0];
        $customer = Customer::where('id', '=', auth()->user()->id)->get()[0];
        $histories = History::where('userId', '=', auth()->user()->id)->get();
        $computers = Computer::all();

        return view('dashboardUser', compact('user', 'customer', 'histories', 'computers'));
    }

    // Update Customer account balance
    public function updateBalance(Request $request)
    {
        $form = $request->validate([
            'balance' => 'required',
        ]);

        // Update the customer's balance
        $customer = Customer::where('id', '=', auth()->user()->id)->get()[0];
        $customer['balance'] = $form['balance'] + $customer['balance'];
        $customer->save();

        return redirect('/')->with('message', 'Charge Success!');
    }

    // Logout user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logout Success!');
    }

    // View User Edit page
    public function editUser(User $user)
    {
        return view('userEdit', compact('user'));
    }

    // Update User Details
    public function updateUser(Request $request, User $user)
    {
        $form = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
        ]);

        $user->update($form);

        return redirect('/user')->with('message', 'Update Success!');
    }

    // Manage User
    public function userManage()
    {
        // get all customers and users
        $customers = Customer::all();
        $users = User::all();

        return view('userManage', compact('customers', 'users'));
    }

    // View Manager Dashboard
    public function viewManager()
    {
        // get total number of users (staffs + customers)
        $user_count = User::all()->count();

        // get total number of blacklisted users
        $blacklist_count = Customer::where('damageTime', '>=', 3)->count();

        // get not rented computers count
        $not_rented_count = Computer::where('isRented', '>=', 0)->count();

        // get not rented computers count
        $rented_count = Computer::where('isRented', '>=', 1)->count();

        // get not rented computers count
        $pending_count = Computer::where('isRented', '>=', 2)->count();

        return view('dashboardManager', compact(
            'user_count',
            'blacklist_count',
            'not_rented_count',
            'rented_count',
            'pending_count'
        ));
    }

    // Delete a staff
    public function delete(User $user)
    {
        $user->delete();
        return redirect('/user/manage')->with('message', 'Staff Deleted!');
    }

    // Create a staff
    public function create(Request $request)
    {
        $form = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        // hash password
        $form['password'] = bcrypt($form['password']);

        // Set up access level
        $form['accessLevel'] = 1;

        User::create($form);

        return redirect('/user/manage')->with('message', 'Staff Created!');
    }

    // Unblacklist a Customer
    public function unblacklist(User $user)
    {

        $customer = Customer::where('id', '=', $user->id)->get()[0];

        // Reset Customer's damage time into 0
        $customer['damageTime'] = 0;

        $customer->save();

        return redirect('/user/manage')->with('message', 'Customer Updated!');
    }
}
