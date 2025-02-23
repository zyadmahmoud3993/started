<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $this->identify = filter_var(request()->input('identify') , FILTER_VALIDATE_EMAIL ) ? "email" : 'mobile';
        $emailOrInteger = $this->identify == 'email' ? 'email' : 'integer';
        return [
            'identify' => ['required', "$emailOrInteger","exists:users,$this->identify"],
            'password' => ['required', 'string'],
        ];
    }
    public function messages(): array
    {
        return [
            'identify.exists' => 'غير موجود',
            'identify.integer'=> 'يجب ان يكون بريد اكتروني صحيح او عددًا صحيحًا'
        ];
    }
    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    // التحقق إذا كان الإدخال هو بريد إلكتروني أو رقم هاتف
    // $identify = filter_var($this->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
    // $inputs = [
    //     $identify => $this->input('identify'),
    //     'password'=> $this->input('password')
    // ];
    
    if (!Auth::attempt([$this->identify => request()->input('identify'), 'password' => request()->input('password')], $this->boolean('remember'))) {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'identify' => trans('auth.failed'), // رسالة الخطأ عند الفشل
        ]);
    }

    // مسح الـ RateLimiter عند النجاح
    RateLimiter::clear($this->throttleKey());
}

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
