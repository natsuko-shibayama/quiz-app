<x-app-layout>
    {{-- これはlayoutsのapp.blade.phpを指す。AppLayout.phpを見よ --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('管理者ページ') }}
        </h2>
    </x-slot>

    <style>
        .register_btn{
        background-color: darkcyan;
        padding: 10px;
        border-radius: 4px;
        color: white;
        }
        .register_btn:hover{
        color: black;
        background-color: #fff;
        border: 1px solid black;
        }
    </style>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 style="font-weight: bold; font-size:24px; padding-bottom:8px;">カテゴリの新規登録はこちらから！</h1>
                    <a type="button" class="register_btn" href="{{ route('admin.categories.create') }}">新規登録</a>
                </div>
                <div class="p-6 text-gray-900">
                    <h1 style="font-weight: bold; font-size:24px; padding-bottom:8px;">カテゴリ一覧はこちらから！</h1>
                    <a class="register_btn" href="{{ route('admin.categories.index') }}">カテゴリ一覧</a>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>
