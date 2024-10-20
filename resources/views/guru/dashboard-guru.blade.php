@extends('layouts.dashboard-layout')
@section('title','dashboard')
@section('content')
<body>
    <div>
        <div class="container md:grid md:grid-cols-3 md:gap-3">
            <div class="p-3 my-3 space-y-4 border-2 rounded-md">
                <div class="space-y-2 text-[#0d3676]">
                    <div class="border-b">MATEMATIKA</div>
                    <div>J</div>
                </div>
                <div>
                    <div class="h-full w-full rounded-md bg-[#c0f090] py-2 text-center font-semibold hover:bg-green-300 active:bg-green-600">Absensi</div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection