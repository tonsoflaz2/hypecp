<?php

namespace App\Http\Controllers\Htmx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ValidationController extends Controller
{
    public function index()
    {
        return view('demos.htmx-validation.index');
    }

    public function validate()
    {
        $validation_errors = $this->requestIsValid();
        //dd($validation_errors);
        return view('demos.htmx-validation.errors', compact('validation_errors'));
    }

    public function create()
    {
        sleep(3);
        $validation_errors = $this->requestIsValid();
        if ($validation_errors) {
            return view('demos.htmx-validation.form', compact('validation_errors'));
        }
        return view('demos.htmx-validation.success');
    }

    public function requestIsValid()
    {
        $name = request('name');
        $raw_ssn = request('ssn');
        $ssn = str_replace('-', '', $raw_ssn);
        $email = request('email');
        $raw_password = request('create_password');
        $password = Hash::make(request('create_password'));
        $raw_confirm_password = request('confirm_password');
        $confirm_password = Hash::make(request('confirm_password'));

        $validation_errors = [];

        // =======================> Name
        if (!$name) {
            $validation_errors['name']['required'] = 'Name is required.';
        }
        if (!str_contains(strtolower($name), 'z')) {
            $validation_errors['name']['contains_z'] = 'Name must contain a Z.';
        }

        // =======================> SSN
        if (!$ssn) {
            $validation_errors['ssn']['required'] = 'SSN is required.';
        }
        if (!is_numeric($ssn) || strlen($ssn) != 9) {
            $validation_errors['ssn']['nine_digits'] = 'SSN must contain 9 digits.';
            $validation_errors['ssn']['verified'] = 'SSN must be registered and verified.';
        } else {
            if (!$this->verifySSN($ssn)) {
                $validation_errors['ssn']['verified'] = 'SSN must be registered and verified.';
            }
        }

        // =======================> Email
        if (!$email) {
            $validation_errors['email']['required'] = 'Email is required.';
        }
        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors['email']['format'] = 'Email must be valid format.';
        }
        $user = User::where('email', $email)
                    ->exists();
        if ($user) {
            $validation_errors['email']['unique'] = 'Email must be unique.';
        }

        // =======================> Create Password
        if (!$raw_password) {
            $validation_errors['create_password']['required'] = 'Create Password is required.';
        }
        $users = User::all();
        //dd(Hash::make('firefly!'));
        //dd($users);

        foreach ($users as $user) {
            $matches = [];
            if (Hash::check($raw_password, $user->password)) {
                $matches[] = $user->email;
            }
            if (count($matches) > 0) {
                $validation_errors['create_password']['unique'] = 'Password must be unique. Did you mean to use email '.implode(', ',$matches)."?";
            }
        }
        if (strlen($raw_password) < 7) {
            $validation_errors['create_password']['length'] = 'Password must be 7+ characters.';
        }

        $has_special_characters = preg_match('/[^a-zA-Z0-9]/', $raw_password);
        if (!$has_special_characters) {
            $validation_errors['create_password']['special'] = 'Password must contain a special character.';
        }

        // =======================> Confirm Password
        if (!request('confirm_password')) {
            $validation_errors['confirm_password']['required'] = 'Confirm Password is required.';
        }
        if ($raw_password != $raw_confirm_password) {
            $validation_errors['confirm_password']['match'] = 'Confirm Password must match Create Password.';
        }


        if (count($validation_errors) > 0) {
            return $validation_errors;
        }
        return null;
    }

    public function verifySSN($ssn)
    {
        // Perform lookup to SSA Registry
        // sleep(1);
        return true;
    }
    
}
