<div class="container mx-auto py-8">
    <div class="overflow-x-auto px-4">
        <table class="w-full bg-white border border-gray-200 shadow-md rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b border-gray-200"></th>
                    <th class="px-4 py-2 border-b border-gray-200 text-center">Male</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-center">Female</th>
                    <th class="px-4 py-2 border-b border-gray-200 text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td class="px-4 py-2 border-b border-gray-200 flex items-right">
                            <span class="mr-2">
                            <img
                                src="https://flagcdn.com/32x24/{{ $country->country_code }}.png"
                                srcset="https://flagcdn.com/64x48/{{ $country->country_code }}.png 2x,
                                    https://flagcdn.com/96x72/{{ $country->country_code }}.png 3x"
                                width="32"
                                    height="24"
                                    alt="{{ $country->country_name }}">
                            </span>
                            <span>{{ $country->country_name }}</span>
                        </td>
                        <td class="px-4 py-2 border-b border-gray-200 text-center">{{ $country->male }}</td>
                        <td class="px-4 py-2 border-b border-gray-200 text-center">{{ $country->female }}</td>
                        <td class="px-4 py-2 border-b border-gray-200 text-center">{{ $country->total }}</td>
                    </tr>
                @endforeach
                <tr class="font-bold">
                    <th class="px-4 py-2 border-t border-gray-200 text-center">Total</th>
                    <td class="px-4 py-2 border-t border-gray-200 text-center">{{ $totals['male'] }}</td>
                    <td class="px-4 py-2 border-t border-gray-200 text-center">{{ $totals['female'] }}</td>
                    <td class="px-4 py-2 border-t border-gray-200 text-center">{{ $totals['total'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>