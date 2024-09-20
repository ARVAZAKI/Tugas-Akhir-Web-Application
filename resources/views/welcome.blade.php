<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-gray-100">   
        <div class="min-h-screen flex flex-col lg:flex-row">
            <div class="w-full lg:w-1/2 flex justify-center items-center p-4 lg:p-8">
                <div class="w-full max-w-md">                
                    <div class="font-bold text-3xl mb-8 text-center text-[#0B235E]">EduSecure</div>
                    <div class="space-y-4">
                        <a href="{{route('login')}}" wire:navigate class="w-full bg-[#0B235E] text-white py-4 px-6 rounded-lg flex justify-between items-center hover:bg-blue-800 transition-colors no-underline">
                            <div>
                                <div class="text-xl font-bold">Student</div>
                                <div class="text-sm">Access the students' portal here.</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        
                        @if (Route::has('login'))
                        <a href="{{route('login')}}" wire:navigate class="w-full bg-gray-100 text-[#0B235E] py-4 px-6 rounded-lg flex justify-between items-center hover:bg-gray-200 transition-colors no-underline">
                            <div>
                                <div class="text-xl font-bold">Teacher / Staff</div>
                                <div class="text-sm">Exclusive to teacher/staff members only.</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        @endif
                        <a href="{{route('login')}}" wire:navigate class="w-full bg-[#0B235E] text-white py-4 px-6 rounded-lg flex justify-between items-center hover:bg-blue-800 transition-colors no-underline">
                            <div>
                                <div class="text-xl font-bold">Visitor</div>
                                <div class="text-sm">Exclusive to visitor only.</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 bg-[#0B235E] lg:h-screen"></div>
        </div>
        @livewireScripts
    </body>
</html>