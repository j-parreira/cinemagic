@extends('layouts.main')

@section('header-title', 'Customer ')

@section('main')
    <div class="flex justify-center">
        <div class="my-4 p-6 bg-white w-full dark:bg-gray-900 overflow-hidden
                    shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-50">
            <x-customer.filter-card
                :filterAction="route('customers.index')"
                :resetUrl="route('customers.index')"
                :search="old('search', $filterByName)"
                :payment="old('payment_type', $filterByPayment)"
                class="mb-6"
            />
            <hr class="dark:border-gray-700">
            <br>
            @if($customers->count() > 0)
                <div class="font-base text-sm text-gray-700 dark:text-gray-300">
                    <x-customer.table :customers="$customers"
                                      :showView="false"
                                      :showEdit="false"
                                      :showDelete="true"
                    />
                </div>
                <div class="mt-4">
                    {{ $customers->links() }}
                </div>
            @else
                <div class="flex items-center justify-center font-bold">No Customers found</div>
            @endif

        </div>
    </div>
@endsection
