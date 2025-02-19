@extends('layouts.main')

@section('header-title', 'Add new Theater')

@section('main')
    <div class="flex flex-col space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-900 shadow sm:rounded-lg">
            <div class="max-full">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Add New Theater
                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300  mb-6">
                            Click on "Save" button to store the information.
                        </p>
                    </header>

                    <form method="POST" action="{{ route('theaters.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mt-6 space-y-4">
                                @include('theaters.shared.fields', ['mode' => 'edit'])
                            <div class="flex mt-6">
                                <x-button element="submit" type="dark" text="Save New Theater" class="uppercase"/>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection
