@props(['title', 'value', 'description' => null, 'icon' => null])

<div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="p-5">
        <div class="flex items-center">
            @if($icon)
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center h-8 w-8 rounded-md bg-blue-primary text-white">
                        {!! $icon !!}
                    </div>
                </div>
            @endif
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                        {{ $title }}
                    </dt>
                    <dd class="text-lg font-medium text-gray-900">
                        {{ $value }}
                    </dd>
                    @if($description)
                        <dd class="text-sm text-gray-600">
                            {{ $description }}
                        </dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>
