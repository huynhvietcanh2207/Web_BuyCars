@extends('admin')
@section('main')
<div class="container">
    <h1 class="h4 mb-4">Thêm người dùng</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit"  class="btn btn-success" >Create</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>

    </form>
</div>
@endsection