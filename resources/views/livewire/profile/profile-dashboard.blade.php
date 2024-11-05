@extends('layouts.dashboard-layout')
@section('title', 'Buat Akun')
@section('content')

<div class="container my-3 space-y-5">
    <div>
        <div class="relative flex justify-center">
            <div class="w-full rounded-lg min-h-28 bg-slate-500"></div>
            <div class="absolute bg-black rounded-full inset-y-16 size-24"></div>
        </div>
        <div class="flex justify-center mt-12 text-center">
            <div>
                <div>Lorem, ipsum.</div>
                <div>Lorem.ipsum@gmail.com</div>
                <div>12 RPL 1</div>
            </div>
        </div>
    </div>
    <div class="space-y-5">
        <div class="">
            <div class="relative overflow-hidden border-2 border-transparent rounded-lg">
                <div class="border-b-2 border-[#a8b9ca] bg-[#e9f0f4] px-4 py-2 text-[#0b235e]">Personal</div>
                <div class="px-4 py-3 space-y-3 md:container md:flex md:items-center md:justify-between">
                    <div>
                        <div class="space-y-1">
                            <div class="text-sm text-[#798aa3] md:text-base">Gender</div>
                            <div class="text-lg text-[#0b235e] md:text-2xl">Male</div>
                        </div>
                    </div>
                    <div>
                        <div class="space-y-1">
                            <div class="text-sm text-[#798aa3] md:text-base">Religion</div>
                            <div class="text-lg text-[#0b235e] md:text-2xl">Atheis</div>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 h-full w-2 overflow-hidden rounded-l-md bg-[#0b235e]"></div>
            </div>
        </div>
        <div>
            <div class="">
                <div class="relative overflow-hidden border-2 border-transparent rounded-lg">
                    <div class="border-b-2 border-[#a8b9ca] bg-[#e9f0f4] px-4 py-2 text-[#0b235e]">Contact</div>
                    <div class="space-y-3 px-4 py-3 md:container md:grid md:grid-cols-2 md:gap-x-64 lg:gap-x-[40rem]">
                        <div>
                            <div class="space-y-1">
                                <div class="text-sm text-[#798aa3] md:text-base">Email</div>
                                <div class="text-lg text-[#0b235e] md:text-2xl">kelvin.yeboah@gmail.com</div>
                            </div>
                        </div>
                        <div>
                            <div class="space-y-1">
                                <div class="text-sm text-[#798aa3] md:text-base">Mobile Number</div>
                                <div class="text-lg text-[#0b235e] md:text-2xl">0234567891</div>
                            </div>
                        </div>
                        <div>
                            <div class="space-y-1">
                                <div class="text-sm text-[#798aa3] md:text-base">Alternate Mobile Number</div>
                                <div class="text-lg text-[#0b235e] md:text-2xl">0509876543</div>
                            </div>
                        </div>
                        <div>
                            <div class="space-y-1">
                                <div class="text-sm text-[#798aa3] md:text-base">Address</div>
                                <div class="text-lg text-[#0b235e] md:text-2xl">JI Wonokromo, sukolilo utara</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-y-0 h-full w-2 overflow-hidden rounded-l-md bg-[#0b235e]"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection