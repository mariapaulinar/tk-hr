<div class="container mx-auto py-8">
    <div class="overflow-x-auto px-4">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
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
                    <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                        <td class="px-4 py-2 border-b border-gray-200 flex items-right">
                            <span class="mr-2">
                                @switch($country->country)
                                    @case('Colombia')
                                        🇨🇴
                                        @break
                                    @case('Spain')
                                        🇪🇸
                                        @break
                                    @case('France')
                                        🇫🇷
                                        @break
                                    @case('Portugal')
                                        🇵🇹
                                        @break
                                    @case('Netherlands')
                                        🇳🇱
                                        @break
                                    @case('Belgium')
                                        🇧🇪
                                        @break
                                    @case('Sweden')
                                        🇸🇪
                                        @break
                                    @case('Norway')
                                        🇳🇴
                                        @break
                                    @case('Denmark')
                                        🇩🇰
                                        @break
                                    @case('UK')
                                        🇬🇧
                                        @break
                                    @default
                                        🏳️
                                @endswitch
                            </span>
                            <span>{{ $country->country }}</span>
                        </td>
                        <td class="px-4 py-2 border-b border-gray-200 text-center">{{ $country->male }}</td>
                        <td class="px-4 py-2 border-b border-gray-200 text-center">{{ $country->female }}</td>
                        <td class="px-4 py-2 border-b border-gray-200 text-center">{{ $country->total }}</td>
                    </tr>
                @endforeach
                <tr class="font-bold">
                    <td class="px-4 py-2 border-t border-gray-200 text-center">TOTAL</td>
                    <td class="px-4 py-2 border-t border-gray-200 text-center">{{ $totals['male'] }}</td>
                    <td class="px-4 py-2 border-t border-gray-200 text-center">{{ $totals['female'] }}</td>
                    <td class="px-4 py-2 border-t border-gray-200 text-center">{{ $totals['total'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>