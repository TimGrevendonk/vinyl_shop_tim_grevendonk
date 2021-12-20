@extends('layouts.template')

@section("title, The Vinyl Shop")

@section('main')
    <h1>Contact us</h1>
{{--    will get the alert box --}}
    @include("shared.alert")
    @if( !session()->has('success') )
    <form action="/contact-us" method="post" novalidate>
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name"
{{--            Class does a check for errors and places "invalid" in class if so --}}
{{--            first = the first (error) message of the "name" --}}
                   class="form-control {{ $errors->any() ? ($errors->first('name') ? 'is-invalid' : 'is-valid') : '' }}"
                   placeholder="Your name"
                   required
                   value="{{ old("name") }}">
{{--            The alert block that displays if the form content was invalid. --}}
            <div class="invalid-feedback">{{ $errors->first('name') }} </div>
        </div >
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control  {{ $errors->any() ? ($errors->first('email') ? 'is-invalid' : 'is-valid') : '' }}"
                   placeholder="Your email"
                   required
                   value="{{ old("email", "jane.doe@example.com") }}">
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <select name="contact" id="contact"
                    class="form-control {{ $errors->any() ? ($errors->first('contact') ? 'is-invalid' : 'is-valid') : '' }}"
                    required>
                <option value="{{ old("contact") }}" selected>select a contact</option>
                <option value="info@thevinylshop.com">info</option>
                <option value="billing@thevinylshop.com">billing</option>
                <option value="support@thevinylshop.com">support</option>
            </select>
            <div class="invalid-feedback">{{ $errors->first('contact') }}</div>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="5"
                      class="form-control {{ $errors->any() ? ($errors->first('message') ? 'is-invalid' : 'is-valid') : '' }}"
                      placeholder="Your message"
                      required
                      minlength="10">{{ old("message", "default message through 'old' laravel function.") }}</textarea>
            <div class="invalid-feedback">{{ $errors->first('message') }}</div>
        </div>
        <button type="submit" class="btn btn-success">Send Message</button>
    </form>
    @endif
@endsection
