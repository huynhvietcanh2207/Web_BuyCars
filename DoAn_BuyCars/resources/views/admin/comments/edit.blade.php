@extends('admin')

@section('main')
<div class="container bg-white p-4 shadow">
    <h1 class="h4">Chỉnh sửa Bình luận</h1>

    <form action="{{ route('comments.update', $comment->CommentId) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="CommentId">ID Bình luận</label>
            <input type="text" id="CommentId" class="form-control" value="{{ $comment->CommentId }}" readonly>
        </div>

        <div class="form-group">
            <label for="ProductId">ID Sản Phẩm</label>
            <input type="text" id="ProductId" class="form-control" value="{{ $comment->ProductId }}" readonly>
        </div>

        <div class="form-group">
            <label for="id">ID Người Dùng</label>
            <input type="text" id="id" class="form-control" value="{{ $comment->id }}" readonly>
        </div>

        <div class="form-group">
            <label for="CreatedAt">Ngày Tạo</label>
            <input type="text" id="CreatedAt" class="form-control"
                value="{{ \Carbon\Carbon::parse($comment->CreatedAt)->format('d/m/Y H:i:s') }}" readonly>
        </div>

        <div class="form-group">
            <label for="CommentText">Nội dung Bình luận</label>
            <textarea name="CommentText" id="CommentText" class="form-control"
                required>{{ old('CommentText', $comment->CommentText) }}</textarea>
            @if ($errors->has('CommentText'))
                <span class="text-danger">{{ $errors->first('CommentText') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('comments.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection