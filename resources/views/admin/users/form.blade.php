@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="{{ old('name', $user->name ?? '') }}"
           minlength="3"
           required
           value="{{ old('name', $user->name ?? '') }}">
    <div class="invalid-feedback">{{ $errors->first('name') }} </div>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" id="email"
           class="form-control @error('email') is-invalid @enderror"
           placeholder="{{ old('email', $user->email ?? '') }}"
           minlength="3"
           required
           value="{{ old('email', $user->email ?? '') }}">
    <div class="invalid-feedback">{{ $errors->first('email') }} </div>
</div>
<div class="form-group">
    <input type="checkbox" class="form-check-input" name="active" id="active" value="1" @if($user->active == 1) checked @endif >
    <label for="active" class="form-check-label">active</label>
</div>
<div class="form-group">
    <input type="checkbox" class="form-check-input" name="admin" id="admin" value="1"  @if($user->admin == 1) checked @endif>
    <label for="admin" class="form-check-label">admin</label>
</div>
@error('name')
<div class="invalid-feedback">{{ $message }}</div>
@enderror
@error('email')
<div class="invalid-feedback">{{ $message }}</div>
@enderror

<button type="submit" class="btn btn-success">Save user</button>
