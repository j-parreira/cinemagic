<div {{ $attributes }}>
    @foreach ($screenings->groupBy('theater_id') as $theater => $screeningTheaters)
        <table class="table-auto border-collapse dark:text-gray-200 rounded">
            <thead>
            <tr>
                <th colspan="100%" class="px-2 py-2 text-xl">
                    Theater: {{\App\Models\Theater::find($theater)->name?? "Unknown Theater"}}
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach ($screeningTheaters->groupBy('date') as $date => $screeningDates)
                <tr class="border-b border-b-gray-200 dark:border-b-gray-700">
                @if($loop->last)
                    <tr>
                        @endif
                        <td class="px-2 py-2 w-40">
                            {{date('l, F j', strtotime($date))}}
                        </td>
                        @foreach ($screeningDates as $screening)
                            <td class="px-2 py-2 text-center dark:text-gray-400">
                                <a class="font-extrabold hover:underline underline-offset-2"
                                   href="#">{{date('H:i', strtotime($screening->start_time))}}</a>
                            </td>
                        @endforeach
                    </tr>
                    @endforeach

            </tbody>
        </table>
        <br>
    @endforeach
</div>
