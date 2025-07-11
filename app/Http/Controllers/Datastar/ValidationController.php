<?php

namespace App\Http\Controllers\Datastar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ValidationController extends Controller
{
    // use DatastarEventStream;

    public function sse()
    {
        return view('demos.datastar-sse-validation.index');
    }

    public function sseValidate()
    {

        $sse = new \starfederation\datastar\ServerSentEventGenerator();
        $sse->sendHeaders();

        $signals = \starfederation\datastar\ServerSentEventGenerator::readSignals();

        $validation_errors = $this->requestIsValid($signals);

        $html = view('demos.datastar-sse-validation.errors', compact('validation_errors'))->render();
        $sse->patchElements($html);

    }
    public function sseCreate()
    {
        sleep(3);
        $validation_errors = $this->requestIsValid();
        if ($validation_errors) {
            return view('demos.datastar-sse-validation.form', compact('validation_errors'));
        }
        return view('demos.datastar-sse-validation.success');
    }

    public function index()
    {
        return view('demos.datastar-validation.index');
    }

    public function validate()
    {
        $validation_errors = $this->requestIsValid();
        //dd($validation_errors);
        return view('demos.datastar-validation.errors', compact('validation_errors'));
    }

    public function create()
    {
        sleep(3);
        $validation_errors = $this->requestIsValid();
        if ($validation_errors) {
            return view('demos.datastar-validation.form', compact('validation_errors'));
        }
        return view('demos.datastar-validation.success');
    }



    public function requestIsValid($input = null)
    {
        if (!$input) {
            $input = request()->input();
        }
        // Use provided parameters or fall back to request() values
        $name = $input['name'] ?? '';
        $raw_ssn = $input['ssn'] ?? '';
        $ssn = str_replace('-', '', $raw_ssn);
        $email = $input['email'] ?? '';
        $raw_password = $input['create_password'] ?? '';
        $password = null;
        if ($raw_password) {
            $password = Hash::make($raw_password);
        }
        $raw_confirm_password = $input['confirm_password'] ?? '';
        $confirm_password = null;
        if ($raw_confirm_password) {
            $confirm_password = Hash::make($raw_confirm_password);
        }

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
            if ($raw_password) {
                if (Hash::check($raw_password, $user->password)) {
                    $matches[] = $user->email;
                }
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
        if (!$raw_confirm_password) {
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
