@extends('layouts.main') @section('title') Lỗi @endsection @section('content')

<div class="misc-wrapper">
    <div class="misc-inner p-2 p-sm-3">
        <div class="w-100 text-center">
            <h2 class="m-b-20">
                Bạn không có quyền truy cập tính năng này! 🔐
            </h2>
            <p class="m-b-20">Vui lòng liên hệ quản trị viên.</p>
            <a
                class="btn btn-primary m-b-20"
                href="javascript:void(0)"
                onclick="history.back()"
                >Quay lại</a
            >
        </div>
    </div>
</div>
@endsection @section('page-script')
<script type="text/javascript"></script>
@endsection
