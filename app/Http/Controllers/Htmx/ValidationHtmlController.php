<?php

namespace App\Http\Controllers\Htmx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ValidationHtmlController extends Controller
{
    public function index()
    {
        return view('demos.html-validation.index');
    }
    public function validate()
    {
        $errors = $this->requestIsValid();
        return view('demos.html-validation.errors', compact('errors'));
    }
    public function create()
    {
        $errors = $this->requestIsValid();
        if ($errors) {
            return view('demos.html-validation.index', compact('errors'));
        }
        return view('demos.html-validation.success');
    }

    public function requestIsValid()
    {
        $name = request('name');
        $ssn = request('ssn');
        $email = request('email');
        $raw_password = request('create_password');
        $password = Hash::make(request('create_password'));
        $raw_confirm_password = request('confirm_password');
        $confirm_password = Hash::make(request('confirm_password'));

        $errors = [];

        // =======================> Name
        if (!$name) {
            $errors['name']['required'] = 'Name is required.';
        }
        if (!str_contains(strtolower($name), 'z')) {
            $errors['name']['contains_z'] = 'Name must contain a Z.';
        }

        // =======================> SSN
        if (!$ssn) {
            $errors['ssn']['required'] = 'SSN is required.';
        }
        if (!is_numeric($ssn) || strlen($ssn) != 9) {
            $errors['ssn']['nine_digits'] = 'SSN must contain 9 digits.';
            $errors['ssn']['verified'] = 'SSN must be registered and verified.';
        } else {
            if (!$this->verifySSN($ssn)) {
                $errors['ssn']['verified'] = 'SSN must be registered and verified.';
            }
        }

        // =======================> Email
        if (!$email) {
            $errors['email']['required'] = 'Email is required.';
        }
        if (!$email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email']['format'] = 'Email must be valid format.';
        }
        $user = User::where('email', $email)
                    ->exists();
        if ($user) {
            $errors['email']['unique'] = 'Email must be unique.';
        }

        // =======================> Create Password
        if (!$raw_password) {
            $errors['create_password']['required'] = 'Create Password is required.';
        }
        $user = User::where('password', $password)
                    ->first();
        if ($user) {
            $errors['create_password']['unique'] = 'Password must be unique. Did you mean to use email '.$user->email."?";
        }
        if (strlen($raw_password) < 7) {
            $errors['create_password']['length'] = 'Password must be 7+ characters.';
        }

        $has_special_characters = preg_match('/[^a-zA-Z0-9]/', $raw_password);
        if (!$has_special_characters) {
            $errors['create_password']['special'] = 'Password must contain a special character.';
        }

        // =======================> Confirm Password
        if (!request('confirm_password')) {
            $errors['confirm_password']['required'] = 'Confirm Password is required.';
        }
        if ($raw_password != $raw_confirm_password) {
            $errors['confirm_password']['match'] = 'Confirm Password must match Create Password.';
        }


        if (count($errors) > 0) {
            return $errors;
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
