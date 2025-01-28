@extends('layouts.sideNav')

@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header bg-info">
                <h4>Update Web Content</h4>
            </div>
            <div class="card-body">
                <form action="{{route('web.content.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Home Description</label>
                        <input type="hidden" name="id" value="{{$webcontents->id}}">
                        <textarea name="desp" class="form-control">{{$webcontents->desp}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" value="{{$webcontents->address}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Whatsapp</label>
                        <input type="text" name="whatsapp" class="form-control" value="{{$webcontents->whatsapp}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{$webcontents->email}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Charge</label>
                        <input type="number" name="charge" class="form-control" value="{{$webcontents->charge}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quran Meet Link</label>
                        <input type="text" name="quran_link" class="form-control" value="{{$webcontents->quran_link}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bkash Number</label>
                        <input type="number" name="bkash" class="form-control" value="{{$webcontents->bkash}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nagad Number</label>
                        <input type="number" name="nagad" class="form-control" value="{{$webcontents->nagad}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rocket Number</label>
                        <input type="number" name="rocket" class="form-control" value="{{$webcontents->rocket}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if (session('success'))
<script>
    toastify().success("{{ session('success') }}");

</script>
@endif
@endsection
